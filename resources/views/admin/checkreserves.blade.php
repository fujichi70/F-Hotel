<x-user>

	<x-slot name="header">
	</x-slot>

	<section id="checkreserves" class="bg-white mt-2 pt-4 pb-8">
		<div class="wrapper">
			<h1 class="user-title">宿泊予約確認</h1>
		</div>

		<div class="pc-style">
			<table class="text-center mx-auto border-collapse">
				@foreach ($reserves as $reserve)
				<tr>
					<th class="border-gray-400 font-normal px-2 border-solid border text-white bg-green-900"
						rowspan="4">予約番号<br>{{$reserve->reservation_id }}</th>
					<th class="border-gray-400 border-solid border bg-gray-200" colspan="2">宿泊日</th>
					<th class="border-gray-400 border-solid border bg-gray-200">泊数</th>
					<th class="border-gray-400 border-solid border bg-gray-200">予約名</th>
					<th class="border-gray-400 border-solid border bg-gray-200" rowspan="2">合計金額</th>
					<th class="px-4 border-gray-400 border border-b-4 border-double" rowspan="4">
						<button type="button" class="btn pay-btn">未払い</button>
					</th>
				</tr>
				<tr>
					<td class="px-4 border-gray-400 border-solid border">{{ $reserve->arrival }}</td>
					<td class="px-4 border-gray-400 border-solid border">{{ $reserve->departure }}</td>
					<td class="px-4 border-gray-400 border-solid border">{{ (strtotime($reserve->departure) -
						strtotime($reserve->arrival)) / 86400 }}日</td>
					<td class="px-4 border-gray-400 border-solid border">{{ $reserve->lastname }} {{ $reserve->firstname
						}}
						様</td>

				</tr>
				<tr>
					<th class="border-gray-400 border-solid border bg-gray-200">部屋名</th>
					<th class="border-gray-400 border-solid border bg-gray-200">人数</th>
					<th class="border-gray-400 border-solid border bg-gray-200" colspan="2">連絡先</th>
					<td class="px-4 border-gray-400 border border-b-4 border-double" rowspan="2">{{
						number_format($reserve->totalprice) }}円</td>
				</tr>
				<tr>
					<td class="px-4 border-gray-400 border border-b-4 border-double">{{ $reserve->room->room_name }}
					</td>
					<td class="px-4 border-gray-400 border border-b-4 border-double">{{ $reserve->people }}名</td>
					<td class="px-4 border-gray-400 border border-b-4 border-double">{{ $reserve->email }}</td>
					<td class="px-4 border-gray-400 border border-b-4 border-double">{{ $reserve->tel }}</td>
				</tr>
				@endforeach
			</table>
		</div>

		<div class="sp-style">
			@foreach ($reserves as $reserve)
			<table class="text-center mx-auto border-collapse mb-4">
				<thead>
					<tr>
						<th class="border-gray-400 font-normal px-2 border-solid border text-white bg-green-900"
							colspan="2">予約番号
						</th>
						<td class="px-4 border-gray-400 border-solid border" colspan="2">{{$reserve->reservation_id }}
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">宿泊日</th>
						<td class="px-4 border-gray-400 border-solid border">{{ $reserve->arrival }}</td>
						<td class="px-4 border-gray-400 border-solid border">{{$reserve->departure }}</td>
						<th class="px-4 border-gray-400 border border-double" rowspan="8">
							<button type="button" class="btn pay-btn">未払い</button>
						</th>
					</tr>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">泊数</th>
						<td class="px-4 border-gray-400 border-solid border" colspan="2">{{
							(strtotime($reserve->departure) -
							strtotime($reserve->arrival)) / 86400 }}日</td>
					</tr>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">予約名</th>
						<td class="px-4 border-gray-400 border-solid border" colspan="2">{{ $reserve->lastname }} {{
							$reserve->firstname
							}}
							様</td>
					</tr>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">部屋名</th>
						<td class="px-4 border-gray-400 border" colspan="2">{{ $reserve->room->room_name }}
					</tr>

					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">人数</th>
						<td class="px-4 border-gray-400 border" colspan="2">{{ $reserve->people }}名</td>
					</tr>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200" rowspan="2">連絡先</th>
						<td class="px-4 border-gray-400 border" colspan="2">{{ $reserve->email }}</td>
					</tr>
					<tr>
						<td class="px-4 border-gray-400 border" colspan="2">{{ $reserve->tel }}</td>
					</tr>
					<tr>
						<th class="border-gray-400 border-solid border bg-gray-200">合計金額</th>
						<td class="px-4 border-gray-400 border" colspan="2">{{
							number_format($reserve->totalprice) }}円</td>
					</tr>
				</tbody>
			</table>
			@endforeach
		</div>
	</section>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const btns = document.querySelectorAll(".pay-btn");

		for(let i = 0; i < btns.length; i++) {
				btns[i].addEventListener('click', () => {
					if(btns[i].textContent == '未払い') {
						btns[i].innerText = "支払い済";
					} else if (btns[i].textContent == '支払い済') {
						btns[i].innerText = "未払い";
					}
			}, false);
		} }, false);
	</script>
</x-user>