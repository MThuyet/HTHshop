document.addEventListener("DOMContentLoaded", function () {
    // ======== Ảnh chính và thumbnail ========
    const thumbnails = document.querySelectorAll(".thumbnail");
    const mainImage = document.getElementById("mainImage");

    thumbnails.forEach((thumb) => {
        thumb.addEventListener("click", () => {
            const newSrc = thumb.getAttribute("data-src");
            mainImage.src = newSrc;

            thumbnails.forEach((t) => {
                t.classList.remove("border-blue-500", "border-2");
                t.classList.add("border-gray-300");
            });

            thumb.classList.remove("border-gray-300");
            thumb.classList.add("border-blue-500", "border-2");
        });
    });

    // ======== Chọn màu ========
    const colorOptions = document.querySelectorAll(".color-option");
    const colorInput = document.querySelector('input[name="color"]');

    if (colorOptions.length > 0) {
        const firstColor = colorOptions[0].getAttribute("data-color");
        colorOptions[0].classList.remove("border-transparent");
        colorOptions[0].classList.add("border-black");
        colorInput.value = firstColor;
    }

    colorOptions.forEach((option) => {
        option.addEventListener("click", function () {
            const selectedColor = option.getAttribute("data-color");

            colorOptions.forEach((opt) => {
                opt.classList.remove("border-black", "border-transparent");
                opt.classList.add("border-transparent");
            });

            this.classList.remove("border-transparent");
            this.classList.add("border-black");

            colorInput.value = selectedColor;
        });
    });

    // ======== Chọn vị trí in ========
    const printOptions = document.querySelectorAll(".print-position-option");
    const defaultInput = document.querySelector(
        'input[name="printPosition"][value="front"]'
    );

    if (defaultInput) {
        defaultInput.checked = true;
        defaultInput.parentElement.classList.add(
            "bg-orangeColor",
            "text-white"
        );
    }

    printOptions.forEach((option) => {
        const input = option.querySelector("input");

        option.addEventListener("click", function () {
            printOptions.forEach((opt) => {
                opt.classList.remove(
                    "bg-orangeColor",
                    "text-white",
                    "border-orangeColor"
                );
                const radio = opt.querySelector("input");
                if (radio) radio.checked = false;
            });

            if (input) {
                input.checked = true;
                option.classList.add(
                    "bg-orangeColor",
                    "text-white",
                    "border-orangeColor"
                );
            }
        });
    });

    // ======== Chọn size ========
    const sizeButtons = document.querySelectorAll(".size-option");
    const sizeInput = document.querySelector('input[name="size"]');

    sizeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            sizeButtons.forEach((btn) =>
                btn.classList.remove(
                    "bg-orangeColor",
                    "text-white",
                    "border-orangeColor"
                )
            );

            this.classList.add(
                "bg-orangeColor",
                "text-white",
                "border-orangeColor"
            );

            if (sizeInput) {
                sizeInput.value = this.textContent.trim();
            }
        });
    });

    // ======== Tăng giảm số lượng ========
    const quantityInput = document.getElementById("quantity");
    const decreaseBtn = document.getElementById("decreaseBtn");
    const increaseBtn = document.getElementById("increaseBtn");

    decreaseBtn.addEventListener("click", function () {
        let current = parseInt(quantityInput.value);
        let min = parseInt(quantityInput.min);
        if (current > min) quantityInput.value = current - 1;
    });

    increaseBtn.addEventListener("click", function () {
        let current = parseInt(quantityInput.value);
        let max = parseInt(quantityInput.max);
        if (current < max) quantityInput.value = current + 1;
    });

    quantityInput.addEventListener("input", function () {
        let value = parseInt(this.value);
        let min = parseInt(this.min);
        let max = parseInt(this.max);
        if (value < min) this.value = min;
        if (value > max) this.value = max;
    });

    // ======== Upload ảnh tùy chỉnh ========
    const customImageCheckbox = document.getElementById("customImage");
    const uploadContainer = document.getElementById("uploadContainer");
    const uploadInputImage = document.getElementById("uploadImage");
    const previewImageBox = document.getElementById("previewImage");
    const uploadPlaceholder = document.getElementById("uploadPlaceholder");

    let uploadedImageBase64 = "";

    customImageCheckbox.addEventListener("change", function () {
        if (this.checked) {
            uploadContainer.classList.remove("hidden");
        } else {
            uploadContainer.classList.add("hidden");
            uploadInputImage.value = "";
            previewImageBox.classList.add("hidden");
            uploadPlaceholder.classList.remove("hidden");
            uploadedImageBase64 = ""; // reset
        }
    });

    uploadInputImage.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                uploadedImageBase64 = e.target.result;
                previewImageBox.src = uploadedImageBase64;
                previewImageBox.classList.remove("hidden");
                uploadPlaceholder.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        } else {
            previewImageBox.classList.add("hidden");
            uploadPlaceholder.classList.remove("hidden");
            uploadedImageBase64 = "";
        }
    });
});

// Thêm vào giỏ hàng
document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("addToCartBtn")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn form gửi lên server

            const form = document.getElementById("productDetailForm");
            const formData = new FormData(form);

            const customImageCheckbox = document.getElementById("customImage");
            const uploadImageInput = document.getElementById("uploadImage");

            if (
                customImageCheckbox.checked &&
                uploadImageInput.files.length > 0
            ) {
                // Upload ảnh qua AJAX
                const imageFormData = new FormData();
                imageFormData.append("image", uploadImageInput.files[0]);

                fetch("/upload-image", {
                    method: "POST",
                    body: imageFormData,
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.path) {
                            // Upload ảnh thành công, lưu dữ liệu vào localStorage
                            storeCartItem(formData, data.path);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: `Thất bại`,
                                text: `Có lỗi xảy ra khi upload ảnh`,
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Lỗi khi upload ảnh:", error);
                        Swal.fire({
                            icon: "error",
                            title: `Thất bại`,
                            text: `Có lỗi xảy ra khi upload ảnh`,
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    });
            } else {
                // Không có ảnh, chỉ lưu các tùy chọn khác
                storeCartItem(formData, null);
            }
        });

    function storeCartItem(formData, imagePath) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        // Tạo đối tượng sản phẩm
        const cartItem = {
            productId: formData.get("productId"),
            productName: formData.get("productName"), // Lấy tên sản phẩm từ form
            image: formData.get("mainImage"), // Lấy đường dẫn ảnh chính
            color: formData.get("color"),
            printPosition: formData.get("printPosition"),
            size: formData.get("size"),
            quantity: parseInt(formData.get("quantity")), // Chuyển thành số
            customImagePath: imagePath || null,
        };

        // Kiểm tra sản phẩm trùng lặp
        const existingItemIndex = cart.findIndex(
            (item) =>
                item.productId === cartItem.productId &&
                item.color === cartItem.color &&
                item.printPosition === cartItem.printPosition &&
                item.size === cartItem.size &&
                item.customImagePath === cartItem.customImagePath
        );

        if (existingItemIndex !== -1) {
            // Tăng số lượng nếu trùng
            cart[existingItemIndex].quantity += cartItem.quantity;
        } else {
            // Thêm sản phẩm mới
            cart.push(cartItem);
        }

        // Lưu lại vào localStorage
        localStorage.setItem("cart", JSON.stringify(cart));

        Swal.fire({
            icon: "success",
            title: `Thành công`,
            text: `Thêm vào giỏ hàng thành công`,
            timer: 3000,
            showConfirmButton: false,
        });
    }
});
