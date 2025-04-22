@extends('layouts.client.master')
@section('title', 'Danh sách yêu thích')

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
            <a href="{{ route('product') }}" class="bg-orangeColor text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadFavoriteProducts();
            
            // Nút thử lại
            document.getElementById('retry-button').addEventListener('click', function() {
                document.getElementById('error-message').classList.add('hidden');
                document.getElementById('loading-indicator').classList.remove('hidden');
                loadFavoriteProducts();
            });
            
            function loadFavoriteProducts() {
                console.log('Loading favorite products...');
                const favoriteContainer = document.getElementById('favorite-products-container');
                const noFavoritesMessage = document.getElementById('no-favorites');
                const loadingIndicator = document.getElementById('loading-indicator');
                const errorMessage = document.getElementById('error-message');
                const errorDetails = document.getElementById('error-details');
                
                // Ẩn container sản phẩm và hiển thị đang tải
                favoriteContainer.classList.add('hidden');
                loadingIndicator.classList.remove('hidden');
                noFavoritesMessage.classList.add('hidden');
                errorMessage.classList.add('hidden');
                
                // Lấy danh sách sản phẩm yêu thích từ localStorage
                const favoriteProducts = JSON.parse(localStorage.getItem('favoriteProducts')) || [];
                
                console.log('Favorite products from localStorage:', favoriteProducts);
                
                // Nếu không có sản phẩm yêu thích, hiển thị thông báo
                if (!favoriteProducts || favoriteProducts.length === 0) {
                    loadingIndicator.classList.add('hidden');
                    noFavoritesMessage.classList.remove('hidden');
                    console.log('No favorites found');
                    return;
                }
                
                // Xóa nội dung cũ
                favoriteContainer.innerHTML = '';
                
                // Chuyển mảng ID thành chuỗi URL
                const idsParam = favoriteProducts.join(',');
                const apiUrl = '/api-web/products?ids=' + idsParam;
                console.log('API request URL:', apiUrl);
                
                // Tải thông tin sản phẩm yêu thích từ API
                fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('API response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    loadingIndicator.classList.add('hidden');
                    console.log('API response data:', data);
                    
                    if (data.products && data.products.length > 0) {
                        favoriteContainer.classList.remove('hidden');
                        renderFavoriteProducts(data.products);
                    } else {
                        noFavoritesMessage.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    loadingIndicator.classList.add('hidden');
                    errorMessage.classList.remove('hidden');
                    errorDetails.textContent = error.message;
                    console.error('Error fetching favorite products:', error);
                });
            }
            
            function renderFavoriteProducts(products) {
                const favoriteContainer = document.getElementById('favorite-products-container');
                
                // Đảm bảo container hiển thị và trống
                favoriteContainer.classList.remove('hidden');
                favoriteContainer.innerHTML = '';
                
                console.log('Rendering', products.length, 'products');
                
                products.forEach((product, index) => {
                    console.log('Rendering product', index + 1, ':', product.name);
                    
                    const productCard = document.createElement('div');
                    productCard.className = 'relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg';
                    
                    // Kiểm tra nếu sản phẩm có giảm giá 
                    if (product.discount > 0) {
                        productCard.innerHTML += `
                            <span class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                                -${product.discount}%
                    </span>
                        `;
                    }
                    
                    // Tạo URL sản phẩm
                    const productUrl = `/san-pham/${product.slug}`;

                    // Build HTML content for the product card
                    productCard.innerHTML += `
                        <a href="${productUrl}">
                        <div class="relative overflow-hidden cursor-pointer">
                                <img src="${product.image_url}" alt="${product.name}"
                                class="w-full h-60 object-cover rounded-t-md">

                            <!-- Wishlist button with tooltip -->
                            <button
                                    class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-orangeColor text-white flex items-center justify-center rounded-full shadow-md group/button"
                                    data-variant-product-id="${product.variant_id}">
                                    <span class="material-symbols-rounded icon-heart" style="font-variation-settings: 'FILL' 1">
                                    favorite
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="tooltip-text absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 delay-100 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                        Đã yêu thích
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
                            <a href="${productUrl}">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                    ${product.name}
                            </p>
                        </a>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                    <p class="text-orangeColor font-semibold text-[14px]">
                                        ${(product.price - (product.price * product.discount / 100)).toLocaleString('vi-VN')}đ
                                    </p>
                                    ${product.discount > 0 ? `<p class="text-gray-400 line-through text-[12px]">${product.price.toLocaleString('vi-VN')}đ</p>` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                    
                    favoriteContainer.appendChild(productCard);
                });
                
                // Nếu không có sản phẩm nào được render
                if (favoriteContainer.children.length === 0) {
                    console.log('No products were rendered');
                    document.getElementById('no-favorites').classList.remove('hidden');
                    favoriteContainer.classList.add('hidden');
                } else {
                    console.log('Rendered', favoriteContainer.children.length, 'products');
                    
                    
                    // Khởi tạo lại nút wishlist sau khi render
                    initWishlistButtons();
                }
            }

            // Khởi tạo các nút wishlist
            function initWishlistButtons() {
                const wishlistButtons = document.querySelectorAll(".wishlist-btn");
                console.log('Initializing', wishlistButtons.length, 'wishlist buttons');
                
                // Lấy danh sách yêu thích từ localStorage
                let favoriteProducts = JSON.parse(localStorage.getItem('favoriteProducts')) || [];
                const favoriteContainer = document.getElementById('favorite-products-container');
                
                // Biến lưu trạng thái đang xử lý yêu thích
                let isProcessingFavorite = false;
                // Thời gian chờ giữa các lần yêu thích (2 giây)
                const favoriteDelay = 2000;
                
                wishlistButtons.forEach((btn) => {
                    const icon = btn.querySelector(".icon-heart");
                    const tooltip = btn.querySelector(".tooltip-text");
                    const productVariantId = btn.getAttribute('data-variant-product-id');
                    
                    // Kiểm tra sản phẩm đã được yêu thích chưa
                    let isFavorited = productVariantId ? favoriteProducts.includes(productVariantId) : false;
                    
                    function updateButtonUI() {
                        if (isFavorited) {
                            tooltip.textContent = "Đã yêu thích";
                            icon.style.fontVariationSettings = "'FILL' 1";
                            btn.classList.remove("bg-white", "text-orangeColor");
                            btn.classList.add("bg-orangeColor", "text-white");
                        } else {
                            tooltip.textContent = "Yêu thích";
                            icon.style.fontVariationSettings = "'FILL' 0";
                            btn.classList.remove("bg-orangeColor", "text-white");
                            btn.classList.add("bg-white", "text-orangeColor");
                        }
                    }
                    
                    // Khởi tạo giao diện
                    updateButtonUI();
                    
                    // Click để toggle trạng thái
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        if (!productVariantId) {
                            console.error('Missing product variant ID');
                            return;
                        }
                        
                        // Kiểm tra nếu đang trong quá trình xử lý yêu thích
                        if (isProcessingFavorite) {
                            // Hiển thị thông báo phải đợi
                            const toast = document.createElement('div');
                            toast.className = 'fixed bottom-4 right-4 bg-yellow-500 text-white px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up';
                            toast.innerHTML = 'Vui lòng đợi giây lát trước khi thêm sản phẩm khác vào yêu thích';
                            document.body.appendChild(toast);
                            
                            // Tự động ẩn toast sau 2 giây
                            setTimeout(() => {
                                toast.classList.add('animate-fade-out');
                                setTimeout(() => {
                                    document.body.removeChild(toast);
                                }, 300);
                            }, 2000);
                            
                            return;
                        }
                        
                        // Đánh dấu đang xử lý
                        isProcessingFavorite = true;
                        
                        isFavorited = !isFavorited;
                        updateButtonUI();
                        
                        // Cập nhật danh sách yêu thích trong localStorage
                        if (isFavorited) {
                            if (!favoriteProducts.includes(productVariantId)) {
                                favoriteProducts.push(productVariantId);
                            }
                        } else {
                            favoriteProducts = favoriteProducts.filter(id => id !== productVariantId);
                            
                            // Xóa phần tử khỏi trang và kiểm tra lại danh sách
                            const productCard = btn.closest('.slide-up-effect');
                            if (productCard) {
                                productCard.remove();
                                
                                // Kiểm tra nếu không còn sản phẩm nào
                                if (favoriteContainer.children.length === 0) {
                                    favoriteContainer.classList.add('hidden');
                                    document.getElementById('no-favorites').classList.remove('hidden');
                                }
                            }
                        }
                        
                        localStorage.setItem('favoriteProducts', JSON.stringify(favoriteProducts));
                        
                        // Gọi API để cập nhật số lượng yêu thích
                        fetch('/api-web/products/toggle-favorite', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                product_variant_id: productVariantId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Sau khoảng thời gian chờ, đánh dấu là đã xử lý xong
                            setTimeout(() => {
                                isProcessingFavorite = false;
                            }, favoriteDelay);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            isProcessingFavorite = false;
                        });
                        
                        // Load lại trang sau khi xóa sản phẩm khỏi yêu thích
                        if (!isFavorited) {
                            loadFavoriteProducts();
                        }
                    });
                });
            }
        });
    </script>
@endsection
