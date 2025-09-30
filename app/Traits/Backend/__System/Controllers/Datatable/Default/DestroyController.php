<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Default;

use Illuminate\Support\Facades\Cache;

trait DestroyController
{
    public function destroy($id)
    {
        try {
            $this->model::destroy($id);
            Cache::forget($this->url);
            return redirect($this->url)->with('success', __('default.notification.success.item_deleted'));
        } catch (\Exception $e) {
            return redirect($this->url)->with('error', __('default.notification.error'));
        }
    }
}
