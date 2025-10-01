<?php

namespace App\Http\Requests\Backend\__System\Application\Datatable\Relation;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            // 
        ];
    }

    public function persist()
    {
        $model  = app('current.model');
        $url    = app('current.url');
        $data   = $model::findOrFail($this->route('id'));
        $data->fill($this->all());

        if ($this->hasFile('file')) {
            $file = $this->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/files/form-uploads'), $filename);
            $data['file'] = $filename;
        }

        $dirty = collect($data->getDirty())->except('updated_at');
        if ($dirty->isEmpty()) {
            session()->flash('success', __('default.notification.success.item_ignored'));
            return response()->json(['status' => 'success', 'redirect_url' => url($url)], 200);
        }

        $data->save();
        \Cache::forget($url);
        session()->flash('success', __('default.notification.success.item_updated'));
        return response()->json(['status' => 'success', 'redirect_url' => url($url)], 200);
    }
}
