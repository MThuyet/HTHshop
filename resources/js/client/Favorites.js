// Active favorite
const wishlistButtons = document.querySelectorAll(".wishlist-btn");

// Khởi tạo danh sách yêu thích từ localStorage
let favoriteProducts = JSON.parse(localStorage.getItem('favoriteProducts')) || [];

// Biến lưu trạng thái đang xử lý yêu thích
let isProcessingFavorite = false;
// Thời gian chờ giữa các lần yêu thích (2 giây)
const favoriteDelay = 2000;

// Cập nhật UI của các nút yêu thích khi trang tải lên
document.addEventListener('DOMContentLoaded', function() {
    const wishlistButtons = document.querySelectorAll(".wishlist-btn");
    
    wishlistButtons.forEach((btn) => {
        const icon = btn.querySelector(".icon-heart");
        const tooltip = btn.querySelector(".tooltip-text");
        const productVariantId = btn.getAttribute('data-variant-product-id');
        
        // Kiểm tra sản phẩm đã được yêu thích chưa
        let isFavorited = productVariantId ? favoriteProducts.includes(productVariantId) : false;
        
        // Cập nhật giao diện nút
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
    });
});

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
        e.preventDefault(); // Ngăn trình duyệt thực hiện hành vi mặc định (chuyển trang)
        e.stopPropagation(); // Ngăn sự kiện lan ra thẻ cha (thẻ <a>)

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
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // Hiển thị thông báo thành công
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up';
                toast.innerHTML = isFavorited ? 'Đã thêm sản phẩm vào danh sách yêu thích' : 'Đã hủy sản phẩm khỏi danh sách yêu thích';
                document.body.appendChild(toast);
                
                // Tự động ẩn toast sau 3 giây
                setTimeout(() => {
                    toast.classList.add('animate-fade-out');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
                
                // Sau khoảng thời gian chờ, đánh dấu là đã xử lý xong
                setTimeout(() => {
                    isProcessingFavorite = false;
                }, favoriteDelay);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Hiển thị toast lỗi
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up';
            toast.innerHTML = 'Có lỗi xảy ra khi cập nhật yêu thích!';
            document.body.appendChild(toast);
            
            // Tự động ẩn toast sau 3 giây
            setTimeout(() => {
                toast.classList.add('animate-fade-out');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
            
            // Đánh dấu xử lý xong để người dùng có thể thử lại
            isProcessingFavorite = false;
        });
    });

    // Hover để hiển thị tooltip đúng theo trạng thái
    btn.addEventListener("mouseenter", function (e) {
        tooltip.textContent = isFavorited ? "Đã yêu thích" : "Yêu thích";
    });

    btn.addEventListener("mouseleave", function (e) {
        tooltip.textContent = isFavorited ? "Đã yêu thích" : "Yêu thích";
    });
}); 