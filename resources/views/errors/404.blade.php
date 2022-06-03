@extends('layouts.app')

@section('content')
<section id="error">
	<h1 class="error-title">404</h1>
	<h2 class="error-subtitle">ページが見つかりませんでした</h2>

	<p error="error-text">申し訳ありません。以下ボタンからトップページにお戻りください。</p>
	<a href="{{ route('top') }}" class="btn btn-back">トップに戻る</a>
</section>
@endsection