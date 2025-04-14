@extends('layouts.client.master')
@vite(['resources/css/client/NewsPage.css', 'resources/js/client/News.js'])

@section('title', 'Tin tức')

@section('content')
    <div class="responsive flex flex-col gap-4">

        <nav class="w-full mt-4 overflow-auto">
            <ul class="flex gap-2 sm:gap-4 text-textColor relative border-gray-300">
                @foreach ($newsCategories as $item)
                    <li>
                        <a href="{{ route('news.category', $item->slug) }}"
                            class="tab-item block p-2 text-[15px] sm:text-[17px] relative text-nowrap"
                            data-slug="{{ $item->slug }}">
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
                <!-- Thanh gạch dưới -->
                <div id="tab-underline" class="absolute bottom-0 h-[3px] bg-orangeColor"></div>
            </ul>
        </nav>


        <div class="news__container">
            {{-- Tin tức hot --}}
            <a href="{{ route('news.detail', $hotNews->slug) }}">
                <div class="news__hottest sm:grid-cols-2 grid-cols-1">
                    <div class="news__paragraph">
                        <div class="flex justify-between mb-3">
                            <span class="news__badge news__badge--hot">Tin Tức Hot</span>
                            <p class="news__date">Ngày {{ $hotNews->created_at->format('d/m/Y') }}</p>
                        </div>
                        <h2 class="news__title">{{ $hotNews->title }}</h2>
                        <p class="news__excerpt line-clamp-2 text-ellipsis overflow-clip">
                            {!! $hotNews->excerpt !!}
                        </p>
                    </div>
                    <img title="{{ $hotNews->title }}" src="{{ asset('storage/' . $hotNews->thumbnail) }}"
                        alt="{{ $hotNews->title }}" class="w-full h-auto aspect-[5/3] object-cover object-center" />
                </div>
            </a>

            {{-- Danh sách tin tức --}}
            <div class="news__list grid gap-[30px] md:grid-cols-2 lg:grid-cols-3 grid-cols-1">
                @foreach ($newsList as $news)
                    <a href="{{ route('news.detail', $news->slug) }}">
                        <div class="news__item">
                            <div class="news__thumbnail" title="{{ $news->title }}">
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}"
                                    class="news__image w-full h-auto aspect-[5/3] object-cover object-center">
                            </div>
                            <div class="news__info">
                                <span class="news__badge news__badge--new">Tin Tức Mới</span>
                                <h3 class="news__title">{{ $news->title }}</h3>
                                <p class="news__excerpt">
                                    {!! $news->excerpt !!}
                                </p>
                                <p class="news__date">Ngày {{ $news->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
