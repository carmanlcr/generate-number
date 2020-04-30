@extends('layouts.app')
@section('title')
<title>Reporte de Post de Usuarios</title>
@endsection
@section('content')
	<div id="postFacebook">
		<div class="row">
			<div class="col-md-10 col-ls-10">
				<br>
				<h1 class="text-center">
					<strong class="text-primary" >Post - @{{ facebook.date }}</strong>
				</h1>
				<br>
				<table class="table table-bordered" >
					@include('facebook.user-post.table-cabecera')
					@include('facebook.user-post.table-body')
				</table>
			</div>

		</div>
		
	</div>
@endsection
