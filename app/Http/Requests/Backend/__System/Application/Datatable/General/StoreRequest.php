<?php

namespace App\Http\Requests\Backend\__System\Application\Datatable\General;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Cache;

class StoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:15', 'unique:system_application_table_generals,name'],
        ];
    }

    public function persist()
    {
        $file = $this->file('file');
        $model  = app('current.model');
        $url    = app('current.url');

        $data = $this->validated();
        $requestData = $this->except(['updated_at']);

        if ($this->hasFile('file')) {
            $file = $this->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/files/form-uploads'), $filename);
            $requestData['file'] = $filename;
        }

        $data   = $model::create($requestData);

        Cache::forget($url);
        session()->flash('success', __('default.notification.success.item_created'));
        return response()->json(['status'  => 'success', 'redirect_url' => $url], 200);
    }
}
