@extends('layouts.admin.master')
@section('title', 'Tạo danh mục tin tức mới')
@section('nav-active', 'news')

@php 
    $breadCrump = [
        ['name' => 'Quản lý tin tức', 'href' => route('dashboard.news')],
        ['name' => 'Quản lý danh mục tin tức', 'href' => route('dashboard.news-category')],
        ['name' => 'Tạo danh mục tin tức mới', 'href' => route('dashboard.news-category.create')]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('dashboard.news-category.store') }}" method="POST" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        
        {{-- Tên danh mục tin tức --}}
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700">Tên danh mục tin tức</label>
            <input type="text" name="name" id="name" maxlength="100" value="{{ old('name') }}"
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nhập tên danh mục tin tức" required>
        </div>
    
        {{-- Mô tả --}}
        <div>
            <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
            <textarea name="description" id="description" rows="3" placeholder="Nhập mô tả"
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>
    
        {{-- Trạng thái --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="active" id="active" class="w-4 h-4" {{ old('active', true) ? 'checked' : '' }}>
            <label for="active" class="text-sm text-gray-700">Hiển thị</label>
        </div>
    
        {{-- Submit --}}
        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                Tạo danh mục
            </button>
        </div>
    </form>
</div>
@endsection