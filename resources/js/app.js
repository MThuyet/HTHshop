import "./client/bootstrap";
import SimpleBar from "simplebar";
import "simplebar/dist/simplebar.css";

// Simplebar
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-simplebar]").forEach((el) => {
        new SimpleBar(el);
    });
});

// Active nav category
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".category-nav ul li a");
    const currentPath = window.location.pathname;

    // Thêm hoặc bỏ lớp active dựa trên đường dẫn
    navLinks.forEach((link) => {
        const linkPath = link.getAttribute("href");
        const isActive =
            currentPath === linkPath ||
            (linkPath.startsWith("/tin-tuc") &&
                currentPath.startsWith("/tin-tuc"));
        link.classList.toggle("active", isActive);
    });

    // Lưu trạng thái active khi click vào tab
    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            navLinks.forEach((item) => item.classList.remove("active"));
            link.classList.add("active");
        });
    });
});

// Animation
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
