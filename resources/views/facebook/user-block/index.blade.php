@extends('layouts.app')
@section('title')
<title>Reporte de Usuarios Blockeados</title>
@endsection
@section('content')
	<div id="blockFacebook">
		<div class="row">
			<div class="col-md-10">
				<br>
				<h1 class="text-center">
					<strong class="text-primary" >Usuarios Blockeados</strong>
				</h1>
				<br>
				<table class="table table-bordered" >
					@include('facebook.user-block.table-cabecera')
					@include('facebook.user-block.table-body')
				</table>
			</div>

		</div>
		
	</div>
@endsection
