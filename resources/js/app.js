import "./bootstrap";
import SimpleBar from "simplebar";
import "simplebar/dist/simplebar.css";

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-simplebar]").forEach((el) => {
        new SimpleBar(el);
    });
});
