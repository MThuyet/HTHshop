<div
    class="header lg:w-10/12 md:w-11/12 mx-auto flex flex-wrap md:flex-nowrap md:gap-6 gap-2 justify-between items-center md:p-0 p-3">
    {{-- Logo --}}
    <a href="/">
        <div class="header-logo p-2 flex items-center cursor-pointer">
            <img class="md:w-20 w-[10vw]" src="{{ asset('images/logo-header-crop.png') }}" alt="Logo">
            <p class="text-nowrap sm:text-[1.5vw] lg:text-[1.1vw] text-[#0576a9] font-semibold">HTH Clothes</p>
        </div>
    </a>

    {{-- Search --}}
    <div
        class="header-search flex flex-row w-full md:flex-1 md:justify-center justify-between items-center lg:gap-6 gap-3 order-last md:order-none md:mt-0 mt-3">
        <!-- Search Input -->
        <div class="relative flex items-center w-full max-w-md md:order-1 order-2">
            <input class="w-full outline-none rounded-full px-4 py-2 pr-10 border border-gray-400" type="text"
                placeholder="Tìm kiếm sản phẩm ...">
            <span class="material-symbols-rounded absolute right-2 text-gray-500 cursor-pointer"
                style="font-size: 32px">search</span>

        </div>

        {{-- Hỗ trợ --}}
        <a href="tel:0332393031" class="support items-center gap-2 flex md:order-2 order-1">
            <span class="animate-phone-ring">
                <span class="material-symbols-rounded" style="font-size: 36px">
                    phonelink_ring
                </span>
            </span>
            <div class="md:text-[1.5vw] lg:text-[1.1vw] sm:text-[2vw] text-sm">
                <p class="text-nowrap">Tư vấn hỗ trợ</p>
                <p class="font-bold text-redColor hover:opacity-70">0332 393 031</p>
            </div>
        </a>
    </div>

    {{-- Action --}}
    <div
        class="action flex items-center lg:gap-4 md:gap-3 gap-4 ml-auto lg:text-[1.1vw] md:text-[1.5vw] sm:text-[2vw] text-[14px]">
        <div class="relative flex flex-col justify-between items-center cursor-pointer">
            <span class="material-symbols-rounded" style="font-size: 28px">
                shopping_bag
            </span>
            <span>Giỏ hàng</span>
            <span
                class="absolute -top-2 -right-0 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full">0</span>
        </div>

        <a href="{{ route('LoginRoute') }}">
            <div class="flex flex-col items-center justify-between cursor-pointer">
                <span class="material-symbols-rounded" style="font-size: 28px">
                    account_circle
                </span>
                <span">Đăng nhập</span>
            </div>
        </a>
    </div>
</div>

<nav class="category-nav w-full bg-[#f7f8fa] scrollbar-hide fixed bottom-0 left-0 right-0 z-50 md:relative">
    <ul
        class="flex items-center md:gap-5 sm:gap-8 gap-9 text-gray-800 md:py-2 mx-auto whitespace-nowrap w-max px-4 md:text-[17px] text-[15px]">
        <li>
            <a href="/"
                class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                <span class="md:hidden">
                    <span class="material-symbols-rounded" style="font-size: 32px;">home</span>
                </span>
                <span class="md:text-lg">Trang chủ</span>
            </a>
        </li>
        <li>
            <a href="/san-pham"
                class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                <span class="md:hidden">
                    <span class="material-symbols-rounded" style="font-size: 32px;">shopping_bag</span>
                </span>
                <span class="md:text-lg">Sản phẩm</span>
            </a>
        </li>
        <li>
            <a href="/tin-tuc"
                class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                <span class="md:hidden">
                    <span class="material-symbols-rounded" style="font-size: 32px;">article</span>
                </span>
                <span class="md:text-lg">Tin tức</span>
            </a>
        </li>
        <li>
            <a href="/ho-tro"
                class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                <span class="md:hidden">
                    <span class="material-symbols-rounded" style="font-size: 32px;">help</span>
                </span>
                <span class="md:text-lg">Hỗ trợ</span>
            </a>
        </li>
        <li class="hidden sm:block">
            <a href="/lien-he"
                class="hover:text-orange-500 transition text-nowrap sm:px-2 py-1 md:px-4 md:py-2 flex flex-col md:flex-row items-center">
                <span class="md:hidden">
                    <span class="material-symbols-rounded" style="font-size: 32px;">phone</span>
                </span>
                <span class="md:text-lg">Liên hệ</span>
            </a>
        </li>
    </ul>
</nav>
