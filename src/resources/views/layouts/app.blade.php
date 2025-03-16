<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flea-market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a91304fdfa.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="logo_title">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="coachtech" class="coachtech">
            </a>
        </div>
        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ old('keyword', session('keyword', '')) }}">
        </form>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="nav-menu" id="nav-menu">
            <ul>
                @if (Auth::check())
                    <li>
                        <form  action="/logout" method="post">
                            @csrf
                            <button class="logout-btn">ログアウト</button>
                        </form>
                    </li>
                @else
                    <li><a href="/login" class="login-btn">ログイン</a></li>
                @endif
                <li><a href="/mypage?tab=sell" class="mypage_btn">マイページ</a></li>
                <li><a href="/sell" class="listing_btn">出品</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>