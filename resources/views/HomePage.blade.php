@extends('layouts.Master')
@section('title')
    Trang chủ
@endsection

@section('content')
    <div class="banner">
        <img class="w-full object-cover" src="{{ asset('images/banner-home.webp') }}" alt="">
    </div>

    <div class="content sm:w-10/12 mx-auto py-5 md:px-0 px-4">
        <div class="service grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-6 gap-x-2">
            <div class="flex items-center  lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_1.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Miễn phí giao hàng</p>
                    <p class="text-[12px] text-[#888888]">Miễn phí ship với đơn hàng > 498K</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_2.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Thanh toán COD</p>
                    <p class="text-[12px] text-[#888888]">Thanh toán khi nhận hàng (COD)</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_3.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Khách hàng VIP</p>
                    <p class="text-[12px] text-[#888888]">Ưu đãi dành cho khách hàng VIP</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_4.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Hỗ trợ bảo hành</p>
                    <p class="text-[12px] text-[#888888]">Đổi, sửa đồ tại tất cả store</p>
                </div>
            </div>
        </div>
    </div>
@endsection
