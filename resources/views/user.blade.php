@extends('layouts.app')

@section('content')
<section id="user-auth">
    <div class="wrapper">
        <h1 class="user-title">管理者画面</h1>
        <div class="auth">
        @if (Auth::check())
        <a href="{{ url('admin.index') }}" class="user-btn">トップ</a>
        <a href="{{ url('admin.checkreserve') }}" class="user-btn">管理者予約確認</a>
        <a href="{{ url('admin.calendar') }}" class="user-btn">部屋価格設定</a>
        @else
            <a href="{{ route('login') }}" class="user-btn login">ログイン</a>
            <a href="{{ route('register') }}" class="user-btn register">新規登録</a>
        </div>
        @endif
    </div>
</section>
@endsection