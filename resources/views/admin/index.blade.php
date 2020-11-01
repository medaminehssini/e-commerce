

    @include('admin.layouts.header')
    @stack('css')
    @include('admin.layouts.topbar')
    @include('admin.layouts.vertical-menu')
    @include('sweetalert::alert')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->



    @include('admin.layouts.scripts')
    @stack('scripts')

    @include('admin.layouts.footer')

