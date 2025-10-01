@if (!empty($daterange) && $daterange == 'true')
<div class="form-group row">
    <label class="col-4 col-form-label"> {{ __('default.label.daterange') }} </label>
    <div class="col-8">
        <div class="input-daterange input-group" id="ex_datepicker_daterange">
            {{ Html::text('date_start', (isset($data->date_start) ? \Carbon\Carbon::parse($data->date_start)->format('Y-m-d ') : ''))->class([ $errors->has('date_start') ? 'form-control is-invalid text-center' : 'form-control text-center', ])->id('date_start')->placeholder('- ' . __("default.select.date-start") . ' -')->isReadOnly() }}
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-ellipsis-h"></i>
                </span>
            </div>
            {{ Html::text('date_end', (isset($data->date_end) ? \Carbon\Carbon::parse($data->date_end)->format('Y-m-d ') : ''))->class([ $errors->has('date_end') ? 'form-control is-invalid text-center' : 'form-control text-center', ])->id('date_end')->placeholder('- ' . __("default.select.date-end") . ' -')->isReadOnly() }}
        </div>
    </div>
</div>
@endif