<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - HTH Shop</title>
    @vite(['resources/css/app.css', 'resources/js/admin/main.js'])

    {{-- Gg font --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@200" rel="stylesheet" />

    {{-- Toast --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="h-screen">
    <div id="app" class="bg-[#F2F8FF]">
        {{-- Header --}}
        <header
            class="fixed top-0 left-0 z-[1000] right-0 flex justify-between items-center py-2 px-5 bg-white shadow-md">
            @include('layouts.admin.Header')
        </header>

        {{-- Main Content --}}
        <main class="pt-[80px] px-5 min-h-screen">
            @if (!empty($breadCrump))
                <div class="text-sm mb-2">
                    <span class="mx-1 text-gray-400">/</span>
                    @foreach ($breadCrump as $item)
                        <a href="{{ $item['href'] }}" class="hover:underline text-gray-700">{{ $item['name'] }}</a>
                        @unless ($loop->last)
                            <span class="mx-1 text-gray-400">/</span>
                        @endunless
                    @endforeach
                </div>
            @endif
            @yield('content')

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.js"></script>

            @if (session('toast'))
                <script>
                    // Sử dụng timestamp trong khóa để phân biệt các thông báo
                    const toastKey = 'toast_shown_{{ session()->getId() }}_{{ time() }}';
                    if (!sessionStorage.getItem(toastKey)) {
                        Swal.fire({
                            icon: '{{ session('toast')['icon'] ?? 'info' }}',
                            title: '{{ session('toast')['title'] ?? '' }}',
                            text: '{{ session('toast')['text'] ?? '' }}',
                            toast: true,
                            position: '{{ session('toast')['position'] ?? 'top-end' }}',
                            showConfirmButton: false,
                            timer: '{{ session('toast')['timer'] ?? '3000' }}',
                        });
                        // Đánh dấu thông báo đã hiển thị trong sessionStorage
                        sessionStorage.setItem(toastKey, '1');
                    }
                </script>
            @endif
            @stack('scripts')
        </main>
    </div>
</body>

</html>
