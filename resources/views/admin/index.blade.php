<x-user>
	<x-slot name="header">
	</x-slot>

	@if (session('message'))
	<div class="alert">
		{{ session('message') }}
	</div>
	@endif
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<div class="info-box pb-8 mb-4 border-b border-gray-400 border-solid">
						<h1>業務連絡</h1>
						<table class="border-collapse mb-2">
							<tr>
								<th class="border-gray-400 border-solid border text-white bg-green-900">連絡日付</th>
								<th class="border-gray-400 border-solid border text-white bg-green-900">内容</th>
								<th class="border-gray-400 border-solid border text-white bg-green-900">連絡者</th>
							</tr>
							@foreach ($infos as $info)
							<tr>
								<td class="px-4 border-gray-400 border-solid border">{{ $info->date }}</td>
								<td class="text-left px-4 border-gray-400 border-solid border">{{ $info->contents }}
								</td>
								<td class="text-left px-4 border-gray-400 border-solid border">{{ $info->user }}</td>
								<form action="{{ route('admin.destroy', $info->id ) }}" method="post">
									@csrf
									@method('delete')
									<td><input name="info_delete"
											class="cursor-pointer bg-green-900 text-white rounded-md p-2 hover:border-green-900 hover:border-solid hover:border hover:text-green-900 hover:bg-white" type="submit"
											value="削除"></td>
								</form>
							</tr>
							@endforeach
						</table>

						<div>業務連絡入力</div>
						<form action="{{ route('admin.store') }}" method="post" class="flex">
							@csrf
							<textarea name="contents" class="h-10 mr-4" cols="50" placeholder="業務連絡"></textarea>
							<input name="date" type="hidden" value="{{ date('Y/m/d', time()) }}">
							<input name="info_submit" type="submit" class="btn" value="報告">
						</form>
					</div>
					<div class="memo-box">
						<h1>自分メモ</h1>
						<table class="border-collapse mb-2">
							<tr>
								<th class="border-gray-400 border-solid border text-white bg-green-900">日付</th>
								<th class="border-gray-400 border-solid border text-white bg-green-900">内容</th>
							</tr>
							@foreach ($memos as $memo)
							<tr>
								<td class="px-4 border-gray-400 border-solid border">{{ $memo->date }}</td>
								<td class="text-left px-4 border-gray-400 border-solid border">{{ $memo->memo }}
								</td>
								<form action="{{ route('admin.destroy', $memo->id ) }}" method="post">
									@csrf
									@method('delete')
									<td><input name="memo_complete"
											class="cursor-pointer bg-green-900 text-white rounded p-2 hover:border-green-900 hover:border-solid hover:border hover:text-green-900 hover:bg-white" type="submit"
											value="完了">
									</td>
								</form>
							</tr>
							@endforeach
						</table>
						<div>メモ入力</div>
						<form action="" method="post" class="flex">
							@csrf
							<textarea name="memo" class="h-10 mr-4" cols="50" placeholder="自分のメモ"></textarea>
							<input name="date" type="hidden" value="{{ date('Y/m/d', time()) }}">
							<input name="memo_submit" type="submit" class="btn" value="追加">
						</form>
						<ul>
							<li></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-user>