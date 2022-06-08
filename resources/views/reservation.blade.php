@extends('layouts.app')

@section('content')

<section id="reservation">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">reservation<span class="sub-title">- 宿泊ご予約 -</span></h2>
		</div>

		<div class="search-bar">
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
						{!! $calendar->render() !!}
					</div>
			</div>


			<div class="search-day">
				<h3>検索</h3>
				<form action="" method="get">
					@csrf
					<label>ご宿泊予定日</label>
					<input type="text" name="year" value="{{ $calendar->getYear() }}">年
					<input type="text" name="month" value="{{ $calendar->getMonth() }}">月
					<input type="text" name="day" value="{{ $calendar->getDay() }}">日
					<input type="submit" name="day-submit" value="検索">
				</form>
			</div>
		</div>

		<div class="reservation-room">
			<h3 class="reservation-room--title">お部屋を選択</h3>
			<div class="reservation-room--box">
				@foreach ($rooms as $room)
				<div class="reservation-room--item">
					<a href="{{ request()->url() }}/room/{{ $room->room_id }}">
						<h4 class="reservation-room--name" data-en="{{ ucfirst($room->name) }}">{{ $room->room_name }}
						</h4>
						<img src="/storage/images/{{ $room->img_path }}" alt="{{ $room->name }}">
						<dl class="room-flex">
							<dt>ベッド</dt>
							<dd>{{ $room->type }}</dd>
						</dl>
						<dl class="room-flex">
							<dt>定員人数</dt>
							<dd>{{ $room->people }}名</dd>
						</dl>
						<dl class="room-flex">
							<dt>お食事</dt>
							<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
						</dl>
						<dl class="room-flex">
							<dt>1名様の料金<br class="room-br">(税込)</dt>
							<dd>{{ number_format($room->price) }}円<br class="room-br">（1名様での宿泊時）</dd>
						</dl>
					</a>
					<button onclick="location.href='{{ request()->url() }}/{{ $room->name }}'"
						class="btn">この部屋を選択</button>
				</div>
				@endforeach
			</div><!-- .reservation-room--box -->
		</div><!-- #room-reservation -->
	</div><!-- .wrapper -->
</section>
@endsection

@section('js')
<script src="{{ asset('js/ajax.js') }}"></script>
@endsection