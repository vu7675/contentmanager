<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Post;
use Yajra\DataTables\DataTables;


class DataController extends AdminController
{
    protected $dataTables;

    /**
     * DataController constructor.
     */
    public function __construct(DataTables $dataTables)
    {
        $this->dataTables = $dataTables;
    }

    public function pageData()
    {
        $pages = Page::orderByDesc('id')->get();
        return Datatables::of($pages)
            ->addColumn('actions', function ($page) {
                return '<a href="' . route('pages.edit', $page->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $page->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }

    public function postData()
    {
        $posts = Post::orderByDesc('id')->get();
        return Datatables::of($posts)
            ->addColumn('actions', function ($post) {
                return '<a href="' . route('posts.edit', $post->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $post->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }
}

