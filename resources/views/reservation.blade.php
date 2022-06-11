@extends('layouts.app')

@section('content')

<section id="reservation">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">reservation<span class="sub-title">- 宿泊ご予約 -</span></h2>
		</div>

		<h3 class="reservation-main--title">ご宿泊日選択</h3>

		<div class="search-bar">

			<div class="search-input--box">
				<div class="search-input--items">
					<label for="people">人数</label>
					<select id="people" name="people" class="search-input">
						<option class="input-people" value="1">おとな 1名</option>
						<option class="search-input input-people" value="2" selected>おとな 2名</option>
					</select>
				</div>
				<div class="search-input--items">
					<label for="stay">泊数</label>
					<select id="stay" name="stay" class="search-input">
						<option class="inpput-stay" value="1" selected>1泊</option>
						<option class="inpput-stay" value="2">2泊</option>
						<option class="inpput-stay" value="3">3泊</option>
						<option class="inpput-stay" value="4">4泊</option>
						<option class="inpput-stay" value="5">5泊</option>
						<option class="inpput-stay" value="6">6泊</option>
						<option class="inpput-stay" value="7">7泊</option>
					</select>
				</div>
			</div>

			<div class="calendar">
				<div class="calendar-header text-center">
					<a class="calendar-btn btn-left"
						href="{{ url('/reservation?date=' . $calendar->getPreviousMonth()) }}"><i
							class="fa-solid fa-angles-left"></i>前の月</a>
					<span class="calendar-main--title">{{ $calendar->getTitle() }}</span>
					<a class="calendar-btn btn-right"
						href="{{ url('/reservation?date=' . $calendar->getNextMonth()) }}">次の月<i
							class="fa-solid fa-angles-right arrow"></i></a>
				</div>
				<div class="calendar-body">
					{!! $calendar->render() !!}
				</div>
			</div>

		</div>

		<div class="reservation-room">
			<h3 class="reservation-main--title">お部屋選択</h3>
			<div class="reservation-room--box">
				@foreach ($rooms as $room)
				<div class="reservation-room--item">
					<a href="{{ request()->url() }}/room/{{ $room->room_id }}">
						<h4 class="reservation-room--name" data-en="{{ ucfirst($room->name) }}">{{ $room->room_name
							}}
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