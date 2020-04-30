
@extends('layouts.app')
@section('title')
<title>Reporte de llamadas</title>
@endsection
@section('content')
	<br>
	<div id="calls">
		<div class="row">
			<div class="col-md-10">
				<h1 class="text-center">
					<strong class="text-primary" >Llamadas del {{ $date }}</strong>
				</h1>
				<br>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-ls-12">
				<table class="table table-bordered">
					@include('calls.table-cabecera')
					@include('calls.table-body')
				</table>
			</div>
		</div>
			

		
		
	</div>
@endsection
