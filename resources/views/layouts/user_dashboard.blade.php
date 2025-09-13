<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>داشبورد کاربر</title>
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</head>
<body>
    @include('frontend.partials.dash_nav')
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
