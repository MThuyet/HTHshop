<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<div class="fixed left-3 top-2/3 transform -translate-y-1/2 flex flex-col gap-3 z-50">
    <!-- Nút Facebook -->
    <a href="https://www.facebook.com/" target="_blank"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-800 transition">
        <i class="fab fa-facebook-f text-xl"></i>
    </a>

    <!-- Nút Zalo -->
    <a href="https://zalo.me/" target="_blank"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-700 transition">
        <i class="fas fa-comment-dots text-xl"></i>
    </a>

    <!-- Nút Điện thoại -->
    <a href="tel:0123456789"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-green-500 text-white rounded-full shadow-lg hover:bg-green-700 transition">
        <i class="fas fa-phone-alt text-xl"></i>
    </a>
</div>

<body data-simplebar class="h-screen">
    <div id="app">
        <header>
            @include('layouts.Header')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            @include('layouts.Footer')
        </footer>
    </div>
</body>

</html>
