@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endsection

@section('content')
<div class="listing-form">
    <form class="listing-form_contents" action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="listing-form_ttl">商品の出品</h1>
        <div class="form__group--image">
            <p class="form__group--image-txt">商品画像</p>
            <div class="form__input--image">
                <label for="file-upload" class="custom-file-label">画像を選択する</label>
                <span id="file-name" class="file-name"></span>
            </div>
            <input class="custom-file-input" id="file-upload" type="file" name="image" >
        </div>
        <div class="form__error">
            @error('image')
                {{ $message }}
            @enderror
        </div>
        <div class="form__group-content-detail">
            <p class="form__group--ttl">商品の詳細</p>
            <div class="form__category-content">
                <p class="form__group--txt">カテゴリー</p>
                <div class="form__category-input">
                    <input type="checkbox" id="fashion" class="category-checkbox" name="category[]" value="1" {{ in_array('1', old('category', [])) ? 'checked' : '' }}>
                    <label for="fashion" class="category-label">ファッション</label>
                    <input type="checkbox" id="appliances" class="category-checkbox" name="category[]" value="2" {{ in_array('2', old('category', [])) ? 'checked' : '' }}>
                    <label for="appliances" class="category-label">家電</label>
                    <input type="checkbox" id="interior" class="category-checkbox" name="category[]" value="3" {{ in_array('3', old('category', [])) ? 'checked' : '' }}>
                    <label for="interior" class="category-label">インテリア</label>
                    <input type="checkbox" id="ladies" class="category-checkbox" name="category[]" value="4" {{ in_array('4', old('category', [])) ? 'checked' : '' }}>
                    <label for="ladies" class="category-label">レディース</label>
                    <input type="checkbox" id="mens" class="category-checkbox" name="category[]" value="5" {{ in_array('5', old('category', [])) ? 'checked' : '' }}>
                    <label for="mens" class="category-label">メンズ</label>
                    <input type="checkbox" id="cosmetics" class="category-checkbox" name="category[]" value="6" {{ in_array('6', old('category', [])) ? 'checked' : '' }}>
                    <label for="cosmetics" class="category-label">コスメ</label>
                    <input type="checkbox" id="books" class="category-checkbox" name="category[]" value="7" {{ in_array('7', old('category', [])) ? 'checked' : '' }}>
                    <label for="books" class="category-label">本</label>
                    <input type="checkbox" id="games" class="category-checkbox" name="category[]" value="8" {{ in_array('8', old('category', [])) ? 'checked' : '' }}>
                    <label for="games" class="category-label">ゲーム</label>
                    <input type="checkbox" id="sports" class="category-checkbox" name="category[]" value="9" {{ in_array('9', old('category', [])) ? 'checked' : '' }}>
                    <label for="sports" class="category-label">スポーツ</label>
                    <input type="checkbox" id="kitchen" class="category-checkbox" name="category[]" value="10" {{ in_array('10', old('category', [])) ? 'checked' : '' }}>
                    <label for="kitchen" class="category-label">キッチン</label>
                    <input type="checkbox" id="handmade" class="category-checkbox" name="category[]" value="11" {{ in_array('11', old('category', [])) ? 'checked' : '' }}>
                    <label for="handmade" class="category-label">ハンドメイド</label>
                    <input type="checkbox" id="accessories" class="category-checkbox" name="category[]" value="12" {{ in_array('12', old('category', [])) ? 'checked' : '' }}>
                    <label for="accessories" class="category-label">アクセサリー</label>
                    <input type="checkbox" id="toys" class="category-checkbox" name="category[]" value="13" {{ in_array('13', old('category', [])) ? 'checked' : '' }}>
                    <label for="toys" class="category-label">おもちゃ</label>
                    <input type="checkbox" id="baby-kids" class="category-checkbox" name="category[]" value="14" {{ in_array('14', old('category', [])) ? 'checked' : '' }}>
                    <label for="baby-kids" class="category-label">ベビー・キッズ</label>
                </div>
            </div>
            <div class="form__error">
                @error('category')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__condition-content">
                <p class="form__group--txt">商品の状態</p>
                <div class="form__condition-input">
                    <select class="form__condition-select" name="condition" onchange="removePlaceholderOption(this)">
                        <option value="" disabled selected>選択してください</option>
                        <option value="良好" @if( old('condition') === '良好' ) selected @endif>良好</option>
                        <option value="目立った傷や汚れなし" @if( old('condition') === '目立った傷や汚れなし' ) selected @endif>目立った傷や汚れなし</option>
                        <option value="やや傷や汚れあり" @if( old('condition') === 'やや傷や汚れあり' ) selected @endif>やや傷や汚れあり</option>
                        <option value="状態が悪い" @if( old('condition') === '状態が悪い' ) selected @endif>状態が悪い</option>
                    </select>
                </div>
            </div>
            <div class="form__error">
                @error('condition')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <p class="form__group--ttl">商品名と説明</p>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}" />
                </div>
            </div>
            <div class="form__error">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ブランド名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="brand" value="{{ old('brand') }}" />
                </div>
            </div>
        </div>
        <div class="form__group-detail">
            <div class="form__group-title">
                <span class="form__label--item">商品の説明</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <textarea name="explanation">{{ old('explanation') }}</textarea>
                </div>
                <div class="form__error">
                    @error('explanation')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">販売価格</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <div class="yen-input">
                        <input type="number" name="price" value="{{ old('price') }}" />
                    </div>
                </div>
                <div class="form__error">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/listing.js') }}"></script>
@endsection