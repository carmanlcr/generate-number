@extends('layouts.app')

@section('title')
	<title>Creacion de perfiles</title>
@endsection

@section('content')
	<br>

	@if($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<div class="card">
		<div class="card-header">
			<h1 class="text-center">
				<strong class="text-primary">Actualziar Usuario {{$usuario->username}}</strong>
			</h1>
		</div>

		<div class="card-body">
			<form action="{{ route('updateInstagramUser', $usuario->users_id) }}" method="POST">
        			@csrf

        			<div class="row form-group">
						<div class="col-md-3">
							<span>
								Nombre*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="full_name" class="form-control" required autofocus value="{{ $usuario->full_name }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Username*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="username" class="form-control" required autofocus value="{{ $usuario->username }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Email*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="email" class="form-control" required autofocus value="{{ $usuario->email }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Phone*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="phone" class="form-control" required autofocus value="{{ $usuario->phone }}">
						</div>
		        	</div>
		        	
		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Password*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="password" class="form-control" required autofocus value="{{ $usuario->password }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Creator
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="creator" class="form-control" autofocus value="{{ $usuario->creator }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Fecha de Nacimiento*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="date" name="date_of_birth" class="form-control" required autofocus value="{{ $usuario->date_of_birth }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Activo*
							</span>
						</div>

		                <div class="col-md-9">
							<div class="form-check">
								@if($usuario->active)

									<input type="checkbox" name="active" class="form-check-input" checked="checked">	
								@else
									<input type="checkbox" name="active" class="form-check-input">	
								@endif
							</div>
			               
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Numero de Simcar*
							</span>
						</div>

		                <div class="col-md-9">
							<input type="numeric" name="sim_card_number" class="form-control" required autofocus value="{{ $usuario->sim_card_number }}" >
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Vpn*
							</span>
						</div>

		                <div class="col-md-9">
		                	<select class="form-control custom-select" id="vpn_id" name="vpn_id" required>
								@foreach($vpn as $vp)
									@if($vp->vpn_id == $usuario->vpn_id)
										<option value="{{ $vp->vpn_id }}" selected="selected">{{$vp->name}}</option>
									@else
										<option value="{{ $vp->vpn_id }}">{{$vp->name}}</option>
									@endif
								@endforeach
							</select>
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Campaña*
							</span>
						</div>

		                <div class="col-md-9">
		                	<select class="form-control custom-select" id="campaings_id" name="campaings_id" required>
								@foreach($campaings as $cam)
									@if($cam->categories_id == $usuario->campaing[0]->categories_id)
										<option value="{{ $cam->categories_id }}" selected="selected">{{$cam->name}}</option>
									@else
										<option value="{{ $cam->categories_id }}">{{$cam->name}}</option>
									@endif
								@endforeach
							</select>
		  				</div>
		        	</div>

		        	<caption>* Obligatorio</caption>
		  			<br>
		  			<div class="row form-group">
		  				<div class="col-md-2">
		  					<a class="btn btn-primary" href="{{ route('usersInstagram') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
		  				</div>
		  				<div class="col-md-8">
		  						<button type="submit" id="updateProfile" class="btn btn-success" style="margin-left: 22em;">Actualizar</button>	
		  				</div>

		  				<!-- profileIndex -->
		  				<div class="col-md-2"></div>
		  			</div>
        		</form>
		</div>
	</div>
@endsection

