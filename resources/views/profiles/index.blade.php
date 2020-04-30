@extends('layouts.app')

@section('title')
	<title>Usuarios Para Creacion</title>
@endsection
@section('content')
	<br>
	<div id="usersCreate">

		<div class="row">
			<div class="col-md-10 col-ls-10">
				@if(Session::has('flash_message'))
				<div class="alert alert-success">
					{{Session::get('flash_message')}}
				</div>
			@endif
			
				<div class="card">
					<div class="card-header">
						<h1 class="text-center">
							<strong class="text-primary">Usuarios</strong>
						</h1>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="form-group col-lg-4">
								<input type="text" v-model="search" placeholder="Buscar username" class="form-control">	
							</div>	

							<div class="col-lg-6"></div>
							<div class="col-lg-2">
								<a class="btn btn-info" href="{{ route('profileAdd') }}"><span>Agregar</span></a>
							</div>
						</div>
						<br>
						<div class="my-custom-scrollbar table-wrapper-scroll-y  table-responsive-xl table-responsive-sm">
							<table id="usersTable" class="table table-bordered table-striped dt-responsive">
								<caption>List of users create</caption>
								<thead class="thead-dark">
									<tr>
										<th>Nombre</th>
										<th>Password</th>
										<th>Telefono</th>
										<th>Email</th>
										<th>Genero</th>
										<th>Vpn</th>
										<th>Activo</th>
										<th>Creado en FB</th>
										<th>Creado en IG</th>
										<th>Creado en TW</th>
										<th>Accion</th>
									</tr>
								</thead>
								<tbody>
									<tr id="rowHidden">
										<th colspan="13" scope="col">
											<h3>
												<center>CARGANDO REPORTE DE USUARIOS
													<div class="spinner-grow text-warning" role="status">
															<span class="sr-only">Loading...</span>
													</div>
													<div class="spinner-grow text-primary" role="status">
														<span class="sr-only">Loading...</span>
													</div>
													<div class="spinner-grow text-danger" role="status">
														<span class="sr-only">Loading...</span>
													</div>
												</center>
											</h3>
										</th>
									</tr>
									<tr v-for="user in filteredEnqueries">
										<th scope="row" >@{{ user.full_name}} </th>
										<th scope="row" >@{{ user.password}} </th>
										<th scope="row" >@{{ user.phone}} </th>
										<th scope="row">@{{ user.email}}</th>
										<th scope="row">@{{ user.gender}}</th>
										<th scope="row">@{{ user.vpn}}</th>
										<th scope="row">@{{ user.active}}</th>
										<th scope="row">@{{ user.create_fb}}</th>
										<th scope="row">@{{ user.create_ig}}</th>
										<th scope="row">@{{ user.create_tw}}</th>
										<th scope="row">
											<div class="btn-group">
												<a class="btn btn-success">Ver</a>
												<a class="btn btn-warning"v-bind:href="'/profile/edit/'+user.users_create_id">Editar</a>
											</div>
										</th>
									</tr>

								</tbody>
							</table>
						</div>
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
@section('js')
	
@endsection
