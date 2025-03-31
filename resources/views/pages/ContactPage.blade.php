@extends('layouts.master')
@section('title', 'Liên Hệ')
@vite(['resources/js/Contact.js'])

@section('content')
    <div class="lg:w-10/12 md:w-11/12 mx-auto py-5 px-4">
        <h2 class="text-2xl font-bold my-5">Liên Hệ</h2>
        <div class="grid xl:grid-cols-2 lg:grid-cols-1 grid-row-2 gap-4 my-[30px] bg-[#f3f3f3] p-6 rounded-md">
            <form action="" method="POST" class="xl:col-span-1">
                <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-5">
                    <div>
                        <label for="full-name" class="text-lg font-bold">
                            Họ và tên
                            <span class="text-[var(--red-color)]">*</span>
                        </label><br>
                        <input type="text" name="fullName" id="full-name" placeholder="Họ và tên" maxlength="50" required
                            class="border-l-[3px] border-l-[var(--red-color)] p-2 w-full duration-500 ease
                            bg-[#fff] focus-within:outline-none
                            focus:outline-none focus:border-l-transparent focus:duration-500 focus:ease
                        ">
                        <span class="error-message text-[var(--red-color)]"></span>
                    </div>
                    <div>
                        <label for="email" class="text-lg font-bold">
                            Email
                            <span class="text-[var(--red-color)]">*</span>
                        </label><br>
                        <input type="text" name="email" id="email" placeholder="Email" maxlength="254" required
                            class="border-l-[3px] border-l-[var(--red-color)] p-2 w-full
                            bg-[#fff] duration-500 ease
                            focus:outline-none focus:border-l-transparent focus:duration-500 focus:ease
                        ">
                        <span class="error-message text-[var(--red-color)]"></span>
                    </div>
                    <div class="lg:col-span-2">
                        <label for="message" class="text-lg font-bold">
                            Tin nhắn
                            <span class="text-[var(--red-color)]">*</span>
                        </label><br>
                        <textarea id="message" name="message" cols="30" rows="8" placeholder="Tin nhắn" minlength="1"
                            maxlength="500" required
                            class="border-l-[3px] border-l-[var(--red-color)] p-2 w-full bg-[#fff] resize-none
                            duration-500 ease
                            focus:outline-none focus:border-l-transparent focus:duration-500 focus:ease
                        "></textarea>
                        <span class="error-message text-[var(--red-color)]"></span>
                    </div>
                    <button
                        class="bg-[var(--red-color)] text-white rounded-md px-[20px] h-[40px] leading-[40px] mt-[20px] hover:bg-[var(--orange-color)]">
                        <b>Gửi liên hệ</b>
                    </button>
                </div>
                @csrf
            </form>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d293.957653563369!2d106.86132012160087!3d10.95471234698858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174dc2a78299a93%3A0x3797df49a37b9efc!2zMzggxJAuIMSQ4bq3bmcgxJDhu6ljIFRodeG6rXQsIFRhbSBIb8OgLCBCacOqbiBIw7JhLCDEkOG7k25nIE5haQ!5e0!3m2!1svi!2s!4v1743244171854!5m2!1svi!2s"
                style="border:0;" width="100%" height="100%" allowfullscreen="true" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" class="min-h-[400px]"></iframe>
        </div>

        <div class="overflow-hidden">
            <h2 class="text-2xl font-bold my-8">Cơ Sở Chính</h2>

            <div class="grid grid-cols-1 xl:grid-cols-4 gap-6 mb-8">
                <div class="xl:col-span-2 flex items-start gap-4 p-4 rounded-lg bg-[#f9f9f9] shadow-md">
                    <div class="flex-shrink-0">
                        <div
                            class="bg-red-600 rounded-full h-[40px] leading-[40px] w-[40px] flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-white text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 mb-2">Địa chỉ:</h3>
                        <p class="text-gray-700">38/16, Đặng Đức Thuật, khu phố 6, Tam Hiệp, Biên Hòa, Đồng Nai</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 rounded-lg bg-[#f9f9f9] shadow-md">
                    <div class="flex-shrink-0">
                        <div
                            class="bg-red-600 rounded-full h-[40px] leading-[40px] w-[40px] flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-white text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 mb-2">Email:</h3>
                        <p class="text-gray-700">
                            <a href="mailto:hthsp@gmail.com" class="text-red-600 hover:underline">hthsp@gmail.com</a>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 rounded-lg bg-[#f9f9f9] shadow-md">
                    <div class="flex-shrink-0">
                        <div
                            class="bg-red-600 rounded-full h-[40px] leading-[40px] w-[40px] flex items-center justify-center">
                            <i class="fa-solid fa-phone text-white text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 mb-2">Điện thoại:</h3>
                        <p class="text-gray-700">
                            <a href="tel:0332393031" class="hover:text-red-600">0332 393 031</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <img src="https://aothunxuxu.com/style/images/shop%20ao%20thun%20xuxu-2-min.jpg" alt="Cơ sở chính"
                    class="max-w-full lg:max-w-[800px] rounded-lg shadow-lg cursor-pointer hover:opacity-90 transition-opacity
                    storeImage">
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-5 mt-10">Chi nhánh</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 md:col-span-1 space-y-4">
                <div class="flex items-start gap-4 rounded-lg p-4 bg-[#f9f9f9] shadow-md">
                    <div class="flex-shrink-0">
                        <div class="bg-red-600 rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-white text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">Địa chỉ:</h3>
                        <p class="text-gray-700">NHÀ MAY TỊNH YÊN": Cù Lâm, Nhơn Lộc, TX An Nhơn, tỉnh Bình Định</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 rounded-lg p-4 bg-[#f9f9f9] shadow-md">
                    <div class="flex-shrink-0">
                        <div class="bg-red-600 rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fa-solid fa-phone text-white text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">Hotline:</h3>
                        <p class="text-gray-700">076 771 0030</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 md:col-span-1">
                <div class="h-full">
                    <img src="https://aothunxuxu.com/style/images/shop%20ao%20thun%20xuxu-binh-dinh-min.jpg"
                        alt="Chi nhánh Bình Định"
                        class="w-full h-full object-cover rounded-lg shadow-md cursor-pointer hover:opacity-90 transition-opacity
                    storeImage">
                </div>
            </div>
        </div>
    </div>
    <div id="imageLightbox" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl w-full">
            <button class="absolute -top-10 right-0 text-white hover:text-red-500 text-3xl">
                <i class="fa-solid fa-times"></i>
            </button>

            <img src="" alt="" class="w-full h-auto max-h-screen object-contain rounded-md">
        </div>
    </div>
@endsection
