document.addEventListener("DOMContentLoaded", function () {
    // Xử lý câu hỏi FAQ
    document.querySelectorAll(".faq__question").forEach((question) => {
        question.addEventListener("click", function () {
            const item = this.parentElement;
            document.querySelectorAll(".faq__item").forEach((faq) => {
                if (faq !== item) faq.classList.remove("active");
            });
            item.classList.toggle("active");
        });
    });

    // Xử lý phóng to ảnh
    const image = document.getElementById("imagePreview");
    const modal = document.getElementById("imageModal");
    const previewImage = document.getElementById("previewImage");
    const closeModal = document.getElementById("closeModal");

    image.addEventListener("click", () => {
        modal.style.display = "flex";
        previewImage.src = image.src;
    });

    closeModal.addEventListener("click", () => (modal.style.display = "none"));

    modal.addEventListener("click", (event) => {
        if (event.target === modal) modal.style.display = "none";
    });
});
