@extends('layouts.client.master')
@section('title', 'Giỏ hàng')

@vite('resources/js/client/Cart.js')

@section('breadcrumb')
    <x-breadcrumb :currentPage="'Giỏ hàng'" />
@endsection

@section('content')
    <div class="responsive py-8">
        <!-- Header with cart count -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 relative">
                Giỏ hàng của bạn
                <span id="cartCount"
                    class="ml-2 text-sm font-medium text-white bg-orange-500 rounded-full px-2 py-1 hidden">0</span>
            </h2>
            <a href="{{ route('product') }}"
                class="text-orange-500 hover:text-orange-600 flex items-center gap-2 transition-colors">
                <span class="material-symbols-rounded">arrow_back</span>
                <span>Tiếp tục mua sắm</span>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items Section -->
            <div class="flex-1">
                <!-- Empty Cart State -->
                <div id="emptyCart" class="text-center py-16 hidden">
                    <p class="text-2xl text-gray-600 font-medium mb-4">Giỏ hàng của bạn đang trống!</p>
                    <p class="text-gray-500 mb-8">Hãy khám phá các sản phẩm của chúng tôi và thêm vào giỏ hàng</p>
                    <a href="{{ route('product') }}"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg shadow-md hover:from-orange-600 hover:to-orange-700 transition-all duration-300">
                        <span class="material-symbols-rounded">shopping_bag</span>
                        <span>Khám phá sản phẩm</span>
                    </a>
                </div>

                <!-- Cart Items List -->
                <div id="cartItems" class="space-y-6 transition-all duration-300"></div>
            </div>

            <!-- Order Summary Section -->
            <div class="lg:w-96">
                <div class="sticky top-24 bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Tóm tắt đơn hàng</h3>

                    <div class="space-y-4">
                        <!-- Subtotal -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Tạm tính</span>
                            <span id="subtotalPrice" class="text-gray-900 font-medium">0 VNĐ</span>
                        </div>

                        <!-- Shipping -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Phí vận chuyển</span>
                            <span class="text-green-600 font-medium">Miễn phí</span>
                        </div>

                        <!-- Discount -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Giảm giá</span>
                            <span id="discountPrice" class="text-orange-500 font-medium">0 VNĐ</span>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Total -->
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Tổng cộng</span>
                            <span id="totalPrice" class="text-2xl font-bold text-orange-500">0 VNĐ</span>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('order') }}" id="checkoutBtn"
                            class="mt-6 w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg shadow-md hover:from-orange-600 hover:to-orange-700 transition-all duration-300 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <span class="material-symbols-rounded">shopping_cart_checkout</span>
                            <span>Thanh toán</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template for Cart Item -->
    <template id="cartItemTemplate">
        <div
            class="cart-item group flex flex-col md:flex-row gap-6 p-6 bg-white shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300">
            <!-- Product Image -->
            <div class="w-full md:w-40 h-48 md:h-40 relative overflow-hidden rounded-lg">
                <img class="cart-item-image w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    alt="Product Image" loading="lazy">

                <!-- Remove Button -->
                <button
                    class="remove-item absolute top-2 right-2 w-8 h-8 bg-white/80 text-red-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-white hover:text-red-600"
                    data-index="">
                    <span class="material-symbols-rounded text-lg">delete</span>
                </button>
            </div>

            <!-- Product Info -->
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="cart-item-name text-xl font-semibold text-gray-900 mb-2"></h3>

                    <div class="grid grid-cols-2 gap-4 text-gray-600 mb-4">
                        <div>
                            <span class="text-orange-500 font-medium"></span>
                            <span class="cart-item-color"></span>
                        </div>
                        <div>
                            <span class="text-orange-500 font-medium"></span>
                            <span class="cart-item-size"></span>
                        </div>
                        <div>
                            <span class="text-orange-500 font-medium"></span>
                            <span class="cart-item-print-position"></span>
                        </div>
                        <div>
                            <span class="text-orange-500 font-medium"></span>
                            <span class="cart-item-price"></span>
                        </div>
                    </div>

                    <!-- Custom Image (if any) -->
                    <div class="cart-item-custom-image-container hidden mt-4">
                        <span class="text-gray-600 font-medium">Ảnh tùy chỉnh:</span>
                        <img class="cart-item-custom-image w-24 h-24 object-cover rounded-md border border-gray-200 mt-2"
                            alt="Custom Image" loading="lazy">
                    </div>
                </div>

                <!-- Quantity Controls -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center gap-3">
                        <button
                            class="decrease-quantity w-9 h-9 flex items-center justify-center bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all duration-200"
                            data-index="">
                            <span class="material-symbols-rounded text-lg">remove</span>
                        </button>
                        <input type="number"
                            class="cart-item-quantity w-16 text-center border border-gray-200 rounded-lg p-1.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            min="1" max="50" value="1">
                        <button
                            class="increase-quantity w-9 h-9 flex items-center justify-center bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all duration-200"
                            data-index="">
                            <span class="material-symbols-rounded text-lg">add</span>
                        </button>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-500"></span>
                        <span class="cart-item-subtotal text-lg font-semibold text-orange-500 ml-2"></span>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection
