<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Yajra\DataTables\Facades\DataTables;

trait TrashController
{
    public function trash()
    {
        $data = $this->model::onlyTrashed()->orderby('deleted_at', 'desc')->get();
        $url = $this->url;
        if (request()->ajax()) {
            return DataTables::of($data)
                ->editColumn('deleted_at', function ($order) {
                    return \Carbon\Carbon::parse($order->deleted_at)->format('d F Y, H:i');
                })
                ->rawColumns(['description'])
                ->addIndexColumn()
                ->make(true);
        }
        return view($this->path . 'trash', compact('data', 'url'));
    }
}
