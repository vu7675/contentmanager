<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Category;
use App\Page;
use App\Post;
use App\Role;
use App\Slider;
use App\User;
use Yajra\DataTables\DataTables;


class DataController extends BackendController
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
        $pages = Page::orderByDesc('id')->latest();
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
        $posts = Post::orderByDesc('id')->latest();
        return Datatables::of($posts)
            ->addColumn('actions', function ($post) {
                return '<a href="' . route('posts.edit', $post->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $post->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }
    public function categoryData()
    {
        $categories = Category::orderByDesc('id')->latest();
        return Datatables::of($categories)
            ->addColumn('actions', function ($category) {
                return '<a href="' . route('categories.edit', $category->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $category->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }

    public function userData()
    {
        $users = User::orderByDesc('id')->latest();
        return Datatables::of($users)
            ->addColumn('actions', function ($user) {
                return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $user->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }

    public function roleData()
    {
        $roles = Role::orderByDesc('id')->latest();
        return Datatables::of($roles)
            ->addColumn('actions', function ($role) {
                return '<a href="' . route('roles.edit', $role->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $role->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }

    public function adminData()
    {
        $admins = Admin::orderByDesc('id')->latest();
        return Datatables::of($admins)
            ->addColumn('actions', function ($admin) {
                return '<a href="' . route('admins.edit', $admin->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $admin->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }

    public function sliderData()
    {
        $sliders = Slider::orderByDesc('id')->latest();
        return Datatables::of($sliders)
            ->addColumn('actions', function ($slider) {
                return '<a href="' . route('sliders.edit', $slider->id) . '" class="btn btn-warning btn-sm btn-margin-right"><i class="cui-pencil"></i></a>
                        <a href="javascript:deleteObject(' . $slider->id . ');" class="btn btn-danger btn-sm"><i class="cui-trash"></i></a>';
            })
            ->escapeColumns(null)
            ->toJson();
    }
}

