<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script>
    fetch("{{ route('assets.lang') }}").then(response => {
        return response.json();
    }).then(data => {
        translations = data;
    });
    window.translations = {
        default: {
            label: {
                please_wait: "{{ __('default.label.please_wait') }}"
            }
        }
    };
</script>

<script>
    var this_url = "{{ URL::Current() }}";
    var active = "{{ !empty($active) && $active == 'true' ? 'true' : '' }}";
    var date = "{{ !empty($date) && $date == 'true' ? 'true' : '' }}";
    var datetime = "{{ !empty($datetime) && $datetime == 'true' ? 'true' : '' }}";
    var daterange = "{{ !empty($daterange) && $daterange == 'true' ? 'true' : '' }}";
    var file = "{{ !empty($file) && $file == 'true' ? 'true' : '' }}";
    var status = "{{ !empty($status) && $status == 'true' ? 'true' : '' }}";
    var extensions = "{{ !empty($extension) && $extension == 'management-users' ? 'management-users' : '' }}";
    var sort = "{{ !empty($sort) && $sort > 0 ? $sort : '1, desc' }}";
    window.tableBodyColumns = [
        @yield('table-body')
    ];
</script>
<script src="/mix/js/plugins.min.js"></script>
<!-- <script src="/assets/backend/plugins/global/plugins.bundle.js"></script> -->
<script src="/assets/backend/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="/assets/backend/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="/assets/backend/js/pages/widgets.js"></script>
<!--end::Page Scripts-->
@stack('js')
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    };
</script>

@if ($message = Session::get('success'))
<script>
    toastr.success('{{ $message }}');
</script>
@endif
@if ($message = Session::get('error'))
<script>
    toastr.error('{{ $message }}');
</script>
@endif

<script>
    $(function() {
        $('[title]').tooltip({
            placement: 'top', // atau 'bottom', 'left', 'right'
            trigger: 'hover'
        });
    });
</script>