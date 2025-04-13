@extends('layouts.client.master')
@section('title', 'Danh sách yêu thích')

@section('content')
    <div class="responsive">
        <h2 class="sub-title">Sản phẩm yêu thích</h2>

        <div
            class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-3 lg:gap-x-5">
            @for ($i = 0; $i < 12; $i++)
                <div
                    class="relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg">
                    <!-- Discount badge -->
                    <span
                        class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                        -35%
                    </span>

                    <!-- Product image -->
                    <a href="{{ route('product.detail') }}">
                        <div class="relative overflow-hidden cursor-pointer">
                            <img src="{{ asset('images/product1.png') }}" alt="Áo Polo Phối Khóa Cổ"
                                class="w-full h-60 object-cover rounded-t-md">

                            <!-- Wishlist button with tooltip -->
                            <button
                                class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full shadow-md group/button">
                                <span class="material-symbols-rounded icon-heart">
                                    favorite
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="tooltip-text absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 delay-100 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Yêu thích
                                </span>
                            </button>

                            <!-- Add to cart button with tooltip -->
                            <button
                                class="absolute bottom-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full transition-all shadow-md group/button">
                                <span class="material-symbols-rounded">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>
                    </a>

                    <!-- Product details -->
                    <div class="md:px-4 md:py-2 p-2">
                        <a href="{{ route('product.detail') }}">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                Áo phông Ông già Noel tùy chỉnh dành cho nam – Áo phông Giáng sinh thời trang cho ngày lễ
                            </p>
                        </a>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <p class="text-orangeColor font-semibold text-[14px]">149.000đ</p>
                                <p class="text-gray-400 line-through text-[12px]">220.000đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
