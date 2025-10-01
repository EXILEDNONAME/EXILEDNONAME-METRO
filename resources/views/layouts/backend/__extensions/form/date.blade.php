@if (!empty($date) && $date == 'true')
<div class="form-group row">
    <label class="col-4 col-form-label"> {{ __('default.label.date') }} </label>
    <div class="col-8">
        <div class="input-group date" id="ex_datetimepicker" data-target-input="nearest">
            {{ Html::text('date', (isset($data->date) ? \Carbon\Carbon::parse($data->date)->format('Y-m-d H:i') : ''))->class([ $errors->has('date') ? 'form-control is-invalid datetimepicker-input' : 'form-control datetimepicker-input', ])->id('date')->placeholder('- ' . __("default.select.date") . ' -')->attribute('data-target', '#ex_datetimepicker')->attribute('data-toggle', 'datetimepicker')->attribute('autocomplete', 'off') }}
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="ki ki-calendar"></i>
                </span>
            </div>
        </div>
    </div>
</div>
@endif