@extends('layouts.app')

@section('content')
<section id="user-auth">
    <div class="wrapper">
        <h1 class="user-title">管理者画面</h1>
        @if (Auth::check())
        <a href="{{ url('dashboard') }}" class="user-btn">管理者予約確認画面</a>
        @else
        <div class="auth">
            <a href="{{ route('login') }}" class="user-btn login">ログイン</a>
            <a href="{{ route('register') }}" class="user-btn register">新規登録</a>
        </div>
        @endif
    </div>
</section>
@endsection