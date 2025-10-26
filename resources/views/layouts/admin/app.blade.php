<!DOCTYPE html>
<html class="no-js" lang="id">

@include('layouts.admin.css')

<body>
    <!-- ========================= HEADER ========================= -->
    @include('layouts.admin.header')
    <!-- ========================= MAIN CONTENT ========================= -->
    @yield('content')
    <!-- ========================= FOOTER ========================= -->
    @include('layouts.admin.footer')
    <!-- ========================= JS ========================= -->
	@include('layouts.admin.js')
</body>
</html>
