@extends('layouts.client.master')
@section('title', $news->title)

@section('breadcrumb')
    @if (isset($news->category) && $news->category)
        <x-breadcrumb :items="[
            ['label' => 'Tin tức', 'url' => route('news.category')],
            ['label' => $news->category->name, 'url' => route('news.category', $news->category->slug)],
        ]" :currentPage="$news->title" />
    @else
        <x-breadcrumb :items="[['label' => 'Tin tức', 'url' => route('news.category')]]" :currentPage="$news->title" />
    @endif
@endsection

@section('content')
    <div class="responsive">
        <div class="news-detail-container">
            <div class="news-header mb-4">
                <h1 class="uppercase text-[25px] tracking-widest mb-6">{{ $news->title }}</h1>
                <p class="text-sm text-gray-500">Ngày {{ $news->created_at->format('d/m/Y') }}</p>
            </div>

            <div class="news-thumbnail mb-4">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}">
            </div>

            <div class="news-content">
                <div class="news-excerpt mb-4 italic">
                    <p>{{ $news->excerpt }}</p>
                </div>

                <div class="news-full-content">
                    {!! $news->content !!}
                </div>
            </div>

            <div class="back-to-list mt-6">
                <a href="{{ $news->category ? route('news.category', $news->category->slug) : route('news.category', 'tin-tong-hop') }}"
                    class="text-orangeColor hover:underline">
                    {{ $news->category ? 'Quay lại danh mục' : 'Quay lại trang tin tức' }}
                </a>
            </div>
        </div>
    </div>
@endsection
