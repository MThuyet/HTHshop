@extends('layouts.admin.master')
@section('title', 'Quản lý sản phẩm')
@section('nav-active', 'product')

@php $breadCrump = [['name' => 'Quản lý sản phẩm', 'href' => route('admin.products')]]; @endphp

@section('content')
    <div class="bg-white p-2 border border-1 rounded-md">
        {{-- Anchor ProCat & Search & Btn Create --}}
        <form action="{{ route('admin.products') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between mb-4 gap-3">
            <a href="{{ route('admin.product-categories') }}"
                class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                Danh mục sản phẩm
            </a>
            <div class="w-full md:w-1/2">
                <div class="relative z-40">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..."
                        class="w-full border border-gray-300 rounded-lg py-1.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="material-symbols-rounded absolute left-3 top-2 text-gray-400">
                        search
                    </span>
                    <button type="submit"
                        class="text-white absolute end-2.5 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tìm kiếm
                    </button>
                </div>
            </div>

            <div class="flex gap-4">
                <select name="table-row-length" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Dòng</option>
                    <option value="15" {{ request('per_page', 10) == 15 ? 'selected' : '' }}>15 Dòng</option>
                    <option value="20" {{ request('per_page', 10) == 20 ? 'selected' : '' }}>20 Dòng</option>
                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 Dòng</option>
                </select>

                <a href="{{ route('admin.products.create') }}"
                    class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                    + Thêm sản phẩm mới
                </a>
            </div>
        </form>

        <div class="overflow-x-auto h-full">
            {{-- Table --}}
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">Ảnh</th>
                        <th scope="col" class="px-6 py-3">Sản phẩm</th>
                        <th scope="col" class="px-6 py-3">Loại</th>
                        <th scope="col" class="px-6 py-3">Tùy chỉnh</th>
                        <th scope="col" class="px-6 py-3">Giá</th>
                        <th scope="col" class="px-6 py-3">Danh mục</th>
                        <th scope="col" class="px-6 py-3">Trạng thái</th>
                        <th scope="col" class="px-6 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-2 md:px-6 py-1 md:py-2 font-medium text-gray-900">
                                <a href="{{ route('admin.products.show', $item->id) }}"
                                    class="material-symbols-rounded inline-flex rounded-md font-medium text-blue-500 border p-1 hover:underline">
                                    info
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                @if ($item->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $item->images->first()->image) }}"
                                        alt="{{ $item->name }}" class="w-20 h-20 object-cover rounded hidden lg:block">
                                @else
                                    <div
                                        class="w-20 h-20 bg-gray-200 rounded hidden lg:block flex items-center justify-center">
                                        <span class="material-symbols-rounded text-gray-400">image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ $item->type === 'ROUND_NECK' ? 'Cổ tròn' : 'Cổ trụ' }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.products.toggle-customization', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">
                                        <span style="font-size: 32px;"
                                            class="material-symbols-rounded {{ $item->has_customization ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $item->has_customization ? 'toggle_on' : 'toggle_off' }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->variants->isNotEmpty())
                                    {{ number_format($item->variants->first()->price) }}đ
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $item->category->name }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.products.toggle', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <button type="submit">
                                        <span style="font-size: 32px;"
                                            class="material-symbols-rounded {{ $item->active ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $item->active ? 'toggle_on' : 'toggle_off' }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $item->id) }}"
                                        class="inline-flex rounded-md font-medium text-yellow-500 border p-1 hover:underline mr-2">
                                        <span class="material-symbols-rounded">edit_square</span>
                                    </a>
                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="inline-flex rounded-md font-medium text-red-500 border p-1 hover:underline btn-open-modal-confirm-delete">
                                        <span class="material-symbols-rounded">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Không tìm thấy sản phẩm nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
                    <span class="text-sm text-gray-500">
                        Hiển thị
                        {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}/{{ $products->total() }} dòng
                    </span>
                    <div class="flex items-center gap-1">
                        @if ($products->onFirstPage())
                            <span
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md text-gray-400">
                                <span class="material-symbols-rounded">first_page</span>
                            </span>
                            <span
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md text-gray-400">
                                <span class="material-symbols-rounded">chevron_left</span>
                            </span>
                        @else
                            <a href="{{ $products->url(1) }}"
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                                <span class="material-symbols-rounded">first_page</span>
                            </a>
                            <a href="{{ $products->previousPageUrl() }}"
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                                <span class="material-symbols-rounded">chevron_left</span>
                            </a>
                        @endif

                        @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                            <a href="{{ $url }}"
                                class="flex items-center justify-center border border-1 px-3 py-1 rounded-md {{ $page == $products->currentPage() ? 'border-[#333]' : 'hover:border-[#333]' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($products->currentPage() < $products->lastPage() - 2)
                            <span class="flex items-center justify-center border border-1 px-3 py-1 rounded-md">...</span>
                            <a href="{{ $products->url($products->lastPage()) }}"
                                class="flex items-center justify-center border border-1 px-3 py-1 rounded-md hover:border-[#333]">
                                {{ $products->lastPage() }}
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                                <span class="material-symbols-rounded">chevron_right</span>
                            </a>
                            <a href="{{ $products->url($products->lastPage()) }}"
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md hover:border-[#333]">
                                <span class="material-symbols-rounded">last_page</span>
                            </a>
                        @else
                            <span
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md text-gray-400">
                                <span class="material-symbols-rounded">chevron_right</span>
                            </span>
                            <span
                                class="flex items-center justify-center border border-1 px-1 py-1 rounded-md text-gray-400">
                                <span class="material-symbols-rounded">last_page</span>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <span class="material-symbols-rounded text-red-600">delete</span>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Xác nhận xóa</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Bạn có chắc chắn muốn xóa sản phẩm này? Sản phẩm sẽ được chuyển vào
                        thùng rác.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Xóa
                        </button>
                        <button type="button" onclick="closeModal()"
                            class="ml-3 px-4 py-2 bg-gray-200 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Hủy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: "Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/products/${productId}`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endpush
