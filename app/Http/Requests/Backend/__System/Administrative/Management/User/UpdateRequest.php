<?php

namespace App\Http\Requests\Backend\__System\Administrative\Management\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

Validator::extend('validateWithoutSpaces', function ($attribute, $value, $parameters, $validator) {
  return !Str::contains($value, ' ');
});

class UpdateRequest extends BaseFormRequest {

  public function rules(): array {
    return [
      'email'     => ['required', Rule::unique('users', 'email')->ignore($this->id), Rule::unique('users', 'phone')->ignore($this->id), Rule::unique('users', 'username')->ignore($this->id)],
      'phone'     => ['required', Rule::unique('users', 'email')->ignore($this->id), Rule::unique('users', 'phone')->ignore($this->id), Rule::unique('users', 'username')->ignore($this->id)],
      'username'  => ['required', 'validateWithoutSpaces', Rule::unique('users', 'email')->ignore($this->id), Rule::unique('users', 'phone')->ignore($this->id), Rule::unique('users', 'username')->ignore($this->id)],
    ];
  }

  public function messages(): array {
    return [
      'validate_without_spaces' => 'Spaces are not allowed.',
    ];
  }

  public function persist() {
    $id = $this->route('id');
    $model  = app('current.model');
    $url    = app('current.url');

    if (in_array($id, [1, 2])) {
      session()->flash('error',  __('default.notification.error.restrict'));
      return response()->json(['status' => 'error', 'message' => __('default.notification.error.restrict'),'redirect_url' => url($url)], 200);
    }

    $data   = $model::findOrFail($id);
    $data->fill($this->all());

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
