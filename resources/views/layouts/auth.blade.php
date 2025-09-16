<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'بدون عنوان' }}</title>
    @vite(['resources/js/app.js'])
</head>
<body>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @yield('scripts')
</body>
</html>