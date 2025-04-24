document.addEventListener('DOMContentLoaded', () => {
/* Begin Search Nav Function Script */
    const searchModal = document.getElementById('search-modal');
    const searchInput = document.querySelector('#search-modal input');
    const searchResultBox = document.getElementById('search-dropdown-result');
    const searchCloseBtn = document.getElementById('search-btn-close');
    const searchBtnOpenModal = document.getElementById('search-btn-open-modal');

    searchBtnOpenModal.onclick = function () {
        searchBtnOpenModal.classList.add('bg-[#0F6A9C]', 'text-white');
        searchModal.classList.remove('hidden');
        searchInput.focus();
    }

    const searchData = [
        /* DashBoard */
        { name: "Thống kê", url: "/admin/dashboard" },

        /* Products */
        { name: "Quản lý sản phẩm", url: "/admin/products" },
        { name: "Thêm sản phẩm mới", url: "/admin/products/create" },

        /* Product Categories */
        { name: "Quản lý danh mục sản phẩm", url: "/admin/product-categories" },
        { name: "Thêm danh mục sản phẩm mới", url: "/admin/product-categories/create" },

        /* Orders */
        { name: "Quản lý đơn hàng", url: "/admin/orders" },

        /* Users */
        { name: "Quản lý người dùng", url: "/admin/users" },
        { name: "Thêm người dùng", url: "/admin/users/create" },

        /* News */
        { name: "Quản lý bài viết", url: "/dashboard/news" },
        { name: "Thêm bài viết", url: "/dashboard/news/create" },

        /* News Categories */
        { name: "Quản lý danh mục bài viết", url: "/dashboard/news-categories" },
        { name: "Thêm danh mục bài viết", url: "/dashboard/news-categories/create" },

        /* Profile */
        { name: "Cài đặt hồ sơ cá nhân", url: "/dashboard/profile" }
    ];

    searchCloseBtn?.addEventListener('click', () => {
        searchBtnOpenModal.classList.remove('bg-[#0F6A9C]', 'text-white');
        searchModal.classList.add('hidden');
        searchInput.value = '';
        searchResultBox.innerHTML = '';
    });

    window.addEventListener('click', (e) => {
        if (e.target === searchModal) {
            searchBtnOpenModal.classList.remove('bg-[#0F6A9C]', 'text-white');
            searchModal.classList.add('hidden');
            searchInput.value = '';
            searchResultBox.innerHTML = '';
        }
    });

    searchInput?.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase().trim();
        searchResultBox.innerHTML = '';

        if (query === '') return;

        const results = searchData.filter(item => item.name.toLowerCase().includes(query));

        if (results.length > 0) {
            results.forEach(item => {
                const link = document.createElement('a');
                link.href = item.url;
                link.textContent = item.name;
                link.className = 'block px-4 py-2 hover:bg-gray-100 text-gray-700';
                searchResultBox.appendChild(link);
            });
        } else {
            searchResultBox.innerHTML = '<div class="px-4 py-2 text-gray-500">Không tìm thấy kết quả.</div>';
        }
    });
/* End Search Nav Function Script */

/* Begin Menu Script */
    const menuModal = document.getElementById('menu-modal');
    const menuAside = document.getElementById('menu-aside');
    const toggleBtn = document.getElementById('menu-toggle'); 
    let isOpen = false;

    toggleBtn?.addEventListener('click', function () {
        isOpen = !isOpen;

        if (isOpen) {
            toggleBtn.classList.add('bg-[#0F6A9C]', 'text-white');

            menuModal.classList.remove('hidden');
            setTimeout(() => {
                menuAside.classList.remove('-translate-x-full');
            }, 10);
        } else {
            menuAside.classList.add('-translate-x-full');
            setTimeout(() => {
                menuModal.classList.add('hidden');
            }, 300);
        }
    });

    menuModal?.addEventListener('click', function (e) {
        if (e.target === menuModal) {
            toggleBtn.classList.remove('bg-[#0F6A9C]', 'text-white');
            isOpen = false;
            menuAside.classList.add('-translate-x-full');
            setTimeout(() => {
                menuModal.classList.add('hidden');
            }, 300);
        }
    });
/* End Menu Script */
});
