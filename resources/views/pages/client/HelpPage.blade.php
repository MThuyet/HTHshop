@extends('layouts.client.master')
@section('title', 'Câu hỏi thường gặp')
@vite(['resources/css/client/HelpPage.css', 'resources/js/client/Help.js'])

@section('content')
    <div class="responsive p-6">
        <div>
            <h2 class="uppercase text-[24px] md:text-[28px] tracking-widest">Câu hỏi thường gặp</h2>
            {{-- Content --}}
            <div class="w-full p-3">
                <div class="faq__list">

                    <div class="faq__item">
                        <div
                            class="faq__question flex justify-between items-center cursor-pointer py-3 px-2 font-semibold shadow-sm rounded hover:text-orangeColor transition-all">
                            <span>1. Sản phẩm có giống với màu và hình ảnh thực tế sản phẩm không?</span>
                            <span class="material-symbols-rounded transition-transform"
                                style="font-size: 30px; font-weight: 500">expand_more</span>
                        </div>
                        <div class="faq__answer p-3 text-textColor hidden">
                            Chào bạn, sản phẩm như hình bạn nhé. Màu sắc qua ảnh chụp sẽ có thể có chút chênh lệch không
                            đáng kể so với thực tế ạ.
                        </div>
                    </div>

                    <div class="faq__item">
                        <div
                            class="faq__question flex justify-between items-center cursor-pointer py-3 px-2 font-semibold shadow-sm rounded hover:text-orangeColor transition-all">
                            <span>2. Sản phẩm báo hết hàng khi nào sẽ về lại hàng?</span>
                            <span class="material-symbols-rounded transition-transform"
                                style="font-size: 30px; font-weight: 500">expand_more</span>
                        </div>
                        <div class="faq__answer p-3 text-textColor hidden">
                            Thời gian về hàng tùy thuộc vào từng sản phẩm, bạn có thể liên hệ để biết thêm thông tin.
                        </div>
                    </div>

                    <div id="huong-dan-mua-hang" class="faq__item">
                        <div
                            class="faq__question flex justify-between items-center cursor-pointer py-3 px-2 font-semibold shadow-sm rounded hover:text-orangeColor transition-all">
                            <span>3. Làm sao để tôi có thể mua hàng?</span>
                            <span class="material-symbols-rounded transition-transform"
                                style="font-size: 30px; font-weight: 500">expand_more</span>
                        </div>
                        <div class="faq__answer p-3 text-textColor hidden">
                            Để mua hàng, bạn cần đăng nhập tài khoản, chọn sản phẩm muốn mua, lựa chọn màu sắc, kích
                            thước,...Sau đó ấn nút thêm vào giỏ hàng hoặc mua ngay, bạn sẽ được chuyển đến trang thanh toán,
                            tại đây nhập thông tin thanh toán là xong.
                        </div>
                    </div>

                    <div class="faq__item">
                        <div
                            class="faq__question flex justify-between items-center cursor-pointer py-3 px-2 font-semibold shadow-sm rounded hover:text-orangeColor transition-all">
                            <span>4. Tôi có thể tùy chỉnh hình ảnh tôi muốn để in trên áo không?</span>
                            <span class="material-symbols-rounded transition-transform"
                                style="font-size: 30px; font-weight: 500">expand_more</span>
                        </div>
                        <div class="faq__answer p-3 text-textColor hidden">
                            Có, bạn hoàn toàn có thể chọn 1 hình ảnh bạn muốn in lên áo trong lúc chọn màu sắc, kích thước
                            của áo, nhưng điều này là không bắt buộc.
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="huong-dan-chon-size" class="mt-6">
            <h2 class="uppercase text-[24px] md:text-[28px] tracking-widest">Hướng dẫn chọn size</h2>

            <div class="md:w-[60%] w-[90%] mt-3 mx-auto md:mx-0 p-3">
                <img class="w-full object-cover cursor-pointer" id="imagePreview"
                    src="{{ asset('images/huong-dan-chon-size.png') }}" alt="Hướng dẫn chọn size">
            </div>
        </div>

        <!-- Modal Preview Image -->
        <div id="imageModal"
            class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <span id="closeModal" class="absolute top-4 right-4 text-white text-2xl cursor-pointer">&times;</span>
            <img id="previewImage" class="max-w-full max-h-full object-contain">
        </div>

    </div>
@endsection
