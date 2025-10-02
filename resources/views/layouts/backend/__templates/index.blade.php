@extends('layouts.backend.default', ['page' => 'datatable-index'])

@push('head')
<link href="/assets/backend/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
@stack('box')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.main') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ URL::Current() }}/create" class="btn btn-icon btn-xs btn-hover-light-primary" data-toggle="tooltip" data-original-title="{{ __('default.label.create') }}"><i class="fas fa-plus"></i></a>
                    <a class="btn btn-icon btn-xs btn-hover-light-primary table_refresh" data-toggle="tooltip" data-original-title="{{ __('default.label.refresh') }}"><i class="fas fa-sync-alt"></i></a>

                    @if(($active ?? '') === 'true' || ($status ?? '') === 'true' || ($date ?? '') === 'true' || ($daterange ?? '') === 'true')
                    <div data-toggle="collapse" data-target="#collapse-filter"><a class="btn btn-icon btn-xs btn-hover-light-primary" data-toggle="tooltip" data-original-title="{{ __('default.label.filter./') }}"><i class="fas fa-filter"></i></a></div>
                    @else
                    @endif

                    <div class="dropdown dropdown-inline" bis_skin_checked="1">
                        <button type="button" class="btn btn-clean btn-xs btn-icon btn-icon-md" data-toggle="dropdown" title="Export"><i class="fas fa-download"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" bis_skin_checked="1">
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item" data-toggle="tooltip" title="Copy"><a href="javascript:void(0);" id="export_copy" class="navi-link"><i class="navi-icon fa fa-copy"></i> Copy </a></li>
                                <li class="navi-item" data-toggle="tooltip" title="Excel"><a href="javascript:void(0);" id="export_excel" class="navi-link"><i class="navi-icon fa fa-file-excel"></i> Excel </a></li>
                                <li class="navi-item" data-toggle="tooltip" title="PDF"><a href="javascript:void(0);" id="export_pdf" class="navi-link"><i class="navi-icon fa fa-file-pdf"></i> PDF </a></li>
                                <li class="navi-item" data-toggle="tooltip" title="Print"><a href="javascript:void(0);" id="export_print" class="navi-link"><i class="navi-icon fa fa-print"></i> Print </a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                    <div id="collapse_bulk" class="collapse">
                        <div class="dropdown">
                            <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                                <a class="btn btn-icon btn-xs btn-hover-light-primary mr-1" title="{{ __('default.label.action') }}"><i class="fas fa-ellipsis-h"></i></a>
                            </div>
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                <ul class="navi navi-hover py-4">
                                    @if (!empty($active) && $active == 'true')
                                    <li class="navi-item"><a href="javascript:void(0);" class="navi-link selected-active"> {{ __('default.label.selected_active') }} </a></li>
                                    <li class="navi-item"><a href="javascript:void(0);" class="navi-link selected-inactive"> {{ __('default.label.selected_inactive') }} </a></li>
                                    @endif
                                    <li class="navi-item"><a href="javascript:void(0);" class="navi-link selected-delete"> {{ __('default.label.selected_delete') }} </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @stack('toolbar-button')
                </div>
            </div>
            <div class="card-body" id="exilednoname_body">

                <div class="accordion" id="accordion-filter">
                    <div id="collapse-filter" class="collapse hide" data-parent="#accordion-filter">

                        @if (!empty($active) && $active == 'true')
                        <div class="mb-2">
                            <div class="col-lg-12 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select class="custom-select form-control filter-form filter_active">
                                        <option value=""> - {{ __('default.select.active') }} - </option>
                                        <option value="1"> {{ __('default.label.yes') }} </option>
                                        <option value="0"> {{ __('default.label.no') }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (!empty($status) && $status == 'true')
                        <div class="mb-2">
                            <div class="col-lg-12 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select data-column="2" class="form-control filter-form filter_status">
                                        <option value=""> - {{ __('default.select.status') }} - </option>
                                        @foreach ($attributes as $key => $label)
                                        <option value="{{ $key }}">
                                            {{ __('default.label.' . strtolower($label)) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (!empty($date) && $date == 'true')
                        <div class="mb-2">
                            <div class="col-lg-12 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="input-group input-daterange" id="ex_datepicker_date">
                                        <input type="text" id="date" class="form-control filter-form filter_date" name="date" placeholder="- {{ __('default.select.date') }} -" autocomplete="off" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (!empty($daterange) && $daterange == 'true')
                        <div class="mb-2">
                            <div class="col-lg-12 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="input-daterange input-group" id="ex_datepicker_daterange">
                                        {{ Html::text('date_start', (isset($data->date_start) ? $data->date_start : ''))->class([$errors->has('date_start') ? 'form-control filter-form is-invalid text-center' : 'form-control filter-form text-center'])->id('date_start')->placeholder('- ' . __("default.select.date-start") . ' -')->isReadOnly() }}
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        {{ Html::text('date_end', (isset($data->date_end) ? $data->date_end : ''))->class([$errors->has('date_end') ? 'form-control filter-form is-invalid text-center' : 'form-control filter-form text-center'])->id('date_end')->placeholder('- ' . __("default.select.date-end") . ' -')->isReadOnly() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @stack('filter-header')
                        <hr>

                    </div>
                </div>

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
                                <th class="no-export"></th>
                                <th style="display: none"> {{ __('default.label.created_at') }} </th>
                                <th> No. </th>
                                @if (!empty($status) && $status == 'true') <th> {{ __('default.label.status') }} </th> @endif
                                @if (!empty($file) && $file == 'true') <th> {{ __('default.label.file') }} </th> @endif
                                @if (!empty($date) && $date == 'true') <th> {{ __('default.label.date') }} </th> @endif
                                @if (!empty($daterange) && $daterange == 'true')
                                <th> {{ __('default.label.date-start') }} </th>
                                <th> {{ __('default.label.date-end') }} </th>
                                @endif
                                @yield('table-header')
                                @if (!empty($active) && $active == 'true') <th> {{ __('default.label.active') }} </th> @endif
                                <th class="no-export"></th>
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
<script src="/assets/backend/plugins/custom/datatables/datatables.bundle.js"></script>

<!-- LOADER -->
<script>
    $(document).ready(function() {
        KTApp.block('#exilednoname_body', {
            overlayColor: '#000000',
            state: 'primary',
            message: translations.default.label.please_wait + " ..."
        });
        setTimeout(function() {
            KTApp.unblock('#exilednoname_body');
        }, 500);
    });
</script>
<script>
    var defaultSort = sort.split(',').map((item, index) => {
        return index === 0 ? parseInt(item.trim()) : item.trim();
    });

    var table = $('#exilednoname_table').DataTable({
        "initComplete": function(settings, json) {
            $('#exilednoname_table_info').appendTo('#ex_table_info');
            $('#exilednoname_table_paginate').appendTo('#ex_table_paginate');
            $('#exilednoname_table_length').appendTo('#ex_table_length');
            $('#exilednoname_table_filter').appendTo('#ex_table_filter');
        },

        "pagingType": "simple_numbers",
        serverSide: true,
        searching: true,
        searchDelay: 2000,
        rowId: 'Collocation',
        select: {
            style: 'multi',
            selector: 'td:first-child .checkable',
        },
        ajax: {
            url: '{{ URL::Current() }}',
            "data": function(ex) {
                ex.date = $('#date').val();
                ex.datetime = $('#datetime').val();
                ex.date_start = $('#date_start').val();
                ex.date_end = $('#date_end').val();
            }
        },
        headerCallback: function(thead, data, start, end, display) {
            thead.getElementsByTagName('th')[0].innerHTML = `
    <label class="checkbox checkbox-single checkbox-solid checkbox-primary mb-0">
      <input type="checkbox" value="" class="group-checkable"/>
      <span></span>
    </label>`;
        },
        "lengthMenu": [
            [25, 100, 250, 500],
            [25, 100, 250, 500]
        ],
        "pageLength": 25,
        buttons: [{
                extend: 'print',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export"
                },
            },
            {
                extend: 'copyHtml5',
                title: '',
                autoClose: 'true',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export"
                },
            },
            {
                extend: 'excelHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export"
                },
            },
            {
                extend: 'pdfHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export"
                },
            },
            {
                extend: 'print',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: {
                        selected: true
                    }
                },
            },
            {
                extend: 'copyHtml5',
                title: '',
                autoClose: 'true',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: {
                        selected: true
                    }
                },
            },
            {
                extend: 'excelHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: {
                        selected: true
                    }
                },
            },
            {
                extend: 'pdfHtml5',
                title: '',
                exportOptions: {
                    columns: "thead th:not(.no-export)",
                    orthogonal: "Export",
                    rows: {
                        selected: true
                    }
                },
            },
        ],
        columns: [{
                data: 'checkbox',
                orderable: false,
                searchable: false,
                'width': '1',
                render: function(data, type, row, meta) {
                    return '<label class="checkbox checkbox-single checkbox-primary mb-0"><input type="checkbox" data-id="' + row.id + '" class="checkable"><span></span></label>';
                },
            },
            {
                data: 'created_at',
                name: 'created_at',
                visible: false
            },
            {
                data: 'autonumber',
                orderable: false,
                searchable: false,
                'className': 'align-middle text-center',
                'width': '1',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },

            ...(status ? [{
                data: 'status',
                name: 'status',
                orderable: true,
                className: 'align-middle text-nowrap',
                width: '1',
                render: function(data) {
                    if (data == 1) return '<span class="label label-dark label-inline">' + translations.default.label.default+'</span>';
                    if (data == 2) return '<span class="label label-warning label-inline">' + translations.default.label.pending + '</span>';
                    if (data == 3) return '<span class="label label-info label-inline">' + translations.default.label.progress + '</span>';
                    if (data == 4) return '<span class="label label-success label-inline">' + translations.default.label.success + '</span>';
                    if (data == 5) return '<span class="label label-danger label-inline">' + translations.default.label.failed + '</span>';
                }
            }, ] : []),

            ...(file ? [{
                data: 'file',
                orderable: false,
                'className': 'align-middle text-nowrap text-center',
                'width': '1'
            }, ] : []),

            ...(date ? [{
                data: 'date',
                orderable: true,
                'className': 'align-middle text-nowrap',
                'width': '1',
                render: function(data, type, row) {
                    if (data == null) {
                        return '<center> - </center>'
                    } else {
                        return data;
                    }
                }
            }, ] : []),

            ...(datetime ? [{
                data: 'datetime',
                orderable: true,
                'className': 'align-middle text-nowrap',
                'width': '1',
                render: function(data, type, row) {
                    if (data == null) {
                        return '<center> - </center>'
                    } else {
                        return data;
                    }
                }
            }, ] : []),

            ...(daterange ? [{
                    data: 'date_start',
                    orderable: true,
                    'className': 'align-middle text-nowrap',
                    'width': '1',
                    render: function(data, type, row) {
                        if (data == null) {
                            return '<center> - </center>'
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'date_end',
                    orderable: true,
                    'className': 'align-middle text-nowrap',
                    'width': '1',
                    render: function(data, type, row) {
                        if (data == null) {
                            return '<center> - </center>'
                        } else {
                            return data;
                        }
                    }
                },
            ] : []),

            ...window.tableBodyColumns,

            ...(active ? [{
                data: 'active',
                name: 'active',
                orderable: true,
                'className': 'align-middle text-center',
                'width': '1',
                render: function(data, type, row) {
                    if (data == 0) {
                        return '<a href="javascript:void(0);" class="table_active" data-toggle="tooltip" data-id="' + row.id + '"><span class="label label-dark label-inline">' + translations.default.label.no + '</span></a>';
                    }
                    if (data == 1) {
                        return '<a href="javascript:void(0);" class="table_inactive" data-toggle="tooltip" data-id="' + row.id + '"><span class="label label-info label-inline">' + translations.default.label.yes + '</span></a>';
                    }
                    if (data == 2) {
                        return '<a href="javascript:void(0);" class="table_active" data-toggle="tooltip" data-id="' + row.id + '"><span class="label label-dark label-inline">' + translations.default.label.no + '</span></a>';
                    }
                }
            }, ] : []),

            {
                data: 'action',
                orderable: false,
                searchable: false,
                'width': '1',
                render: function(data, type, row) {
                    return '' +
                        '<div class="dropdown dropdown-inline">' +
                        '<button type="button" class="btn btn-hover-light-dark btn-icon btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ki ki-bold-more-ver"></i></button>' +
                        '<div class="dropdown-menu dropdown-menu-xs border" style="max-width: 200px; width: auto;">' +
                        '<ul class="navi navi-hover">' +
                        '<li class="navi-item"><a href="' + this_url + '/' + row.id + '" class="navi-link"><span class="navi-icon"><i class="flaticon2-expand"></i></span><span class="navi-text">' + translations.default.label.view + '</span></a></li>' +
                        '<li class="navi-item"><a href="' + this_url + '/' + row.id + '/edit" class="navi-link"><span class="navi-icon"><i class="flaticon2-contract"></i></span><span class="navi-text">' + translations.default.label.edit + '</span></a></li>' +
                        '<li class="navi-item"><a href="javascript:void(0);" class="navi-link delete" data-id="' + row.id + '"><span class="navi-icon"><i class="flaticon2-trash"></i></span><span class="navi-text">' + translations.default.label.delete.delete + '</span></a></li>' +
                        '</ul></div></div>';
                }
            },
        ],
        order: [defaultSort]
    });

    $('#export_print').on('click', function(e) {
        e.preventDefault();
        table.button(0).trigger();
    });
    $('#export_copy').on('click', function(e) {
        e.preventDefault();
        table.button(1).trigger();
    });
    $('#export_excel').on('click', function(e) {
        e.preventDefault();
        table.button(2).trigger();
    });
    $('#export_pdf').on('click', function(e) {
        e.preventDefault();
        table.button(3).trigger();
    });

    // GROUP CHECKABLE
    table.on('change', '.group-checkable', function() {
        var set = $(this).closest('table').find('td:first-child .checkable');
        var checked = $(this).is(':checked');
        $(set).each(function() {
            if (checked) {
                $(this).prop('checked', true);
                $('#exilednoname_table').DataTable().rows($(this).closest('tr')).select();
                var checkedNodes = $('#exilednoname_table').DataTable().rows('.selected').nodes();
                var count = checkedNodes.length;
                $('#exilednoname_selected').html(count);
                if (count > 0) {
                    $('#toolbar_delete').collapse('show');
                    $('#collapse_bulk').collapse('show');
                }
            } else {
                $(this).prop('checked', false);
                $('#exilednoname_table').DataTable().rows($(this).closest('tr')).deselect();
                $('#toolbar_delete').collapse('hide');
                $('#collapse_bulk').collapse('hide');
            }
        });
    });

    // CHECKABLE
    table.on('change', '.checkable', function() {
        var checkedNodes = $('#exilednoname_table').DataTable().rows('.selected').nodes();
        var count = checkedNodes.length;
        $('#exilednoname_selected').html(count);
        if (count > 0) {
            $('#toolbar_delete').collapse('show');
            $('#collapse_bulk').collapse('show');
        } else {
            $('#toolbar_delete').collapse('hide');
            $('#collapse_bulk').collapse('hide');
        }
    });

    $(".table_refresh").on("click", function() {
        KTApp.block('#exilednoname_body', {
            overlayColor: '#000000',
            state: 'primary',
            message: translations.default.label.please_wait + " ..."
        });
        setTimeout(function() {
            KTApp.unblock('#exilednoname_body');
            $('#collapse_bulk').collapse('hide');
            $('.filter-form').val('');
            $('#exilednoname_table').DataTable().search('').columns().search('').draw();
            $('#exilednoname_table').DataTable().ajax.reload();
        }, 500);
    });

    // TABLE ACTIVE
    $('body').on('click', '.table_active', function() {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: this_url + "/active/" + id,
            processing: true,
            serverSide: true,
            success: function(data) {
                if (data.status && data.status === 'error') {
                    toastr.error(data.message);
                    return;
                }
                KTApp.block('#exilednoname_body', {
                    overlayColor: '#000000',
                    state: 'info',
                    message: translations.default.label.processing + ' ...'
                });
                setTimeout(function() {
                    KTApp.unblock('#exilednoname_body');
                    $('#exilednoname_table').dataTable().fnDraw(false);
                    toastr.success(translations.default.notification.success.item_active);
                }, 500);
            },
            error: function(data) {
                toastr.error(translations.default.notification.error.error);
            }
        });
    });

    // TABLE INACTIVE
    $('body').on('click', '.table_inactive', function() {
        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: this_url + "/inactive/" + id,
            processing: true,
            serverSide: true,
            success: function(data) {
                if (data.status && data.status === 'error') {
                    toastr.error(data.message);
                    return;
                }
                KTApp.block('#exilednoname_body', {
                    overlayColor: '#000000',
                    state: 'info',
                    message: translations.default.label.processing + ' ...'
                });
                setTimeout(function() {
                    KTApp.unblock('#exilednoname_body');
                    $('#exilednoname_table').dataTable().fnDraw(false);
                    toastr.success(translations.default.notification.success.item_inactive);
                }, 500);
            },
            error: function(data) {
                toastr.error(translations.default.notification.error.error);
            }
        });
    });

    // TABLE DELETE
    $('body').on('click', '.delete', function() {
        var id = $(this).data("id");
        Swal.fire({
            text: translations.default.notification.confirm.delete + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: this_url + "/delete/" + id,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'primary',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#exilednoname_table').dataTable().fnDraw(false);
                            toastr.success(translations.default.notification.success.item_deleted);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // FILTER ACTIVE OR INACTIVE
    $('.filter_active').change(function() {
        KTApp.block('#exilednoname_body', {
            overlayColor: '#000000',
            state: 'primary',
            message: translations.default.label.processing + ' ...'
        });
        setTimeout(function() {
            KTApp.unblock('#exilednoname_body');
            $('#exilednoname_table').dataTable().fnDraw(false);
        }, 500);
        $('#exilednoname_table').DataTable().column('active:name').search(this.value).draw();
    });

    // SELECTED ACTIVE
    $('.selected-active').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_active + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: this_url + "/selected-active",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#collapse_bulk').collapse('hide');
                            $('#exilednoname_table').dataTable().fnDraw(false);
                            toastr.success(translations.default.notification.success.selected_active);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // SELECTED INACTIVE
    $('.selected-inactive').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_inactive + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: this_url + "/selected-inactive",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#collapse_bulk').collapse('hide');
                            $('#exilednoname_table').dataTable().fnDraw(false);
                            toastr.success(translations.default.notification.success.selected_inactive);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // SELECTED DELETE
    $('.selected-delete').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_delete + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: this_url + "/selected-delete",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        if (data.status && data.status === 'error') {
                            toastr.error(data.message);
                            return;
                        }
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#collapse_bulk').collapse('hide');
                            $('#exilednoname_table').dataTable().fnDraw(false);
                            toastr.success(translations.default.notification.success.selected_delete);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    // LOADER IMAGE
    ! function(t, e) {
        "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.lozad = e()
    }(this, function() {
        "use strict";
        var g = "undefined" != typeof document && document.documentMode,
            f = {
                rootMargin: "0px",
                threshold: 0,
                load: function(t) {
                    if ("picture" === t.nodeName.toLowerCase()) {
                        var e = t.querySelector("img"),
                            r = !1;
                        null === e && (e = document.createElement("img"), r = !0), g && t.getAttribute("data-iesrc") && (e.src = t.getAttribute("data-iesrc")), t.getAttribute("data-alt") && (e.alt = t.getAttribute("data-alt")), r && t.append(e)
                    }
                    if ("video" === t.nodeName.toLowerCase() && !t.getAttribute("data-src") && t.children) {
                        for (var a = t.children, o = void 0, i = 0; i <= a.length - 1; i++)(o = a[i].getAttribute("data-src")) && (a[i].src = o);
                        t.load()
                    }
                    t.getAttribute("data-poster") && (t.poster = t.getAttribute("data-poster")), t.getAttribute("data-src") && (t.src = t.getAttribute("data-src")), t.getAttribute("data-srcset") && t.setAttribute("srcset", t.getAttribute("data-srcset"));
                    var n = ",";
                    if (t.getAttribute("data-background-delimiter") && (n = t.getAttribute("data-background-delimiter")), t.getAttribute("data-background-image")) t.style.backgroundImage = "url('" + t.getAttribute("data-background-image").split(n).join("'),url('") + "')";
                    else if (t.getAttribute("data-background-image-set")) {
                        var d = t.getAttribute("data-background-image-set").split(n),
                            u = d[0].substr(0, d[0].indexOf(" ")) || d[0]; // Substring before ... 1x
                        u = -1 === u.indexOf("url(") ? "url(" + u + ")" : u, 1 === d.length ? t.style.backgroundImage = u : t.setAttribute("style", (t.getAttribute("style") || "") + "background-image: " + u + "; background-image: -webkit-image-set(" + d + "); background-image: image-set(" + d + ")")
                    }
                    t.getAttribute("data-toggle-class") && t.classList.toggle(t.getAttribute("data-toggle-class"))
                },
                loaded: function() {}
            };

        function A(t) {
            t.setAttribute("data-loaded", !0)
        }
        var m = function(t) {
                return "true" === t.getAttribute("data-loaded")
            },
            v = function(t) {
                var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : document;
                return t instanceof Element ? [t] : t instanceof NodeList ? t : e.querySelectorAll(t)
            };
        return function() {
            var r, a, o = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ".lozad",
                t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                e = Object.assign({}, f, t),
                i = e.root,
                n = e.rootMargin,
                d = e.threshold,
                u = e.load,
                g = e.loaded,
                s = void 0;
            "undefined" != typeof window && window.IntersectionObserver && (s = new IntersectionObserver((r = u, a = g, function(t, e) {
                t.forEach(function(t) {
                    (0 < t.intersectionRatio || t.isIntersecting) && (e.unobserve(t.target), m(t.target) || (r(t.target), A(t.target), a(t.target)))
                })
            }), {
                root: i,
                rootMargin: n,
                threshold: d
            }));
            for (var c, l = v(o, i), b = 0; b < l.length; b++)(c = l[b]).getAttribute("data-placeholder-background") && (c.style.background = c.getAttribute("data-placeholder-background"));
            return {
                observe: function() {
                    for (var t = v(o, i), e = 0; e < t.length; e++) m(t[e]) || (s ? s.observe(t[e]) : (u(t[e]), A(t[e]), g(t[e])))
                },
                triggerLoad: function(t) {
                    m(t) || (u(t), A(t), g(t))
                },
                observer: s
            }
        }
    });

    $(document).on('shown.bs.modal', '.modal', function() {
        $(this).find('img.lazy-img').each(function() {
            var $img = $(this);
            if (!$img.attr('src')) {
                $img.attr('src', $img.data('src'));
            }
        });
    });
</script>
@endpush