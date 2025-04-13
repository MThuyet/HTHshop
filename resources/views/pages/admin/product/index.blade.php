@extends('layouts.admin.master')
@section('title', 'Quản lý sản phẩm')
@section('nav-active', 'product')

@php $breadCrump = [['name' => 'Quản lý sản phẩm', 'href' => route('admin.product')]]; @endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    {{-- Anchor ProCat & Search & Btn Create --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-4 gap-3">
        <a href="{{ route('admin.product-category') }}"
            class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
            Danh mục sản phẩm
        </a>
        <div class="w-full md:w-1/2">
            <div class="relative z-40">
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
    
            <a href="{{ route('admin.product.create') }}"
               class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                + Thêm sản phẩm mới
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto h-full">
        {{-- Table --}}
        <table class="min-w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">Sản phẩm</th>
                    <th scope="col" class="px-6 py-3">Giá</th>
                    <th scope="col" class="px-6 py-3">Số lượng</th>
                    <th scope="col" class="px-6 py-3">Trạng thái</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">Nike Air Max</td>
                    <td class="px-6 py-4">2,500,000₫</td>
                    <td class="px-6 py-4">12</td>
                    <td class="px-6 py-4 text-green-600">Còn hàng</td>
                    <td class="px-6 py-4">
                        <a href="#" class="inline-flex rounded-md font-medium text-yellow-500 border border-1 p-1 
                        hover:underline mx-2">
                            <span class="material-symbols-rounded">
                                edit_square
                            </span>
                        </a>
                        <a href="#" class="inline-flex rounded-md font-medium text-red-500 border border-1 p-1 
                        hover:underline mx-2">
                            <span class="material-symbols-rounded">
                                delete
                            </span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
            <span class="text-sm text-gray-500">Hiển thị 1-5/200 dòng</span>
            <div class="flex items-center gap-1">
                <a href="" class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                    <span class="material-symbols-rounded">
                        first_page
                    </span>
                </a>
                <a href="" class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                    <span class="material-symbols-rounded">
                        chevron_left
                    </span>
                </a>
                <a href="" class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333] border-[#333]">1</a>
                <a href="" class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333]">2</a>
                <a href="" class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333]">3</a>
                <a href="" class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333]">...</a>
                <a href="" class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333]">25</a>
                <a href="" class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                    <span class="material-symbols-rounded">
                        chevron_right
                    </span>
                </a>
                <a href="" class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                    <span class="material-symbols-rounded">
                        last_page
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection