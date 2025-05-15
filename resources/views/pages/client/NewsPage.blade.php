@extends('layouts.client.master')

@section('title', isset($category) && $category ? $category->name : 'Tin tức')

@section('breadcrumb')
    @if (isset($category) && $category)
        <x-breadcrumb :items="[['label' => 'Tin tức', 'url' => route('news.category')]]" :currentPage="$category->name" />
    @else
        <x-breadcrumb :currentPage="'Tin tức'" />
    @endif
@endsection

@section('content')
    <div class="responsive flex flex-col gap-4">

        <nav class="w-full mt-4 overflow-auto">
            <ul class="flex gap-2 sm:gap-4 text-textColor relative border-gray-300">
                <li>
                    <a href="{{ route('news.category', 'tin-tong-hop') }}"
                        class="border-b-[3px] border-[transparent] block p-2 text-[15px] sm:text-[17px] relative text-nowrap
                        {{ url()->current() === route('news.category', 'tin-tong-hop')
                            ? 'text-orangeColor border-[var(--orange-color)]'
                            : '' }}">
                        Tin tổng hợp
                    </a>
                </li>
                @foreach ($newsCategories as $item)
                    <li>
                        <a href="{{ route('news.category', $item->slug) }}"
                            class="border-b-[3px] border-[transparent] block p-2 text-[15px] sm:text-[17px] relative text-nowrap
                            {{ url()->current() === route('news.category', $item->slug)
                                ? 'text-orangeColor border-[var(--orange-color)]'
                                : '' }}">
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        @isset($newsList)
            @if ($newsList->isNotEmpty())
                {{-- Danh sách tin tức --}}
                <div class="grid gap-5 lg:grid-cols-2 grid-cols-1">
                    @foreach ($newsList as $news)
                        <div class="flex flex-col-reverse sm:flex-row gap-4 overflow-hidden pb-[20px] border-b-[1px]">
                            <a href="{{ route('news.detail', $news->slug) }}" title="{{ $news->title }}"
                                class="block overflow-hidden h-[250px] w-[200px]">
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            </a>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 mb-3 text-xs text-gray-500">
                                        <span class="inline-block px-3 py-1 font-medium rounded-xl bg-gray-200 text-gray-800">
                                            {{ $news->category?->name ?? 'Không có danh mục' }}
                                        </span>
                                        <div class="flex items-center">
                                            <span class="material-symbols-rounded">
                                                calendar_month
                                            </span>
                                            <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('news.detail', $news->slug) }}" class="block group">
                                        <h3
                                            class="text-lg font-bold mb-3 group-hover:text-[var(--orange-color)] transition-colors duration-300">
                                            {!! Str::limit($news->title, 70) !!}
                                        </h3>
                                    </a>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        {!! Str::limit($news->excerpt, 120, '...') !!}
                                        <a href="{{ route('news.detail', $news->slug) }}"
                                            class="block text-[var(--orange-color)] font-medium">
                                            <span class="hover:underline">Xem thêm</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $newsList->appends(request()->query())->links('vendor.pagination.tailwind') }}
            @endif
        @endisset
    </div>
@endsection
