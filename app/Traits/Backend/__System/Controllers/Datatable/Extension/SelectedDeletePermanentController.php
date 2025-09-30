<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

trait SelectedDeletePermanentController
{
    public function selected_delete_permanent(Request $request)
    {
        $data = $request->EXILEDNONAME;
        $ids = explode(",", $data);

        if (Auth::User()->id != 1 && Auth::User()->id != 2 && $this->model::whereIn('id', $ids)->where('created_by', '!=', Auth::User()->id)->exists()) {
            $response = 'ACCESS RESTRICT!';
            return Response::json($response, 403);
        } else {
            $this->model::whereIn('id', $ids)->forceDelete();
            Cache::forget($this->url);
            return Response::json($data);
        }
    }
}
