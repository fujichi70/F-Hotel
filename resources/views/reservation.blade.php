@extends('layouts.app')

@section('content')
<div class="bottom-fix--group wrapper">
	<div class="scroll-arrow">
		<span>Scroll</span>
	</div>
</div>

<section id="reservation">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title">reservation<span class="sub-title">- 宿泊ご予約 -</span></h2>
		</div>

		<div class="calendar">
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

		<div class="swiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide fade">
					<h3>スタンダードルーム</h3>
					<img src="{{ asset('img/room1.jpg') }}" alt="スタンダードルーム">
					<dl class="room-flex">
						<dt>大きさ</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3>デラックスルーム</h3>
					<img src="{{ asset('img/room2.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>部屋</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3>スイートルーム</h3>
					<img src="{{ asset('img/room3.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>部屋</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3>スタンダードルーム</h3>
					<img src="{{ asset('img/room4.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>部屋</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br>（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br>（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3>スタンダードルーム</h3>
					<img src="{{ asset('img/room5.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>部屋</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br>（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br>（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3>スタンダードルーム</h3>
					<img src="{{ asset('img/room6.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>部屋</dt>
						<dd>○○㎥</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>2名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br>（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円<br>（2名様での宿泊時）</dd>
					</dl>
				</div>
			</div>

			<div class="swiper-pagination"></div>

			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>

			<div class="swiper-scrollbar"></div>

		</div>
	</div>
</section>
@endsection