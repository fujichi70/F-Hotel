@extends('layouts.app')

@section('content')
<div class="calendar">
	<div class="calendar-header text-center">
		<a class="btn" href="{{ url('/calendar?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
		<span>{{ $calendar->getTitle() }}</span>
		<a class="btn" href="{{ url('/calendar?date=' . $calendar->getNextMonth()) }}">前の月</a>
	</div>
	<form action="" method="post">
		@csrf
		<div class="calendar-body">
			{!! $calendar->render() !!}
		</div>
	</form>
</div>
@endsection