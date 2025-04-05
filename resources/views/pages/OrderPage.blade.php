<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section("title", "Đặt Hàng")
    @vite(['resources/css/app.css', 'resources/js/Order.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@200" rel="stylesheet">
</head>
<body class="pb-[0!important]">
    <form action="" method="POST" class="flex flex-col lg:flex-row min-h-[100vh]">
        <div class="lg:hidden py-[24px] px-[48px]">
            <div class="flex items-center border-b pb-2 mb-4">
                <img src="{{ asset('images/logo-header-crop.png') }}" class="h-[50px]" alt="logo">
                <h2 class="text-xl font-bold">
                    Đơn hàng (<span class="text-[var(--orange-color)]">6</span> sản phẩm)
                </h2>
            </div>
            <div class="max-h-[250px] overflow-y-auto">
                @for ($i = 0; $i < 6; $i++) 
                    <div class="flex items-center border-b mr-[16px] mb-4 py-2">
                        <img src="{{ asset('images/product1.png') }}" alt="Áo phông cộc tay" class="w-24 h-24 rounded-md">
                        <div class="ml-4 flex-1">
                            <h3 class="font-semibold">Áo phông cộc tay</h3>
                            <p class="text-sm text-gray-500">S / Vàng</p>
                            <p class="mt-1">
                                <b>149.000</b> <sup><strike>220.000đ</strike></sup>
                                <span class="text-[var(--orange-color)] font-semibold ml-2">x2</span>
                            </p>
                            <p class="text-sm font-bold text-end text-gray-600">Tạm tính: 298.000đ</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <main class="flex-[3] md:py-[24px] px-[48px] grid md:grid-cols-2 lg:grid-rows-[60px,auto] gap-x-[30px] gap-y-[10px]">
            <img src="{{ asset('images/logo-header-crop.png') }}" class="md:col-span-2 h-full hidden lg:block" alt="logo">
            <div>
                <div class="flex items-center gap-2 text-lg font-bold mb-[8px]">
                    <span style="font-size: 30px" class="material-symbols-rounded font-bold">
                        id_card
                    </span> 
                    Thông tin nhận hàng
                </div>
                <div class="mb-[10px]">
                    <input class="border border-1 border-[#d9d9d9] block w-full h-[48px] px-[12px] rounded-[4px] 
                    text-[13px] focus-visible:outline-[#66afe9]" 
                    type="email" name="email" placeholder="Email" pattern="^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                
                <div class="mb-[10px]">
                    <input class="border border-1 border-[#d9d9d9] block w-full h-[48px] px-[12px] rounded-[4px] 
                    text-[13px] focus-visible:outline-[#66afe9]" 
                    type="text" name="fullName" placeholder="Họ và tên" pattern="[A-Za-zÀ-ỹ ]+$" maxlength="50" required>
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <input class="border border-1 border-[#d9d9d9] block w-full h-[48px] px-[12px] rounded-[4px] 
                    text-[13px] focus-visible:outline-[#66afe9]" 
                    type="tel" name="phoneNumber" placeholder="Số điện thoại" pattern="0[0-9]{9,10}$" required>
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <div class="border border-1 border-[#d9d9d9] block w-full h-[48px] ps-[12px] rounded-[4px] text-[13px]
                    relative" id="province" tabindex="0">
                        <span class="absolute top-[2px] text-[#A9A3AF]">Tỉnh thành</span>
                        <h5 class="leading-[48px] translate-y-[8px] text-[14px]">---</h5>
                        <ul class="hidden z-10 absolute top-[calc(100%-2px)] left-[-.5px] border-t-[1px] border-t-[#d9d9d9] 
                        border-s-[1px] border-s-[#aaa] border-e-[1px] border-e-[#aaa] border-b-[1px] border-b-[#aaa] rounded-b-[4px] 
                            text-[14px] w-[calc(100%+1px)] block bg-white">
                            <li class="px-[4px] py-[4px]">
                                <input class="border border-1 w-full px-[6px] py-[4px] focus-visible:outline-[#66afe9]" type="text">
                            </li>
                            <div class="max-h-[140px] overflow-y-auto">
                                <li class="px-[4px] py-[4px] bg-[#eee]">---</li>
                            </div>
                        </ul>
                        <span style="font-size: 35px" class="material-symbols-rounded absolute right-[0] top-[50%] translate-y-[-50%] border-l-2 text-[#656268]">
                            arrow_drop_down
                        </span>
                    </div>
                    <input type="hidden" name="province">
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <div class="bg-[#eee] border border-1 border-[#d9d9d9] block w-full h-[48px] ps-[12px] rounded-[4px] text-[13px]
                    relative" id="district" tabindex="0">
                        <span class="absolute top-[2px] text-[#A9A3AF]">Quận Huyện / Thành phố</span>
                        <h5 class="leading-[48px] translate-y-[8px] text-[14px]">---</h5>
                        <ul class="hidden z-10 absolute top-[calc(100%-2px)] left-[-.5px] border-t-[1px] border-t-[#d9d9d9] 
                        border-s-[1px] border-s-[#aaa] border-e-[1px] border-e-[#aaa] border-b-[1px] border-b-[#aaa] rounded-b-[4px] 
                            text-[14px] w-[calc(100%+1px)] block bg-white">
                            <li class="px-[4px] py-[4px]">
                                <input class="border border-1 w-full px-[6px] py-[4px] focus-visible:outline-[#66afe9]" type="text">
                            </li>
                            <div class="max-h-[140px] overflow-y-auto">
                                <li class="px-[4px] py-[4px] bg-[#eee]">---</li>
                            </div>
                        </ul>
                        <span style="font-size: 35px" class="material-symbols-rounded absolute right-[0] top-[50%] translate-y-[-50%] border-l-2 text-[#656268]">
                            arrow_drop_down
                        </span>
                    </div>
                    <input type="hidden" name="district">
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <div class="bg-[#eee] border border-1 border-[#d9d9d9] block w-full h-[48px] ps-[12px] rounded-[4px] text-[13px]
                    relative" id="ward" tabindex="0">
                        <span class="absolute top-[2px] text-[#A9A3AF]">Phường xã</span>
                        <h5 class="leading-[48px] translate-y-[8px] text-[14px]">---</h5>
                        <ul class="hidden z-10 absolute top-[calc(100%-2px)] left-[-.5px] border-t-[1px] border-t-[#d9d9d9] 
                        border-s-[1px] border-s-[#aaa] border-e-[1px] border-e-[#aaa] border-b-[1px] border-b-[#aaa] rounded-b-[4px] 
                            text-[14px] w-[calc(100%+1px)] block bg-white" tabindex="0">
                            <li class="px-[4px] py-[4px]">
                                <input class="border border-1 w-full px-[6px] py-[4px] focus-visible:outline-[#66afe9]" type="text">
                            </li>
                            <div class="max-h-[140px] overflow-y-auto">
                                <li class="px-[4px] py-[4px] bg-[#eee]">---</li>
                            </div>
                        </ul>
                        <span style="font-size: 35px" class="material-symbols-rounded absolute right-[0] top-[50%] translate-y-[-50%] border-l-2 text-[#656268]">
                            arrow_drop_down
                        </span>
                    </div>
                    <input type="hidden" name="ward">
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <textarea class="border border-1 w-full px-[12px] py-[6px] rounded-[4px] text-[13px] focus-visible:outline-[#66afe9]" name="specifyAddress" cols="30" rows="3" placeholder="Địa chỉ cụ thể" maxlength="255" required></textarea>
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
                <div class="mb-[10px]">
                    <textarea class="border border-1 w-full px-[12px] py-[6px] rounded-[4px] text-[13px] focus-visible:outline-[#66afe9]" name="note" cols="30" rows="3" placeholder="Ghi chú"></textarea>
                    <small class="error-message text-[var(--red-color)]"></small>
                </div>
            </div>
            <div>
                <div class="flex items-center gap-2 text-lg font-bold mb-[8px]"><span style="font-size: 30px" class="material-symbols-rounded">
                    local_shipping
                    </span> Vận chuyển</div>
                <div class="flex items-center justify-between border border-1 border-[#d9d9d9] block w-full h-[48px] px-[12px] mb-[10px] rounded-[4px] 
                    text-[13px]">
                    <div class="flex gap-x-8">
                        <div class="flex items-center justify-center h-[20px] w-[20px] rounded-full bg-[var(--orange-color)]">
                            <div class="h-[8px] w-[8px] rounded-full bg-white"></div>
                        </div>
                        Giao hàng tận nơi
                    </div>
                    <h4>Miễn phí</h4>
                </div>

                <h2 class="text-lg font-bold mb-[8px]">Thanh toán</h2>
                <div class="flex items-center justify-between border border-1 border-[#d9d9d9] block w-full h-[48px] px-[12px] mb-[10px] rounded-[4px] 
                    text-[13px]">
                    <div class="flex gap-x-8">
                        <div class="flex items-center justify-center h-[20px] w-[20px] rounded-full bg-[var(--orange-color)]">
                            <div class="h-[8px] w-[8px] rounded-full bg-white"></div>
                        </div>
                        Thanh toán khi giao hàng (COD)
                    </div>
                    <span style="font-weight: bold;" class="material-symbols-rounded text-[var(--orange-color)]">
                        payments
                    </span>
                </div>
            </div>
        </main>
        <aside class="flex-[2] px-[20px] pb-[20px] lg:py-[20px] bg-[#FAFAFA] border-l-[1px] border-l-[#e1e1e1]">
            <h2 class="hidden lg:block text-xl font-bold border-b pb-2 mb-4">Đơn hàng (<span class="text-[var(--orange-color)]">6</span> sản phẩm)</h2>
            <div class="hidden lg:block max-h-[500px] overflow-y-auto">
                @for ($i = 0; $i < 6; $i++) 
                    <div class="flex items-center border-b mr-[16px] mb-4 py-2">
                        <img src="{{ asset('images/product1.png') }}" alt="Áo phông cộc tay" class="w-24 h-24 rounded-md">
                        <div class="ml-4 flex-1">
                            <h3 class="font-semibold">Áo phông cộc tay</h3>
                            <p class="text-sm text-gray-500">S / Vàng</p>
                            <p class="mt-1">
                                <b>149.000</b> <sup><strike>220.000đ</strike></sup>
                                <span class="text-[var(--orange-color)] font-semibold ml-2">x2</span>
                            </p>
                            <p class="text-sm font-bold text-end text-gray-600">Tạm tính: 298.000đ</p>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="pt-2 mt-2 border-t-[1px] border-t-[#d9d9d9]">
                <div class="flex justify-between text-xl font-bold mt-2">
                    <span>Tổng cộng:</span>
                    <span>2.020.000đ</span>
                </div>
            </div>

            <div class="mt-6 flex flex-col-reverse md:flex-row text-center gap-3 justify-between">
                <a href="#" class="text-[var(--orange-color)] hover:text-[var(--red-color)]">◀ Quay về giỏ hàng</a>
                <button type="submit" name="SubmitOrder" class="bg-[var(--orange-color)] font-bold text-white px-6 py-2 rounded-lg hover:bg-[var(--red-color)]">
                    ĐẶT HÀNG
                </button>
            </div>
        </aside>
        @csrf
    </form>
</body>
</html>