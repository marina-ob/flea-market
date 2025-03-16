@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="user-contents">
    <div class="left_user-contents">
        <img class="user-contents_image" src="{{ $user->image }}">
        <p class="user-contents_name">{{ $user->name }}</p>
    </div>
    <a class="edit-profile_btn" href="/mypage/profile">プロフィールを編集</a>
</div>
@if ($tab === 'sell')
<div class="header__content">
    <div class="header_btn">
        <a class="products_btn selected" href="/mypage?tab=sell">出品した商品</a>
        <a class="products_btn" href="/mypage?tab=buy">購入した商品</a>
    </div>
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
@elseif ($tab === 'buy')
<div class="header__content">
    <div class="header_btn">
        <a class="products_btn" href="/mypage?tab=sell">出品した商品</a>
        <a class="products_btn selected" href="/mypage?tab=buy">購入した商品</a>
    </div>
</div>
<div class="product-contents">
    @foreach ($purchases as $product)
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
@endif
@endsection