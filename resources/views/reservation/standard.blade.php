@extends('layouts.app')

@section('content')

<section id="room-detail">
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
</section>
@endsection