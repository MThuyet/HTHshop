{{-- Reminder: Check image src path and route name again after deploying to production --}}

<div style="font-family: 'Arial', sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px; border-radius: 8px;">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('images/hth-logo.png') }}" alt="HTH Logo" style="height: 60px;">
    </div>

    <p>
        Cảm ơn bạn đã liên hệ với 
        <a href="{{ url('/') }}" style="color: #ff6200; text-decoration: none;"><b>HTH Shop</b></a>. 
        Chúng tôi đã nhận được thông tin của bạn và sẽ phản hồi trong thời gian sớm nhất.
    </p>

    <h2 style="color: #eb3e32; text-align: center; padding-top: 30px; border-top: 1px solid #ddd;">Thông tin liên hệ của bạn</h2>

    <p><strong>👤 Họ tên:</strong> {{ $fullname }}</p>
    <p><strong>📧 Email:</strong> {{ $email }}</p>
    <p><strong>💬 Nội dung:</strong></p>
    
    <div style="background-color: #fff3ed; border-left: 5px solid #ff6200; padding: 12px 16px; border-radius: 4px; white-space: pre-line;">{{ $userMessage }}
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 13px; color: #888;">
        Cảm ơn bạn đã liên hệ với HTH Shop 💖
    </div>
    
    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center; font-size: 14px; color: #666;">
        <p style="margin-bottom: 10px;">
            <a href="{{ url('/') }}" style="color: #ff6200; text-decoration: none; margin: 0 6px;">Trang chủ</a> |
            <a href="{{ url('/products') }}" style="color: #ff6200; text-decoration: none; margin: 0 6px;">Sản phẩm</a> |
            <a href="{{ url('/tin-tuc') }}" style="color: #ff6200; text-decoration: none; margin: 0 6px;">Tin tức</a>
        </p>
        <p style="font-size: 12px; color: #aaa;">© {{ now()->year }} HTH Shop. All rights reserved.</p>
    </div>
</div>