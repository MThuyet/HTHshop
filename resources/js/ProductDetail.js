document.addEventListener("DOMContentLoaded", function () {
    // Chọn màu
    const colorOptions = document.querySelectorAll(".color-option");

    colorOptions.forEach((option) => {
        option.addEventListener("click", function () {
            // Xóa border-black khỏi tất cả
            colorOptions.forEach((opt) => opt.classList.remove("border-black"));

            // Thêm border-black vào màu được chọn
            this.classList.add("border-black");
        });
    });

    // Chọn size
    const sizeButtons = document.querySelectorAll(".size-option");

    sizeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Xóa class active của tất cả các button
            sizeButtons.forEach((btn) =>
                btn.classList.remove("border-orangeColor", "text-orangeColor")
            );

            // Thêm class active cho button được chọn
            this.classList.add("border-orangeColor", "text-orangeColor");
        });
    });

    // Lấy phần tử input và các nút tăng giảm
    const quantityInput = document.getElementById("quantity");
    const decreaseBtn = document.getElementById("decreaseBtn");
    const increaseBtn = document.getElementById("increaseBtn");

    // Hàm giảm số lượng
    decreaseBtn.addEventListener("click", function () {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        }
    });

    // Hàm tăng số lượng
    increaseBtn.addEventListener("click", function () {
        let currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
    });

    // upload
    const customImageCheckbox = document.getElementById("customImage");
    const uploadContainer = document.getElementById("uploadContainer");
    const uploadInput = document.getElementById("uploadImage");
    const previewImage = document.getElementById("previewImage");
    const uploadPlaceholder = document.getElementById("uploadPlaceholder");

    // Khi checkbox thay đổi trạng thái
    customImageCheckbox.addEventListener("change", function () {
        if (this.checked) {
            uploadContainer.classList.remove("hidden");
        } else {
            uploadContainer.classList.add("hidden");
            uploadInput.value = ""; // Reset input file
            previewImage.classList.add("hidden"); // Ẩn ảnh xem trước
            uploadPlaceholder.classList.remove("hidden"); // Hiện icon upload
        }
    });

    // Hiển thị ảnh xem trước khi upload
    uploadInput.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove("hidden");
                uploadPlaceholder.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add("hidden");
            uploadPlaceholder.classList.remove("hidden");
        }
    });
});
