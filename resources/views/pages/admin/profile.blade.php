@extends('layouts.admin.master')
@vite('resources/js/Profile.js')

@section('title', 'Thông Tin Cá Nhân')

@section('content')
<div class="py-12 bg-gray-50">
    <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        @csrf
        @method('PUT')
        <div class="relative bg-white shadow-lg rounded-lg">
            <!-- Header -->
            <div class="absolute -top-6 right-[50%] translate-x-[50%] flex items-center gap-2">
                <img class="w-14 h-14 rounded-full" id="avatar-image"
                    src="{{ Auth::user()->avatar 
                        ? asset('storage/' . Auth::user()->avatar) 
                        : asset('images/avatar-temp.webp') }}"
                    alt="{{ Auth::user()->fullname }}">

                <label class="cursor-pointer text-nowrap rounded-md bg-white px-2.5 py-1.5 text-sm font-medium text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    Thay đổi ảnh đại diện
                    <input type="file" class="hidden" name="avatar" accept="image/*">
                </label>
            </div>
            <div class="text-center px-6 py-4">
                <h2 class="text-xl font-bold mt-8">Thông tin cá nhân</h2>
            </div>

            <div class="py-3 px-6">
                
                <div class="space-y-6">
                    <!-- Fullname -->
                    <div>
                        <label for="fullname" class="font-bold block text-sm text-gray-700">
                            Họ tên
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 -top-1 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-rounded">
                                    badge
                                </span>
                            </div>
                            <input type="text" name="fullname" id="fullname" value="{{ Auth::user()->fullname }}" required
                                placeholder="Nhập họ và tên"
                                class="border p-3 pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="font-bold block text-sm text-gray-700">
                            Tên tài khoản
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-rounded">
                                    person
                                </span>
                            </div>
                            <input type="text" name="username" id="username" value="{{ Auth::user()->username }}" readonly
                                class="border p-3 pl-10 bg-gray-200 block w-full sm:text-sm border-gray-300 rounded-md cursor-not-allowed">
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="toggleChangePwd" class="h-4 w-4 cursor-pointer" type="checkbox">
                        <label for="toggleChangePwd" class="cursor-pointer">Thay đổi mật khẩu</label>
                    </div>

                    <!-- Old Password -->
                    <div class="hidden" id="oldPassword">
                        <label for="oldPassword" class="font-bold block text-sm text-gray-700">
                            Mật khẩu cũ
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-rounded">
                                    lock_clock
                                </span>
                            </div>
                            <input type="password" name="oldPassword" 
                                placeholder="Nhập mật khẩu cũ"
                                class="border p-3 pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="hidden" id="newPassword">
                        <label for="newPassword" class="font-bold block text-sm text-gray-700">
                            Mật khẩu mới
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-rounded">
                                    lock
                                </span>
                            </div>
                            <input type="password" name="newPassword" 
                                placeholder="Nhập mật khẩu mới" 
                                class="border p-3 pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="font-bold block text-sm text-gray-700">
                            Vai trò
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-rounded">
                                    {{ 
                                        Auth::user()->role === 'ADMIN' 
                                        ? 'admin_panel_settings'
                                        : 'person_apron' 
                                    }}
                                </span>
                            </div>
                            <input type="text" name="role" id="role" value="{{ Auth::user()->role }}" readonly
                                    class="border p-3 pl-10 bg-gray-200 block w-full sm:text-sm border-gray-300 rounded-md cursor-not-allowed">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Vai trò không thể thay đổi</p>
                    </div>

                    <!-- TimeStamp Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-500">Ngày tạo</span>
                            <span class="text-sm text-gray-700">{{ Auth::user()->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-500">Lần cuối cập nhật</span>
                            <span class="text-sm text-gray-700">{{ Auth::user()->updated_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" onclick="window.history.back()" 
                            class="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Hủy
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection