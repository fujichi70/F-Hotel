@extends('layouts.app')

@section('content')

<section id="room-detail">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">reservation<span class="sub-title">- 宿泊ご予約 -</span></h2>
		</div>
		
		@foreach ($selectRoom as $room)
		<h3 class="reservation-main--title">ご予約情報ご入力</h3>
		<form action="{{ route('reservation.confirm') }}" method="post" class="reservation-form">
			@csrf
			<table>
				@error('totalprice')
				<p class="error">金額が正しく取得できませんでしたので、恐れ入りますが再度やり直し下さい。</p>
				@enderror
				<tr>
					<th>お部屋</th>
					<td class="room-name">{{ $room->room_name }}</td>
				</tr>
				<tr>
					<th><label class="info">ご宿泊日</label></th>
					<td class="input-arrival">
						<input class="input-area input-date" type="date" name="arrival" min="{{ $today }}"
							value="@if(!empty($select_day)){{ $select_day }}@else{{ old('arrival') }}@endif"> ～
					</td>
				</tr>
				<tr>
					<th>泊数</th>
					<td>
						<select id="reserveStay" name="stay" class="input-area">
							<option class="input-stay" value="1" @if(empty($stay) || $stay==1) selected @endif>1泊
							</option>
							<option class="input-stay" value="2" @if(!empty($stay) && $stay==2) selected @endif>2泊
							</option>
							<option class="input-stay" value="3" @if(!empty($stay) && $stay==3) selected @endif>3泊
							</option>
							<option class="input-stay" value="4" @if(!empty($stay) && $stay==4) selected @endif>4泊
							</option>
							<option class="input-stay" value="5" @if(!empty($stay) && $stay==5) selected @endif>5泊
							</option>
							<option class="input-stay" value="6" @if(!empty($stay) && $stay==6) selected @endif>6泊
							</option>
							<option class="input-stay" value="7" @if(!empty($stay) && $stay==7) selected @endif>7泊
							</option>
						</select>
					</td>
					@error('stay')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr class="name flex">
					<th><label for="lastname" class="info">姓</label></th>
					<td><input class="input-area input-name" type="text" name="lastname" id="lastname" placeholder="山田"
							value="{{ old('lastname') }}">
					</td>
					<th><label for="firstname" class="info">名</label></th>
					<td><input class="input-area input-name" type="text" name="firstname" id="firstname"
							placeholder="太郎" value="{{ old('firstname') }}"></td>
					@error('lastname')
					<td class="error">&#33; {{$message}}</td>
					@enderror
					@error('firstname')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label for="email" class="info">メールアドレス</label></th>
					<td><input class="input-area input-email" type="email" name="email" id="email"
							placeholder="aaa@test.com" value="{{ old('email') }}"></td>
					@error('email')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label for="address" class="info">住所</label></th>
					<td><input class="input-area input-address" type="text" name="address" id="address"
							placeholder="北海道札幌市中央区南◯条西◯丁目××-×-××" value="{{ old('address') }}"></td>
					@error('address')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label for="tel" class="info">電話番号</label></th>
					<td><input class="input-area input-tel" type="tel" name="tel" id="tel"
							placeholder="011××××××××（ハイフンなし）" value="{{ old('tel') }}"></td>
					@error('tel')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label class="info">ご宿泊人数</label></th>
					@if ($room->people == 1)
					<td class="flex">
						<input type="radio" class="radio" name="people" id="people1" value="1" {{ old('people')=="1"
							? 'checked' : '' }} checked>
						<label for="people1" class="radio-text">1名</label>
					</td>
					@else
					<td class="flex">
						<input type="radio" class="radio" name="people" id="people1" value="1" @if (!empty($people) &&
							$people==1) checked @endif {{ old('people')=="1" ? 'checked' : '' }} checked>
						<label for="people1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="people" id="people2" value="2" @if (!empty($people) &&
							$people==2) checked @endif {{ old('people')=="2" ? 'checked' : '' }}>
						<label for="people2" class="radio-text">2名</label>
					</td>
					@endif
					@error('people')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label class="info">男性</label></th>
					@if ($room->people == 1)
					<td class="flex">
						<input type="radio" class="radio" name="men" id="men0" value="0" {{ old('men')=="0" ? 'checked'
							: '' }} checked><label for="men0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="men" id="men1" value="1" {{ old('men')=="1" ? 'checked'
							: '' }}><label for="men1" class="radio-text">1名</label>
					</td>
					@else
					<td class="flex">
						<input type="radio" class="radio" name="men" id="men0" value="0" {{ old('men')=="0" ? 'checked'
							: '' }} checked><label for="men0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="men" id="men1" value="1" {{ old('men')=="1" ? 'checked'
							: '' }}><label for="men1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="men" id="men2" value="2" {{ old('men')=="2" ? 'checked'
							: '' }}><label for="men2" class="radio-text">2名</label>
					</td>
					@endif
					@error('men')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label class="info">女性</label></th>
					@if ($room->people == 1)
					<td class="flex">
						<input type="radio" class="radio" name="women" id="women0" value="0" {{ old('women')=="0"
							? 'checked' : '' }} checked><label for="women0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="women" id="women1" value="1" {{ old('women')=="1"
							? 'checked' : '' }}><label for="women1" class="radio-text">1名</label>
					</td>
					@else
					<td class="flex">
						<input type="radio" class="radio" name="women" id="women0" value="0" {{ old('women')=="0"
							? 'checked' : '' }} checked><label for="women0" class="radio-text">0名</label>
						<input type="radio" class="radio" name="women" id="women1" value="1" {{ old('women')=="1"
							? 'checked' : '' }}><label for="women1" class="radio-text">1名</label>
						<input type="radio" class="radio" name="women" id="women2" value="2" {{ old('women')=="2"
							? 'checked' : '' }}><label for="women2" class="radio-text">2名</label>
					</td>
					@endif
					@error('women')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr>
					<th><label for="checkin_time" class="info">チェックイン</label></th>
					<td>
						<select class="input-checkin" id="checkin_time" name="checkin_time">
							<option value="" selected>選択してください</option>
							<option value="14:00" {{ old('checkin_time')=="14:00" ? 'selected' : '' }}>14:00</option>
							<option value="14:30" {{ old('checkin_time')=="14:30" ? 'selected' : '' }}>14:30</option>
							<option value="15:00" {{ old('checkin_time')=="15:00" ? 'selected' : '' }}>15:00</option>
							<option value="15:30" {{ old('checkin_time')=="15:30" ? 'selected' : '' }}>15:30</option>
							<option value="16:00" {{ old('checkin_time')=="16:00" ? 'selected' : '' }}>16:00</option>
							<option value="16:30" {{ old('checkin_time')=="16:30" ? 'selected' : '' }}>16:30</option>
							<option value="17:00" {{ old('checkin_time')=="17:00" ? 'selected' : '' }}>17:00</option>
							<option value="17:30" {{ old('checkin_time')=="17:30" ? 'selected' : '' }}>17:30</option>
							<option value="18:00" {{ old('checkin_time')=="18:00" ? 'selected' : '' }}>18:00</option>
							<option value="18:30" {{ old('checkin_time')=="18:30" ? 'selected' : '' }}>18:30</option>
							<option value="19:00" {{ old('checkin_time')=="19:00" ? 'selected' : '' }}>19:00</option>
							<option value="19:30" {{ old('checkin_time')=="19:30" ? 'selected' : '' }}>19:30</option>
							<option value="20:00" {{ old('checkin_time')=="20:00" ? 'selected' : '' }}>20:00～</option>
						</select>
					</td>
					@error('checkin_time')
					<td class="error">&#33; {{$message}}</td>
					@enderror
				</tr>
				<tr class="price-box">
					<th><label class="info">合計金額</label></th>
					<td class="flex">
						<p>
							<span class="price">@if (!empty($totalPrice)){{ number_format($totalPrice) }} @else{{
								old('totalprice') }} @endif
							</span>
							円
						</p>
						<input type="hidden" class="input-price" name="totalprice" value="@if (!empty($totalPrice)){{ $totalPrice }} @else{{
								old('totalprice') }} @endif">
					</td>
				</tr>
			</table>
			<input type="hidden" name="room_id" value="{{ $room->room_id }}">
			<input type="hidden" name="room_name" value="{{ $room->room_name }}">
			<div class="confirm-flex btn-box">
				<a href="{{ route('reservation') }}" class="btn btn-back">予約画面に戻る</a>
				<input class="btn btn-confirm" type="submit" name="btn-confirm" value="確認画面へ">
			</div>
		</form>

		<div class="calendar">
			<div class="calendar-header text-center">
				<a class="calendar-btn btn-left"
					href="{{ url('/reservation?date=' . $calendar->getPreviousMonth()) }}"><i
						class="fa-solid fa-angles-left"></i>前の月</a>
				<span class="calendar-title">{{ $calendar->getTitle() }}</span>
				<a class="calendar-btn btn-right"
					href="{{ url('/reservation?date=' . $calendar->getNextMonth()) }}">次の月<i
						class="fa-solid fa-angles-right arrow"></i></a>
			</div>
			<div class="calendar-body">
				<form action="" method="post">
					{!! $calendar->render() !!}
				</form>
			</div>
		</div>

		<div class="reservation-room--item">
			<h4 class="reservation-room--name" data-en="{{ ucfirst($room->name) }}">{{ $room->room_name }}</h4>
			<img src="/storage/images/{{ $room->img_path }}" alt="{{ $room->room_name }}">
			<table class="room-detail--table">
				<tbody>
					<tr>
						<th>お部屋</th>
						<td>{{ $room->room_name }}</td>
					</tr>
					<tr>
						<th>ベッド</th>
						<td>{{ $room->type }}</td>
					</tr>
					<tr>
						<th>定員人数</th>
						<td>{{ $room->people }}名</td>
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
				@endforeach
			</table>
		</div>

	</div>
</section>
@endsection

@section('js')
<script src="{{ asset('js/ajax.js') }}"></script>
@endsection