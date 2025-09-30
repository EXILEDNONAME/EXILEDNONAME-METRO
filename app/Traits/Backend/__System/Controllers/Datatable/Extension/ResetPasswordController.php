<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

trait ResetPasswordController
{
    public function reset_password($id)
    {
        $data = $this->model::where('id', $id)->update([
            'password'  => Hash::make('12345678'),
        ]);
        Cache::forget($this->url);
        return Response::json($data);
    }
}
