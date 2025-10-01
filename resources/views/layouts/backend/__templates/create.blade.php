@extends('layouts.backend.default')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.create') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ $url }}" class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.back') }}"><i class="fas fa-arrow-left"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" id="exilednoname-form" action="{{ URL::current() }}/../" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input class="form-control" name="created_by" type="hidden" value="{{ Auth::User()->id }}">
                    <div class="error" id="errors" style="color:red"></div>
                    @include($path . 'form', ['formMode' => 'create'])
                    @include('layouts.backend.__extensions.form.date')
                    @include('layouts.backend.__extensions.form.daterange')
                    @include('layouts.backend.__extensions.form.status')
                    @include('layouts.backend.__extensions.form.active')
                    @include('layouts.backend.__extensions.form.file', ['formMode' => 'create'])
                </form>
                <div class="form-group row">
                    <div class="col-4"></div>
                    <div class="col-8">
                        <button type="submit" form="exilednoname-form" class="btn btn-success font-weight-bold mr-2"><span class="ml-1 mr-1"> {{ __('default.label.submit') }} </span></button>
                        <a href="{{ $url }}"><button class="btn btn-secondary font-weight-bold"><span class="ml-1 mr-1"> {{ __('default.label.back') }} </span></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$('#exilednoname-form').on('submit', function(e){
  e.preventDefault();

  let formData = new FormData(this);
  var progressBar = $('#uploadProgress');
  var bar = progressBar.find('.progress-bar');

  $('#errors').html('');
  $('#success').html('');

  $.ajax({
    xhr: function() {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
          var percentComplete = Math.round((evt.loaded / evt.total) * 100);
          progressBar.show();
          bar.css('width', percentComplete + '%').text(percentComplete + '%');
        }
      }, false);
      return xhr;
    },

    url: this_url + "/../",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function() {
      $('.progress-bar').css('width', '0%').text('0%');
    },
    success: function(res){
      $('.invalid-feedback').remove();
      $('.is-invalid').removeClass('is-invalid');
      if(res.status === 'success'){ window.location.href = res.redirect_url; }
      else if(res.status === 'error'){ window.location.href = res.redirect_url; }
      else { alert(res.message); }
    },
    error: function(xhr){
      if(xhr.status === 422){
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        let errors = xhr.responseJSON.errors;
        $.each(errors, function(key, value){
          let input = $('[name="'+ key +'"]');
          input.addClass('is-invalid');
          input.after('<div class="invalid-feedback">'+ value[0] +'</div>');
        });
      }
    }
  });
});
</script>
@endpush