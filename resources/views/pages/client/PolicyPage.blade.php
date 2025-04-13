@extends('layouts.client.master')
@section('title', 'Chính sách')
@vite(['resources/css/PolicyPage.css'])

@section('content')
    <div class="responsive">
        <div class="policy">
            <h1 class="policy__title">Chính Sách Bảo Mật</h1>
            <p class="policy__date">Cập nhật lần cuối: 13/04/2025</p>

            <div class="policy__section">
                <p class="policy__text">
                    Website <strong>HTHshop</strong> cam kết bảo mật thông tin cá nhân của khách hàng khi mua sắm các sản
                    phẩm thời trang, bao gồm quần áo, phụ kiện và các mẫu logo thiết kế.
                </p>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">1. Thông tin thu thập</h2>
                <p class="policy__text">Chúng tôi có thể thu thập các thông tin sau:</p>
                <ul class="policy__list">
                    <li class="policy__list-item">Họ tên, email, số điện thoại, địa chỉ giao hàng</li>
                    <li class="policy__list-item">Lịch sử mua hàng, mặt hàng bạn quan tâm</li>
                    <li class="policy__list-item">Hình ảnh hoặc logo bạn gửi để in lên áo (nếu có)</li>
                </ul>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">2. Mục đích sử dụng thông tin</h2>
                <p class="policy__text">Thông tin cá nhân được sử dụng để:</p>
                <ul class="policy__list">
                    <li class="policy__list-item">Xử lý đơn hàng và giao hàng đúng địa chỉ</li>
                    <li class="policy__list-item">Liên hệ khi có vấn đề về đơn hàng hoặc thiết kế logo</li>
                    <li class="policy__list-item">Gửi email khuyến mãi (nếu bạn đồng ý)</li>
                    <li class="policy__list-item">Cải thiện trải nghiệm mua sắm</li>
                </ul>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">3. Bảo mật dữ liệu logo và thiết kế</h2>
                <p class="policy__text">Logo hoặc thiết kế do bạn gửi sẽ chỉ được sử dụng cho mục đích in lên sản phẩm của
                    bạn. Chúng tôi cam kết không sử dụng hoặc chia sẻ thiết kế đó cho mục đích khác nếu không có sự đồng ý
                    rõ ràng từ bạn.</p>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">4. Chia sẻ với bên thứ ba</h2>
                <p class="policy__text">Thông tin chỉ được chia sẻ với đơn vị vận chuyển và thanh toán để phục vụ đơn hàng.
                    Không chia sẻ cho bên thứ ba vì mục đích thương mại khác.</p>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">5. Quyền của khách hàng</h2>
                <p class="policy__text">Bạn có quyền yêu cầu chỉnh sửa, truy cập hoặc xóa dữ liệu cá nhân bất kỳ lúc nào
                    bằng cách liên hệ với chúng tôi.</p>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">6. Liên hệ</h2>
                <p class="policy__text">Mọi thắc mắc về chính sách bảo mật vui lòng liên hệ:</p>
                <ul class="policy__contact-list">
                    <li class="policy__contact-item">Email: hthsp@gmail.com</li>
                    <li class="policy__contact-item">Hotline: 0332 393 031</li>
                </ul>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">7. Chính sách đổi trả</h2>
                <p class="policy__text">Chúng tôi hỗ trợ đổi trả sản phẩm trong vòng <strong>7 ngày</strong> kể từ ngày nhận
                    hàng, áp dụng với các trường hợp sau:</p>
                <ul class="policy__list">
                    <li class="policy__list-item">Sản phẩm bị lỗi do nhà sản xuất (rách, lỗi in, lỗi đường may...)</li>
                    <li class="policy__list-item">Giao nhầm mẫu, sai size, sai số lượng</li>
                </ul>
                <p class="policy__text"><strong>Điều kiện đổi trả:</strong></p>
                <ul class="policy__list">
                    <li class="policy__list-item">Sản phẩm còn nguyên tem, nhãn, chưa qua sử dụng hoặc giặt</li>
                    <li class="policy__list-item">Kèm theo hóa đơn mua hàng hoặc mã đơn hàng</li>
                </ul>
                <p class="policy__text">Chúng tôi không áp dụng đổi trả với sản phẩm thiết kế theo yêu cầu (in logo riêng).
                </p>
            </div>

            <div class="policy__section">
                <h2 class="policy__section-title">8. Điều khoản sử dụng</h2>
                <p class="policy__text">Khi sử dụng website của chúng tôi, bạn đồng ý tuân thủ các điều khoản sau:</p>
                <ul class="policy__list">
                    <li class="policy__list-item">Không sao chép, tái sử dụng nội dung, hình ảnh, logo trên website mà không
                        có sự cho phép</li>
                    <li class="policy__list-item">Không sử dụng website để thực hiện các hành vi gian lận, lừa đảo hoặc vi
                        phạm pháp luật</li>
                    <li class="policy__list-item">Không tải lên nội dung, hình ảnh phản cảm, vi phạm bản quyền khi sử dụng
                        tính năng thiết kế áo/logo</li>
                </ul>
                <p class="policy__text">Chúng tôi có quyền chỉnh sửa các điều khoản mà không cần thông báo trước. Người dùng
                    nên kiểm tra định kỳ để cập nhật thông tin.</p>
            </div>


            <p class="policy__text">Việc tiếp tục sử dụng website đồng nghĩa bạn đồng ý với chính sách bảo mật này.</p>
        </div>

    </div>
@endsection
