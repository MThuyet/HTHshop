import "./bootstrap";
import SimpleBar from "simplebar";
import "simplebar/dist/simplebar.css";

// Simplebar
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-simplebar]").forEach((el) => {
        new SimpleBar(el);
    });
});

// Active category header
document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".category-nav ul li a");
    const currentPath = window.location.pathname;

    navLinks.forEach((link) => {
        link.classList.toggle(
            "active",
            link.getAttribute("href") === currentPath
        );
    });

    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            navLinks.forEach((item) => item.classList.remove("active"));
            link.classList.add("active");
            localStorage.setItem("activeNavLink", link.getAttribute("href"));
        });
    });
});

// Active favorite
const wishlistButtons = document.querySelectorAll(".wishlist-btn");

wishlistButtons.forEach((btn) => {
    const icon = btn.querySelector(".icon-heart");
    const tooltip = btn.querySelector(".tooltip-text");

    let isFavorited = false;

    function updateButtonUI() {
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

    // Khởi tạo giao diện
    updateButtonUI();

    // Click để toggle trạng thái
    btn.addEventListener("click", function (e) {
        e.preventDefault(); // Ngăn trình duyệt thực hiện hành vi mặc định (chuyển trang)
        e.stopPropagation(); // Ngăn sự kiện lan ra thẻ cha (thẻ <a>)

        isFavorited = !isFavorited;
        updateButtonUI();
    });

    // Hover để hiển thị tooltip đúng theo trạng thái
    btn.addEventListener("mouseenter", function (e) {
        tooltip.textContent = isFavorited ? "Đã yêu thích" : "Yêu thích";
    });

    btn.addEventListener("mouseleave", function (e) {
        tooltip.textContent = isFavorited ? "Đã yêu thích" : "Yêu thích";
    });
});
