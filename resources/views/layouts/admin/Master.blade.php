<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
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
        <header class="fixed top-0 left-0 z-[1000] right-0 flex justify-between items-center py-2 px-5 bg-white shadow-md">
            @include('layouts.admin.Header')
        </header>

        {{-- Main Content --}}
        <main class="pt-[80px] px-5 h-screen">
            @if (!empty($breadCrump))
                <div class="text-sm mb-2">
                    <span class="mx-1 text-gray-400">/</span>
                    @foreach ($breadCrump as $item)
                        <a href="{{ $item['href'] }}" class="hover:underline text-gray-700">{{ $item['name'] }}</a>
                        @unless($loop->last)
                            <span class="mx-1 text-gray-400">/</span>
                        @endunless
                    @endforeach
                </div>
            @endif
            @yield('content')
            
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.js"></script>

            @if (session('toast'))
                <script>
                    Swal.fire({
                        icon: '{{ session('toast.icon') ?? 'success' }}',
                        title: `{!! session('toast.title') ?? '' !!}`,
                        text: `{!! session('toast.text') ?? '' !!}`,
                        timer: `{{ session('toast.timer') ?? 3000  }}`,
                        showConfirmButton: false
                    });
                </script>
            @endif
            @stack('scripts')
        </main>
    </div>
</body>

</html>
