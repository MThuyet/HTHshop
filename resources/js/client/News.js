// Active tab

document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-item");
    const underline = document.getElementById("tab-underline");

    function setUnderline(tab) {
        underline.style.width = `${tab.offsetWidth}px`;
        underline.style.left = `${tab.offsetLeft}px`;
    }

    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            tabs.forEach((t) => t.classList.remove("text-orangeColor"));
            this.classList.add("text-orangeColor");
            setUnderline(this);
        });
    });

    // Set vị trí ban đầu
    setUnderline(tabs[0]);
    tabs[0].classList.add("text-orangeColor");
});

// Active sidebar
document.addEventListener("DOMContentLoaded", function () {
    const sidebarItems = document.querySelectorAll(".sidebar-item");

    sidebarItems.forEach((item) => {
        item.addEventListener("click", function (e) {
            e.preventDefault();

            // Xóa active ở tất cả các tab
            sidebarItems.forEach((el) => {
                el.classList.remove("bg-orangeColor", "text-white");
                el.classList.add("bg-white", "text-gray-800"); // Giữ màu mặc định khi không active
            });

            // Active tab được chọn
            this.classList.add("bg-orangeColor", "text-white");
            this.classList.remove("bg-white", "text-gray-800");
        });
    });

    // Set mặc định active cho mục đầu tiên
    sidebarItems[0].classList.add("bg-orangeColor", "text-white");
    sidebarItems[0].classList.remove("bg-white", "text-gray-800");
});
