@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa thông tin người dùng')
@section('nav-active', 'user')

@php 
    $breadCrump = [
        ['name' => 'Quản lý người dùng', 'href' => route('admin.user')],
        ['name' => 'Chỉnh sửa thông tin người dùng', 'href' => Request::url()]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        @method('PUT')

        {{-- Fullname + Username --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block">Họ tên</label>
                <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Tên đăng nhập</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        {{-- Email + Phone --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
    
        {{-- Role --}}
        <div>
            <label class="block">Vai trò</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                <option value="STAFF" {{ $user->role === 'STAFF' ? 'selected' : '' }}>STAFF</option>
            </select>
        </div>

        {{-- Description --}}
        <div>
            <label class="block">Mô tả</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $user->description) }}</textarea>
        </div>

        {{-- Active --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="active" {{ $user->active ? 'checked' : '' }} class="w-4 h-4">
            <label>Hoạt động</label>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">Cập nhật</button>
        </div>
    </form>
</div>
@endsection