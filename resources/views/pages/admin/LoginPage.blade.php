@extends('layouts.client.Master')
@vite(['resources/css/admin/Login.css', 'resources/js/admin/Login.js'])

@section('title', 'Đăng Nhập')

@section('content')
    <div class="login__container mt-6">
        <div class="login__wrapper-left">
            <form action="" method="POST">
                <h2 class="sub-title">Đăng nhập tài khoản</h2>
                <div class="errors__container">
                    {{-- Hiển thị lỗi từ session --}}
                    @if (session('error'))
                        <div class="alert alert-danger" style="color: red; font-weight: bold; margin-bottom: 1rem;">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email">Email <span style="color: var(--red-color)">*</span></label>
                    <input id="email" placeholder="Email" type="email" name="email"
                        pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                    <small class="error-message"></small>
                </div>

                <div class="mb3">
                    <label for="password">Mật khẩu <span style="color: var(--red-color)">*</span></label>
                    <input id="password" placeholder="Mật khẩu" type="password" name="password" minlength="5"
                        maxlength="60" required>
                    <small class="error-message"></small>
                </div>

                <input class="mt-8 cursor-pointer" type="submit" value="ĐĂNG NHẬP" name="btnSubmitLogin">
                @csrf
            </form>
        </div>
        <div class="login__wrapper-right">
            <h2>Quyền lợi thành viên</h2>
            <ul>
                <li>Vận chuyển siêu tốc</li>
                <li>Sản phẩm đa dạng</li>
                <li>Đổi trả dễ dàng</li>
                <li>Tích điểm đổi quà</li>
                <li>Được giảm giá cho lần mua tiếp theo lên đến 10%</li>
            </ul>
        </div>
    </div>
@endsection
