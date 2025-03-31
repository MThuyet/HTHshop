// Promo banner
const messages = [
    "🔥Mua 1 tặng 1 cho tất cả sản phẩm mới!",
    "🚀Free ship toàn quốc cho đơn hàng từ 500K!",
    "🎉Giảm ngay 100K cho đơn hàng đầu tiên!",
];

let index = 0;
const promoText = document.getElementById("promo-text");

function changeText() {
    promoText.style.opacity = 0; // Ẩn chữ cũ
    setTimeout(() => {
        index++;
        if (index >= messages.length) {
            index = 0;
        }
        promoText.innerText = messages[index];
        promoText.style.opacity = 1;
    }, 500);
}

setInterval(changeText, 3000);

// Animate promo banner
document.addEventListener("DOMContentLoaded", function () {
    // Lấy danh sách phần tử cần quan sát
    const promoElements = document.querySelectorAll(".hidden-promo-banner");
    const slideUpElements = document.querySelectorAll(".slide-up-effect");

    // Hàm xử lý khi phần tử vào viewport
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Áp dụng class phù hợp
                    if (
                        entry.target.classList.contains("hidden-promo-banner")
                    ) {
                        entry.target.classList.add("visible-promo-banner");
                    }
                    if (entry.target.classList.contains("slide-up-effect")) {
                        entry.target.classList.add("visible-slide-up");
                    }
                } else {
                    // Xóa class nếu ra khỏi viewport
                    if (
                        entry.target.classList.contains("hidden-promo-banner")
                    ) {
                        entry.target.classList.remove("visible-promo-banner");
                    }
                    if (entry.target.classList.contains("slide-up-effect")) {
                        entry.target.classList.remove("visible-slide-up");
                    }
                }
            });
        },
        {
            threshold: 0.15,
        }
    );

    // Quan sát cả hai nhóm phần tử
    promoElements.forEach((el) => observer.observe(el));
    slideUpElements.forEach((el) => observer.observe(el));
});
