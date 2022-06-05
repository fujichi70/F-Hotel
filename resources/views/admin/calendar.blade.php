@extends('layouts.app')

@section('content')
<section id="user-auth">
	<div class="wrapper">
		<h1 class="user-title">年間価格設定ページ</h1>
	</div>	

	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif

	<div class="calendar">
	<div class="calendar-header text-center">
		<a class="calendar-btn btn-left" href="{{ url('/admin.calendar?date=' . $calendar->getPreviousMonth()) }}"><i
				class="fa-solid fa-angles-left"></i>前の月</a>
		<span class="calendar-title">{{ $calendar->getTitle() }}</span>
		<a class="calendar-btn btn-right" href="{{ url('/admin.calendar?date=' . $calendar->getNextMonth()) }}">次の月<i
				class="fa-solid fa-angles-right arrow"></i></a>
	</div>
	{{-- <form action="" method="post"> --}}
	<form action="{{ route('admin.update') }}" method="post">
		@csrf
		<div class="calendar-body">
			{!! $calendar->render() !!}
		</div>
		<button type="submit" name="update" class="btn">更新</button>
	</form>
</div>
</section>

@endsection