@vite(['resources/css/NewsPage.css'])
@extends('layouts.master') 

@section('title', 'Tin tức') 

@section('content')
<div class="aside">
    <h2>Aside Content</h2>
</div>

<div class="news__container">
    <div class="news__hottest">
        <div class="news__paragraph">
            <div class="flex justify-between mb-3">
                <span class="news__badge news__badge--hot">Tin Tức Hot</span>
                <p class="news__date">Ngày 11/11/2024</p>
            </div>
            <h2 class="news__title">HUYỀN THOẠI PHƯƠNG ĐÔNG</h2>
            <p class="news__excerpt">
                Ra mắt Bộ Sưu Tập Thu Đông mới 2024, Aristino dành tặng khách hàng chương trình quà tặng đặc biệt "Nhân ba điểm tích lũy" với đơn hàng có sản...
            </p>
        </div>
        <img 
            title="HUYỀN THOẠI PHƯƠNG ĐÔNG" 
            src="https://i1-giaitri.vnecdn.net/2025/02/24/Image-ExtractWord-0-Out-4175-1740399713.png?w=500&h=300&q=100&dpr=2&fit=crop&s=r4PWmB1ECKK9UI0FHWb4hw" 
            alt="HUYỀN THOẠI PHƯƠNG ĐÔNG"
        />
    </div>
    <div class="news__list">
        @for ($i = 0; $i<=8; $i++) 
        <div class="news__item">
            <div class="news__thumbnail" title="HUYỀN THOẠI PHƯƠNG ĐÔNG">
                <img src="https://file.hstatic.net/200000887901/article/1_89229ba8660b4e319f342ca1f643bccc_grande.jpg" class="news__image">
            </div>
            <div class="news__info">
                <span class="news__badge news__badge--new">Tin Tức Mới</span>
                <h3 class="news__title">HUYỀN THOẠI PHƯƠNG ĐÔNG</h3>
                <p class="news__excerpt">
                    Ra mắt Bộ Sưu Tập Thu Đông mới 2024, Aristino dành tặng khách hàng chương trình quà tặng đặc biệt "Nhân ba điểm tích lũy" với đơn hàng có sản...
                </p>
                <p class="news__date">Ngày 11/11/2024</p>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
