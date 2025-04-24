@extends('layouts.admin.master')
@section('title', 'Tạo sản phẩm mới')
@section('nav-active', 'product')
@php
    $breadCrump = [
        ['name' => 'Quản lý sản phẩm', 'href' => route('admin.products')],
        ['name' => 'Tạo sản phẩm mới', 'href' => route('admin.products.create')],
    ];
@endphp

@section('content')
    <div class="bg-white p-4 border border-1 rounded-md">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
            onsubmit="return true;">
            @csrf
            {{-- Thông tin cơ bản --}}
            <div>
                <h2 class="text-xl font-semibold mb-4">Thông tin cơ bản</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Tên sản phẩm --}}
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700">Tên sản phẩm <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập tên sản phẩm" required maxlength="100">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Danh mục --}}
                    <div>
                        <label for="product_category_id" class="block text-sm font-bold text-gray-700">Danh mục <span
                                class="text-red-500">*</span></label>
                        <select name="product_category_id" id="product_category_id"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Loại áo --}}
                    <div>
                        <label for="type" class="block text-sm font-bold text-gray-700">Loại áo <span
                                class="text-red-500">*</span></label>
                        <select name="type" id="type"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="ROUND_NECK" {{ old('type') == 'ROUND_NECK' ? 'selected' : '' }}>Cổ tròn</option>
                            <option value="COLLAR_NECK" {{ old('type') == 'COLLAR_NECK' ? 'selected' : '' }}>Cổ trụ</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Giảm giá --}}
                    <div>
                        <label for="discount" class="block text-sm font-bold text-gray-700">Giảm giá (%)</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', 0) }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập phần trăm giảm giá" min="0" max="100">
                        @error('discount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tùy chỉnh --}}
                    <div class="flex items-center">
                        <input type="checkbox" name="has_customization" id="has_customization" value="1"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            {{ old('has_customization') ? 'checked' : '' }}>
                        <label for="has_customization" class="ml-2 block text-sm font-bold text-gray-700">Cho phép tùy chỉnh
                            ảnh</label>
                        @error('has_customization')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="active" value="1"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            {{ old('active', true) ? 'checked' : '' }}>
                        <label for="active" class="ml-2 block text-sm font-bold text-gray-700">Hiển thị sản phẩm</label>
                        @error('active')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Hình ảnh sản phẩm --}}
            <div>
                <h2 class="text-xl font-semibold mb-4">Hình ảnh sản phẩm</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @for ($i = 0; $i < 4; $i++)
                        <div>
                            <label for="images_{{ $i }}" class="block text-sm font-bold text-gray-700">
                                Hình ảnh {{ $i + 1 }} {!! $i === 0 ? '<span class="text-red-500">*</span>' : '' !!}
                            </label>
                            <input type="file" name="images[]" id="images_{{ $i }}"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                accept="image/*" {{ $i === 0 ? 'required' : '' }}>
                            @error('images.' . $i)
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Biến thể sản phẩm --}}
            <div>
                <h2 class="text-xl font-semibold mb-4">Biến thể sản phẩm</h2>
                <div class="space-y-4">
                    @foreach (['CENTER_CHEST_A4', 'CENTER_BACK_A4', 'BOTH_SIDES'] as $position)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">
                                    Vị trí in:
                                    @switch($position)
                                        @case('CENTER_CHEST_A4')
                                            Giữa ngực A4
                                        @break

                                        @case('CENTER_BACK_A4')
                                            Giữa lưng A4
                                        @break

                                        @case('BOTH_SIDES')
                                            Cả hai mặt
                                        @break
                                    @endswitch
                                </label>
                            </div>
                            <div>
                                <label for="price_{{ $position }}" class="block text-sm font-bold text-gray-700">Giá
                                    (đ)
                                </label>
                                <input type="number" name="variants[{{ $position }}][price]"
                                    id="price_{{ $position }}"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Nhập giá sản phẩm" min="0" required>
                                <input type="hidden" name="variants[{{ $position }}][print_position]"
                                    value="{{ $position }}">
                                @error('variants.' . $position . '.price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Nút submit --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.products') }}"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Hủy
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Tạo sản phẩm
                </button>
            </div>
        </form>
    </div>
@endsection
