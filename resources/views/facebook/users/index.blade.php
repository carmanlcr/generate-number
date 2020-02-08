@extends('layouts.app')
@section('title')
<title>Reporte de Usuarios</title>
@endsection
@section('content')
	<div id="usersFacebook">
		<div class="row">
			<div class="col-md-10 col-ls-10">
				<br>
				@if(Session::has('flash_message'))
					<div class="alert alert-success">
						{{Session::get('flash_message')}}
					</div>
				@endif
				<h1 class="text-center">
					<strong class="text-primary" >Usuarios Facebook</strong>
				</h1>
				<br>
				<div class="card">
					<div class="card-header">
						<div class="form-group col-lg-4">
							<input type="text" v-model="search" placeholder="Buscar username" class="form-control">	
						</div>
					    
					 </div>
					<div class="my-custom-scrollbar table-wrapper-scroll-y  table-responsive-xl table-responsive-sm">
						<table class="table table-bordered" id="tableUsers">
							@include('facebook.users.table-cabecera')
							@include('facebook.users.table-body')
						</table>
					</div>

					<div class="card card-footer">
						<div class="pagination">
							<button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.prev_page_url)":disabled="!pagination.prev_page_url">Anterior</button>
							<span> Pagina @{{pagination.current_page}} de @{{pagination.last_page}}</span>
							<button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.next_page_url)":disabled="!pagination.next_page_url">Siguiente</button>
						</div>
					</div> 
				</div>
				
			</div>

		</div>
		
	</div>
@endsection
