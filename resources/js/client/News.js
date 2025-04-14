document.addEventListener("DOMContentLoaded", () => {
    // Lấy tất cả các tab và phần underline
    const tabs = document.querySelectorAll(".tab-item");
    const underline = document.getElementById("tab-underline");

    // Lấy đường dẫn hiện tại
    const currentPath = window.location.pathname;

    // Lấy slug đã lưu trong localStorage (nếu có)
    const savedSlug = localStorage.getItem("activeTabSlug");

    // Tách slug từ URL (phần sau cùng)
    const pathSlug = currentPath.split("/").pop();

    // Cập nhật vị trí và độ rộng của underline theo tab được chọn
    const setUnderline = (tab) => {
        underline.style.width = `${tab.offsetWidth}px`;
        underline.style.left = `${tab.offsetLeft}px`;
    };

    // Đặt trạng thái "active" cho tab dựa vào slug
    const setActiveTab = (slug) => {
        tabs.forEach((tab) => {
            const isActive = tab.getAttribute("data-slug") === slug;
            tab.classList.toggle("text-orangeColor", isActive); // Thêm hoặc gỡ lớp active
            if (isActive) setUnderline(tab); // Nếu tab này đang active thì đặt underline
        });
    };

    // Gán sự kiện click cho mỗi tab
    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            const slug = tab.getAttribute("data-slug"); // Lấy slug từ data attribute
            localStorage.setItem("activeTabSlug", slug); // Lưu slug vào localStorage
            setActiveTab(slug); // Cập nhật giao diện
        });
    });

    // Nếu là trang tin tức
    if (currentPath.startsWith("/tin-tuc")) {
        // Ưu tiên slug từ URL, sau đó đến slug đã lưu, nếu không có thì mặc định "tin-noi-bat"
        setActiveTab(pathSlug || savedSlug || "tin-noi-bat");
    } else {
        // Nếu không phải trang tin tức, luôn đặt tab mặc định là "tin-noi-bat"
        setActiveTab("tin-noi-bat");
    }
});
