@extends('layouts.client.master')
@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="responsive flex justify-between gap-4 md:flex-row flex-col">
        {{-- Mobile Filter --}}
        <div id="openFilter" class="md:hidden flex items-center cursor-pointer w-fit mt-4">
            <h2 class=" text-lg tracking-widest">Lọc sản phẩm</h2>
            <span class="material-symbols-rounded text-orangeColor" style="font-size: 32px">
                filter_alt
            </span>
        </div>

        {{-- Filter Modal --}}
        <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-2xl w-[90%] max-w-[420px] relative">

                <!-- Reset Button -->
                <button class="absolute top-3 left-4 text-gray-600 hover:text-orange-500 transition">
                    <span class="material-symbols-rounded"
                        style="font-size: 30px; line-height: 36px; font-weight: 600">restart_alt</span>
                </button>

                <!-- Close Button -->
                <button id="closeFilter"
                    class="absolute top-3 right-4 text-gray-600 hover:text-red-500 transition text-2xl">
                    ✖
                </button>

                <h2 class="text-center text-xl font-semibold text-gray-800 mb-6 uppercase">Bộ lọc sản phẩm</h2>

                <!-- Danh mục -->
                <fieldset>
                    <div class="mb-6">
                        <legend class="text-orange-500 text-lg tracking-wide font-semibold mb-3">Thể loại</legend>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo cổ tròn</span>
                                <input type="checkbox" id="aoNamModal" class="w-5 h-5 accent-orange-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo cổ trụ</span>
                                <input type="checkbox" id="aoNuModal" class="w-5 h-5 accent-orange-500">
                            </label>
                        </div>
                    </div>

                    <div>
                        <legend class="text-orange-500 text-lg tracking-wide font-semibold mb-3">Danh mục</legend>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo nam</span>
                                <input type="checkbox" id="aoNamModal" class="w-5 h-5 accent-orange-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo nữ</span>
                                <input type="checkbox" id="aoNuModal" class="w-5 h-5 accent-orange-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo cặp đôi</span>
                                <input type="checkbox" id="aoCapModal" class="w-5 h-5 accent-orange-500">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo trẻ em</span>
                                <input type="checkbox" id="aoTreEmModal" class="w-5 h-5 accent-orange-500">
                            </label>
                        </div>
                    </div>
                </fieldset>

                <!-- Apply Button -->
                <div class="mt-6 text-center">
                    <button
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg text-lg font-semibold shadow-md hover:bg-orange-600 transition">
                        Áp dụng bộ lọc
                    </button>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="shadow p-3 md:min-w-[200px] bg-gray rounded-lg h-fit md:block hidden">
            <div class="flex items-end justify-between mb-8">
                <h2 class="uppercase text-[16px] tracking-widest ">Lọc sản phẩm</h2>
                <span class="material-symbols-rounded cursor-pointer hover:text-orangeColor"
                    style="font-size: 26px; font-weight: 600">
                    restart_alt
                </span>
            </div>

            {{-- Danh mục --}}
            <fieldset class="w-[80%]">
                <div class="mb-6">
                    <legend class="uppercase text-orangeColor text-[18px] tracking-widest mb-2 font-medium">Thể loại
                    </legend>
                    <div class="ml-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoNam">Áo cổ tròn</label>
                            <input type="checkbox" name="aoNam" id="aoNam"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoNu">Áo cổ trụ</label>
                            <input type="checkbox" name="aoNu" id="aoNu"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                    </div>
                </div>

                <div>
                    <legend class="uppercase text-orangeColor text-[18px] tracking-widest mb-2 font-medium">Danh mục
                    </legend>
                    <div class="ml-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoNam">Áo nam</label>
                            <input type="checkbox" name="aoNam" id="aoNam"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoNu">Áo nữ</label>
                            <input type="checkbox" name="aoNu" id="aoNu"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoCap">Áo cặp đôi</label>
                            <input type="checkbox" name="aoCap" id="aoCap"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="aoTreEm">Áo trẻ em</label>
                            <input type="checkbox" name="aoTreEm" id="aoTreEm"
                                class="w-5 h-5 cursor-pointer accent-orangeColor">
                        </div>
                    </div>
                </div>
            </fieldset>

            {{-- Apply Button --}}
            <div class="mt-6 text-center">
                <button
                    class="bg-orange-500 text-white px-4 py-2 rounded-lg text-md font-semibold shadow-md hover:bg-orange-600 transition">
                    Áp dụng bộ lọc
                </button>
            </div>
        </div>

        {{-- Product --}}
        <div class="w-full">
            <div
                class=" grid md:grid-rows-1 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 md:gap-x-2 md:gap-y-6 sm:gap-4 gap-x-2 gap-y-4">
                @for ($i = 0; $i < 12; $i++)
                    <div
                        class="relative bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl group">
                        <!-- Discount badge -->
                        <span
                            class="absolute top-2 left-2 bg-orangeColor text-white text-xs font-semibold px-3 py-1.5 rounded-full z-10">
                            Giảm 35%
                        </span>

                        <!-- Product image -->
                        <a href="{{ route('product.detail') }}">
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
                        </a>

                        <!-- Product details -->
                        <div class="md:px-4 md:py-2 p-2">
                            <a href="{{ route('product.detail') }}">
                                <p
                                    class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                    Áo phông Ông già Noel tùy chỉnh dành cho nam – Áo phông Giáng sinh thời trang cho ngày
                                    lễ
                                </p>
                            </a>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <p class="text-orangeColor md:text-md sm:text-sm text-[14px] font-[550]">149.000đ
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

    <script>
        document.getElementById("openFilter").addEventListener("click", function() {
            document.getElementById("filterModal").classList.remove("hidden");
            document.getElementById("filterModal").classList.add("flex");
        });

        document.getElementById("closeFilter").addEventListener("click", function() {
            document.getElementById("filterModal").classList.add("hidden");
        });

        document.getElementById("filterModal").addEventListener("click", function(event) {
            if (event.target === this) {
                this.classList.add("hidden");
            }
        });
    </script>
@endsection
