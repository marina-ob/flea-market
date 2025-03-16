@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address__content">
    <div class="address-form__heading">
        <h1>住所の変更</h1>
    </div>
    <form class="form" action="/purchase/{{$product->id}}" method="POST">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="postal_code" value="{{ old('postal_code') }}"pattern="\d{3}-\d{4}"/>
            </div>
            <div class="form__error">
                @error('postal_code')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="address" value="{{ old('address') }}"/>
            </div>
            <div class="form__error">
                @error('address')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="building" value="{{ old('building') }}" />
            </div>
        </div>
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection