@extends('layouts.app')

@section('content')
	<div class="container" id="calls">
		<h1 class="text-center">
			<strong class="text-primary" >Llamadas del @{{ calls.date }}</strong>
		</h1>
		<br>
		<table class="table table-bordered">
			@include('calls.table-cabecera')
			@include('calls.table-body')
		</table>
	</div>
@endsection