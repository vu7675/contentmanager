<?php

namespace App\Listeners;

use App\Events\EditBodyContent;

class UploadImageAndAppendToBody
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EditBodyContent $event
     * @return void
     */
    public function handle(EditBodyContent $event)
    {
        $body = $event->body;
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            if(strpos('/images/', $data)!=0){
                list(, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = '/images/' . uniqid() . '.jpg';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $img->setattribute('src', $image_name);
            }
        }
        $body = $dom->saveHTML();
        return $body;
    }
}
