@extends('layouts.admin.master')
@section('title', 'Tạo người dùng mới')
@section('nav-active', 'product')

@php 
    $breadCrump = [
        ['name' => 'Quản lý người dùng', 'href' => route('admin.user')],
        ['name' => 'Tạo người dùng mới', 'href' => route('admin.user.create')]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('admin.user.store') }}" method="POST" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        {{-- Fullname + Username --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Họ tên</label>
                <input type="text" name="fullname" id="fullname" maxlength="50"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Tên đăng nhập</label>
                <input type="text" name="username" id="username" maxlength="20"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
        </div>
    
        {{-- Email + Phone --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" maxlength="100"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                <input type="text" name="phone" id="phone" maxlength="11"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    
        {{-- Password + Role --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" name="password" id="password"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Vai trò</label>
                <select name="role" id="role"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="ADMIN">ADMIN</option>
                    <option value="STAFF">STAFF</option>
                </select>
            </div>
        </div>
    
        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
    
        {{-- Submit --}}
        <div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                Tạo người dùng
            </button>
        </div>
    </form>
</div>
@endsection