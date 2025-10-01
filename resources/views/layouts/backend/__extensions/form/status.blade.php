@if (!empty($status) && $status == 'true')
<div class="form-group row">
    <label class="col-4 col-form-label"> {{ __('default.label.status') }} </label>
    <div class="col-8">
        @if (!empty($statusName))
        @php
        $items = DB::table('system_status_filters')->where('name', $statusName)->first();
        $attributes = json_decode($items->properties ?? '[]', true);
        @endphp
        {{ Html::select('status', $attributes, (isset($data->status) ? $data->status : ''))->class($errors->has('status') ? 'form-control is-invalid' : 'form-control')->placeholder('- ' . __("default.select.status") . ' -')->required() }}
        @error('status') {{ Html::span()->text($message)->class('invalid-feedback') }} @enderror
        @else
        {{ Html::select('status')->class($errors->has('status') ? 'form-control is-invalid' : 'form-control')->placeholder('- ' . __("default.select.status") . ' -')->required() }}
        @endif
    </div>
</div>
@endif