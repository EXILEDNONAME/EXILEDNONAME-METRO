<?php

namespace App\Http\Requests\Backend\__System\Administrative\Management\Permission;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class StoreRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', Rule::unique('model_has_roles')->where(function ($query) {
                return $query->where('model_id', $this->model_id);
            })],
        ];
    }

    public function messages(): array
    {
        return [
            'validate_without_spaces' => 'Spaces are not allowed.',
            'role_id.unique' => 'Role has already been taken.',
        ];
    }

    public function persist()
    {
        $model  = app('current.model');
        $url    = app('current.url');

        $data = $this->validated();
        $requestData = $this->except(['updated_at']);

        $data   = $model::create($requestData);

        Cache::forget($url);
        session()->flash('success', __('default.notification.success.item_created'));
        return response()->json(['status'  => 'success', 'redirect_url' => url($url)], 200);
    }
}
