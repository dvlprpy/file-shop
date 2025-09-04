<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>صفحه اصل</title>
    @vite(['resources/js/app.js'])
    <style>
        body{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between
        }
    </style>
</head>
<body>
    @include('frontend.partials.nav')

    <div class="container">
        @yield('desc')
    </div>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <div class="cotainer">
        @yield('footer')
    </div>
</body>
</html>
