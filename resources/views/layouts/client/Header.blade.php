<div
    class="header lg:w-10/12 md:w-11/12 mx-auto flex flex-wrap md:flex-nowrap md:gap-6 gap-2 justify-between items-center md:p-0 p-3">
    {{-- Logo --}}
    <a href="/">
        <div class="header-logo py-2 flex items-center cursor-pointer">
            <img class="md:w-20 w-[10vw]" src="{{ asset('images/logo-header-crop.png') }}" alt="Logo">
            <p class="text-nowrap sm:text-[1.5vw] lg:text-[1.1vw] text-[#0576a9] font-semibold">HTH Clothes</p>
        </div>
    </a>

    {{-- Search --}}
    <div
        class="header-search flex flex-row w-full md:flex-1 md:justify-center justify-between items-center lg:gap-6 gap-3 order-last md:order-none md:mt-0 mt-3">
        <!-- Search Input -->
        <form action="{{ route('product') }}" method="POST"
            class="relative flex items-center w-full max-w-md md:order-1 order-2">
            @csrf
            <input class="w-full outline-none rounded-full px-4 py-2 pr-10 border border-gray-400" type="text"
                placeholder="Tìm kiếm sản phẩm ..." name="searchValue"
                value="{{ old('searchValue', request('searchValue')) }}">
            <span class="material-symbols-rounded absolute right-2 text-gray-500 cursor-pointer"
                style="font-size: 32px">search</span>
        </form>

        {{-- Hỗ trợ --}}
        <a href="tel:0332393031" class="support items-center gap-2 flex md:order-2 order-1">
            <span class="animate-phone-ring">
                <span class="material-symbols-rounded" style="font-size: 36px">
                    phonelink_ring
                </span>
            </span>
            <div class="md:text-[1.5vw] lg:text-[1.1vw] sm:text-[2vw] text-sm">
                <p class="text-nowrap">Tư vấn hỗ trợ</p>
                <p class="font-bold text-redColor hover:opacity-70 text-nowrap">0332 393 031</p>
            </div>
        </a>
    </div>

    {{-- Action --}}
    <div
        class="action flex items-center lg:gap-4 md:gap-3 gap-4 ml-auto lg:text-[1.1vw] md:text-[1.5vw] sm:text-[2vw] text-[14px] relative z-50">
        {{-- Giỏ hàng --}}
        <a href="{{ route('cart') }}">
            <div class="relative flex flex-col justify-between items-center cursor-pointer">
                <span class="material-symbols-rounded" style="font-size: 28px">
                    shopping_bag
                </span>
                <span>Giỏ hàng</span>
                <span id="headerCartCount"
                    class="absolute -top-2 -right-0 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full">0</span>
            </div>
        </a>

        {{-- Yêu thích --}}
        <a href="{{ route('favorite') }}">
            <div class="relative flex flex-col justify-between items-center cursor-pointer">
                <span class="material-symbols-rounded" style="font-size: 28px">
                    favorite
                </span>
                <span>Yêu thích</span>
                <span id="headerFavoriteCount"
                    class="absolute -top-2 -right-0 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full">0</span>
            </div>
        </a>

        {{-- Tài khoản --}}
        {{-- <div class="relative">
            <button id="account-btn"
                class="flex flex-col items-center justify-between cursor-pointer focus:outline-none">
                <span class="material-symbols-rounded" style="font-size: 28px">
                    account_circle
                </span>

                @if (Auth::check())
                    <span>Tài khoản</span>
                @else
                    <a href="{{ route('login') }}">Đăng nhập</a>
                @endif


            </button>

            {{-- Nếu đã đăng nhập, hiển thị dropdown --}}
        {{-- @if (Auth::check())
                <div id="account-dropdown"
                    class="absolute z-[999] right-0 mt-2 w-44 bg-white border border-gray-200 rounded-xl shadow-lg hidden overflow-hidden">

                    {{-- Thông tin --}}
        {{-- <a href="#"
                        class="flex items-center gap-2 text-nowrap px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-all duration-150">
                        <span class="material-symbols-rounded text-textColor">person</span>
                        Thông tin
                    </a> --}}

        {{-- Đơn hàng --}}
        {{-- <a href="#"
                        class="flex items-center gap-2 text-nowrap px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-all duration-150">
                        <span class="material-symbols-rounded text-textColor">receipt_long</span>
                        Đơn hàng
                    </a> --}}

        {{-- Divider --}}
        {{-- <div class="h-px bg-gray-200"></div> --}}

        {{-- Đăng xuất --}}
        {{-- <a href="{{ route('logout') }}"
                        class="flex items-center gap-2 text-nowrap px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition-all duration-150">
                        <span class="material-symbols-rounded text-red-500">logout</span>
                        Đăng xuất
                    </a>
                </div> --}}
        {{-- @endif  --}}
        {{-- </div>  --}}
    </div>

</div>

<nav class="category-nav w-full bg-[#f7f8fa] scrollbar-hide fixed bottom-0 left-0 right-0 z-50 md:static">
    <div class="lg:w-10/12 md:w-11/12 mx-auto">
        <ul
            class="flex items-center mx-auto md:mx-0 md:gap-5 sm:gap-8 gap-9 text-gray-800 md:py-2 sm:px-0 px-4 whitespace-nowrap w-max text-[15px]">
            <li>
                <a href="/"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">home</span>
                    </span>
                    <span class="">Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="/san-pham"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">shopping_bag</span>
                    </span>
                    <span class="">Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{ route('news.category', 'tin-tong-hop') }}"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center {{ request()->is('tin-tuc*') ? 'text-orange-500' : '' }}">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">article</span>
                    </span>
                    <span class="">Tin tức</span>
                </a>
            </li>
            <li>
                <a href="/ho-tro"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">help</span>
                    </span>
                    <span class="">Hỗ trợ</span>
                </a>
            </li>
            <li class="hidden sm:block">
                <a href="/lien-he"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">phone</span>
                    </span>
                    <span class="">Liên hệ</span>
                </a>
            </li>
            <li class="hidden sm:block">
                <a href="/chinh-sach"
                    class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                    <span class="md:hidden">
                        <span class="material-symbols-rounded" style="font-size: 32px;">phone</span>
                    </span>
                    <span class="">Chính sách</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    // Function to update cart count in header
    function updateHeaderCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        document.getElementById('headerCartCount').textContent = totalItems;
    }
    
    // Function to update favorite count in header
    function updateHeaderFavoriteCount() {
        const favorites = JSON.parse(localStorage.getItem('favoriteProducts')) || [];
        document.getElementById('headerFavoriteCount').textContent = favorites.length;
    }

    // Update counts when page loads
    document.addEventListener('DOMContentLoaded', function() {
        updateHeaderCartCount();
        updateHeaderFavoriteCount();
    });

    // Update cart count when cart changes in the same tab
    function handleCartChange() {
        updateHeaderCartCount();
    }
    
    // Update favorite count when favorites changes in the same tab
    function handleFavoriteChange() {
        updateHeaderFavoriteCount();
    }

    // Listen for storage changes from other tabs
    window.addEventListener('storage', function(e) {
        if (e.key === 'cart') {
            updateHeaderCartCount();
        }
        if (e.key === 'favoriteProducts') {
            updateHeaderFavoriteCount();
        }
    });

    // Override localStorage.setItem to detect changes
    const originalSetItem = localStorage.setItem;
    localStorage.setItem = function(key, value) {
        originalSetItem.apply(this, arguments);
        if (key === 'cart') {
            handleCartChange();
        }
        if (key === 'favoriteProducts') {
            handleFavoriteChange();
        }
    };

    // Override localStorage.removeItem to detect changes
    const originalRemoveItem = localStorage.removeItem;
    localStorage.removeItem = function(key) {
        originalRemoveItem.apply(this, arguments);
        if (key === 'cart') {
            handleCartChange();
        }
        if (key === 'favoriteProducts') {
            handleFavoriteChange();
        }
    };
</script>
