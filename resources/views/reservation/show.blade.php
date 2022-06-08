@extends('layouts.app')

@section('content')

<div class="reservation-room">
			<h3 class="reservation-room--title">お部屋を選択</h3>
			<div class="reservation-room--box">
				@foreach ($space_rooms as $space_room)
				<div class="reservation-room--item">
					<a href="{{ request()->url() }}/{{ $space_room->room_id }}">
						<h4 class="reservation-room--name" data-en="{{ ucfirst($space_room->name) }}">{{ $space_room->room_name }}
						</h4>
						<img src="/storage/images/{{ $space_room->img_path }}" alt="スタンダードルーム">
						<dl class="room-flex">
							<dt>ベッド</dt>
							<dd>{{ $space_room->type }}</dd>
						</dl>
						<dl class="room-flex">
							<dt>定員人数</dt>
							<dd>{{ $space_room->people }}名</dd>
						</dl>
						<dl class="room-flex">
							<dt>お食事</dt>
							<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
						</dl>
						<dl class="room-flex">
							<dt>1名様の料金<br class="room-br">(税込)</dt>
							<dd>{{ number_format($space_room->price + $priceUp) }}円<br class="room-br">（1名様での宿泊時）</dd>
						</dl>
					</a>
					<button onclick="location.href='{{ request()->url() }}/{{ $space_room->name }}'" class="btn">この部屋を選択</button>
				</div>
				@endforeach
			</div><!-- .reservation-room--box -->
		</div><!-- #room-reservation -->

		<div class="day-select">
			<p>日付：{{ $select_day }}選択中</p>
		</div>
@endsection