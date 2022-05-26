@extends('layouts.app')

@section('content')
<section id="error">
	<h1 class="error-title">419</h1>
	<h2 class="error-subtitle">エラーが発生しました</h2>

	<p error="error-text">申し訳ありません。以下ボタンからトップページにお戻りください。</p>
	<a href="{{ route('/') }}" class="btn btn-back">トップに戻る</a>
</section>
@endsection