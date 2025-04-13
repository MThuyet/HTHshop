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
        { name: "Quản lý sản phẩm", url: "{{ route('admin.dashboard') }}" },
        { name: "Thống kê doanh thu", url: "/admin/statistics" },
        { name: "Quản lý bài viết", url: "/admin/articles" },
        { name: "Cài đặt tài khoản", url: "/admin/settings" }
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
