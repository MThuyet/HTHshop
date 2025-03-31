@vite(['resources/css/Login.css', 'resources/js/Login.js'])
@extends("layouts.master");

@section('title', 'Đăng Nhập')

@section('content')
    <div class="login__container">
        <div class="login__wrapper-left">
            <form action="" method="POST">
                <h2>Đăng nhập tài khoản</h2>
                <div class="errors__container"></div>

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

                <div class="mb3">
                    <label for="password">Mật khẩu <span style="color: var(--red-color)">*</span></label>
                    <input id="password" placeholder="Mật khẩu"
                        type="password"
                        name="password"
                        minlength="5"
                        maxlength="60"
                        required    
                    >
                    <small class="error-message"></small>
                </div>

                <input type="submit" value="ĐĂNG NHẬP" name="btnSubmitLogin">
                @csrf
            </form>
            <p class="login-with-others"><span>Hoặc đăng nhập bằng</span></p>
            <div class="login__wrapper-socials">
                <a href=""><img src="https://bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg" alt="Facebook"></a>
                <a href=""><img src="https://bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg" alt="Google"></a>
            </div>
            <p class="text-center mb-2">
                Bạn quên mật khẩu bấm 
                <a href="" style="color: #007bff; text-decoration: underline;">vào đây</a>
            </p>
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
            <a href="{{ route('RegisterRoute') }}" class="btn-register">Đăng ký</a>
        </div>
    </div>
@endsection