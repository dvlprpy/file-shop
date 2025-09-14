<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>صفحه اصلی</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    @include('frontend.partials.nav')
    @include('sweetalert2::index')

    
    <div class="container mt-4">
        @yield('desc')
    </div>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <div class="container-fluid">
        @yield('footer')
    </div>

    
</body>
</html>