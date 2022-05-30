@extends('layouts.app')

@section('content')

<p>{{ $selectDay }}</p>

{{-- @foreach ($roomItem as $item)
{{ $item }}	
@endforeach --}}


<?php 

var_dump($roomItem);

?>
@endsection