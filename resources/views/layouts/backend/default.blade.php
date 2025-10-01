<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.backend.__includes.head')

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    @include('layouts.backend.__includes.mobile-menu')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.backend.__includes.sidebar')
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        @include('layouts.backend.__includes.topbar-left')
                        @include('layouts.backend.__includes.topbar-right')
                    </div>
                </div>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @include('layouts.backend.__includes.subheader')

                    <!-- CONTENT -->
                    <div class="d-flex flex-column-fluid">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('layouts.backend.__includes.footer')
            </div>
        </div>
    </div>
    @include('layouts.backend.__includes.scroll-top')
    @include('layouts.backend.__includes.js')
</body>

</html>