@include('boutique.layouts.headers')
@include('sweetalert::alert')

@stack('css')
@include('boutique.layouts.menu')
@include('boutique.layouts.sectionbar')

@yield('content')

@include('boutique.layouts.scripts')
@stack('scripts')
@include('boutique.layouts.footer')


