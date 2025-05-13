document.addEventListener("DOMContentLoaded", function () {
    const cartContainer = document.getElementById("cartItems");
    const cartTotalPrice = document.getElementById("totalPrice");
    const emptyCart = document.getElementById("emptyCart");
    const cartItemTemplate =
        document.getElementById("cartItemTemplate").content;

    const colorMap = {
        black: "Đen",
        white: "Trắng",
    };

    const printPositionMap = {
        CENTER_CHEST_A4: "Mặt trước",
        CENTER_BACK_A4: "Mặt sau",
        BOTH_SIDES: "Cả hai mặt",
    };

    function formatPrice(price) {
        return price.toLocaleString("vi-VN") + " VNĐ";
    }

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function updateCartTotal() {
        const totalCartPrice = cart.reduce(
            (sum, item) => sum + item.price * (item.quantity || 1),
            0
        );
        cartTotalPrice.textContent = formatPrice(totalCartPrice);
        // Hiển thị hoặc ẩn giỏ hàng trống
        if (cart.length === 0) {
            emptyCart.classList.remove("hidden");
            cartContainer.innerHTML = "";
        } else {
            emptyCart.classList.add("hidden");
        }

        // Dispatch cart updated event
        window.dispatchEvent(new CustomEvent("hth:cartUpdated"));

        // Nếu hàm cập nhật header có sẵn, gọi ngay lập tức
        if (typeof window.updateHeaderCartCount === "function") {
            window.updateHeaderCartCount();
        }
    }

    function renderCart() {
        cartContainer.innerHTML = "";
        if (cart.length === 0) {
            updateCartTotal();
            return;
        }

        cart.forEach((item, index) => {
            const totalPrice = item.price * item.quantity;
            const cartItem = document.importNode(cartItemTemplate, true);

            // Populate data
            cartItem.querySelector(".cart-item-image").src = item.image;
            cartItem.querySelector(".cart-item-image").alt = item.productName;
            cartItem.querySelector(".cart-item-name").textContent =
                item.productName;
            cartItem.querySelector(
                ".cart-item-color"
            ).innerHTML = `<span class="text-orange-500">Màu: </span>${
                colorMap[item.color] || item.color
            }`;
            cartItem.querySelector(
                ".cart-item-size"
            ).innerHTML = `<span class="text-orange-500">Size: </span>${item.size}`;
            cartItem.querySelector(
                ".cart-item-print-position"
            ).innerHTML = `<span class="text-orange-500">Vị trí in: </span>${
                printPositionMap[item.printPosition] || item.printPosition
            }`;
            cartItem.querySelector(
                ".cart-item-price"
            ).innerHTML = `<span class="text-orange-500">Giá: </span>${formatPrice(
                item.price
            )}`;
            cartItem.querySelector(
                ".cart-item-subtotal"
            ).innerHTML = `<span class="text-orange-500">Tổng: </span>${formatPrice(
                totalPrice
            )}`;
            cartItem.querySelector(".cart-item-quantity").value = item.quantity;
            cartItem.querySelector(".cart-item-quantity").dataset.index = index;
            cartItem.querySelector(".decrease-quantity").dataset.index = index;
            cartItem.querySelector(".increase-quantity").dataset.index = index;
            cartItem.querySelector(".remove-item").dataset.index = index;

            // Handle custom image
            if (item.customImagePath || item.customImageBase64) {
                const customImageContainer = cartItem.querySelector(
                    ".cart-item-custom-image-container"
                );
                customImageContainer.classList.remove("hidden");

                if (item.customImageBase64) {
                    // Sử dụng trực tiếp base64 image
                    cartItem.querySelector(".cart-item-custom-image").src =
                        item.customImageBase64;
                } else if (item.customImagePath) {
                    // Chuyển đổi đường dẫn uploads/... thành URL đầy đủ
                    let imgSrc = item.customImagePath;

                    // Nếu đường dẫn đã là URL đầy đủ, giữ nguyên
                    if (!imgSrc.startsWith("http")) {
                        // Nếu chỉ là tên file trong uploads, thêm /storage/ vào trước
                        if (imgSrc.startsWith("uploads/")) {
                            imgSrc = "/storage/" + imgSrc;
                        }
                        // Nếu bắt đầu bằng /, đảm bảo thêm domain
                        if (imgSrc.startsWith("/")) {
                            imgSrc = window.location.origin + imgSrc;
                        } else {
                            // Trường hợp còn lại, thêm đầy đủ đường dẫn
                            imgSrc =
                                window.location.origin + "/storage/" + imgSrc;
                        }
                    }

                    cartItem.querySelector(".cart-item-custom-image").src =
                        imgSrc;
                }
            }

            cartContainer.appendChild(cartItem);
        });

        updateCartTotal();
    }

    function updateQuantity(index, newQuantity) {
        newQuantity = parseInt(newQuantity);
        if (isNaN(newQuantity) || newQuantity < 1) {
            Swal.fire({
                icon: "warning",
                title: "HTH Shop",
                text: "Số lượng tối thiểu là 1",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
            });
            newQuantity = 1;
        } else if (newQuantity > 50) {
            Swal.fire({
                icon: "warning",
                title: "HTH Shop",
                text: "Số lượng tối đa là 50",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
            });
            newQuantity = 50;
        }

        cart[index].quantity = newQuantity;
        localStorage.setItem("cart", JSON.stringify(cart));

        // Cập nhật giao diện chỉ cho mục cụ thể
        const cartItem = cartContainer
            .querySelector(`.cart-item [data-index="${index}"]`)
            .closest(".cart-item");
        cartItem.querySelector(".cart-item-quantity").value = newQuantity;
        cartItem.querySelector(
            ".cart-item-subtotal"
        ).innerHTML = `<span class="text-orange-500">Tổng: </span>${formatPrice(
            cart[index].price * newQuantity
        )}`;
        updateCartTotal();
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    cartContainer.addEventListener("click", function (e) {
        const index =
            e.target.dataset.index ||
            e.target.closest("[data-index]")?.dataset.index;

        if (!index) return;

        if (e.target.closest(".decrease-quantity")) {
            updateQuantity(index, cart[index].quantity - 1);
        } else if (e.target.closest(".increase-quantity")) {
            updateQuantity(index, cart[index].quantity + 1);
        } else if (e.target.closest(".remove-item")) {
            Swal.fire({
                title: "Bạn chắc chắn muốn xóa sản phẩm này?",
                text: "Thao tác này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    cart.splice(index, 1);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    renderCart(); // Gọi renderCart khi xóa vì cần xóa mục khỏi DOM
                    Swal.fire({
                        title: "HTH Shop",
                        text: "Sản phẩm đã được xóa khỏi giỏ hàng",
                        icon: "success",
                        toast: true,
                        position: "top-end",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                }
            });
        }
    });

    cartContainer.addEventListener(
        "input",
        debounce(function (e) {
            if (e.target.classList.contains("cart-item-quantity")) {
                const index = e.target.dataset.index;
                const newQuantity = e.target.value;
                updateQuantity(index, newQuantity);
            }
        }, 300)
    );

    cartContainer.addEventListener(
        "blur",
        function (e) {
            if (e.target.classList.contains("cart-item-quantity")) {
                const index = e.target.dataset.index;
                const newQuantity = e.target.value;
                if (!newQuantity || newQuantity < 1) {
                    e.target.value = 1;
                    updateQuantity(index, 1);
                }
            }
        },
        true
    );

    renderCart();
});
