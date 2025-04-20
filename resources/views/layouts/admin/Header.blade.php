{{-- Header left side --}}
<div class="flex items-center gap-5">
    <img src="{{ asset('images/logo-header-crop.png') }}" class="max-w-[55px]" alt="logo-hth-shop" />
</div>

{{-- Header center side --}}
<div class="hidden lg:flex flex-1 justify-center gap-5">
    @php
        $navList = [
            ['navName' => 'dashBoard', 'navIcon' => 'bar_chart_4_bars', 'route' => 'admin.dashboard'],
            ['navName' => 'product', 'navIcon' => 'apparel', 'route' => 'admin.product'],
            ['navName' => 'order', 'navIcon' => 'shopping_bag', 'route' => 'admin.dashboard'],
            ['navName' => 'user', 'navIcon' => 'manage_accounts', 'route' => 'admin.user'],
            ['navName' => 'news', 'navIcon' => 'news', 'route' => 'admin.dashboard'],
        ];

        $navItemActive = trim($__env->yieldContent('nav-active'));
    @endphp

    @foreach ($navList as $item)
        <a href="{{ route($item['route']) }}"
            class="flex items-center p-2 rounded-lg border border-gray-400 hover:bg-[#0F6A9C] hover:text-white
           {{ $item['navName'] === $navItemActive ? 'text-white bg-[#0F6A9C]' : '' }}">
            <span class="material-symbols-rounded">{{ $item['navIcon'] }}</span>
        </a>
    @endforeach
</div>

{{-- Header right side --}}
<div class="flex items-center gap-5">
    <button type="button"
        class="flex items-center p-2 rounded-lg border border-gray-400 hover:bg-[#0F6A9C] hover:text-white"
        id="search-btn-open-modal">
        <span class="material-symbols-rounded">
            search
        </span>
    </button>
    <button type="button"
        class="lg:hidden flex items-center p-2 rounded-lg border border-gray-400 hover:bg-[#0F6A9C] hover:text-white"
        id="menu-toggle">
        <span class="material-symbols-rounded">
            menu
        </span>
    </button>
    <div class="relative group inline-block">
        <img src="{{ Auth::user()->avatar 
            ? asset('storage/' . Auth::user()->avatar) 
            : asset('images/avatar-temp.webp') }}"
            alt="{{ Auth::user()->fullname }}" class="rounded-full h-[40px] w-[40px] cursor-pointer" />

        <ul
            class="absolute right-0 min-w-[150px] bg-white border shadow-sm rounded-md overflow-hidden z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-150">
            <li>
                <a href="{{ route('user.profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 text-sm">
                    <span class="material-symbols-rounded">account_circle</span> Hồ sơ
                </a>
            </li>
            <li class="h-px bg-gray-200"></li>
            <li>
                <a href="{{ route('logout') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 text-sm">
                    <span class="material-symbols-rounded">logout</span> Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</div>

{{-- Search modal --}}
<div id="search-modal"
    class="fixed inset-0 z-[9999] bg-black bg-opacity-50 flex items-start justify-center pt-24 px-4 hidden">
    <div id="search-dropdown" class="w-full max-w-xl bg-white rounded-lg shadow-lg p-4 relative">
        <div class="relative">
            <span
                class="material-symbols-rounded absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                search
            </span>
            <input type="text" placeholder="Nhập chức năng bạn tìm kiếm..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div id="search-dropdown-result"
            class="mt-3 max-h-60 overflow-y-auto border border-gray-200 rounded-md bg-white shadow-sm text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Quản lý sản
                phẩm</a>
        </div>
        <button class="close-modal-btn absolute right-[-10px] top-[-12px]" id="search-btn-close">
            <span
                class="material-symbols-rounded bg-white rounded-full h-[30px] w-[30px] leading-[30px!important] shadow-md">
                close
            </span>
        </button>
    </div>
</div>

{{-- Menu modal --}}
<div id="menu-modal" class="fixed inset-0 z-[9999] bg-black bg-opacity-50 hidden">
    <div id="menu-aside"
        class="fixed top-0 left-0 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out p-4 flex flex-col gap-5">
        @foreach ($navList as $item)
            <a href="{{ route($item['route']) }}"
                class="flex items-center gap-2 p-2 rounded-lg border border-gray-400 hover:bg-[#0F6A9C] hover:text-white
                {{ $item['navName'] === $navItemActive ? 'text-white bg-[#0F6A9C]' : '' }}">
                <span class="material-symbols-rounded">{{ $item['navIcon'] }}</span>
            </a>
        @endforeach
    </div>
</div>
