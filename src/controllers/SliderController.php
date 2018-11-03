<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('contentmanager::sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contentmanager::sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $dom = new \DOMDocument();
        $dom->loadHtml($data['body'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = '/images/' . uniqid() . '.jpg';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }
        $detail = $dom->saveHTML();
        $this->model->create([
            'body' => $detail,
            'title' => $request->title,
            'slug' => str_slug($request->title),
        ]);
        return redirect('/admin/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = $this->model->find($id);
        return view('contentmanager::sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('contentmanager::sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $slider->update($data);
        return redirect('/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect('sliders');
    }
}
