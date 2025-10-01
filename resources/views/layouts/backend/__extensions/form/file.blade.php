@if (!empty($file) && $file == 'true')

@if($formMode == 'create')
<div class="form-group row">
    <label class="col-4 col-form-label"> {{ __('default.label.file') }} </label>
    <div class="col-8">
        <input type="file" name="file" accept="image/*">
        <div id="previewContainer" style="margin-top: 15px;">
            <img id="previewImage" src="" style="max-width: 200px; display: none;">
        </div>
        <div id="uploadProgress" class="progress mt-3" style="height: 15px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
        </div>
        <div id="uploadStatus" class="mt-2"></div>
    </div>
</div>
@endif

@if($formMode == 'edit')
<div class="form-group row">
    <label class="col-4 col-form-label"> {{ __('default.label.file') }} </label>
    <div class="col-8">
        @if(!empty($data->file))
        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalFile" class="btn btn-sm btn-icon btn-dark mr-2">
            <i class="fas fa-eye"></i>
        </a>
        <div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{ __('default.label.preview') }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img width="100%" data-src="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" class="lazy-img" loading="lazy" alt="Preview">
                    </div>
                    <div class="modal-footer">
                        <a href="{{ env('APP_URL') }}/storage/files/form-uploads/{{ $data->file }}" download="{{ $data->file }}" class="btn btn-light-primary font-weight-bold"> {{ __('default.label.download') }} </a>
                        <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal"> {{ __('default.label.close') }} </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <input type="file" name="file" accept="image/*">
        <div id="previewContainer" style="margin-top: 15px;">
            <img id="previewImage" src="" style="max-width: 200px; display: none;">
        </div>
        <div id="uploadProgress" class="progress mt-3" style="height: 15px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
        </div>
        <div id="uploadStatus" class="mt-2"></div>
    </div>
</div>
@endif

@endif