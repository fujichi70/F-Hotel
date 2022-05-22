<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理者画面</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    {{-- @if (Route::has('user.login'))
    <div class="flex">
        @auth('users')
        <a href="{{ url('dashboard') }}" class="">管理者画面</a>
        @else
        <a href="{{ route('login') }}" class="login">ログイン</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="register">新規登録</a>
        @endif
        @endauth
    </div>
    @endif
    --}}
    <section id="user-auth">
        <div class="wrapper">
            <h1 class="user-title">管理者画面</h1>
            @if (Auth::check())
            <a href="{{ url('dashboard') }}" class="btn">管理者予約確認画面</a>
            @else
            <div class="auth">
                <a href="{{ route('login') }}" class="btn login">ログイン</a>
                <a href="{{ route('register') }}" class="btn register">新規登録</a>
            </div>
        @endif
        </div>
    </section>
</body>

</html>