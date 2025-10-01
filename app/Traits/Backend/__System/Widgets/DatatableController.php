<?php

namespace App\Traits\Backend\__System\Widgets;

use App\Models\Backend\__System\Application\Datatable\General;
use DataTables;
use Illuminate\Http\Request;
use Redirect, Response;

trait DatatableController {

  public function widget_datatable(Request $request) {
    if ($request->ajax()) {
        $query = General::orderBy('id', 'desc')->take(5)->get();

        return DataTables::of($query)
        ->addIndexColumn()
        ->editColumn('created_at', function ($order) { return empty($order->created_at) ? NULL : \Carbon\Carbon::parse($order->created_at)->format('d F Y, H:i'); })
        ->make(true);
    }

    return abort(404);
  }

}
