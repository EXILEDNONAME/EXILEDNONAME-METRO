<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

trait RestoreController
{
    public function restore($id = null)
    {
        if (!$id) {
            return redirect('/dashboard')->with('error', __('default.notification.error.restrict'));
        }

        if (Auth::User()->id != 1 && Auth::User()->id != 2 && $this->model::where('id', $id)->first()->created_by != Auth::User()->id) {
            $data = 'ACCESS RESTRICT!';
            return Response::json($data, 403);
        } else {
            $data = $this->model::withTrashed()->findOrFail($id);
            if ($data->trashed()) {
                $data->restore();
                $data = $this->model::where('id', $id)->update(['deleted_at' => NULL]);
                Cache::forget($this->url);
                return Response::json($data);
            } else {
                Cache::forget($this->url);
                return Response::json($data);
            }
        }
    }
}
