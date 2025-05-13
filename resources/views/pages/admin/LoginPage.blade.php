<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập - HTH Shop</title>
    @vite(['resources/css/app.css', 'resources/js/admin/Login.js'])

    {{-- Gg font --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@200" rel="stylesheet">

    {{-- Toast --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="relative bg-gray-50 h-screen overflow-hidden">
    <a href="{{ route('home') }}"
        class="flex h-12 items-center justify-center bg-white rounded-md tracking-wider transition-all cursor-pointer border-none shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <span class="material-symbols-rounded">
            arrow_back
        </span>
        <span class="text-nowrap">Quay về trang chủ</span>
    </a>

    <form action="{{ route('handle-login') }}" method="POST"
        class="absolute top[50%] right-[50%] translate-x-[50%] translate-y-[25%] text-gray-800 antialiased overflow-hidden">
        @csrf
        <div class="relative py-3 max-w-[400px] mx-auto text-center">
            <h2 class="text-2xl font-bold">ĐĂNG NHẬP TÀI KHOẢN</h2>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-[var(--orange-color)] rounded-t-md"></div>
                <div class="px-8 py-6">
                    <div class="mb-3">
                        <label for="username" class="font-bold">Tên tài khoản
                            <span style="color: var(--red-color)">*</span>
                        </label>
                        <input id="username" class="w-full p-3 my-3 border rounded-lg" type="text" name="username"
                            placeholder="Nhập tên tài khoản" value="{{ old('username') }}" minlength="5" maxlength="50"
                            required>
                        <small class="error-message text-[var(--red-color)]"></small>
                    </div>

                    <div class="mb3">
                        <label for="password" class="font-bold">Mật khẩu
                            <span style="color: var(--red-color)">*</span>
                        </label>
                        <input id="password" class="w-full p-3 my-3 border rounded-lg" type="password" name="password"
                            placeholder="Nhập mật khẩu" value="{{ old('password') }}" minlength="5" maxlength="60"
                            required>
                        <small class="error-message text-[var(--red-color)]"></small>
                    </div>

                    <button type="submit"
                        class="mt-4 bg-[var(--orange-color)] text-white w-full py-2 px-6 rounded-md
                    hover:bg-[var(--red-color)] ">
                        Đăng Nhập
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.js"></script>
    @if (session('toast'))
        <script>
            // Sử dụng timestamp trong khóa để phân biệt các thông báo
            const toastKey = 'toast_shown_{{ session()->getId() }}_{{ time() }}';
            if (!sessionStorage.getItem(toastKey)) {
                Swal.fire({
                    icon: '{{ session('toast.icon') ?? 'success' }}',
                    title: '{{ session('toast.title') ?? '' }}',
                    text: '{{ session('toast.text') ?? '' }}',
                    toast: true,
                    position: '{{ session('toast.position') ?? 'top-end' }}',
                    showConfirmButton: false,
                    timer: '{{ session('toast.timer') ?? '3000' }}',
                });
                // Đánh dấu thông báo đã hiển thị trong sessionStorage
                sessionStorage.setItem(toastKey, '1');
            }
        </script>
    @endif
</body>

</html>
