@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="edit__content">
    <div class="edit-form__heading">
        <h1>プロフィール設定</h1>
    </div>
    <form class="form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form__group--image">
            <div class="form__group-content">
                <div class="form__input--image">
                    <img id="img" src="{{ asset($user->image) }}">
                </div>
            </div>
            <div class="form__group--image-title">
                <input  id="input" type="file" style="display:none" name="image">
                <input type="hidden" name="old_image" value="{{ $user->image }}">
                <button id="fileSelect" type="button" class="file-button">画像を選択する</button>
            </div>
        </div>
        <div class="form__error">
            @error('image')
                {{ $message }}
            @enderror
        </div>
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__input--text">
                    <input type="text" name="name" value="{{ $user->name }}" />
            </div>
            
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="postal_code" value="{{ $user->postal_code }}" pattern="\d{3}-\d{4}"/>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="address" value="{{ $user->address }}"/>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="building" value="{{ $user->building }}" />
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/edit.js') }}"></script>
@endsection