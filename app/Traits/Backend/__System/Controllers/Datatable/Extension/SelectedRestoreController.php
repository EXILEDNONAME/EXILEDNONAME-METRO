<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

trait SelectedRestoreController
{
    public function selected_restore(Request $request)
    {
        $data = $request->EXILEDNONAME;
        $ids = explode(",", $data);
        $firstId = $ids[0] ?? null;
        if (Auth::User()->id != 1 && Auth::User()->id != 2 && $firstId && $this->model::where('id', $firstId)->first()->created_by != Auth::User()->id) {
            $data = 'ACCESS RESTRICT!';
            return Response::json($data, 403);
        } else {
            $data = $request->EXILEDNONAME;
            $this->model::whereIn('id', explode(",", $data))->restore();
            Cache::forget($this->url);
            return Response::json($data);
        }
    }
}
