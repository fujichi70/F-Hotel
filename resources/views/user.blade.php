@extends('layouts.app')

@section('content')
<section id="user-auth">
    <div class="wrapper">
        <h1 class="user-title">管理者画面</h1>
        <div class="auth">
            <a href="{{ route('login') }}" class="user-btn login">ログイン</a>
            <a href="{{ route('register') }}" class="user-btn register">新規登録</a>
        </div>
    </div>
</section>
@endsection