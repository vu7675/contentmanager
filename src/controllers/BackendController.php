<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contentmanager::index');
    }

}
