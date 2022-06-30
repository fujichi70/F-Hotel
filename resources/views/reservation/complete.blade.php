@extends('layouts.app')

@section('content')

<section id="reservation-complete">
	<div class="wrapper">
		<h2 class="complete-title">Thank you for reservation!</h2>

		<div class="complete-box">
			<h3 class="complete-text">- 宿泊ご予約完了 -</h3>
			@if (isset($message))
			<div class="message">{{ $message }}</div>
			@endif
	
			@if (isset($reservation_id))
			<p class="complete-reservation_id">予約番号：{{ $reservation_id }}</p>
			<p class="complete-message">当日のお越しをお待ちしております。お気をつけてお越しくださいませ。</p>
			@else
			<p class="reservation_error">エラーが発生しました。恐れ入りますが最初からご予約手続きをお願いいたします。</p>
			@endif

			<a href="{{ route('reservation') }}" class="btn">戻る</a>
		</div>
	</p>
</section>
@endsection