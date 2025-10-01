<?php

namespace App\Http\Requests\Backend\__System\Administrative\Management\Role;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

Validator::extend('validateWithoutSpaces', function ($attribute, $value, $parameters, $validator) {
    return !Str::contains($value, ' ');
});

class StoreRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'validateWithoutSpaces', 'alpha-dash', 'unique:roles'],
        ];
    }

    public function messages(): array
    {
        return [
            'validate_without_spaces' => 'Spaces are not allowed.',
        ];
    }

    public function persist()
    {
        $model  = app('current.model');
        $url    = app('current.url');

        $data = $this->validated();
        $requestData = $this->except(['updated_at']);

        $data   = $model::create($requestData);

        \Cache::forget($url);
        session()->flash('success', __('default.notification.success.item_created'));
        return response()->json(['status'  => 'success', 'redirect_url' => url($url)], 200);
    }
}
