<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\Hash;

trait ResetPasswordSingleController
{
    public function reset_password_single($id)
    {
        $data = $this->model::where('id', $id)->update([
            'password'  => Hash::make('12345678'),
        ]);
        return redirect($this->url)->with('success', __('default.notification.success.reset-password'));
    }
}
