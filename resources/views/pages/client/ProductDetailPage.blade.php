@extends('layouts.client.master')
@section('title', $product->name)

@vite('resources/js/client/ProductDetail.js')

@section('content')
    <div class="responsive">
        {{-- Chi tiết sản phẩm --}}
        <form class="grid md:grid-cols-2 grid-cols-1 gap-4 text-textColor" id="productDetailForm" action="" method="POST"
            enctype="multipart/form-data" data-variants="{{ $product->variants->toJson() }}">
            @csrf
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <input type="hidden" name="productName" value="{{ $product->name }}">
            <input type="hidden" name="mainImage"
                value="{{ asset('storage/images/products/' . $product->images[0]->image) }}">
            <input type="hidden" name="price" id="priceInput"
                value="{{ $product->variants->where('print_position', 'CENTER_CHEST_A4')->first()->price ?? 0 }}">
            <input type="hidden" name="productVariantId" id="productVariantId"
                value="{{ $product->variants->where('print_position', 'CENTER_CHEST_A4')->first()->id ?? '' }}">

            <div class="w-full flex items-center flex-col-reverse gap-2">
                <!-- Ảnh nhỏ (thumbnail) -->
                <div class="flex flex-row gap-2 w-full items-center justify-center">
                    @foreach ($product->images as $index => $img)
                        <div class="w-20 h-20 overflow-hidden rounded-md border cursor-pointer thumbnail
                    {{ $index === 0 ? 'border-blue-500 border-2' : 'border-gray-300' }}"
                            data-index="{{ $index }}"
                            data-src="{{ asset('storage/images/products/' . $img->image) }}">
                            <img src="{{ asset('storage/images/products/' . $img->image) }}"
                                alt="Thumb {{ $index + 1 }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                <!-- Ảnh lớn -->
                <div class="">
                    <img id="mainImage" class="w-full h-[400px] md:h-[500px] rounded-lg object-cover"
                        src="{{ asset('storage/images/products/' . $product->images[0]->image) }}"
                        alt="{{ $product->name }}">
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="flex flex-col gap-4">
                <p class="font-semibold text-lg">{{ $product->name }}</p>
                <!-- Hiển thị giá động -->
                <p class="text-xl font-bold text-orange-500" id="priceDisplay">
                    {{ number_format($product->variants->where('print_position', 'CENTER_CHEST_A4')->first()->price ?? 0, 0, ',', '.') }}
                    VNĐ
                </p>

                <!-- Mô tả sản phẩm -->
                <div class="flex flex-col gap-2 leading-relaxed">
                    <p class="text-sm text-slate-600">
                        Áo phông Ông già Noel với thiết kế độc đáo và mang không khí lễ hội, phù hợp làm quà tặng hoặc mặc
                        trong dịp Giáng sinh. Phom dáng thoải mái, dễ phối đồ.
                    </p>
                    <p class="italic">Chất liệu: 100% cotton cao cấp, thoáng mát và thấm hút tốt.</p>
                </div>

                <!-- Chọn màu áo -->
                <div class="flex flex-row items-center gap-4">
                    <input type="hidden" name="color" value="black">
                    <span class="text-base font-medium">Chọn màu áo:</span>
                    <div class="flex gap-3">
                        <!-- Màu đen -->
                        <div class="color-option md:w-9 cursor-pointer md:h-9 w-11 h-11 rounded-full border-[2px] overflow-hidden p-[3px] border-black"
                            data-color="black">
                            <div class="bg-black w-full h-full border-[1px] border-black/30 rounded-full"></div>
                        </div>
                        <!-- Màu trắng -->
                        <div class="color-option group w-11 h-11 md:w-9 md:h-9 rounded-full border-2 border-transparent cursor-pointer transition-all duration-200 p-[3px]"
                            data-color="white">
                            <div class="bg-white w-full h-full border border-black/30 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Chọn vị trí in áo -->
                <div class="flex flex-col gap-2 mb-3">
                    <span class="text-base font-medium">Chọn vị trí in:</span>
                    <div class="flex gap-3 flex-wrap">
                        <label
                            class="print-position-option cursor-pointer border border-gray-400 rounded-full px-4 py-1 text-sm hover:border-orangeColor border-orangeColor bg-orangeColor text-white">
                            <input type="radio" name="printPosition" value="CENTER_CHEST_A4" class="hidden" checked>
                            Mặt trước
                        </label>
                        <label
                            class="print-position-option cursor-pointer border border-gray-400 rounded-full px-4 py-1 text-sm hover:border-orangeColor">
                            <input type="radio" name="printPosition" value="CENTER_BACK_A4" class="hidden">
                            Mặt sau
                        </label>
                        <label
                            class="print-position-option cursor-pointer border border-gray-400 rounded-full px-4 py-1 text-sm hover:border-orangeColor">
                            <input type="radio" name="printPosition" value="BOTH_SIDES" class="hidden">
                            Cả hai mặt
                        </label>
                    </div>
                </div>

                <!-- Chọn size -->
                <div class="flex flex-col gap-2">
                    <span>Chọn size:</span>
                    <div class="flex gap-2">
                        <!-- Size options: 1, 2, 3, 4, 5, 6 -->
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            1
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            2
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            3
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            4
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            5
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            6
                        </button>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <!-- Size options: S, M, L, XL, XXL, XXXL -->
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            S
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            M
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor bg-orangeColor text-white border-orangeColor">
                            L
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            XL
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            XXL
                        </button>
                        <button type="button"
                            class="size-option border-[1px] border-gray-400 rounded-full px-3 py-1 text-sm hover:border-orangeColor">
                            XXXL
                        </button>
                    </div>
                    <input type="hidden" name="size" value="L">
                </div>

                <!-- Chọn số lượng -->
                <div>
                    <span>Chọn số lượng</span>
                    <div class="flex items-center gap-2 mt-2">
                        <button id="decreaseBtn" type="button"
                            class="border-orangeColor border-[1px] border-gray-400 rounded-full px-1 py-1 hover:bg-orangeColor text-textColor hover:text-white">
                            <span class="material-symbols-rounded text-orangeColor hover:text-white">remove</span>
                        </button>
                        <input id="quantity" type="number" value="1" min="1" max="50"
                            name="quantity"
                            class="w-20 h-9 font-semibold text-center border-[1px] border-gray-400 rounded-md">
                        <button id="increaseBtn" type="button"
                            class="border-orangeColor border-[1px] border-gray-400 rounded-full px-1 py-1 hover:bg-orangeColor text-textColor hover:text-white">
                            <span class="material-symbols-rounded text-orangeColor hover:text-white">add</span>
                        </button>
                    </div>
                </div>

                <!-- Tùy chỉnh ảnh -->
                <div class="flex items-center gap-2">
                    <label for="customImage" class="hover:text-orangeColor cursor-pointer">Tôi muốn tùy chỉnh ảnh</label>
                    <input id="customImage" type="checkbox" class="w-5 h-5 rounded border-gray-400 accent-orangeColor">
                </div>

                <!-- Ô upload ảnh -->
                <div id="uploadContainer" class="hidden">
                    <label for="uploadImage"
                        class="flex flex-col items-center justify-center w-36 h-36 border-2 border-dashed border-orangeColor rounded-md cursor-pointer hover:bg-orange-50 transition overflow-hidden">
                        <img id="previewImage" class="hidden w-full h-full object-cover rounded-md" alt="Preview Image">
                        <div id="uploadPlaceholder" class="flex flex-col items-center">
                            <span class="material-symbols-rounded text-orangeColor mb-2"
                                style="font-size: 48px">upload</span>
                            <span class="text-gray-600 text-sm text-center">Nhấn để tải ảnh lên</span>
                        </div>
                        <input id="uploadImage" type="file" class="hidden" accept="image/*" name="customImage">
                    </label>
                </div>

                <!-- Button -->
                <div class="flex flex-row md:items-center md:gap-4 gap-3 w-full">
                    <button id="addToCartBtn" data-slug="{{ $product->slug }}" type="submit"
                        class="flex justify-center items-center w-fit md:w-auto lg:px-6 lg:py-3 px-4 py-1 text-sm py-3 border-2 border-orangeColor text-white bg-orangeColor rounded-lg hover:bg-white hover:text-orangeColor transition-all duration-300 relative overflow-hidden">
                        <span class="material-symbols-rounded">add_shopping_cart</span>
                        <span class="text-nowrap">Thêm vào giỏ hàng</span>
                    </button>
                    <button type="submit"
                        class="flex justify-center items-center w-fit md:w-auto lg:px-6 lg:py-3 px-4 py-1 text-sm py-3 border-2 border-green-500 text-white bg-green-500 rounded-lg hover:bg-white hover:text-green-500 transition-all duration-300 relative overflow-hidden">
                        <span class="material-symbols-rounded">shopping_cart_checkout</span>
                        <span class="text-nowrap">Mua ngay</span>
                    </button>
                </div>
            </div>
        </form>

        <hr class="mt-14">

        <!-- Đánh giá sản phẩm -->
        <div class="flex flex-col gap-2 mt-4">
            <div class="flex items-center gap-2">
                <div class="flex items-center">
                    @php
                        // Lấy danh sách review active của sản phẩm
                        $reviews = $product->reviews()->where('active', true)->get();
                        $totalReviews = $reviews->count();

                        // Tính điểm trung bình
                        $weightedSum = 0;
                        for ($i = 1; $i <= 5; $i++) {
                            $count = $reviews->where('rated', $i)->count();
                            $weightedSum += $i * $count; // Tổng trọng số
                        }
                        $avgRating = $totalReviews > 0 ? round($weightedSum / $totalReviews, 1) : 0;
                    @endphp

                    <span class="flex items-center text-yellow-500">
                        <span class="font-medium">Tổng: {{ $avgRating }}⭐</span>
                    </span>

                </div>
                <span class="text-sm text-gray-600">
                    ({{ $product->reviews->where('active', true)->count() }} đánh giá)
                </span>
            </div>

            <!-- Danh sách đánh giá -->
            <div class="mt-4 space-y-4">
                @foreach ($product->reviews()->where('active', true)->get() as $review)
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-medium">{{ $review->fullname }}</span>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= $review->rated; $i++)
                                        <span class="text-yellow-500 text-sm">⭐</span>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $review->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ $review->content }}</p>
                        @if ($review->image)
                            <img src="{{ asset('storage/' . $review->image) }}" alt="Review image"
                                class="mt-2 max-w-xs rounded-lg">
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Form đánh giá -->
            <div class="mt-6">
                <h4 class="font-medium mb-2">Đánh giá sản phẩm</h4>
                <form action="{{ route('reviews.store', $product->slug) }}" method="POST" class="space-y-3"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label for="fullname" class="text-sm">Họ tên:</label>
                            <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                                class="border border-gray-300 rounded-md p-2 text-sm" required>
                            @error('fullname')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="phone" class="text-sm">Số điện thoại:</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="border border-gray-300 rounded-md p-2 text-sm" required>
                            @error('phone')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm">Đánh giá:</span>
                        <div class="flex items-center" id="ratingStars">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="rating-btn" data-rating="{{ $i }}">
                                    <span
                                        class="material-symbols-rounded text-gray-400 hover:text-yellow-500">star_border</span>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rated" id="ratingInput" value="{{ old('rated', 0) }}">
                        @error('rated')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-1">
                        <textarea name="content" rows="3" class="w-full border border-gray-300 rounded-md p-2 text-sm"
                            placeholder="Nhập đánh giá của bạn..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="reviewImage" class="text-sm">Hình ảnh (nếu có):</label>
                        <input type="file" name="image" id="reviewImage" accept="image/*" class="text-sm">
                        @error('image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 text-sm">Gửi đánh
                        giá</button>
                </form>
            </div>
        </div>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingButtons = document.querySelectorAll('.rating-btn');
        const ratingInput = document.getElementById('ratingInput');

        ratingButtons.forEach(button => {
            button.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                // Reset tất cả sao về màu xám
                ratingButtons.forEach(btn => {
                    btn.querySelector('span').classList.remove('text-yellow-500');
                    btn.querySelector('span').classList.add('text-gray-400');
                    btn.querySelector('span').textContent = 'star_border';
                });

                // Tô sáng các sao từ 1 đến rating
                for (let i = 0; i < rating; i++) {
                    ratingButtons[i].querySelector('span').classList.remove('text-gray-400');
                    ratingButtons[i].querySelector('span').classList.add('text-yellow-500');
                    ratingButtons[i].querySelector('span').textContent = 'star';
                }
            });
        });
    });
</script>
