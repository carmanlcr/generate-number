@extends('layouts.app')
@section('css')
<link href="{{ asset('css/generate.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<h1 class="text-center">
			GENERADOR DE NUMEROS
		</h1>
		<br>
		<form class="form-group" href="{{ route('numberGenerate') }}" method="POST">
			@csrf
			@include('generate.generatecard')
			@include('generate.inputquantity')	
		</form>
	</div>
@endsection

@section('js')	
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<script src="{{ asset('js/generate.js') }}" type="text/javascript"></script>
@endsection