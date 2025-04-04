@extends('layouts.master')
@section('title', 'Slug của sản phẩm')

@vite('resources/js/ProductDetail.js')

@section('content')
    <div class="responsive">
        {{-- Chi tiết sản phẩm --}}
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 text-textColor">
            <div class="w-full flex justify-center">
                <img class="w-full md:w-[90%] lg:w-[80%] h-fit mx-auto rounded-lg object-cover"
                    src="{{ asset('images/product1.png') }}" alt="Sản phẩm">
            </div>

            <div class="flex flex-col gap-4">
                <p class="font-semibold">Áo phông Ông già Noel tùy chỉnh dành cho nam – Áo phông Giáng sinh
                    thời trang cho ngày lễ
                </p>

                <!-- Mô tả sản phẩm -->
                <div class=" flex flex-col gap-2 leading-relaxed ">
                    <p class="text-sm text-slate-600">
                        Áo phông Ông già Noel với thiết kế độc đáo và mang không
                        khí lễ
                        hội, phù hợp làm quà tặng hoặc mặc trong dịp Giáng sinh. Phom dáng thoải mái, dễ phối đồ.
                    </p>
                    <p class="italic">Chất liệu: 100% cotton cao cấp, thoáng mát và thấm hút tốt.</p>
                </div>

                {{-- Chọn màu áo --}}
                <div class="flex items-center gap-4">
                    <span>Chọn màu áo:</span>
                    <div class="flex gap-2">
                        <div
                            class="color-option md:w-9 cursor-pointer md:h-9 w-11 h-11 rounded-full border-[2px] overflow-hidden p-[3px] border-black">
                            <div class="bg-black w-full h-full border-[1px] border-black/30 rounded-full"></div>
                        </div>

                        <div
                            class="color-option md:w-9 cursor-pointer md:h-9 w-11 h-11 rounded-full border-[2px] overflow-hidden p-[3px]">
                            <div class="bg-gray-600 w-full h-full border-[1px] border-black/30 rounded-full"></div>
                        </div>

                        <div
                            class="color-option md:w-9 cursor-pointer md:h-9 w-11 h-11 rounded-full border-[2px] overflow-hidden p-[3px]">
                            <div class="bg-white w-full h-full border-[1px] border-black/30 rounded-full"></div>
                        </div>
                    </div>
                </div>

                {{-- Chọn size --}}
                <div class="flex flex-col gap-2">
                    <span>Chọn size:</span>
                    <div class="flex gap-2">
                        <!-- Size options: 1, 2, 3, 4, 5, 6 -->
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            1
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            2
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            3
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            4
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            5
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            6
                        </button>
                    </div>

                    <div class="flex gap-2 mt-2">
                        <!-- Size options: S, M, L, XL, XXL, XXXL -->
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            S
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            M
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            L
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            XL
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            XXL
                        </button>
                        <button
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm
																		hover:bg-orangeColor hover:text-white hover:border-orangeColor">
                            XXXL
                        </button>
                    </div>
                </div>

                {{-- Chọn số lượng --}}
                <div>
                    <span class="">Chọn số lượng</span>
                    <div class="flex items-center gap-2 mt-2">
                        <button id="decreaseBtn"
                            class="border-orangeColor border-[1px] border-gray-400 rounded-full px-1 py-1 hover:bg-orangeColor text-textColor hover:text-white"
                            onclick="decreaseQuantity()">
                            <span class="material-symbols-rounded text-orangeColor hover:text-white">
                                remove
                            </span>
                        </button>
                        <input id="quantity" type="number" value="1" min="1" max="50"
                            class="w-20 h-9 font-semibold text-center border-[1px] border-gray-400 rounded-md">
                        <button id="increaseBtn"
                            class="border-orangeColor border-[1px] border-gray-400 rounded-full px-1 py-1 hover:bg-orangeColor text-textColor hover:text-white"
                            onclick="increaseQuantity()">
                            <span class="material-symbols-rounded text-orangeColor hover:text-white">
                                add
                            </span>
                        </button>
                    </div>
                </div>

                {{-- Tùy chỉnh ảnh --}}
                <div class=" flex items-center gap-2">
                    <label for="customImage" class="hover:text-orangeColor cursor-pointer">Tôi muốn tùy chỉnh
                        ảnh</label>
                    <input id="customImage" type="checkbox" class="w-5 h-5 rounded border-gray-400 accent-orangeColor">
                </div>

                {{-- Ô upload ảnh --}}
                <div id="uploadContainer" class="hidden">
                    <label for="uploadImage"
                        class="flex flex-col items-center justify-center w-36 h-36 border-2 border-dashed border-orangeColor rounded-md cursor-pointer hover:bg-orange-50 transition overflow-hidden">
                        <img id="previewImage" class="hidden w-full h-full object-cover rounded-md" alt="Preview Image">
                        <div id="uploadPlaceholder" class="flex flex-col items-center">
                            <span class="material-symbols-rounded text-orangeColor mb-2"
                                style="font-size: 48px">upload</span>
                            <span class="text-gray-600 text-sm text-center">Nhấn để tải ảnh lên</span>
                        </div>
                        <input id="uploadImage" type="file" class="hidden" accept="image/*">
                    </label>
                </div>

                {{-- Button --}}
                <div class="flex flex-row md:items-center md:gap-4 gap-3 w-full">
                    <button
                        class="flex justify-center items-center w-fit md:w-auto lg:px-6 lg:py-3 px-4 py-3 border-2 border-orangeColor text-white bg-orangeColor rounded-lg hover:bg-white hover:text-orangeColor transition-all duration-300 relative overflow-hidden">
                        <span class="material-symbols-rounded">add_shopping_cart</span>
                        <span class="text-nowrap">Thêm vào giỏ hàng</span>
                    </button>

                    <button
                        class="flex justify-center items-center w-fit md:w-auto lg:px-6 lg:py-3 px-4 py-3 border-2 border-green-500 text-white bg-green-500 rounded-lg hover:bg-white hover:text-green-500 transition-all duration-300 relative overflow-hidden">
                        <span class="material-symbols-rounded">shopping_cart_checkout</span>
                        <span class="text-nowrap">Mua ngay</span>
                    </button>
                </div>

            </div>

        </div>

        <hr class="mt-14">

        {{-- Đã xem gần đây --}}
        <div class="mt-10">
            <h2 class="sub-title text-center">Đã xem gần đây</h2>
            <div class=" grid md:grid-rows-1 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">
                @for ($i = 0; $i < 5; $i++)
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
                                class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                                <span class="material-symbols-rounded" style="font-weight: 600">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>

                        <!-- Product details -->
                        <div class="md:px-4 md:py-2 p-2">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
													 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                                Áo thun nam in hình độc đáo tùy chỉnh
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">
                                        149.000đ
                                    </p>
                                    <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Sản phẩm liên quan --}}
        <div class="mt-20">
            <h2 class="sub-title text-center">Sản phẩm liên quan</h2>
            <div class=" grid md:grid-rows-1 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4">
                @for ($i = 0; $i < 5; $i++)
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
                                class="absolute bottom-2 right-2 w-10 h-10 bg-white/80 text-orangeColor flex items-center justify-center rounded-full transition-all duration-300 hover:bg-white hover:scale-110 shadow-md group/button">
                                <span class="material-symbols-rounded" style="font-weight: 600">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-3 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 group-hover/button:opacity-100 group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>

                        <!-- Product details -->
                        <div class="md:px-4 md:py-2 p-2">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1
												 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em]">
                                Áo thun nam in hình độc đáo tùy chỉnh
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <p class="text-orangeColor lg:text-lg md:text-md sm:text-sm text-[14px] font-[550]">
                                        149.000đ
                                    </p>
                                    <p class="text-[#888888] line-through text-[10px] sm:text-[12px]">220.000đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
