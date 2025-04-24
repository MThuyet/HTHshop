document.addEventListener('DOMContentLoaded', function () {
    const wishlistButtons = document.querySelectorAll(".wishlist-btn") ?? [];
    let favoriteProducts = getFavoriteProducts();
    let delayTime = 500; 
    let isProcessingFavorite = false;

    wishlistButtons.forEach((btn) => {  
        updateButtonWishList(btn);
        btn.addEventListener("click", function (e) {
            e.preventDefault(); // Ngăn trình duyệt thực hiện hành vi mặc định (chuyển trang)
            e.stopPropagation(); // Ngăn sự kiện lan ra thẻ cha (thẻ <a>)
            
            const productId = btn.dataset.productId;
    
            if (!productId) {
                showToast('Lỗi không xác định được thông tin sản phẩm. Vui lòng thử lại sau!!!', 'error');
                return;
            }
            
            if(isProcessingFavorite) {
                showToast('Bạn đang thao tác quá nhanh. Hãy đợi một chút để tiếp tục.', 'warning');
                return;
            }
         
            toggleFavoriteProduct(btn, productId);
        });
    });

    function toggleFavoriteProduct(btn, productId) {
        let isFavorite = favoriteProducts.find(id => id === productId);
        let actionType = '';

        if(isFavorite) {
            favoriteProducts = favoriteProducts.filter(id => id !== productId);
            actionType = 'DECREASE';
        }else {
            favoriteProducts.push(productId)
            actionType = 'INCREASE';
        }

        fetch('/api/products/toggle-favorite', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                productId,
                actionType
            })
        })
        .then(response => {
            if (response.status === 429) {
                throw new Error('Bạn đã gửi quá nhiều yêu cầu. Vui lòng thử lại sau!!!');
            }
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            
            return response.json();
        })
        .then(data => {
            if (data.status === true) {
                isProcessingFavorite = true;
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up';
                toast.innerHTML = data.message;
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.classList.add('animate-fade-out');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);

                setTimeout(() => {
                    isProcessingFavorite = false;
                }, delayTime)

                setFavoriteProducts(favoriteProducts);
                updateButtonWishList(btn);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast(`Lỗi rồi ${error}`, 'error')
        });
    }

    function updateButtonWishList(btn) {
        const icon = btn.querySelector(".icon-heart");
        const tooltip = btn.querySelector(".tooltip-text");
        const productId = btn.dataset.productId;
        let isFavorited = productId ? favoriteProducts.includes(productId) : false;
    
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
});

function getFavoriteProducts() {
    return JSON.parse(localStorage.getItem('favoriteProducts')) ?? [];
}

function setFavoriteProducts(data) {
    localStorage.setItem('favoriteProducts', JSON.stringify(data));
}

function showToast(message, type = 'success') {
    const oldToast = document.querySelector('.custom-toast');
    if (oldToast) oldToast.remove();    

    const toast = document.createElement('div');
    const backgroundType = {
        'success': 'bg-green-500',
        'warning': 'bg-yellow-500',
        'error': 'bg-red-500',
    };
    
    const bgColor = backgroundType[type] || 'bg-green-500';
    
    toast.className = `custom-toast fixed bottom-4 right-4 px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up ${bgColor} text-white`;
    toast.innerHTML = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('animate-fade-out');
        setTimeout(() => {
            if (document.body.contains(toast)) {
                toast.remove();
            }
        }, 300);
    }, 3000);
}
