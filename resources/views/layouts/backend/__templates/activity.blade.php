@extends('layouts.backend.default', ['activities' => 'true'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="card-label"> {{ __('default.label.activities') }} </h4>
                </div>
                <div class="card-toolbar">
                    <a href="{{ $url }}" class="btn btn-icon btn-xs btn-hover-light-primary mr-1" title="{{ __('default.label.back') }}"><i class="fas fa-arrow-left"></i></a>
                    <a class="btn btn-icon btn-xs btn-hover-light-primary mr-1 table_refresh" title="{{ __('default.label.refresh') }}"><i class="fas fa-sync-alt"></i></a>
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-clean btn-xs btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-download"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item" data-toggle="tooltip" title="{{ __('default.label.export.description.copy') }}"><a href="javascript:void(0);" id="export_copy" class="navi-link"><i class="navi-icon fa fa-copy"></i> {{ __('default.label.export.copy') }} </a></li>
                                <li class="navi-item" data-toggle="tooltip" title="{{ __('default.label.export.description.excel') }}"><a href="javascript:void(0);" id="export_excel" class="navi-link"><i class="navi-icon fa fa-file-excel"></i> {{ __('default.label.export.excel') }}</a></li>
                                <li class="navi-item" data-toggle="tooltip" title="{{ __('default.label.export.description.pdf') }}"><a href="javascript:void(0);" id="export_pdf" class="navi-link"><i class="navi-icon fa fa-file-pdf"></i> {{ __('default.label.export.pdf') }}</a></li>
                                <li class="navi-item" data-toggle="tooltip" title="{{ __('default.label.export.description.print') }}"><a href="javascript:void(0);" id="export_print" class="navi-link"><i class="navi-icon fa fa-print"></i> {{ __('default.label.export.print') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="btn btn-icon btn-xs btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title=""><i class="fas fa-caret-down"></i></a>
                    <div class="collapse" id="collapse_bulk">
                        <a id="selected-restore" data-url="" class="btn btn-xs btn-icon btn-clean btn-icon-md" data-toggle="tooltip" title="{{ __('default.label.selected-restore') }}"><i class="text-success fas fa-undo"></i></a>
                        <a id="selected-delete-permanent" data-url="" class="btn btn-xs btn-icon btn-clean btn-icon-md" data-toggle="tooltip" title="{{ __('default.label.selected-delete-permanent') }}"><i class="text-danger fas fa-trash"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body" id="exilednoname_body">
                <div class="row dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="col-sm-12 col-md-6">
                        <div id="ex_table_length"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="ex_table_filter"></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table table-separate table-head-custom table-checkable table-sm" id="exilednoname_table">
                        <thead>
                            <tr>
                                <th width="1"> No. </th>
                                <th width="1"> </th>
                                <th width="1"> Status </th>
                                <th> Subject </th>
                                <th width="1"> Causer </th>
                                <th> Date </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="col-sm-12 col-md-5">
                        <div id="ex_table_info"></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div id="ex_table_paginate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/datatable.js"></script>
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/datatable-activity.js"></script>
@endpush