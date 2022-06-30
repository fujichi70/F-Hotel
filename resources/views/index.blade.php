@extends('layouts.app')

@section('content')
<div class="bottom-fix--group wrapper">
	<div class="scroll-arrow">
		<span>Scroll</span>
	</div>
	<div class="return-top">
		<span>Return<br>Top</span>
	</div>

	<div class="reservation-btn">
		<a class="reserve-btn" href="{{ route('reservation') }}">ご予約はこちら</a>
	</div>
</div>

<main id="main">
	<div class="wrapper">
		<div class="main-grid">
			<div class="top-left">
				<nav class="main-menu">
					<ul class="main-menu--parts">
						<li class="main-menu--list">room</li>
						<li class="main-menu--list">restaurant</li>
						<li class="main-menu--list">spa</li>
						<li class="main-menu--list">services</li>
						<li class="main-menu--list">access</li>
					</ul>
				</nav>
			</div>
			<div class="top-center">
				<img src="{{ asset('img/main-grid/standard.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/double.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/standard-delux.jpg') }}" alt="">
			</div>
			<div class="top-right">
				<img src="{{ asset('img/main-grid/food1.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food2.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food3.jpg') }}" alt="">
			</div>
			<div class="grid-text">
				<h1 class="main-title">
					<span>落ち着く。<br><span>癒される。</span>
				</h1>
			</div>
			<div class="middle-left">
				<img src="{{ asset('img/main-grid/food4.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food5.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food6.jpg') }}" alt="">
			</div>
			<div class="middle-center">
				<img src="{{ asset('img/main-grid/concierge1.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/concierge2.jpg') }}" alt="">
			</div>
			<div class="middle-right">
				<img src="{{ asset('img/main-grid/food6.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food7.jpg') }}" alt="">
				<img src="{{ asset('img/main-grid/food8.jpg') }}" alt="">
			</div>
		</div><!-- .main-grid -->
	</div><!-- .wrapper -->

	<div class="sp-slide">
		<div class="sp-slide--group">
			<div class="sp-slide--parts">
				<img src="{{ asset('img/main-carousel/concierge.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/outside.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/lobby1.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/room.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/food1.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/food2.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/food3.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/hotspring.png') }}" alt="">
				<img src="{{ asset('img/main-carousel/lobby2.png') }}" alt="">
			</div>
			<div class="sp-slide--text"></div>
			<div class="sp-slide--text-parts">落ち着く。癒される。</div>
		</div>
	</div>
</main>

<section id="news">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title fade">news</h2>
		</div>

		<div class="news-group">
			<dl class="news-box">
				<div class="news-parts">
					<dt>20××.××.××</dt>
					<dd>花火打ち上げについて</dd>
				</div>
				<dd class="news-contents">20××年××月××日～20××年××月××日まで海側で10分間花火が上がりますのでぜひご覧ください。<br>
					※天候により中止になる場合がございます。</dd>
				<div class="news-parts">
					<dt>20××.××.××</dt>
					<dd>夕食ビュッフェリニューアルについて</dd>
				</div>
				<dd class="news-contents">お客様からの中華系の料理も増やしてほしいとのご要望により、中華系のお料理を追加させていただき70種類となりました。どうぞご堪能ください。</dd>
				<div class="news-parts">
					<dt>20××.××.××</dt>
					<dd>ウイルス対策について</dd>
				</div>
				<dd class="news-contents">
					コロナウイルス感染対策のため、安全衛生管理に取り組み皆様に安心とくつろぎの時間をご提供できるようスタッフ一同努めておりますので、検温および消毒等ご協力いただけますようお願い申し上げます。
				</dd>

				<div class="news-parts--hidden">
					<div class="hide news-parts">
						<dt>20××.××.××</dt>
						<dd>喫煙所について</dd>
					</div>
					<dd class="news-contents">喫煙所は各階にございます。詳しくは館内に掲示されているマップをご覧ください。</dd>
					<div class="hide news-parts">
						<dt>20××.××.××</dt>
						<dd>温泉の営業時間について</dd>
					</div>
					<dd class="news-contents">当面の間営業時間を短縮させていただきます。
						<br>営業時間　4:00 ～ 25:00
					</dd>
					<div class="hide news-parts">
						<dt>20××.××.××</dt>
						<dd>ハイフロアルームが誕生しました！</dd>
					</div>
					<dd class="news-contents">最上階をリニューアルし、ハイフロアルームとして生まれ変わりました。
						<br>特別なひと時をお過ごしになりたい方はぜひご検討ください。
					</dd>

					<button class="news-parts news-btn">more</button>
				</div>
			</dl>
		</div>
	</div>
</section>

<section id="room">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title fade">room</h2>
		</div>

		<div class="swiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide fade">
					<h3 class="room-name">スタンダードルーム</h3>
					<img src="{{ asset('img/room/standard.jpg') }}" alt="スタンダードルーム">
					<dl class="room-flex">
						<dt>ベッド</dt>
						<dd>シングル</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>1名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥18,000円～<br class="room-br">（1名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3 class="room-name">ダブルルーム</h3>
					<img src="{{ asset('img/room/double.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>ベッド</dt>
						<dd>ダブル</dd>
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
						<dd>¥17,000円～<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3 class="room-name">シングルデラックスルーム</h3>
					<img src="{{ asset('img/room/standard-delux.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>ベッド</dt>
						<dd>シングル</dd>
					</dl>
					<dl class="room-flex">
						<dt>定員人数</dt>
						<dd>1名</dd>
					</dl>
					<dl class="room-flex">
						<dt>お食事</dt>
						<dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
					</dl>
					<dl class="room-flex">
						<dt>1名様の料金<br>（税込）</dt>
						<dd>¥20,000円～<br class="room-br">（1名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3 class="room-name">セミダブルデラックスルーム</h3>
					<img src="{{ asset('img/room/semidouble-delux.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>ベッド</dt>
						<dd>セミダブル</dd>
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
						<dd>¥20,000円～<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3 class="room-name">ダブルデラックスルーム</h3>
					<img src="{{ asset('img/room/double-delux.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>ベッド</dt>
						<dd>ダブル</dd>
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
						<dd>¥23,000円～<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
				<div class="swiper-slide fade">
					<h3 class="room-name">ハイフロアルーム</h3>
					<img src="{{ asset('img/room/highfloor.jpg') }}" alt="">
					<dl class="room-flex">
						<dt>タイプ</dt>
						<dd>ダブル</dd>
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
						<dd>¥30,000円～<br class="room-br">（2名様での宿泊時）</dd>
					</dl>
				</div>
			</div><!-- .swiper-wrapper -->

			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>

		</div><!-- .swiper -->
	</div>
</section>


<section id="restaurant">
	<div class="contents">
		<h2 class="contents-title fade">restaurant</h2>
	</div>

	<div class="wrapper">
		<p class="text fade">
			夕食・朝食ともにビュッフェスタイルで和洋中80種類のお食事をご用意させていただいております。<br>感染対策はしっかり行っておりますので安心してご利用ください。</p>

		<div class="restaurant-group">
			<div class="restaurant-group--left time-fade">
				<div class="restaurant-slide">
					<img src="{{ asset('img/food1.jpg') }}" alt="">
					<img src="{{ asset('img/food2.jpg') }}" alt="">
					<img src="{{ asset('img/food3.jpg') }}" alt="">
					<img src="{{ asset('img/food4.jpg') }}" alt="">
				</div>
			</div>
			<div class="restaurant-group--center time-fade">
				<img src="{{ asset('img/inside1.jpg') }}" alt="">
			</div>
			<div class="restaurant-group--right time-fade">
				<div class="restaurant-slide">
					<img src="{{ asset('img/food5.jpg') }}" alt="">
					<img src="{{ asset('img/food6.jpg') }}" alt="">
					<img src="{{ asset('img/food7.jpg') }}" alt="">
					<img src="{{ asset('img/food8.jpg') }}" alt="">
				</div>
			</div>
		</div>

</section>

<section id="spa">
	<div class="wrapper">
		<div class="contents">
			<h2 class="contents-title fade">spa</h2>
		</div>

		<p class="text fade">
			なめらかで身体を心から温めてくれる水質の温泉をご用意いたしました。<br>24時間いつでもご利用いただけます。
		</p>

		<div class="spa-main--group">
			<img src="{{ asset('img/hotspring4.jpg') }}" alt="" class="spa-main--img fade">
			<p class="spa-main--text">極楽。</p>
			<img src="{{ asset('img/hotspring5.jpg') }}" alt="" class="spa-main--img fade">
		</div>

	</div><!-- .wrapper -->
</section>

<section id="service">
	<div class="contents">
		<h2 class="contents-title fade">service</h2>
	</div>

	<div class="wrapper">
		<p class="text fade">
			コロナ感染症対策はもちろん、お客様に快適にお過ごしいただけるよう様々なサービスをご用意いたしました。<br>何かお困りの際は従業員にお声がけいただけましたらすぐに対応させていただきます。</p>

		<div class="services-box grid">
			<div class="services-parts time-fade">
				<div class="service-img">
					<img src="{{ asset('img/service1.jpg') }}" alt="">
				</div>
				<h2 class="services-title fade"><span class="first-obj">P</span><span
						class="others-obj">revention</span></h2>
				<p>マスク着用・入館時の検温・アルコール除菌・ソーシャルディスタンスを徹底して行っております。</p>
				<p>ビュッフェ時は、それぞれ手袋の着用をお願いしております。</p>
			</div>
			<div class="services-parts time-fade">
				<div class="service-img">
					<img src="{{ asset('img/amenity1.jpg') }}" alt="">
				</div>
				<h2 class="services-title fade"><span class="first-obj">A</span><span class="others-obj">menities</span>
				</h2>
				<p>各種アメニティをご用意しております。</p>
				<ul>
					<li>ハンドタオル</li>
					<li>バスタオル</li>
					<li>ドライヤー</li>
					<li>シャンプー・トリートメント</li>
					<li>化粧落とし・洗顔フォーム</li>
					<li>化粧水・美容液・乳液</li>
					<li>シャワーキャップ・カミソリ</li>
					<li>綿棒・コットン</li>
				</ul>
			</div>
			<div class="services-parts time-fade">
				<div class="service-img">
					<img src="{{ asset('img/roomware.jpg') }}" alt="">
				</div>
				<h2 class="services-title fade"><span class="first-obj">R</span><span class="others-obj">oomWare</span>
				</h2>
				<p>ワッフル生地で着心地がよいパジャマをご用意いたしました。ちょうど良い厚さで動きやすい素材です。館内にてご使用いただけます。</p>
			</div>
		</div>
	</div>
</section>

<section id="access">
	<div class="contents">
		<h2 class="contents-title fade">access</h2>
	</div>

	<div class="access-googlemap--group">
		<div class="access-googlemap--box">
			<div class="aceess-googlemap--parts">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d691.1847332958213!2d141.1430537201058!3d42.49460386787359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f7566c38b33f1d7%3A0x2e2486e4e6564531!2z44CSMDU5LTA1NTEg5YyX5rW36YGT55m75Yil5biC55m75Yil5rip5rOJ55S677yZ77yR!5e0!3m2!1sja!2sjp!4v1646103724231!5m2!1sja!2sjp"
					width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy"
					class="access-googlemap"></iframe>
			</div>
		</div>
		<div class="access-detail">
			<div class="access-text--group fade">
				<p class="access-text--name">F HOTEL</p>
				<dl class="access-text--parts">
					<dt class="access-text--list">住所</dt>
					<dd class="access-text--detail">〒059-0551 北海道登別市登別温泉町９１</dd>
					<dt class="access-text--list">電話</dt>
					<dd class="access-text--detail">0143-××-××××
					<dd>
					<dt class="access-text--list">駐車場</dt>
					<dd class="access-text--detail">100台収容（無料）※ホテル横
					<dd>
				</dl>
			</div>

			<div class="access-hokkaidomap--parts fade">
				<img class="access-hokkaidomap" src="{{ asset('img/hokkaido.jpg') }}" alt="">
			</div>
		</div>
	</div>

	<div class="access-img--parts fade">
		<img class="access-img" src="{{ asset('img/access.png') }}" alt="">
		<img class="access-sp-img" src="{{ asset('img/access-sp.png') }}" alt="">
	</div>

</section>
@endsection