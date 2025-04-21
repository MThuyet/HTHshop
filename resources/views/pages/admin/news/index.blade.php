@extends('layouts.admin.master')
@section('title', 'Quản lý tin tức')
@section('nav-active', 'news')

@php $breadCrump = [['name' => 'Quản lý tin tức', 'href' => route('dashboard.news')]]; @endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    {{-- Anchor ProCat & Search & Btn Create --}}
    <form method="GET" action="{{ route('dashboard.news') }}" class="flex flex-col md:flex-row items-center justify-between mb-4 gap-3">
        <a href="{{ route('dashboard.news-category') }}"
            class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
            Danh mục tin tức
        </a>
        <div class="w-full md:w-1/2">
            <div class="relative z-40">
                <div class="mb-0 text-md">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Tìm kiếm tin tức..."
                        class="w-full border border-gray-300 rounded-lg py-1.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <span class="material-symbols-rounded absolute left-3 top-2 text-gray-400">
                        search
                    </span>
                    <button type="submit" class="text-white absolute end-2.5 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm kiếm</button>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <div class="flex gap-2 mb-0 items-center">
                <label for="table-row-length" class="text-sm font-medium text-gray-700 mr-2">Hiển thị:</label>
                <select name="limit-row-length" id="table-row-length" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Dòng</option>
                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 Dòng</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 Dòng</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Dòng</option>
                </select>
            </div>

            <a href="{{ route('dashboard.news.create') }}"
               class="inline-block px-4 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow">
                + Thêm tin tức mới
            </a>
        </div>
    </form>

    <div class="overflow-auto h-full border-t-2 border-gray-200">
        {{-- Table --}}
        <table class="min-w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Tin tức</th>
                    <th scope="col" class="px-6 py-3 hidden sm:table-cell">Lượt xem</th>
                    <th scope="col" class="px-6 py-3 hidden md:table-cell">Danh mục</th>
                    <th scope="col" class="px-6 py-3 hidden sm:table-cell">Trạng thái</th>
                    <th scope="col" class="px-6 py-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-2 md:px-6 py-1 md:py-2 font-medium text-gray-900">
                            <a href="{{ route('dashboard.news.show', $item->id) }}" class="material-symbols-rounded inline-flex rounded-md font-medium text-blue-500 border p-1 hover:underline">
                                info
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" class="w-20 h-20 object-cover rounded hidden lg:block">
                                @else
                                    <span class="text-gray-400">Không có ảnh</span>
                                @endif
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-0">{{ $item->title }}</h3>
                                    <span class="text-gray-400 text-sm">{{ $item->created_at->format('d/m/Y H:i:s') }}</span>
                                    <p class="text-sm text-gray-500 hidden md:block">{{ Str::limit($item->excerpt, 75) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell">{{ $item->watch }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">{{ $item->category->name ?? 'Không xác định' }}</td>
                        <td class="px-6 py-2 hidden sm:table-cell">
                            <form action="{{ route('dashboard.news.toggle', $item->id) }}" method="POST" class="mb-0">
                                @csrf
                                @method('PUT')
                                <button type="submit">
                                    <span style="font-size: 32px;" class="material-symbols-rounded {{ $item->active ? 'text-green-600' : 'text-gray-600' }}">
                                        {{ $item->active ? 'toggle_on' : 'toggle_off' }}
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-start">
                                <a href="{{ route('dashboard.news.edit', $item->id) }}" class="inline-flex rounded-md font-medium text-yellow-500 border border-1 p-1 hover:underline mx-2">
                                    <span class="material-symbols-rounded">edit_square</span>
                                </a>
                                <button class="inline-flex rounded-md font-medium text-red-500 border p-1 hover:underline btn-open-modal-confirm-delete" data-id="{{ $item->id }}">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
            <span class="text-sm text-gray-500">
                Hiển thị {{ $news->firstItem() }}-{{ $news->lastItem() }}/{{ $news->total() }} dòng
            </span>
            <div class="flex items-center gap-1">
                @if ($news->lastPage() > 1)
                    {{
                        $news->appends(['limit-row-length' => $perPage, 'search' => request('search')])
                        ->links('vendor.pagination.tailwind')
                    }}
                @else
                    <span class="text-gray-400 text-sm">Chỉ có 1 trang</span>
                @endif
            </div>
        </div>
    </div>
</div>
<div id="modal-confirm-delete" class="fixed inset-0 z-[1000] hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 absolute top-1/4 left-1/2
    -translate-x-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-title">

      <div class="flex items-center">
        <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75M12 15.75h.007v.008H12v-.008zm-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126Z" />
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-gray-900" id="modal-title">Xóa danh mục tin tức</h3>
            <p class="text-sm text-gray-500 mt-1">Bạn có chắc muốn xóa tin tức
                <span class="font-bold" id="delete-news"></span>
                này không?
            </p>
        </div>
      </div>

      <!-- Buttons -->
      <div class="mt-6 flex justify-end gap-3">
            <button id="btn-cancel-modal-confirm-delete"
                class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded">
                Hủy
            </button>
            <form id="delete-news-form" method="POST" class="mb-0">
                @csrf
                @method('DELETE')
                <button id="btn-confirm-delete" type="submit"
                    class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded">Xác nhận</button>
            </form>
      </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal-confirm-delete');
        const btnOpen = document.querySelectorAll('.btn-open-modal-confirm-delete');
        const btnCancel = document.getElementById('btn-cancel-modal-confirm-delete');
        const form = document.getElementById('delete-news-form');

        const openModal = (e) => {
            const newsId = e.dataset.id;

            const currentRow = e.closest('tr');
            const fullname = currentRow.querySelector('td:nth-child(2) h3').textContent;

            document.getElementById('delete-news').textContent = fullname;

            // Set form action
            form.action = `/dashboard/news/${newsId}`;

            modal.classList.remove('hidden');
        };

        const closeModal = () => {
            document.getElementById('delete-news').textContent = '';
            form.action = `/dashboard/news`;
            modal.classList.add('hidden');
        };

        btnOpen.forEach(button => {
            button.addEventListener('click', () => openModal(button));
        });

        btnCancel.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    });
</script>
