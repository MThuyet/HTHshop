<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - HTH Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Gg font --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@200" rel="stylesheet">

    {{-- Toast --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<div class="fixed left-3 top-2/3 transform -translate-y-1/2 flex flex-col gap-3 z-50">
    <!-- Nút Facebook -->
    <a href="https://www.facebook.com/MThuyet" target="_blank"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-white text-white rounded-full shadow-lg transition overflow-hidden">
        <img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook" class="w-[90%]">
    </a>

    <!-- Nút Zalo -->
    <a href="https://zalo.me/0332393031" target="_blank"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-white text-white rounded-full shadow-lg transition overflow-hidden">
        <img src="{{ asset('images/zalo-icon.png') }}" alt="Zalo" class="w-[90%]">
    </a>

    <!-- Nút Điện thoại -->
    <a href="tel:0332393031"
        class="animate-phone-ring w-12 h-12 flex items-center justify-center bg-white text-white rounded-full shadow-lg transition overflow-hidden">
        <img src="{{ asset('images/phone-icon.png') }}" alt="Phone" class="w-[90%]">
    </a>
</div>

<body data-simplebar class="h-screen">
    <div id="app">
        <header>
            @include('layouts.client.Header')
        </header>
        <main>
            @yield('content')

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.js"></script>

            @if (session('toast'))
                <script>
                    Swal.fire({
                        icon: '{{ session('toast')['icon'] ?? "info" }}',
                        title: '{{ session('toast')['title'] ?? "" }}',
                        text: '{{ session('toast')['text'] ?? "" }}',
                        toast: true,
                        position: '{{ session('toast')['position'] ?? "top-end" }}',
                        showConfirmButton: false,
                        timer: '{{ session('toast')['timer'] ?? '3000' }}',
                    });
                </script>
            @endif

        </main>
        <footer>
            @include('layouts.client.Footer')
        </footer>
    </div>
</body>

</html>
