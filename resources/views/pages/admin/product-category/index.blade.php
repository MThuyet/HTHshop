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
            <div class="relative z-40">
                <form id="searchForm" method="GET" action="{{ route('admin.product-category') }}" class="mb-0 text-md">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Tìm kiếm người dùng..."
                        class="w-full border border-gray-300 rounded-lg py-1.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <span class="material-symbols-rounded absolute left-3 top-2 text-gray-400">
                        search
                    </span>
                    <button type="submit" class="text-white absolute end-2.5 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm kiếm</button>
                </form>
            </div>
        </div>



        <div class="flex flex-wrap gap-4">
            <form method="GET" action="{{ route('admin.product-category') }}" class="flex gap-2 mb-0 items-center">
                <label for="table-row-length" class="text-sm font-medium text-gray-700 mr-2">Hiển thị:</label>
                <select name="limit-row-length" id="table-row-length" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Dòng</option>
                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 Dòng</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 Dòng</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Dòng</option>
                </select>
            </form>

            <a href="{{ route('admin.product-category.create') }}"
               class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
               + Thêm danh mục mới
            </a>
        </div>
    </div>
    <div class="overflow-x-auto mb-3">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-semibold">
                    <tr>
                        <th class="px-6 py-3">Chi tiết</th>
                        <th class="px-5 py-3">Tên danh mục</th>
                        <th class="px-5 py-3">Mô tả</th>
                        <th class="px-5 py-3">Trạng thái</th>
                        <th class="px-5 py-3">Ngày tạo</th>
                        <th class="px-5 py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productCategory as $category)
                        <tr class="bg-white border-b hover:bg-gray-50 transition duration-200">
                            <td class="px-2 md:px-6 py-1 md:py-2 font-medium text-gray-900">
                                <a href="{{ route('admin.product-category.show', $category->id) }}" class="material-symbols-rounded inline-flex rounded-md font-medium text-blue-500 border p-1 hover:underline">
                                    info
                                </a>
                            </td>
                            <td class="px-5 py-4 font-semibold text-gray-900">{{ $category->name }}</td>
                            <td class="px-5 py-4 text-gray-500 max-w-[250px] truncate">
                                {{ $category->description ?? '—' }}
                            </td>
                            <td class="px-6 py-2 hidden lg:table-cell">
                                <form action="{{ route('admin.product-category.toggle', $category->id) }}" method="POST" class="mb-0">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">
                                        <span style="font-size: 32px;" class="material-symbols-rounded {{ $category->active ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $category->active ? 'toggle_on' : 'toggle_off' }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-500">
                                {{ $category->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('admin.product-category.edit', $category->id) }}"
                                   class="inline-flex rounded-md font-medium text-yellow-500 border p-1 hover:underline mr-2">
                                   <span class="material-symbols-rounded">edit_square</span>
                                </a>
                                <form action="{{ route('admin.product-category.delete', $category->id) }}"
                                      method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex rounded-md font-medium text-red-500 border p-1 hover:underline btn-open-modal-confirm-delete">

                                        <span class="material-symbols-rounded">delete</span>
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        <div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
            <span class="text-sm text-gray-500">
                Hiển thị {{ $productCategory->firstItem() }}-{{ $productCategory->lastItem() }}/{{ $productCategory->total() }} dòng
            </span>
            <div class="flex items-center gap-1">

                {{-- First Page --}}
                <a href="{{ $productCategory->currentPage() > 1 ? $productCategory->url(1) . '&limit-row-length=' . $perPage . '&search=' . request('search') : '#' }}"
                    class="flex items-center justify-center border px-1 py-1 rounded-md hover:border-[#333] {{ $productCategory->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                    <span class="material-symbols-rounded">first_page</span>
                </a>

                {{-- Previous Page --}}
                <a href="{{ $productCategory->previousPageUrl() ? $productCategory->previousPageUrl() . '&limit-row-length=' . $perPage . '&search=' . request('search') : '#' }}"
                    class="flex items-center justify-center border px-1 spy-1 rounded-md hover:border-[#333] {{ !$productCategory->previousPageUrl() ? 'opacity-50 pointer-events-none' : '' }}">
                    <span class="material-symbols-rounded">chevron_left</span>
                </a>

                {{-- Page Numbers --}}
                @if ($productCategory->lastPage() > 1)
                    {{ $productCategory->appends(['limit-row-length' => $perPage, 'search' => request('search')])->links() }}
                @else
                    <span class="text-gray-400 text-sm">Chỉ có 1 trang</span>
                @endif

                {{-- Next Page --}}
                <a href="{{ $productCategory->nextPageUrl() ? $productCategory->nextPageUrl() . '&limit-row-length=' . $perPage . '&search=' . request('search') : '#' }}"
                    class="flex items-center justify-center border px-1 py-1 rounded-md hover:border-[#333] {{ !$productCategory->nextPageUrl() ? 'opacity-50 pointer-events-none' : '' }}">
                    <span class="material-symbols-rounded">chevron_right</span>
                </a>

                {{-- Last Page --}}
                <a href="{{ $productCategory->currentPage() < $productCategory->lastPage() ? $productCategory->url($productCategory->lastPage()) . '&limit-row-length=' . $perPage . '&search=' . request('search') : '#' }}"
                    class="flex items-center justify-center border px-1 py-1 rounded-md hover:border-[#333]
                    {{ $productCategory->currentPage() == $productCategory->lastPage() ? 'opacity-50 pointer-events-none' : '' }}">
                    <span class="material-symbols-rounded">last_page</span>
                </a>
            </div>
        </div>

    </div>
</p>
@endsection
