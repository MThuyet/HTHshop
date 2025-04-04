document.addEventListener("DOMContentLoaded", function () {
    // Xử lý câu hỏi FAQ
    document.querySelectorAll(".faq__question").forEach((question) => {
        question.addEventListener("click", function () {
            const item = this.parentElement;
            const icon = this.querySelector(".material-symbols-rounded");

            document.querySelectorAll(".faq__item").forEach((faq) => {
                const faqIcon = faq.querySelector(".material-symbols-rounded");
                if (faq !== item) {
                    faq.classList.remove("active");
                    faq.querySelector(".faq__answer").classList.add("hidden");
                    faqIcon.textContent = "expand_more"; // Đổi icon về mũi tên xuống
                }
            });

            // Toggle trạng thái mở/đóng
            item.classList.toggle("active");
            const answer = item.querySelector(".faq__answer");
            answer.classList.toggle("hidden");

            // Đổi icon theo trạng thái
            icon.textContent = answer.classList.contains("hidden")
                ? "expand_more"
                : "expand_less";
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
