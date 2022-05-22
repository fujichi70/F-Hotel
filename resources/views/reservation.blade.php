@extends('layouts.app')

@section('content')

<section id="reservation">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">reservation<span class="sub-title">- 宿泊ご予約 -</span></h2>
		</div>

		<div class="search-bar">
			<div class="search-calendar">
				<div class="calendar-header text-center">
					<a class="btn" href="{{ url('/reservation?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
					<span>{{ $calendar->getTitle() }}</span>
					<a class="btn" href="{{ url('/reservation?date=' . $calendar->getNextMonth()) }}">前の月</a>
				</div>
				<form action="" method="post">
					@csrf
					<div class="calendar-body">
						{!! $calendar->render() !!}
					</div>
				</form>
			</div>


			<div class="search-day">
				<h3>検索</h3>
				<form action="" method="post">
					@csrf
					<label>ご宿泊予定日</label>
					<input type="text" name="year" value="{{ $calendar->getYear() }}">年
					<input type="text" name="year" value="{{ $calendar->getMonth() }}">月
					<input type="text" name="year" value="{{ $calendar->getDay() }}">日
					<input type="submit" name="day-submit" value="検索">
				</form>
			</div>
		</div>

		<h3 class="reservation-title">ご予約はこちら</h3>
		<form action="{{ route('reservation.confirm') }}" method="post" class="reservation-form">
			@csrf
			<dl>
				<div class="name flex">
					<dt><label for="lastname" class="info">姓</label></dt>
					<dd><input class="input-area input-name" type="text" name="lastname" id="lastname" placeholder="山田"></dd>
					<dt><label for="firstname" class="info">名</label></dt>
					<dd><input class="input-area input-name" type="text" name="firstname" id="firstname" placeholder="太郎"></dd>
				</div>
				<dt><label for="email" class="info">メールアドレス</label></dt>
				<dd><input class="input-area" type="email" name="email" id="email" placeholder="aaa@test.com"></dd>
				<dt><label for="address" class="info">住所</label></dt>
				<dd><input class="input-area input-address" type="text" name="address" id="address"
						placeholder="北海道札幌市中央区南◯条西◯丁目××-×-××"></dd>
				<dt><label for="tel" class="info">電話番号</label></dt>
				<dd><input class="input-area" type="tel" name="tel" id="tel" placeholder="011-××××-××××"></dd>
				<dt><label class="info">ご宿泊人数</label></dt>
				<dd class="flex">
						<input type="radio" class="radio" name="people" id="people1" value="1"><label for="people1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="people" id="people2" value="2" checked><label for="people2" class="radio-text">2名</label>
				</dd>
				<dt><label class="info">男性</label></dt>
				<dd class="flex">
						<input type="radio" class="radio" name="men" id="men0" value="0" checked><label for="men0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="men" id="men1" value="1"><label for="men1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="men" id="men2" value="2"><label for="men2" class="radio-text">2名</label>
				</dd>
				<dt><label class="info">女性</label></dt>
				<dd class="flex">
						<input type="radio" class="radio" name="women" id="women0" value="0" checked><label for="women0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="women" id="women1" value="1"><label for="women1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="women" id="women2" value="2"><label for="women2" class="radio-text">2名</label>
				</dd>
				<dt><label for="arrival" class="info">ご宿泊日</label></dt>
				<dd>
					<input class="input-area" type="date" name="arrival" value="{{ $calendar->getToday() }}"> ~ 
					<input class="input-area" type="date" name="arrival">
				</dd>
				{{-- <dd>◯日間</dd> --}}
				<dt><label for="checkin_time" class="info">チェックイン</label></dt>
				<dd>
					<select id="checkin_time" name="checkin_time">
						<option value="" selected="selected">選択してください</option>
						<option value="14:00">14:00</option>
						<option value="14:30">14:30</option>
						<option value="15:00">15:00</option>
						<option value="15:30">15:30</option>
						<option value="16:00">16:00</option>
						<option value="16:30">16:30</option>
						<option value="17:00">17:00</option>
						<option value="17:30">17:30</option>
						<option value="18:00">18:00</option>
						<option value="18:30">18:30</option>
						<option value="19:00">19:00</option>
						<option value="19:30">19:30</option>
						<option value="20:00">20:00～</option>
					</select>
				</dd>
			</dl>
			<input class="btn btn-info" type="submit" name="btn-confirm" value="確認画面へ">
		</form>
	</div>
</section>
@endsection