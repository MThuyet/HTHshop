<style>
    @media (max-width: 767px) {
        body {
            overflow-x: hidden;
            padding-bottom: 70px;
        }

        .mobile-nav {
            padding-bottom: env(safe-area-inset-bottom, 10px);
        }
    }
</style>

@vite('resources/js/client/Header.js')

{{-- Top announcement bar --}}
<div class="bg-orangeColor text-white py-2 text-center text-sm font-medium hidden sm:block">
    <div class="lg:w-10/12 md:w-11/12 mx-auto">
        🔥 Miễn phí vận chuyển cho đơn hàng trên 500K - Đổi trả trong 30 ngày 🚚
    </div>
</div>

{{-- Main header section --}}
<div class="bg-white shadow-sm sticky top-0 z-50">
    <div class="lg:w-10/12 md:w-11/12 mx-auto px-4 md:px-0 py-3">
        {{-- Desktop Layout --}}
        <div class="hidden md:flex md:items-center md:justify-between">
            {{-- Logo --}}
            <a href="/" class="flex-shrink-0">
                <div class="header-logo flex items-center cursor-pointer">
                    <img class="w-16 h-auto" src="{{ asset('images/logo-header-crop.png') }}" alt="Logo">
                    <div class="ml-2">
                        <p class="text-nowrap text-lg lg:text-xl text-[#0576a9] font-bold">HTH Clothes</p>
                        <p class="text-gray-500 text-xs">Thời trang cho mọi người</p>
                    </div>
                </div>
            </a>

            {{-- Search --}}
            <div class="flex-grow max-w-md mx-4 md:mt-0 mt-2">
                <form action="{{ route('product') }}" method="POST" class="relative w-full mb-0">
                    @csrf
                    <div class="relative w-full">
                        <input id="searchInput"
                            class="w-full outline-none rounded-full px-5 py-3 pr-12 border-2 border-gray-200 focus:border-orangeColor transition-colors"
                            type="text" placeholder="Tìm kiếm sản phẩm..." name="searchValue"
                            value="{{ old('searchValue', request('searchValue')) }}" autocomplete="off">
                        <button type="submit"
                            class="absolute right-1 top-1/2 -translate-y-1/2 bg-orangeColor text-white p-2 rounded-full hover:bg-orange-600 transition-colors aspect-square w-10 h-10 flex items-center justify-center overflow-hidden">
                            <span class="material-symbols-rounded" style="font-size: 24px">search</span>
                        </button>
                    </div>

                    <!-- Suggestions dropdown -->
                    <div id="searchSuggestions"
                        class="absolute left-0 right-0 top-full mt-2 bg-white shadow-xl rounded-lg z-50 hidden overflow-hidden border border-gray-200 w-full">
                        <ul class="max-h-[70vh] overflow-y-auto divide-y divide-gray-100"></ul>
                    </div>
                </form>
            </div>

            {{-- Flash Deal --}}
            <a href="/san-pham?deal=flash"
                class="hidden lg:flex items-center gap-3 bg-red-50 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors">
                <span class="text-red-500">
                    <span class="material-symbols-rounded" style="font-size: 28px">
                        bolt
                    </span>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Deal hot</p>
                    <p class="font-bold text-red-500">Giảm đến 50%</p>
                </div>
            </a>

            {{-- Action --}}
            <div class="flex items-center gap-4 flex-shrink-0 ml-3">
                {{-- Giỏ hàng --}}
                <a href="{{ route('cart') }}" class="relative group">
                    <div class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-full transition-colors">
                        <span
                            class="material-symbols-rounded text-gray-700 group-hover:text-orangeColor transition-colors"
                            style="font-size: 28px">
                            shopping_bag
                        </span>
                        <span class="text-xs mt-1">Giỏ hàng</span>
                        <span id="headerCartCountDesktop"
                            class="absolute -top-1 -right-1 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full text-xs">0</span>
                    </div>
                </a>

                {{-- Yêu thích --}}
                <a href="{{ route('favorite') }}" class="relative group">
                    <div class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-full transition-colors">
                        <span
                            class="material-symbols-rounded text-gray-700 group-hover:text-orangeColor transition-colors"
                            style="font-size: 28px">
                            favorite
                        </span>
                        <span class="text-xs mt-1">Yêu thích</span>
                        <span id="headerFavoriteCountDesktop"
                            class="absolute -top-1 -right-1 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full text-xs">0</span>
                    </div>
                </a>
            </div>
        </div>

        {{-- Mobile Layout --}}
        <div class="flex flex-col md:hidden gap-3">
            <div class="flex justify-between items-center">
                {{-- Logo --}}
                <a href="/" class="flex-shrink-0">
                    <div class="header-logo flex items-center cursor-pointer">
                        <img class="w-[10vw] h-auto" src="{{ asset('images/logo-header-crop.png') }}" alt="Logo">
                        <div class="ml-2">
                            <p class="text-nowrap text-base text-[#0576a9] font-bold">HTH Clothes</p>
                            <p class="text-gray-500 text-[10px]">Thời trang cho mọi người</p>
                        </div>
                    </div>
                </a>

                {{-- Action --}}
                <div class="flex items-center gap-2">
                    {{-- Giỏ hàng --}}
                    <a href="{{ route('cart') }}" class="relative">
                        <div class="flex flex-col items-center p-2">
                            <span class="material-symbols-rounded text-gray-700" style="font-size: 28px">
                                shopping_bag
                            </span>
                            <span id="headerCartCountMobile"
                                class="absolute -top-1 -right-1 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full text-xs">0</span>
                        </div>
                    </a>

                    {{-- Yêu thích --}}
                    <a href="{{ route('favorite') }}" class="relative">
                        <div class="flex flex-col items-center p-2">
                            <span class="material-symbols-rounded text-gray-700" style="font-size: 28px">
                                favorite
                            </span>
                            <span id="headerFavoriteCountMobile"
                                class="absolute -top-1 -right-1 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full text-xs">0</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Search (Mobile) --}}
            <div class="w-full">
                <form action="{{ route('product') }}" method="POST" class="relative w-full mb-0">
                    @csrf
                    <div class="relative w-full">
                        <input id="searchInputMobile"
                            class="w-full outline-none rounded-full px-4 py-2 pr-12 border-2 border-gray-200 focus:border-orangeColor transition-colors text-base"
                            type="text" placeholder="Tìm kiếm sản phẩm..." name="searchValue"
                            value="{{ old('searchValue', request('searchValue')) }}" autocomplete="off">
                        <button type="submit"
                            class="absolute right-1 top-1/2 -translate-y-1/2 bg-orangeColor text-white p-1.5 rounded-full hover:bg-orange-600 transition-colors aspect-square w-10 h-10 flex items-center justify-center overflow-hidden">
                            <span class="material-symbols-rounded" style="font-size: 22px">search</span>
                        </button>
                    </div>

                    <!-- Suggestions dropdown (Mobile) -->
                    <div id="searchSuggestionsMobile"
                        class="absolute left-0 right-0 top-full mt-1 bg-white shadow-xl rounded-lg z-50 hidden overflow-hidden border border-gray-200 w-full">
                        <ul class="max-h-[50vh] overflow-y-auto divide-y divide-gray-100"></ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Navigation bar --}}
<nav class="bg-gray-50 border-b border-gray-200 shadow-sm md:sticky md:top-[72px] z-40 hidden md:block">
    <div class="lg:w-10/12 md:w-11/12 mx-auto">
        <ul
            class="flex items-center justify-between md:justify-center md:gap-3 lg:gap-8 text-gray-700 py-3 px-4 md:px-0">
            <li>
                <a href="/"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('/') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">home</span>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="/san-pham"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('san-pham*') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">shopping_bag</span>
                    <span>Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="{{ route('news.category', 'tin-tong-hop') }}"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('tin-tuc*') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">article</span>
                    <span>Tin tức</span>
                </a>
            </li>
            <li>
                <a href="/ho-tro"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('ho-tro*') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">help</span>
                    <span>Hỗ trợ</span>
                </a>
            </li>
            <li>
                <a href="/lien-he"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('lien-he*') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">contact_support</span>
                    <span>Liên hệ</span>
                </a>
            </li>
            <li>
                <a href="/chinh-sach"
                    class="hover:text-orangeColor font-medium transition text-nowrap px-3 py-2 rounded-md hover:bg-gray-100 flex items-center gap-2 {{ request()->is('chinh-sach*') ? 'text-orangeColor bg-orange-50' : '' }}">
                    <span class="material-symbols-rounded">policy</span>
                    <span>Chính sách</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- Mobile Bottom Navigation --}}
<nav class="md:hidden w-full bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.05)] fixed bottom-0 left-0 right-0 z-50 overflow-hidden mobile-nav"
    style="margin-bottom: -1px;">
    <div class="flex items-center justify-between px-4 py-1">
        <a href="/"
            class="flex flex-col items-center text-center p-2 {{ request()->is('/') ? 'text-orangeColor' : 'text-gray-700' }}">
            <span class="material-symbols-rounded" style="font-size: 28px;">home</span>
            <span class="text-xs mt-1">Trang chủ</span>
        </a>
        <a href="/san-pham"
            class="flex flex-col items-center text-center p-2 {{ request()->is('san-pham*') ? 'text-orangeColor' : 'text-gray-700' }}">
            <span class="material-symbols-rounded" style="font-size: 28px;">shopping_bag</span>
            <span class="text-xs mt-1">Sản phẩm</span>
        </a>
        <a href="{{ route('news.category', 'tin-tong-hop') }}"
            class="flex flex-col items-center text-center p-2 {{ request()->is('tin-tuc*') ? 'text-orangeColor' : 'text-gray-700' }}">
            <span class="material-symbols-rounded" style="font-size: 28px;">article</span>
            <span class="text-xs mt-1">Tin tức</span>
        </a>
        <a href="/ho-tro"
            class="flex flex-col items-center text-center p-2 {{ request()->is('ho-tro*') ? 'text-orangeColor' : 'text-gray-700' }}">
            <span class="material-symbols-rounded" style="font-size: 28px;">help</span>
            <span class="text-xs mt-1">Hỗ trợ</span>
        </a>
    </div>
</nav>
