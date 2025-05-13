// Function to update cart count in header
function updateHeaderCartCount() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce(
        (sum, item) => sum + (item.quantity || 1),
        0
    );
    document.getElementById("headerCartCountDesktop").textContent = totalItems;
    document.getElementById("headerCartCountMobile").textContent = totalItems;
}

// Function to update favorite count in header
function updateHeaderFavoriteCount() {
    const favorites =
        JSON.parse(localStorage.getItem("favoriteProducts")) || [];
    document.getElementById("headerFavoriteCountDesktop").textContent =
        favorites.length;
    document.getElementById("headerFavoriteCountMobile").textContent =
        favorites.length;
}

// Update counts when page loads
document.addEventListener("DOMContentLoaded", function () {
    updateHeaderCartCount();
    updateHeaderFavoriteCount();

    // Hàm định dạng giá tiền
    function formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN").format(amount);
    }

    // Xử lý tính năng gợi ý tìm kiếm tự động - Desktop
    const setupSearchSuggestions = (inputId, suggestionBoxId) => {
        const searchInput = document.getElementById(inputId);
        const suggestionBox = document.getElementById(suggestionBoxId);
        if (!searchInput || !suggestionBox) return;

        const suggestionList = suggestionBox.querySelector("ul");
        let debounceTimer;

        // Hiển thị gợi ý khi focus vào ô tìm kiếm
        searchInput.addEventListener("focus", function () {
            if (suggestionList.children.length > 0) {
                suggestionBox.classList.remove("hidden");
            }
        });

        // Ẩn gợi ý khi click ra ngoài
        document.addEventListener("click", function (e) {
            if (
                !searchInput.contains(e.target) &&
                !suggestionBox.contains(e.target)
            ) {
                suggestionBox.classList.add("hidden");
            }
        });

        // Xử lý khi người dùng nhập
        searchInput.addEventListener("input", function () {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            // Xóa gợi ý nếu không có từ khóa tìm kiếm
            if (query === "") {
                suggestionList.innerHTML = "";
                suggestionBox.classList.add("hidden");
                return;
            }

            // Đợi 300ms trước khi gửi yêu cầu (tránh gửi quá nhiều request)
            debounceTimer = setTimeout(() => {
                fetch(`/api/search/suggest?query=${encodeURIComponent(query)}`)
                    .then((response) => response.json())
                    .then((data) => {
                        suggestionList.innerHTML = "";

                        if (data.suggestions.length === 0) {
                            suggestionBox.classList.add("hidden");
                            return;
                        }

                        data.suggestions.forEach((product) => {
                            const li = document.createElement("li");
                            li.className =
                                "px-4 py-3 hover:bg-gray-50 cursor-pointer transition-all duration-150";

                            // Tạo HTML cho gợi ý với hình ảnh và giá
                            li.innerHTML = `
                                    <div class="flex items-center gap-4">
                                        <div class="min-w-[60px] w-[60px] h-[60px] overflow-hidden rounded shadow">
                                            <img src="${
                                                product.image
                                                    ? "/storage/" +
                                                      product.image
                                                    : "/images/no-image.png"
                                            }"
                                                class="w-full h-full object-cover" alt="${
                                                    product.name
                                                }">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-[15px] font-medium line-clamp-2">${
                                                product.name
                                            }</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-sm font-semibold text-orangeColor">${formatCurrency(
                                                    product.discountedPrice
                                                )}đ</span>
                                                ${
                                                    product.discount > 0
                                                        ? `<span class="text-sm text-gray-400 line-through">${formatCurrency(
                                                              product.price
                                                          )}đ</span>`
                                                        : ""
                                                }
                                                ${
                                                    product.discount > 0
                                                        ? `<span class="text-xs bg-red-500 text-white px-1.5 py-0.5 rounded">-${product.discount}%</span>`
                                                        : ""
                                                }
                                            </div>
                                        </div>
                                    </div>
                                `;

                            // Điền giá trị vào ô tìm kiếm khi click vào gợi ý
                            li.addEventListener("click", function () {
                                searchInput.value = product.name;
                                suggestionBox.classList.add("hidden");
                                // Tự động chuyển đến trang chi tiết sản phẩm
                                window.location.href = `/san-pham/${product.slug}`;
                            });

                            suggestionList.appendChild(li);
                        });

                        // Hiển thị box gợi ý
                        suggestionBox.classList.remove("hidden");
                    })
                    .catch((error) => {
                        console.error("Lỗi khi tìm kiếm:", error);
                    });
            }, 300);
        });
    };

    // Thiết lập gợi ý cho cả desktop và mobile
    setupSearchSuggestions("searchInput", "searchSuggestions");
    setupSearchSuggestions("searchInputMobile", "searchSuggestionsMobile");
});
