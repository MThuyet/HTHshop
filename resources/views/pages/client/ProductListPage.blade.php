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
        <form id="filterModal" action="{{ url()->current() }}" method="POST"
            class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-2xl w-[90%] max-w-[420px] relative">
                @csrf
                <!-- Reset Button -->
                <a href="{{ url()->current() }}"
                    class="absolute top-3 left-4 text-gray-600 hover:text-orange-500 transition">
                    <span class="material-symbols-rounded"
                        style="font-size: 30px; line-height: 36px; font-weight: 600">restart_alt</span>
                </a>

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
                                <input type="checkbox" name="neckTypes[]" id="modal-round-neck" value="ROUND_NECK"
                                    class="w-5 h-5 accent-orange-500" @if (in_array('ROUND_NECK', $selectedNeckTypes ?? [])) checked @endif>
                            </label>
                            <label class="flex items-center justify-between cursor-pointer">
                                <span>Áo cổ trụ</span>
                                <input type="checkbox" name="neckTypes[]" id="modal-collar-neck" value="COLLAR_NECK"
                                    class="w-5 h-5 accent-orange-500" @if (in_array('COLLAR_NECK', $selectedNeckTypes ?? [])) checked @endif>
                            </label>
                        </div>
                    </div>

                    <div>
                        <legend class="text-orange-500 text-lg tracking-wide font-semibold mb-3">Danh mục</legend>
                        <div class="space-y-4">
                            @foreach ($categories as $category)
                                <label class="flex items-center justify-between cursor-pointer">
                                    <span>{{ $category->name }}</span>
                                    <input type="checkbox" name="categories[]" id="moal-cate-{{ $category->id }}"
                                        value="{{ $category->id }}" class="w-5 h-5 accent-orange-500"
                                        @if (in_array($category->id, $selectedCategories ?? [])) checked @endif>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </fieldset>

                <!-- Apply Button -->
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg text-lg font-semibold shadow-md hover:bg-orange-600 transition">
                        Áp dụng bộ lọc
                    </button>
                </div>
            </div>
        </form>

        {{-- Sidebar --}}
        <form class="shadow p-3 md:min-w-[200px] bg-gray rounded-lg h-fit md:block hidden" action="{{ url()->current() }}"
            method="POST">
            @csrf
            <div class="flex items-end justify-between mb-8">
                <h2 class="uppercase text-[16px] tracking-widest ">Lọc sản phẩm</h2>
                <a href="{{ url()->current() }}" class="flex items-center justify-center">
                    <span class="material-symbols-rounded cursor-pointer hover:text-orangeColor"
                        style="font-size: 26px; font-weight: 600">
                        restart_alt
                    </span>
                </a>
            </div>

            {{-- Danh mục --}}
            <fieldset class="w-[80%]">
                <div class="mb-6">
                    <legend class="uppercase text-orangeColor text-[18px] tracking-widest mb-2 font-medium">Thể loại
                    </legend>
                    <div class="ml-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="round-neck">Áo cổ tròn</label>
                            <input type="checkbox" name="neckTypes[]" id="round-neck" value="ROUND_NECK"
                                class="w-5 h-5 cursor-pointer accent-orangeColor"
                                @if (in_array('ROUND_NECK', $selectedNeckTypes ?? [])) checked @endif>
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer" for="collar-neck">Áo cổ trụ</label>
                            <input type="checkbox" name="neckTypes[]" id="collar-neck" value="COLLAR_NECK"
                                class="w-5 h-5 cursor-pointer accent-orangeColor"
                                @if (in_array('COLLAR_NECK', $selectedNeckTypes ?? [])) checked @endif>
                        </div>
                    </div>
                </div>

                <div>
                    <legend class="uppercase text-orangeColor text-[18px] tracking-widest mb-2 font-medium">Danh mục
                    </legend>
                    <div class="ml-4 space-y-3">
                        @foreach ($categories as $category)
                            <div class="flex items-center justify-between">
                                <label for="cate-{{ $category->id }}" class="cursor-pointer">
                                    {{ $category->name }}
                                </label>
                                <input type="checkbox" name="categories[]" id="cate-{{ $category->id }}"
                                    value="{{ $category->id }}" class="w-5 h-5 cursor-pointer accent-orangeColor"
                                    @if (in_array($category->id, $selectedCategories ?? [])) checked @endif>
                            </div>
                        @endforeach
                    </div>
                </div>
            </fieldset>

            {{-- Apply Button --}}
            <div class="mt-6 text-center">
                <button
                    class="bg-orange-500 text-white px-4 py-2 rounded-lg text-md font-semibold shadow-md hover:bg-orange-600 transition"
                    type="submit">
                    Áp dụng bộ lọc
                </button>
            </div>
        </form>

        {{-- Product --}}
        <div class="w-full">
            <div
                class=" grid md:grid-rows-1 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-2 lg:gap-x-4">
                @foreach ($products as $product)
                    <div
                        class="slide-up-effect relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg">
                        <!-- Discount badge -->
                        <span
                            class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                            -{{ $product->discount }}%
                        </span>

                        <!-- Product image -->
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <div class="relative overflow-hidden cursor-pointer">
                                <img src="{{ asset('storage/images/products/' . $product->product_image->image) }}"
                                    alt="{{ $product->name }}" class="w-full h-60 object-cover object-center rounded-t-md">

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
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <p
                                    class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                    {{ $product->name }}
                                </p>
                            </a>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <p class="text-orangeColor font-semibold text-[14px]">
                                        {{ number_format($product->default_price - ($product->default_price * $product->discount) / 100, 0, ',', '.') }}đ
                                    </p>
                                    <p class="text-gray-400 line-through text-[12px]">
                                        {{ number_format($product->default_price, 0, ',', '.') }}đ
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
