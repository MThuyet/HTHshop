@extends('layouts.Master')
@section('title')
    Trang chủ
@endsection

@vite(['resources/js/Home.js'])

@section('content')
    {{-- Banner --}}
    <div class="banner">
        <img class="w-full object-cover" src="{{ asset('images/banner-home.webp') }}" alt="">
    </div>

    {{-- Service --}}
    <div class="content responsive">
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

    {{-- Mẫu mới về --}}
    <div class="new-product responsive">
        <h2 class="sub-title">Mẫu mới về</h2>

        <div class="slide-up-effect grid md:grid-rows-1 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">
            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
										rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
												opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
       												line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ</p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product2.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
										rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
												opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
       								line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam khóa cổ phối sọc caro
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ</p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product3.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
										rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
												opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
       													line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam phối khóa cổ basic
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ</p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
										rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
												opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
       						line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ</p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
										rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
												opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
      								 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Promo banner --}}
    <div
        class="promo-banner lg:w-10/12 md:w-11/12 mx-auto grid sm:grid-cols-2 grid-cols-1 lg:mt-10 mt-6 gap-4 sm:gap-5 overflow-hidden px-4 hidden-promo-banner">
        <div class="w-full ">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner1.webp') }}" alt="">
        </div>
        <div class="w-full  grid grid-cols-2 grid-rows-[auto_auto] gap-4 sm:gap-5">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner2.webp') }}" alt="">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner3.webp') }}" alt="">
            <img class="w-full object-cover col-span-2 rounded-lg" src="{{ asset('images/promo-banner4.webp') }}"
                alt="">
        </div>
    </div>

    {{-- Sale đồng giá --}}
    <div class="sale-product responsive mt-8">
        <h2 class="sub-title">Sale đồng giá</h2>

        <div class="slide-up-effect grid md:grid-rows-1 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">
            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
									rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
											opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
														 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product2.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
									rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
											opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
										 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam khóa cổ phối sọc caro
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product3.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
									rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
											opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
															 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam phối khóa cổ basic
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
									rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
											opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
								 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
									rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
											opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
										 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Notification Bar --}}
    <div class="notification-bar responsive">
        <div class="w-full py-5 px-5 rounded bg-redColor flex items-center justify-center text-white text-lg relative">
            <div id="promo-text" class="text-justify transition-opacity duration-500 opacity-100">
                HOT: Sale 50% cho toàn bộ đơn hàng có giá trị từ 2 triệu, miễn phí ship toàn quốc
            </div>
        </div>
    </div>

    {{-- Top bán chạy --}}
    <div class="slide-up-effect sale-product responsive ">
        <h2 class="sub-title">Top bán chạy</h2>

        <div class="grid md:grid-rows-1 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">
            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
							rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
									opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
												 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product2.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
							rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
									opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
								 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam khóa cổ phối sọc caro
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product3.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
							rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
									opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
													 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo Polo nam phối khóa cổ basic
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
							rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
									opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
						 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                <!-- Discount badge -->
                <span
                    class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                    Giảm 35%
                </span>

                <!-- Product image -->
                <div class="relative overflow-hidden cursor-pointer">
                    <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                        class="w-full h-60 object-cover transition-transform duration-300 hover:scale-105">

                    <!-- Add to cart button with tooltip -->
                    <button
                        class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center
							rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                        <span class="material-symbols-rounded" style="font-weight: 600">
                            add_shopping_cart
                        </span>

                        <!-- Tooltip -->
                        <span
                            class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap
									opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                            Thêm vào giỏ hàng
                        </span>
                    </button>
                </div>

                <!-- Product details -->
                <div class="md:px-4 md:py-2 p-2">
                    <p
                        class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
								 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                        Áo thun in hình
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
                            </p>
                            <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Banner phụ --}}
    <div class="sub-banner responsive">
        <img class="w-full rounded object-cover" src="{{ asset('images/sub-banner-home.png') }}" alt="">
    </div>

    {{-- Từ khóa hot --}}
    <div class="responsive">
        <div class="flex gap-6 md:flex-row flex-col">
            <h2 class="uppercase text-[28px] tracking-widest text-nowrap">Từ khóa hot</h2>
            <div class="flex flex-wrap gap-3">
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo Polo
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo khoác da
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo chống nắng
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Chân váy
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo sơ mi
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo thun nữ
                </div>
            </div>
        </div>
    </div>

    {{-- Tin tức mới nhất --}}
    <div class="responsive mt-6 ">
        <h2 class="uppercase text-[28px] tracking-widest text-nowrap text-center">Tin tức mới nhất</h2>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6 justify-between md:slide-up-effect">
            <div class="slide-up-effect">
                <div class="overflow-hidden">
                    <img class="aspect-[4/3] object-cover hover:scale-110 duration-500 cursor-pointer"
                        src="{{ asset('images/new1-home.webp') }}" alt="">
                </div>
                <p class="my-2 text-[#888888] text-sm">15/08/2021</p>
                <h3
                    class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                    Những phong cách thời
                    trang tối giản đáng chọn nhất cho mùa hè
                </h3>
                <p class="text-[#888888] text-sm line-clamp-2">
                    Áo thun là một trong những món thời trang biểu tượng của mùa hè. Không chỉ mang đến sự trẻ trung và năng
                    động, áo thun còn có thể giúp chị em ghi điểm thanh lịch. "Bí kíp" ở đây chính là lựa chọn áo thun trơn
                    màu trung tính.
                </p>
            </div>

            <div class="md:flex flex-col gap-4 block">
                <div class="md:flex gap-2 md:mt-0 mt-8 slide-up-effect">
                    <div class="overflow-hidden min-w-[200px]">
                        <img class="aspect-[4/3] md:w-[200px] object-cover hover:scale-110 duration-500 cursor-pointer"
                            src="{{ asset('images/new2-home.webp') }}" alt="">
                    </div>
                    <div>
                        <p class="mb-2 text-[#888888] text-sm">15/08/2021</p>
                        <h3
                            class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                            DGC Selection đạt top 1 hàng Việt Nam được người dùng yêu thích 2023
                        </h3>
                        <p class="text-[#888888] text-sm line-clamp-2">
                            Theo đơn vị, để nhận được đánh giá cao từ người dùng trong nhiều năm, thương hiệu thời trang nam
                            DGC Selection phải liên tục cải tiến, áp dụng quy trình sản xuất, công nghệ hiện đại và sử dụng
                            nguồn nguyên liệu "xanh", thân thiện với môi trường trong từng sản phẩm. Thiết kế áo phao của
                            nhãn hàng mang phong cách tối giản, hướng đến sự lịch lãm và nam tính. Sản phẩm được đánh giá
                            cao bởi ưu điểm dễ mặc, dễ phối đồ và thuận tiện sử dụng.
                        </p>
                    </div>
                </div>

                <div class="md:flex gap-2 md:mt-0 mt-8 slide-up-effect">
                    <div class="overflow-hidden min-w-[200px]">
                        <img class="aspect-[4/3] md:w-[200px] object-cover hover:scale-110 duration-500 cursor-pointer"
                            src="{{ asset('images/new3-home.webp') }}" alt="">
                    </div>
                    <div>
                        <p class="mb-2 text-[#888888] text-sm">15/08/2021</p>
                        <h3
                            class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                            SIR Tailor ra mắt bộ sưu tập 'The Blazy Revolution'
                        </h3>
                        <p class="text-[#888888] text-sm line-clamp-2">
                            Tới năm 2023, Owen đã đưa gần 15 chất liệu xanh vào các thiết kế thời trang và nhận phản hồi
                            tích cực từ khách hàng. Trong đó, sơ mi sợi bạc hà, bã cà phê có nhiều đặc tính nổi trội, mang
                            tới trải nghiệm mặc thoải mái cho người dùng, đồng thời, thân thiện với môi trường.
                        </p>
                    </div>
                </div>

                <div class="md:flex gap-2 md:mt-0 mt-8 slide-up-effect">
                    <div class="overflow-hidden min-w-[200px]">
                        <img class="aspect-[4/3] md:w-[200px] object-cover hover:scale-110 duration-500 cursor-pointer"
                            src="{{ asset('images/new4-home.webp') }}" alt="">
                    </div>
                    <div>
                        <p class="mb-2 text-[#888888] text-sm">15/08/2021</p>
                        <h3
                            class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                            Những món đồ giúp đàn ông ghi điểm phong cách
                        </h3>
                        <p class="text-[#888888] text-sm line-clamp-2">
                            Theo cuộc khảo sát "Phụ nữ thích đàn ông mặc gì" của tạp chí Esquire, khi đưa ra bảng màu trang
                            phục mà phụ nữ cho rằng lý tưởng với đàn ông, đa số họ chọn xanh dương (chiếm 42%), màu hồng
                            chiếm 12,9%, số còn lại chia đều cho các màu khác.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slider infinite --}}
    <div class="w-full overflow-hidden whitespace-nowrap bg-redColor py-4 mb-6">
        <div class="inline-block animate-marquee">
            <span class="text-white text-2xl font-bold mx-8">🔥 Sản phẩm mới nhất!</span>
            <span class="text-white text-2xl font-bold mx-8">🚀 Giảm giá sốc!</span>
            <span class="text-white text-2xl font-bold mx-8">💥 Mua ngay kẻo lỡ!</span>
            <span class="text-white text-2xl font-bold mx-8">🎉 Freeship toàn quốc!</span>
        </div>
    </div>
@endsection
