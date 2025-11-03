<!DOCTYPE html>
<html class="no-js" lang="id">

@include('layouts.guest.css')

<body>
    <!-- ========================= HEADER ========================= -->
    @include('layouts.guest.header')
    <!-- ========================= MAIN CONTENT ========================= -->
    @yield('content')
    <!-- ========================= FOOTER ========================= -->
    @include('layouts.guest.footer')
    <!-- ========================= JS ========================= -->
	@include('layouts.guest.js')
</body>
</html>
