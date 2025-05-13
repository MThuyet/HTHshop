@extends('layouts.admin.master')
@section('title', 'Quản lý sản phẩm')
@section('nav-active', 'product')

@php $breadCrump = [['name' => 'Quản lý sản phẩm', 'href' => route('admin.products')]]; @endphp

@section('content')
    <style>
        .product-image-fixed {
            width: 100px !important;
            height: 100px !important;
            object-fit: cover !important;
            border-radius: 0.375rem !important;
            min-width: 100px !important;
            max-width: 100px !important;
            min-height: 100px !important;
            max-height: 100px !important;
            flex-shrink: 0 !important;
        }

        .product-placeholder-fixed {
            width: 100px !important;
            height: 100px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #e5e7eb !important;
            border-radius: 0.375rem !important;
            min-width: 100px !important;
            max-width: 100px !important;
            min-height: 100px !important;
            max-height: 100px !important;
            flex-shrink: 0 !important;
        }

        .table-row {
            height: 140px !important;
            min-height: 140px !important;
        }

        .table-cell {
            padding-top: 16px !important;
            padding-bottom: 16px !important;
            vertical-align: middle !important;
        }

        .image-cell {
            width: 132px !important;
            min-width: 132px !important;
            max-width: 132px !important;
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        @media (max-width: 768px) {
            .responsive-table {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch !important;
            }

            .responsive-table table {
                min-width: 900px;
                table-layout: fixed !important;
            }

            .product-image-fixed,
            .product-placeholder-fixed {
                transform: scale(1) !important;
            }
        }
    </style>

    <div class="bg-white p-3 border border-1 rounded-md">
        {{-- Anchor ProCat & Search & Btn Create --}}
        <form action="{{ route('admin.products') }}" method="GET"
            class="flex flex-col lg:flex-row items-center justify-between mb-4 gap-3">
            <a href="{{ route('admin.product-categories') }}"
                class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                Danh mục sản phẩm
            </a>
            <div class="w-full lg:w-1/2">
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

            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 w-full lg:w-auto">
                <select name="limit-row-length" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Dòng</option>
                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 Dòng</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 Dòng</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Dòng</option>
                </select>

                <a href="{{ route('admin.products.create') }}"
                    class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                    + Thêm sản phẩm mới
                </a>
            </div>
        </form>

        <!-- Additional filters -->
        <div class="mb-4 p-3 bg-gray-50 border rounded-md">
            <h3 class="text-blue-700 font-medium mb-3">Bộ lọc nâng cao</h3>
            <form action="{{ route('admin.products') }}" method="GET" class="flex flex-col space-y-3">
                <!-- Keep existing search parameters -->
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if (request('limit-row-length'))
                    <input type="hidden" name="limit-row-length" value="{{ request('limit-row-length') }}">
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Category filter -->
                    <div>
                        <label for="category_filter" class="block text-sm font-medium text-gray-700 mb-1">Danh mục sản
                            phẩm</label>
                        <select id="category_filter" name="category_id"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="">Tất cả danh mục</option>
                            @foreach (\App\Models\ProductCategory::where('active', true)->get() as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type filter -->
                    <div>
                        <label for="type_filter" class="block text-sm font-medium text-gray-700 mb-1">Loại sản phẩm</label>
                        <select id="type_filter" name="type"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="">Tất cả loại</option>
                            <option value="ROUND_NECK" {{ request('type') == 'ROUND_NECK' ? 'selected' : '' }}>Cổ tròn
                            </option>
                            <option value="COLLAR_NECK" {{ request('type') == 'COLLAR_NECK' ? 'selected' : '' }}>Cổ trụ
                            </option>
                        </select>
                    </div>

                    <!-- Customization filter -->
                    <div>
                        <label for="customization_filter" class="block text-sm font-medium text-gray-700 mb-1">Tùy
                            chỉnh</label>
                        <select id="customization_filter" name="has_customization"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="">Tất cả</option>
                            <option value="1" {{ request('has_customization') == '1' ? 'selected' : '' }}>Có tùy chỉnh
                            </option>
                            <option value="0" {{ request('has_customization') == '0' ? 'selected' : '' }}>Không tùy
                                chỉnh</option>
                        </select>
                    </div>

                    <!-- Status filter (replacing active_only checkbox) -->
                    <div>
                        <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                        <select id="status_filter" name="active_status"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1"
                                {{ request('active_status') == '1' || (isset($showOnlyActive) && $showOnlyActive) ? 'selected' : '' }}>
                                Đang hoạt động</option>
                            <option value="0" {{ request('active_status') == '0' ? 'selected' : '' }}>Không hoạt động
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                        <span class="material-symbols-rounded text-sm sm:mr-1">filter_alt</span>
                        <span class="hidden sm:inline">Lọc sản phẩm</span>
                    </button>
                    <a href="{{ route('admin.products') }}"
                        class="ml-2 inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300">
                        <span class="material-symbols-rounded text-sm sm:mr-1">restart_alt</span>
                        <span class="hidden sm:inline">Xóa bộ lọc</span>
                    </a>
                </div>
            </form>
        </div>

        <div class="responsive-table">
            {{-- Table --}}
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th scope="col" class="px-3 py-3 sm:px-6">#</th>
                        <th scope="col" class="px-3 py-3 sm:px-6 image-cell">Ảnh</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Sản phẩm</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Loại</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Tùy chỉnh</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Giá</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Danh mục</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Trạng thái</th>
                        <th scope="col" class="px-3 py-3 sm:px-6">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr class="bg-white border-b hover:bg-gray-50 table-row">
                            <td class="px-3 py-4 sm:px-6 table-cell font-medium text-gray-900">
                                <a href="{{ route('admin.products.show', $item->id) }}"
                                    class="material-symbols-rounded inline-flex rounded-md font-medium text-blue-500 border p-1 hover:underline">
                                    info
                                </a>
                            </td>
                            <td class="table-cell font-medium text-gray-900 image-cell">
                                @if ($item->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $item->images->first()->image) }}"
                                        alt="{{ $item->name }}" class="product-image-fixed">
                                @else
                                    <div class="product-placeholder-fixed">
                                        <span class="material-symbols-rounded text-gray-400">image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-4 sm:px-6 table-cell max-w-[200px] truncate">{{ $item->name }}</td>
                            <td class="px-3 py-4 sm:px-6 table-cell">
                                {{ $item->type === 'ROUND_NECK' ? 'Cổ tròn' : 'Cổ trụ' }}</td>
                            <td class="px-3 py-4 sm:px-6 table-cell">
                                <form action="{{ route('admin.products.toggle-customization', $item->id) }}"
                                    method="POST">
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
                            <td class="px-3 py-4 sm:px-6 table-cell">
                                @if ($item->variants->isNotEmpty())
                                    {{ number_format($item->variants->first()->price) }}đ
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-4 sm:px-6 table-cell">{{ $item->category->name }}</td>
                            <td class="px-3 py-4 sm:px-6 table-cell">
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
                            <td class="px-3 py-4 sm:px-6 table-cell whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.products.edit', $item->id) }}"
                                        class="inline-flex rounded-md font-medium text-yellow-500 border p-1 hover:underline">
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
                            <td colspan="9" class="px-3 py-4 sm:px-6 text-center text-gray-500">
                                Không tìm thấy sản phẩm nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="mt-4">
                <x-pagination :paginator="$products" />
            </div>
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
