@extends('layouts.app')

@section('content')

<section id="room-detail">
<div class="calendar">
				<div class="calendar-header text-center">
					<a class="calendar-btn btn-left" href="{{ url('/reservation?date=' . $calendar->getPreviousMonth()) }}"><i
							class="fa-solid fa-angles-left"></i>前の月</a>
					<span class="calendar-title">{{ $calendar->getTitle() }}</span>
					<a class="calendar-btn btn-right" href="{{ url('/reservation?date=' . $calendar->getNextMonth()) }}">次の月<i
							class="fa-solid fa-angles-right arrow"></i></a>
				</div>
				<form action="{{ route('reservation.standard') }}" method="post">
					@csrf
					<div class="calendar-body">
						{!! $calendar->render() !!}
					</div>
				</form>
			</div>

	<div class="reservation-room--item">
		<h4 class="reservation-room--name" data-en="Standard">スタンダードルーム</h4>
		<img src="{{ asset('img/room/standard.jpg') }}" alt="スタンダードルーム">

		<table class="room-detail--table">
			<tbody>
				<tr>
					<th>お部屋</th>
					<td>スタンダードルーム</td>
				</tr>
				<tr>
					<th>定員人数</th>
					<td>1名</td>
				</tr>
				<tr>
					<th>お食事</th>
					<td>
						<li>夕食／ビュッフェ</li>
						<li>朝食／ビュッフェ</li>
					</td>
				</tr>
				<tr>
					<th>客室の主な設備</th>
					<td>
						<li>広さ：30平米</li>
						<li>ベッド：ダブル 1台</li>
						<li>禁煙</li>
						<li>アメニティ各種 等</li>
					</td>
				</tr>
				<tr>
					<th>チェックイン</th>
					<td>15時00分～19時00分</td>
				</tr>
				<tr>
					<th>チェックアウト</th>
					<td>10時00分まで</td>
				</tr>
				<tr>
					<th>キャンセル規定</th>
					<td>
						<li>宿泊７日前：宿泊代金の30％</li>
						<li>宿泊前日　：宿泊代金の50％</li>
						<li>宿泊当日　：宿泊代金の100％</li>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<h3 class="reservation-title">ご予約はこちら</h3>
	<form action="{{ route('reservation.confirm') }}" method="post" class="reservation-form">
		@csrf
		<dl>
			<div class="name flex">
				<dt><label for="lastname" class="info">姓</label></dt>
				<dd><input class="input-area input-name" type="text" name="lastname" id="lastname" placeholder="山田"
						value="{{ old('lastname') }}">
				</dd>
				<dt><label for="firstname" class="info">名</label></dt>
				<dd><input class="input-area input-name" type="text" name="firstname" id="firstname" placeholder="太郎"
						value="{{ old('firstname') }}"></dd>
			</div>
			@error('lastname')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			@error('firstname')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label for="email" class="info">メールアドレス</label></dt>
			<dd><input class="input-area" type="email" name="email" id="email" placeholder="aaa@test.com"
					value="{{ old('email') }}"></dd>
			@error('email')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label for="address" class="info">住所</label></dt>
			<dd><input class="input-area input-address" type="text" name="address" id="address"
					placeholder="北海道札幌市中央区南◯条西◯丁目××-×-××" value="{{ old('address') }}"></dd>
			@error('address')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label for="tel" class="info">電話番号</label></dt>
			<dd><input class="input-area input-tel" type="tel" name="tel" id="tel" placeholder="011××××××××（ハイフンなし）"
					value="{{ old('tel') }}"></dd>
			@error('tel')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label class="info">ご宿泊人数</label></dt>
			<dd class="flex">
				<input type="radio" class="radio" name="people" id="people1" value="1"><label for="people1"
					class="radio-text">1名</label>
				<input type="radio" class="radio" name="people" id="people2" value="2" checked><label for="people2"
					class="radio-text">2名</label>
			</dd>
			@error('people')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label class="info">男性</label></dt>
			<dd class="flex">
				<input type="radio" class="radio" name="men" id="men0" value="0" checked><label for="men0"
					class="radio-text">0名</label>
				<input type="radio" class="radio" name="men" id="men1" value="1"><label for="men1"
					class="radio-text">1名</label>
				<input type="radio" class="radio" name="men" id="men2" value="2"><label for="men2"
					class="radio-text">2名</label>
			</dd>
			@error('men')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label class="info">女性</label></dt>
			<dd class="flex">
				<input type="radio" class="radio" name="women" id="women0" value="0" checked><label for="women0"
					class="radio-text">0名</label>
				<input type="radio" class="radio" name="women" id="women1" value="1"><label for="women1"
					class="radio-text">1名</label>
				<input type="radio" class="radio" name="women" id="women2" value="2"><label for="women2"
					class="radio-text">2名</label>
			</dd>
			@error('women')
			<p class="error">&#33; {{$message}}</p>
			@enderror
			<dt><label class="info">ご宿泊日</label></dt>
			<dd class="input-arrival">
				<input class="input-area" type="date" name="arrival" value="{{ $calendar->getToday() }}"> ~
				<input class="input-area" type="date" name="departure" value="{{ old('departure') }}">
			</dd>
			{{-- <dd>◯日間</dd> --}}
			@error('departure')
			<p class="error">&#33; {{$message}}</p>
			@enderror
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
			@error('checkin_time')
			<p class="error">&#33; {{$message}}</p>
			@enderror
		</dl>
		<input class="btn" type="submit" name="btn-confirm" value="確認画面へ">
	</form>
	</div>
	</section>
</section>
@endsection