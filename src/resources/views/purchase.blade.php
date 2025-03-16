@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form class="purchase-content" id="purchaseForm" action="/checkout" method="POST">
    @csrf
    <div class="left-content">
        <div class="product-contents">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="product-image">
                <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
            </div>
            <div class="product-detail">
                <div class="product_name">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="product_price">
                    <p>¥<span class="product_price-value">{{ number_format($product->price) }}</span></p>
                </div>
            </div>
        </div>
        <div class="payment">
            <p>支払い方法</p>
            <div class="form__payment">
                <select class="payment_select" name="payment" id="payment" onchange="removePlaceholderOption(this)">
                    <option value="" disabled selected>選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
            </div>
            <div class="form__error">
                @error('payment')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="delivery-address">
            <div class="delivery-address_ttl">
                <span>配送先</span>
                <a href="/purchase/address/{{$product->id}}" >変更する</a>
            </div>
            <div class="form__delivery-address">
                <p>〒<input type="text" name="postal_code" id="postal_code" value="{{ $user_info['postal_code'] }}" readonly></p>
                <div class="address-building">
                    <input type="text" name="address" id="address" value="{{ $user_info['address'] }}" readonly>
                    <input type="text" name="building"  id="building" value="{{ $user_info['building'] }}" readonly>
                </div>
                <input type="hidden" name="delivery_address" id="delivery_address">
            </div>
            <div class="form__error">
                @error('delivery_address')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="right-content">
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">商品代金</th>
                <td class="confirm-table__text">
                    <p>¥<span class="product_price-value">{{ number_format($product->price) }}</span></p>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">支払い方法</th>
                <td class="confirm-table__text">
                    <p><span id="selected-payment"></span></p>
                </td>
            </tr>
        </table>
        <button class="form__button-submit" type="submit">購入する</button>
    </div>
</form>
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection