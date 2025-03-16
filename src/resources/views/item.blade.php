@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="all-contents">
    <div class="left-content">
        <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
    </div>
    <div class="right-content">
        <div class="product-title">
            <div class="product_name">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="product_brand">
                <p>{{ $product->brand }}</p>
            </div>
            <div class="product_price">
                <p>¥<span class="product_price-value">{{ number_format($product->price) }}</span> (税込)</p>
            </div>
            <div class="product-actions">
                <div class="liked-icon">
                    <button id="like-btn" data-product-id="{{ $product->id }}" class="like-button">
                        <img id="like-icon-{{ $product->id }}" src="{{ asset('images/star.png') }}" class="like-icon {{ $product->likes()->where('user_id', Auth::id())->exists() ? 'liked' : '' }}">
                    </button>
                    <span id="like-count-{{ $product->id }}">{{ $product->likes()->count() }}</span>
                </div>
                <div class="comment-icon">
                    <img src="{{ asset('images/comment.png') }}">
                    <span class="comment-count">{{ $commentCount > 0 ? $commentCount : '0' }}</span>
                </div>
            </div>
        </div>
        <a href="/purchase/{{$product->id}}" class="product-purchase">購入手続きへ</a>
        <div class="product-description">
            <h2>商品説明</h2>
            <div class="product_explanation">
                <p>{!! nl2br(e($product->explanation)) !!}</p>
            </div>
        </div>
        <div class="product-info">
            <h2>商品の情報</h2>
            <div class="product_category">
                <h3>カテゴリー</h3>
                <div class="categories-name">
                @foreach ($product->categories as $category)
                    <p>{{ $category->name }}</p>
                @endforeach
                </div>
            </div>
            <div class="product_condition">
                <h3>商品の状態</h3>
                <p>{{ $product->condition }}</p>
            </div>
        </div>
        <div class="comment-content">
            <h2>コメント({{ $commentCount > 0 ? $commentCount : '0' }})</h2>
            @foreach ($comments as $comment)
                <div class="comments-list">
                    <div class="comment_user">
                        <img class="user-contents_image" src="{{ asset($comment->user->image) }}">
                        <p class="user-contents_name">{{ $comment->user->name }}</p>
                    </div>
                    <p class="comments-text">{!! nl2br(e($comment->comment)) !!}</p>
                </div>
            @endforeach
            <form class="comment-input" action="/comment" method="POST">
                @csrf
                <h3>商品へのコメント</h3>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <textarea class="comments-form" name="comment">{{ old('comment') }}</textarea>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
                <button class="comment-form_btn" type="submit">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/item.js') }}"></script>
@endsection