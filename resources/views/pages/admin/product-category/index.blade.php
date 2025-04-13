@extends('layouts.admin.master')
@section('title', 'Quản lý danh mục sản phẩm')

@section('nav-active', 'product')
@php
    $breadCrump = [['name' => 'Quản lý danh mục sản phẩm', 'href' => route('admin.product-category')]];
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <div class="flex flex-col md:flex-row items-center justify-between mb-4 gap-3">
        <a href="{{ route('admin.product') }}"
            class="flex px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
            <span class="material-symbols-rounded">
                arrow_back
            </span>
            Quản lý sản phẩm
        </a>
        <div class="w-full md:w-1/2">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Tìm kiếm sản phẩm..."
                    class="w-full border border-gray-300 rounded-lg py-1.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <span class="material-symbols-rounded absolute left-3 top-2 text-gray-400">
                    search
                </span>
            </div>
        </div>
        <div class="flex gap-4">
            <select name="table-row-length" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="10">10 Dòng</option>
                <option value="15">15 Dòng</option>
                <option value="20">20 Dòng</option>
                <option value="25">25 Dòng</option>
            </select>
            
            <a href="{{ route('admin.product-category.create') }}"
               class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                + Thêm danh mục mới
            </a>
        </div>
    </div>
    <div class="overflow-x-auto mb-3">
        <table class="min-w-full text-sm text-left text-gray-500 border rounded shadow-sm">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Tên danh mục</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Mô tả</th>
                    <th class="px-4 py-3">Trạng thái</th>
                    <th class="px-4 py-3">Ngày tạo</th>
                    <th class="px-4 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">Danh mục {{ $i }}</td>
                        <td class="px-4 py-3 text-sm">danh-muc-{{ $i }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600 max-w-[200px] truncate">
                            Mô tả cho danh mục số {{ $i }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($i % 2 == 0)
                                <span class="text-green-600 font-semibold">Hiển thị</span>
                            @else
                                <span class="text-red-500 font-semibold">Ẩn</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::now()->subDays($i)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="#" class="text-blue-600 hover:underline mx-1">Sửa</a>
                            <button class="text-red-600 hover:underline mx-1" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</p>
@endsection