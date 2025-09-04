<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <title>داشبورد مدیریتی</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    @include('admin.partials.nav')
    <div class="container-fluid admin-blade-no-padding">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2.select.js') }}"></script>
</body>
</html>
