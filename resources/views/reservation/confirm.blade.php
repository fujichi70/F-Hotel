<?php
$arrival = $reservation['arrival'];
$departure = $reservation['departure'];
$totalDay = (strtotime($departure) - strtotime($arrival)) / 86400;
$arrival = strtotime($arrival);
$arrival = date('Y年m月d日', $arrival);
$departure = strtotime($departure);
$departure = date('Y年m月d日', $departure);
?>

@extends('layouts.app')

@section('content')

<section id="reservation-confirm">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">Reservation Confirm<span class="sub-title">- 宿泊ご予約確認 -</span></h2>
		</div>

		<form method="post" action="{{ route('reservation.store') }}" class="confirm-form">
			@csrf
			<div class="confirm-item">
				<div class="confirm-flex">
					<p>ご氏名</p>
					<p>{{ $reservation['lastname'] }} {{ $reservation['firstname'] }}</p>
				</div>
				<div class="confirm-flex">
					<p>メールアドレス</p>
					<p>{{ $reservation['email'] }}</p>
				</div>
				<div class="confirm-flex">
					<p>ご住所</p>
					<p>{{ $reservation['address'] }}</p>
				</div>
				<div class="confirm-flex">
					<p>電話番号</p>
					<p>{{ $reservation['tel'] }}</p>
				</div>
				<div class="confirm-flex">
					<p class="info">ご宿泊人数</p>
					<p>{{ $reservation['people'] }}名様
					<span>（男性{{ $reservation['men'] }}名　女性{{ $reservation['women'] }}名）</span>
				</div>
				<div class="confirm-flex">
					<p class="info">ご宿泊日</p>
					<p>{{ $arrival }} ~ {{ $departure }}</p>
					<span>{{ $totalDay }}泊</span>
				</div>
				<div class="confirm-flex">
					<p>チェックイン時間</p>
					<p>{{ $reservation['checkin_time'] }}</p>
				</div>
				<input type="hidden" name="reservation_id" value="{{ $reservation['reservation_id'] }}">
				<input type="hidden" name="room_id" value="{{ $reservation['room_id'] }}">
				<input type="hidden" name="lastname" value="{{ $reservation['lastname'] }}">
				<input type="hidden" name="firstname" value="{{ $reservation['firstname'] }}">
				<input type="hidden" name="email" value="{{ $reservation['email'] }}">
				<input type="hidden" name="address" value="{{ $reservation['address'] }}">
				<input type="hidden" name="tel" value="{{ $reservation['tel'] }}">
				<input type="hidden" name="people" value="{{ $reservation['people'] }}">
				<input type="hidden" name="men" value="{{ $reservation['men'] }}">
				<input type="hidden" name="women" value="{{ $reservation['women'] }}">
				<input type="hidden" name="arrival" value="{{ $reservation['arrival'] }}">
				<input type="hidden" name="departure" value="{{ $reservation['departure'] }}">
				<input type="hidden" name="checkin_time" value="{{ $reservation['checkin_time'] }}">
				
				<div class="confirm-flex btn-box">
					<input class="btn btn-back" type="button" onclick=history.back() name="btn-back" value="戻る">
					<input class="btn" type="submit" name="btn-complete" value="予約する">
				</div>
			</div>
		</form>
	</div>
</section>
@endsection