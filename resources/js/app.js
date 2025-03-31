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
