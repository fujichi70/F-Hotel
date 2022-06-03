@extends('layouts.app')

@section('content')
<section id="user-auth">
	<div class="wrapper">
		<h1 class="user-title">管理者画面</h1>
		<div class="auth">
			<a href={{ route('admin.calendar') }} class="user-btn calendar">価格等の設定</a> 
		</div>
	</div>
</section>
@endsection