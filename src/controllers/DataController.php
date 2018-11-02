<?php

namespace VincentNt\ContentManager\Controllers;

use App\Http\Controllers\Controller;
use VincentNt\ContentManager\Models\Page;
use Yajra\DataTables\DataTables;


class DataController extends Controller
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
}

