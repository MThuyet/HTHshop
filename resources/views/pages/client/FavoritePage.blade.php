@extends('layouts.client.master')
@section('title', 'Danh sách yêu thích')
@vite(['resources/js/client/FavoritePage'])

@section('content')
    <div class="responsive">
        <h2 class="sub-title">Sản phẩm yêu thích</h2>

        <div id="loading-indicator" class="text-center py-10">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
            <p class="mt-2 text-gray-600">Đang tải sản phẩm yêu thích...</p>
        </div>

        <div id="favorite-products-container"
            class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-3 lg:gap-x-5 mb-5">
            <!-- Render sản phẩm bằng JS -->
        </div>

        <div id="no-favorites" class="text-center py-10 hidden">
            <p class="text-gray-500 mb-4">Bạn chưa có sản phẩm yêu thích nào.</p>
            <a href="{{ route('product') }}"
                class="bg-orangeColor text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                Khám phá sản phẩm
            </a>
        </div>

        <div id="error-message" class="text-center py-10 hidden">
            <p class="text-red-500 mb-4">Đã xảy ra lỗi khi tải sản phẩm yêu thích.</p>
            <p id="error-details" class="text-gray-500 mb-4"></p>
            <button id="retry-button" class="bg-orangeColor text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                Thử lại
            </button>
        </div>
    </div>
@endsection
<script>
    const assetStorageUrl = @json(asset('storage/'));
</script>
