@extends('layouts.backend.default', ['trash' => 'true'])

@push('head')
<link href="/assets/backend/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b card-sticky" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="card-label"> {{ __('default.label.trash') }} </h4>
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
                                <li class="navi-item" data-toggle="tooltip" title="{{ __('default.label.export.description.copy') }}"><a href="javascript:void(0);" id="export_copy" class="navi-link"><i class="navi-icon fa fa-copy"></i> {{ __('default.label.export.copy') }}</a></li>
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
                                <th class="no-export"> </th>
                                <th width="1"> No. </th>
                                <th width="1" class="text-nowrap"> Deleted At </th>
                                @yield('table-header')
                                <th class="no-export"> </th>
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

    var card = new KTCard('exilednoname_card');

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
        rowId: 'Collocation',
        select: {
            style: 'multi',
            selector: 'td:first-child .checkable',
        },
        ajax: {
            url: this_url,
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
                orderable: false,
                searchable: false,
                'width': '1',
                render: function(data, type, row, meta) {
                    return '<label class="checkbox checkbox-single checkbox-primary mb-0"><input type="checkbox" data-id="' + row.id + '" class="checkable"><span></span></label>';
                },
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
            {
                data: 'deleted_at',
                'className': 'align-middle text-nowrap',
                'width': '1',
            },

            ...window.tableBodyColumns,

            {
                data: 'action',
                orderable: false,
                orderable: false,
                searchable: false,
                'width': '1',
                render: function(data, type, row) {
                    return '' +
                        '<div class="dropdown dropdown-inline">' +
                        '<button type="button" class="btn btn-hover-light-dark btn-icon btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ki ki-bold-more-ver"></i></button>' +
                        '<div class="dropdown-menu dropdown-menu-xs border" style="max-width: 200px; width: auto;"><ul class="navi navi-hover py-5">' +
                        '<li class="navi-item"><a id="restore" href="javascript:void(0);" class="navi-link" data-id="' + row.id + '"><span class="navi-icon"><i class="fas fa-undo"></i></span><span class="navi-text">' + translations.default.label.restore + '</span></a></li>' +
                        '<li class="navi-item"><a id="delete-permanent" href="javascript:void(0);" class="navi-link" data-id="' + row.id + '"><span class="navi-icon"><i class="flaticon2-trash"></i></span><span class="navi-text text-nowrap">' + translations.default.label.delete.permanent + '</span></a></li>';
                },
            },
        ]
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
    $('#export_csv').on('click', function(e) {
        e.preventDefault();
        table.button(3).trigger();
    });
    $('#export_pdf').on('click', function(e) {
        e.preventDefault();
        table.button(4).trigger();
    });

    // GROUP CHECKABLE
    $('#exilednoname_table').on('change', '.group-checkable', function() {
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
    $('#exilednoname_table').on('change', '.checkable', function() {
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

    // REFRESH TABLE
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

    $('body').on('click', '#delete-permanent', function() {
        var id = $(this).data("id");
        Swal.fire({
            text: translations.default.notification.confirm.delete_permanent + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: this_url + "/../delete-permanent/" + id,
                    success: function(data) {
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            var oTable = $('#exilednoname_table').dataTable();
                            oTable.fnDraw(false);
                            toastr.success(translations.default.notification.success.item_delete_permanently);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    $('body').on('click', '#restore', function() {
        var id = $(this).data("id");
        Swal.fire({
            text: translations.default.notification.confirm.restore + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: this_url + "/../restore/" + id,
                    success: function(data) {
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            var oTable = $('#exilednoname_table').dataTable();
                            oTable.fnDraw(false);
                            toastr.success(translations.default.notification.success.item_restored);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    $('#selected-delete-permanent').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_delete_permanent + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'get',
                    url: this_url + "/../selected-delete-permanent",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#collapse_bulk').collapse('hide');
                            var oTable = $('#exilednoname_table').dataTable();
                            oTable.fnDraw(false);
                            toastr.success(translations.default.notification.success.selected_delete_permanent);
                        }, 1000);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });

    $('#selected-restore').on('click', function(e) {
        var exilednonameArr = [];
        $(".checkable:checked").each(function() {
            exilednonameArr.push($(this).attr('data-id'));
        });
        var strEXILEDNONAME = exilednonameArr.join(",");
        Swal.fire({
            text: translations.default.notification.confirm.selected_restore + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'get',
                    url: this_url + "/../selected-restore",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'EXILEDNONAME=' + strEXILEDNONAME,
                    success: function(data) {
                        KTApp.block('#exilednoname_body', {
                            overlayColor: '#000000',
                            state: 'info',
                            message: translations.default.label.processing + ' ...'
                        });
                        setTimeout(function() {
                            KTApp.unblock('#exilednoname_body');
                            $('#collapse_bulk').collapse('hide');
                            var oTable = $('#exilednoname_table').dataTable();
                            oTable.fnDraw(false);
                            toastr.success(translations.default.notification.success.selected_restore);
                        }, 500);
                    },
                    error: function(data) {
                        toastr.error(translations.default.notification.error.error);
                    }
                });
            }
        });
    });
</script>
@endpush