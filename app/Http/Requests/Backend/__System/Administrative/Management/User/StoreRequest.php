<?php

namespace App\Http\Requests\Backend\__System\Administrative\Management\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

Validator::extend('validateWithoutSpaces', function ($attribute, $value, $parameters, $validator) {
  return !Str::contains($value, ' ');
});

class StoreRequest extends BaseFormRequest {

  public function rules(): array {
    return [
      'email'     => ['required', 'unique:users,email', 'unique:users,phone', 'unique:users,username'],
      'phone'     => ['required', 'unique:users,email', 'unique:users,phone', 'unique:users,username'],
      'username'  => ['required', 'validateWithoutSpaces', 'unique:users,email', 'unique:users,phone', 'unique:users,username'],
      'password'  => ['required', 'min:4', 'confirmed'],
    ];
  }

  public function messages(): array {
    return [
      'validate_without_spaces' => 'Spaces are not allowed.',
    ];
  }

  public function persist() {
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
