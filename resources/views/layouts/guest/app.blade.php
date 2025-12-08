<!DOCTYPE html>
<html class="no-js" lang="id">

@include('layouts.guest.css')

<body>
    <!-- ========================= HEADER ========================= -->
    @include('layouts.guest.header')
    <!-- ========================= MAIN CONTENT ========================= -->
    @yield('content')
    <!-- ========================= IDENTITAS PENGEMBANG ========================= -->
    @include('layouts.guest.identitas')
    <!-- ========================= FOOTER ========================= -->
    @include('layouts.guest.footer')
    <!-- ========================= JS ========================= -->
	@include('layouts.guest.js')
    {{-- SLIDESHOW INDONESIA --}}
    @include('layouts.guest.slideshow')
</body>
</html>
