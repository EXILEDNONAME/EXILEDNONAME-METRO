<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

trait InactiveController
{
    public function inactive($id = null)
    {
        if (!$id) {
            return redirect('/dashboard')->with('error', __('default.notification.error.restrict'));
        }

        if (Auth::User()->id != 1 && Auth::User()->id != 2 && $this->model::where('id', $id)->first()->created_by != Auth::User()->id) {
            $data = 'ACCESS RESTRICT!';
            return Response::json($data, 403);
        } else {
            $data = $this->model::where('id', $id)->update(['active' => 0]);
            Cache::forget($this->url);
            return Response::json($data);
        }
    }
}
