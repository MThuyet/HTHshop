@vite(['resources/css/Register.css', 'resources/js/Register.js'])
@extends("layouts.master");

@section('title', 'Đăng Ký')

@section('content')
    <div class="register__container">
        <div class="register__wrapper-left">
            <form action="" method="POST">
                <h2>Đăng ký tài khoản</h2>
                <div class="mb-3">
                    <label for="last-name">Họ <span style="color: var(--red-color)">*</span></label>
                    <input id="last-name" placeholder="Họ" 
                        type="text"
                        name="lastName"
                        pattern="[A-Za-zÀ-ỹ ]+$"
                        required
                    >
                    <small class="error-message"></small>
                </div>

                <div class="mb-3">
                    <label for="first-name">Tên <span style="color: var(--red-color)">*</span></label>
                    <input id="first-name" placeholder="Tên"
                        type="text"
                        name="firstName"
                        pattern="[A-Za-zÀ-ỹ ]+$"
                        maxlength="25" 
                        required
                    >
                    <small class="error-message"></small>
                </div>
                
                <div class="mb-3">
                    <label for="phone-number">Số điện thoại <span style="color: var(--red-color)">*</span></label>
                    <input id="phone-number" placeholder="Số điện thoại" 
                        type="tel"
                        name="phoneNumber"
                        pattern="0[0-9]{9,10}$"
                        required
                    >
                    <small class="error-message"></small>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span style="color: var(--red-color)">*</span></label>
                    <input id="email" placeholder="Email" 
                        type="email"
                        name="email"
                        pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                        required
                    >
                    <small class="error-message"></small>
                </div>

                <div class="mb-3">
                    <label for="password">Mật khẩu <span style="color: var(--red-color)">*</span></label>
                    <input id="password" type="password" placeholder="Mật khẩu" 
                        name="password"
                        minlength="5"
                        maxlength="60"
                        required
                    >
                    <small class="error-message"></small>
                </div>

                <input type="submit" value="ĐĂNG KÝ" name="btnSubmitRegister">
                @csrf
            </form>
            <p class="register-with-others"><span>Hoặc đăng nhập bằng</span></p>
            <div class="register__wrapper-socials">
                <a href=""><img src="https://bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg" alt="Facebook"></a>
                <a href=""><img src="https://bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg" alt="Google"></a>
            </div>
        </div>
        <div class="register__wrapper-right">
            <h2>Quyền lợi thành viên</h2>
            <ul>
                <li>Vận chuyển siêu tốc</li>
                <li>Sản phẩm đa dạng</li>
                <li>Đổi trả dễ dàng</li>
                <li>Tích điểm đổi quà</li>
                <li>Được giảm giá cho lần mua tiếp theo lên đến 10%</li>
            </ul>
            <a href="{{ route('LoginRoute') }}" class="btn-register">Đăng nhập</a>
        </div>
    </div>
@endsection