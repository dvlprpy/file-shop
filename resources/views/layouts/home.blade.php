<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>صفحه اصلی</title>
    @vite(['resources/js/app.js'])
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        /* کارت 3D */
        .card-3d {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-3d:hover {
            transform: perspective(1000px) rotateY(5deg) rotateX(5deg) scale(1.03);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .btn-3d {
            transition: all 0.2s ease-in-out;
            border-radius: 10px;
        }
        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }
        .btn-3d:active {
            transform: translateY(2px);
            box-shadow: inset 0 3px 5px rgba(0,0,0,0.2);
        }
        p.p-desc{
            padding: 50px;
            font-size: x-large;
            text-transform: capitalize;
            text-align: left;
        }
    </style>
</head>
<body>
    @include('frontend.partials.nav')

    <div class="container mt-4">
        @yield('desc')
    </div>

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <div class="container">
        @yield('footer')
    </div>
</body>
</html>