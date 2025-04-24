document.addEventListener("DOMContentLoaded", function () {
    const favoriteContainer = document.getElementById(
        "favorite-products-container"
    );
    const noFavoritesMessage = document.getElementById("no-favorites");
    const loadingIndicator = document.getElementById("loading-indicator");
    const errorMessage = document.getElementById("error-message");
    const errorDetails = document.getElementById("error-details");

    loadFavoriteProducts();

    document
        .getElementById("retry-button")
        .addEventListener("click", function () {
            document.getElementById("error-message").classList.add("hidden");
            document
                .getElementById("loading-indicator")
                .classList.remove("hidden");
            loadFavoriteProducts();
        });

    function loadFavoriteProducts() {
        favoriteContainer.classList.add("hidden");
        noFavoritesMessage.classList.add("hidden");
        errorMessage.classList.add("hidden");

        loadingIndicator.classList.remove("hidden");

        const favoriteProducts = getFavoriteProducts();

        if (!favoriteProducts || favoriteProducts.length === 0) {
            loadingIndicator.classList.add("hidden");
            noFavoritesMessage.classList.remove("hidden");
            return;
        }

        favoriteContainer.innerHTML = "";

        fetch("/api/products/by-ids", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
            },
            body: JSON.stringify({
                productIds: favoriteProducts,
            }),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Network response was not ok: " + response.status
                    );
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === true && data.productList.length > 0) {
                    loadingIndicator.classList.add("hidden");
                    favoriteContainer.classList.remove("hidden");
                    renderFavoriteProducts(data.productList);
                } else {
                    noFavoritesMessage.classList.remove("hidden");
                }
            })
            .catch((error) => {
                console.error("Error fetching favorite products:", error);
                loadingIndicator.classList.add("hidden");
                errorMessage.classList.remove("hidden");
                errorDetails.textContent = error.message;
            });
    }

    function renderFavoriteProducts(products) {
        favoriteContainer.classList.remove("hidden");
        favoriteContainer.innerHTML = "";

        products.forEach((product) => {
            const productCard = document.createElement("div");
            productCard.className =
                "relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg";

            if (product.discount > 0) {
                productCard.innerHTML += `
                    <span class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">-${product.discount}%</span>
                `;
            }

            const productUrl = `/san-pham/${product.slug}`;
            const productPrice = product.variants[0].price;
            const productDiscount = product.discount;
            const productImage = product.images[0].image;

            productCard.innerHTML += `
                <a href="${productUrl}">
                <div class="relative overflow-hidden cursor-pointer">
                        <img src="${assetStorageUrl}/${productImage}" alt="${
                product.name
            }"
                        class="w-full h-60 object-cover rounded-t-md">

                    <!-- Wishlist button with tooltip -->
                    <button
                            class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-orangeColor text-white flex items-center justify-center rounded-full shadow-md group/button"
                            data-product-id="${product.id}">
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
                                ${formatPrice(productPrice, productDiscount)}
                            </p>
                            ${
                                productDiscount > 0
                                    ? `<p class="text-gray-400 line-through text-[12px]">${formatPrice(
                                          productPrice
                                      )}</p>`
                                    : ""
                            }
                        </div>
                    </div>
                </div>
            `;

            favoriteContainer.appendChild(productCard);
        });

        wishlistButtonListener();
    }

    function formatPrice(price, discount = 0) {
        if (isNaN(price)) return "0đ";
        const finalPrice =
            discount > 0 ? price - (price * discount) / 100 : price;
        return (
            finalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ"
        );
    }

    function wishlistButtonListener() {
        const wishlistButtons = document.querySelectorAll(".wishlist-btn");

        wishlistButtons.forEach((btn) => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();

                const productId = btn.dataset.productId;

                if (!productId) {
                    showToast(
                        "Lỗi không xác định được thông tin sản phẩm. Vui lòng thử lại sau!!!",
                        "error"
                    );
                    return;
                }

                removeProductWishList(productId);
            });
        });
    }

    function removeProductWishList(productId) {
        let favoriteProducts = getFavoriteProducts();

        fetch("/api/products/toggle-favorite", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
            },
            body: JSON.stringify({
                productId,
                actionType: "DECREASE",
            }),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Network response was not ok: " + response.status
                    );
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === true) {
                    showToast(
                        "Xóa sản phẩm khỏi danh mục yêu thích thành công",
                        "success"
                    );

                    favoriteProducts = favoriteProducts.filter(
                        (id) => id !== productId
                    );
                    setFavoriteProducts(favoriteProducts);

                    loadFavoriteProducts();
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showToast("Có lỗi xảy ra khi cập nhật yêu thích!", "error");
            });
    }
});

function getFavoriteProducts() {
    return JSON.parse(localStorage.getItem("favoriteProducts")) ?? [];
}

function setFavoriteProducts(data) {
    localStorage.setItem("favoriteProducts", JSON.stringify(data));
}

function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `fixed bottom-4 right-4 px-4 py-2 rounded shadow-lg z-50 animate-fade-in-up ${
        type === "success" ? "bg-green-500" : "bg-red-500"
    } text-white`;
    toast.innerHTML = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("animate-fade-out");
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
