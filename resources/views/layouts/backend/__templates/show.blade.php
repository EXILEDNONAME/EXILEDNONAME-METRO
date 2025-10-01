@extends('layouts.backend.default')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.details') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ $url }}" class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.back') }}"><i class="fas fa-arrow-left"></i></a>
                    <a data-toggle="modal" data-target="#qrcode_modal" class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.qr-code') }}"><i class="fas fa-qrcode"></i></a>
                    <a class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.print') }}" onclick="printData('printData')"><i class="fas fa-print"></i></a>
                    <a href="{{ URL::Current() }}/edit" class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.edit') }}"><i class="fas fa-pencil-alt"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                    <form method="POST" action="{{ URL::current() }}/../{{ $data->id }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <a id="delete" class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.delete.delete') }}"><i class="fas fa-trash text-danger"></i></a>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="printData">
                    <div class="table-responsive">
                        <table class="table table-hover table-head-custom table-checkable table-sm">
                            <table width="100%" class="table table-separate table-head-custom table-checkable table-sm">
                            @if (!empty($file) && $file == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.file') }} </td>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalFile"><span class="fas fa-file-image text-success"></span></a>
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
                                </td>
                            </tr>
                            @endif
                            @if (!empty($date) && $date == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.date') }} </td>
                                <td> {{ !empty($data->date) ? \Carbon\Carbon::parse($data->date)->format('d F Y') : '-' }} </td>
                            </tr>
                            @endif
                            @if (!empty($datetime) && $datetime == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.datetime') }} </td>
                                <td> {{ !empty($data->datetime) ? \Carbon\Carbon::parse($data->datetime)->format('d F Y') : '-' }} </td>
                            </tr>
                            @endif
                            @if (!empty($daterange) && $daterange == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.date-start') }} </td>
                                <td> {{ !empty($data->date_start) ? \Carbon\Carbon::parse($data->date_start)->format('d F Y') : '-' }} </td>
                            </tr>
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.date-end') }} </td>
                                <td> {{ !empty($data->date_end) ? \Carbon\Carbon::parse($data->date_end)->format('d F Y') : '-' }} </td>
                            </tr>
                            @endif
                            @yield('table-header')
                            @if (!empty($active) && $active == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.active') }} </td>
                                <td> {{ $data->active == 1 ? __('default.label.yes') : __('default.label.no') }} </td>
                            </tr>
                            @endif
                            @if (!empty($status) && $status == 'true')
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.status') }} </td>
                                <td>
                                    @if( $data->status == 1 ) <strong><span class="text-dark"> {{ __('default.label.default') }} </span></strong>
                                    @elseif( $data->status == 2 ) <strong><span class="text-warning"> {{ __('default.label.pending') }} </span></strong>
                                    @elseif( $data->status == 3 ) <strong><span class="text-info"> {{ __('default.label.progress') }} </span></strong>
                                    @elseif( $data->status == 4 ) <strong><span class="text-success"> {{ __('default.label.success') }} </span></strong>
                                    @elseif( $data->status == 5 ) <strong><span class="text-danger"> {{ __('default.label.failed') }} </span></strong>
                                    @else {{ __('default.label.unknown') }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.created_at') }} </td>
                                <td> {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y, H:i') }} </td>
                            </tr>
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.updated_at') }} </td>
                                <td> {{ \Carbon\Carbon::parse($data->updated_at)->format('d F Y, H:i') }} </td>
                            </tr>
                            @if(!empty($data->created_by))
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.created_by') }} </td>
                                <td> {{ \DB::table('users')->where('id', $data->created_by)->first()->name ?? '-' }} </td>
                            </tr>
                            @endif
                            @if(!empty($data->updated_by))
                            <tr>
                                <td class="align-middle font-weight-bold"> {{ __('default.label.last_updated_by') }} </td>
                                <td> {{ \DB::table('users')->where('id', $data->updated_by)->first()->name ?? '-' }} </td>
                            </tr>
                            @endif
                            <tr>
                                <td width="50%"></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-custom gutter-b" data-card="true" id="exilednoname_activity">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"> {{ __('default.label.activities') }} </h3>
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-icon btn-xs btn-hover-light-primary" title="{{ __('default.label.print') }}" onclick="printData('printDataActivities')"><i class="fas fa-print"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle"><i class="fas fa-caret-down"></i></a>
                </div>
            </div>

            <div class="card-body">
                <div id="printDataActivities">

                    <div class="example-preview">
                        <div class="timeline timeline-2">
                            <div class="timeline-bar"></div>

                            @php $activity = activities($model)->where('subject_id', $data->id)->take(7); @endphp
                            @if (!empty($activity) && !empty($activity->count()))
                            @foreach($activity as $item)
                            <div class="timeline-item">

                                @foreach($item['properties'] as $data_object)
                                @if ($item->description == 'created')
                                <span class="timeline-badge bg-success"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">
                                        <span class="text-muted"> {{ $item->created_at->diffForHumans() }}, {{ $item->causer->name }} </span><br>
                                        @if (!empty($item->causer->name) && !empty($data_object['name']))
                                        {{ __('default.activity.item-created') }} <span class="font-weight-bolder"> {{ mb_strimwidth($data_object['name'], 0, 10, ' ...') }} </span>
                                        @else
                                        {{ __('default.activity.item-created') }}
                                        @endif
                                    </span>
                                </div>
                                @endif
                                @endforeach


                                @if ($item->description == 'updated')
                                @if ($item['properties']['attributes']['deleted_at'] == NULL && !empty($item['properties']['old']['deleted_at']))
                                <span class="timeline-badge bg-info"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">
                                        <span class="text-muted"> {{ $item->created_at->diffForHumans() }}, {{ $item->causer->name }} </span><br>
                                        @if (!empty($item->causer->name) && !empty($data_object['name']))
                                        {{ __('default.activity.item-restored') }} <span class="font-weight-bolder"> {{ mb_strimwidth($data_object['name'], 0, 10, ' ...') }} </span>
                                        @else
                                        {{ __('default.activity.item-restored') }}
                                        @endif
                                    </span>
                                </div>
                                @else
                                <span class="timeline-badge bg-warning"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">
                                        <span class="text-muted"> {{ $item->created_at->diffForHumans() }}, {{ $item->causer->name }} </span><br>
                                        @if (!empty($data_object['name']))
                                        {{ __('default.activity.item-updated') }} <span class="font-weight-bolder"> {{ mb_strimwidth($item['properties']['old']['name'], 0, 10, ' ...') }} </span> to <span class="font-weight-bolder"> {{ mb_strimwidth($item['properties']['attributes']['name'], 0, 10, ' ...') }} </span>
                                        @else
                                        {{ __('default.activity.item-updated') }}
                                        @endif
                                    </span>
                                </div>
                                @endif
                                @endif

                                @foreach($item['properties'] as $data_object)
                                @if ($item->description == 'deleted')
                                <span class="timeline-badge bg-danger"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">
                                        <span class="text-muted"> {{ $item->created_at->diffForHumans() }}, {{ $item->causer->name }} </span><br>
                                        @if (!empty($data_object['name']))
                                        {{ __('default.activity.item-deleted') }} <b>{{ $data_object['name'] }}</b>
                                        @else
                                        {{ __('default.activity.item-deleted') }}
                                        @endif
                                    </span>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            @endforeach
                            @else
                            <span class="text-muted"> {{ trans('default.activity.no-recent-activities') }} </span>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="qrcode_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{ __('default.label.qr-code') }} </h5>
                <button type="button" class="close" data-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div id="printQR">
                    <p class="text-center"> {!! QrCode::size(300)->generate(URL::current()); !!} </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-icon btn-outline-primary" onclick="printQR('printQR')"><i class="fas fa-print"></i></button>
                <button type="button" class="btn btn-outline-primary font-weight-bolder" data-dismiss="modal"> {{ __('default.label.close') }} </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    var card = new KTCard('exilednoname_card');
    var card = new KTCard('exilednoname_activity');
    var card = new KTCard('exilednoname_chart');

    function printData(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function printDataActivities(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function printQR(divName) {
        var myWindow = window.open('', '', '');
        myWindow.document.write(document.getElementById(divName).innerHTML);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.document.close();
    }

    $('body').on('click', '#delete', function(e) {
        e.preventDefault()
        Swal.fire({
            text: translations.default.notification.confirm.delete + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: translations.default.label.yes,
            cancelButtonText: translations.default.label.no,
            reverseButtons: false
        }).then(function(result) {
            if (result.value) {
                $(e.target).closest('form').submit()
            }
        });
    });

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