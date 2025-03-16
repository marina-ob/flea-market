@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="header__content">
    @if ($tab === 'mylist' && $user)
        <div class="header_btn">
            <a href="/" class="products_btn">おすすめ</a>
            <a class="products_btn selected" href="/?tab=mylist">マイリスト</a>
        </div>
    @else
        <div class="header_btn">
            <a href="/" class="products_btn selected">おすすめ</a>
            <a class="products_btn" href="/?tab=mylist">マイリスト</a>
        </div>
    @endif
</div>
<div class="product-contents">
    @foreach ($products as $product)
        <div class="product-content">
            <a href="/item/{{$product->id}}" class="product-link"></a>
            <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
            @if ($product->isSold())
                <span class="sold-label">SOLD</span>
            @endif
            <div class="detail-content">
                <p>{{$product->name}}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection