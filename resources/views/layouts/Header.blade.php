<div
    class="header lg:w-10/12 md:w-11/12 sm:w-10/12 mx-auto flex flex-wrap md:flex-nowrap md:gap-6 gap-2 justify-between items-center md:p-0 p-3">
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
            <i class="fas fa-search absolute right-4 text-gray-500 text-lg cursor-pointer"></i>
        </div>

        {{-- Hỗ trợ --}}
        <div class="support items-center gap-2 flex md:order-2 order-1">
            <i
                class="animate-phone-ring fa-solid fa-phone-volume lg:text-2xl md:text-xl cursor-pointer hover:scale-110 transition animate-shake"></i>
            <div class="md:text-[1.5vw] lg:text-[1.1vw] sm:text-[2vw] text-sm">
                <p class="text-nowrap">Tư vấn hỗ trợ</p>
                <p class="font-bold text-redColor cursor-pointer hover:opacity-70">1900 6750</p>
            </div>
        </div>
    </div>

    {{-- Action --}}
    <div
        class="action flex items-center lg:gap-4 gap-3 ml-auto lg:text-[1.1vw] md:text-[1.5vw] sm:text-[2vw] text-[14px]">
        <div class="relative flex flex-col justify-between items-center cursor-pointer">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Giỏ hàng</span>
            <span
                class="absolute -top-2 -right-0 bg-redColor text-white w-5 h-5 flex items-center justify-center rounded-full">0</span>
        </div>

        <div class="flex flex-col items-center justify-between cursor-pointer">
            <i class="fa-solid fa-user"></i>
            <span>Đăng nhập</span>
        </div>
    </div>
</div>

<nav
    class="category-nav w-full bg-[#f7f8fa] overflow-x-auto scrollbar-hide
    fixed bottom-0 left-0 right-0 z-50 md:relative">
    <ul
        class="flex items-center sm:gap-2 text-gray-800 sm:py-2 py-1 mx-auto
						 whitespace-nowrap w-max px-4 md:text-[17px] text-[15px]">
        <li>
            <a href="/"
                class=" hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center md:ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-house "></i></span> <span>Trang chủ</span>
            </a>
        </li>
        <li>
            <a href="/san-pham"
                class="hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-shirt"></i></span> <span>Sản phẩm</span>
            </a>
        </li>
        <li>
            <a href="/tin-tuc"
                class="hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-newspaper "></i></span> <span>Tin tức</span>
            </a>
        </li>
        <li>
            <a href="/gioi-thieu"
                class="hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-info-circle "></i></span> <span>Giới thiệu</span>
            </a>
        </li>
        <li>
            <a href="/cau-hoi"
                class="hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-question-circle "></i></span> <span>Câu hỏi</span>
            </a>
        </li>
        <li>
            <a href="/lien-he"
                class="hover:text-orange-500 transition text-nowrap px-4 py-2 flex flex-col md:flex-row items-center ms:gap-2 gap-1">
                <span class="md:hidden"><i class="fa-solid fa-phone "></i></span> <span>Liên hệ</span>
            </a>
        </li>
    </ul>
</nav>
