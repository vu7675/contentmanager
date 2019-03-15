<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Events\EditBodyContent;
use App\Events\UploadCover;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contentmanager::posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('contentmanager::posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->all();
            $data['slug'] = str_slug($data['title']);
            $data['body'] = event(new EditBodyContent($request['summer_note']))[0];
            $data['cover'] = event(new UploadCover($request->file('cover'), 'post'))[0];
            $post = Post::create(array_except($data, ['_method', '_token', 'summer_note', 'files', 'categories']));
            $post->categories()->sync(array_values($data['categories']));
            DB::commit();
            return redirect('/admin/posts')->with('success','Item successfully created');
        }catch (\Exception $e){
            $e->getMessage();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->model->find($id);
        return view('contentmanager::posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::select('id', 'name')->get();
        return view('contentmanager::posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        try{
            $data = $request->all();
            DB::beginTransaction();
            $data['slug'] = str_slug($request['title']);
            $data['body'] = event(new EditBodyContent($request['summer_note']))[0];
            $data['cover'] = $request->file('cover') == null ? $post->cover : event(new UploadCover($request->file('cover'), 'post'))[0];
            $post->update(array_except($data, ['_method', '_token', 'summer_note', 'files','categories']));
            $post->categories()->sync(array_values($data['categories']));
            DB::commit();
            return redirect()->back()->with('success','Item successfully updated');
        }catch (\Exception $e){
            $e->getMessage();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->delete()) {
            return 1;
        }
        return 0;

    }
}
