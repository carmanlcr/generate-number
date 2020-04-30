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

	@if(Session::has('flash_message'))
		<div class="alert alert-success">
			{{Session::get('flash_message')}}
		</div>
	@endif
	<div class="card">
		<div class="card-header">
			<h1 class="text-center">
				<strong class="text-primary">Actualziar Usuario</strong>
			</h1>
		</div>

		<div class="card-body">
			<form action="{{ route('profileUpdate', $usuario->users_create_id) }}" method="POST" enctype="multipart/form-data">
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
								VPN*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="vpn" class="form-control" required autofocus value="{{ $usuario->vpn }}">
						</div>
		        	</div>

		    		<div class="row form-group">
						<div class="col-md-3">
							<span>
								Numero de Telefono*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="phone" class="form-control" required autofocus value="{{ $phone->phone }}">
						</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Numero de Simcard
								<small>Numero pequeño</small>
							</span>
						</div>
						<div class="col-md-9">
						    @if($phone->sim_card_number == 2147483647) 
						    <input type="numeric" name="sim_card_number" value ="" class="form-control">	
						    @else
						    <input type="numeric" name="sim_card_number" value ="{{$phone->sim_card_number}}" class="form-control">	
						    @endif
			               
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Codigo de Barra*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="number_sim" class="form-control" required value="{{$phone->number_sim}}">	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								PIN Simcard*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="pin_simcard" class="form-control" required value="{{$phone->pin_simcard}}">	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								PUK Simcard*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="puk_simcard" class="form-control" required value="{{ $phone->puk_simcard }}">	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Operadora*
							</span>
						</div>
						<div class="col-md-9">
			               <select class="form-control custom-select" id="operadora" name="operadora" required>
		        				<option value="0">Seleccione una opcion</option>
		   						@foreach($operadoras as $opera)
		   							@if($opera->operators_id == $phone->operators_id)
		   								<option value="{{ $opera->operators_id }}" selected="selected">{{$opera->name}}</option>
		   							@else
		   								<option value="{{ $opera->operators_id }}">{{$opera->name}}</option>
		   							@endif
		   							
		   						@endforeach
		  					</select>
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Etnia*
							</span>
						</div>
						<div class="col-md-9">
			               <select class="form-control custom-select" id="etnia" name="etnia" required>
		        				<option value="2">Seleccione una opcion</option>
		        				@foreach($etnia as $et)
		        				 	@if($et->ethnicitys_id == $usuario->ethnicitys_id)
		        				 		<option value="{{ $et->ethnicitys_id }}" selected="selected">{{$et->name}}</option>
		        				 	@else
		        				 		<option value="{{ $et->ethnicitys_id }}">{{$et->name}}</option>
		        				 	@endif
		   							
		   						@endforeach
		  					</select>
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Sexo*
							</span>
						</div>
						<div class="col-md-9">
			               <select class="form-control custom-select" id="gender" name="gender" required>
		        				<option value="2">Seleccione una opcion</option>
		        				@for($i = 0; $i < count($generos) ;$i++)
		        					@if($i == $usuario->gender)
		        						<option value="{{$i}}" selected="selected">{{ $generos[$i] }}</option>
		        					@else
		        						<option value="{{$i}}">{{ $generos[$i] }}</option>
		        					@endif
		        					
		        				@endfor
		        				
		  					</select>
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Activo
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
		        			<span>Fotos* 
		        				@if($usuario->gender == 1)
		        					(Mujer)
		        				@else
		        					(Hombre)
		        				@endif
		        			</span>
		        			<input type="text" name="genere" hidden="hidden">
		        		</div>	

		        		<div class="col-md-3">
							<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvas"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fPerfil" id="fPerfil" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*"> <span>Perfil</span>

		        			@if(count($detail) > 0 && !is_null($detail[0]->fPerfil))
		        				<img src="{{'/images/profiles/'.$detail[0]->fPerfil}}" class="img-thumbnail rounded" width="500" height="500">
		        			@endif
		        			
		        		</div>
		        		<div class="col-md-3">
		        			<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvasP"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fPortada" id="fPortada" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*"> <span>Portada</span>

		        			@if(count($detail) > 0 && !is_null($detail[0]->fPortada))
		        				<img src="{{'/images/profiles/'.$detail[0]->fPortada}}" class="img-thumbnail rounded" width="500" height="500">
		        			@endif
		        		</div>
		        		<div class="col-md-3">
		        			<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvasA"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fAdicional" id="fAdicional" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*">	<span>Adicional</span>
		        			@if(count($detail) > 0 && !is_null($detail[0]->fAdicional))
		        				<img src="{{'/images/profiles/'.$detail[0]->fAdicional}}" class="img-thumbnail rounded" width="500" height="500">
		        			@endif
		        			
		        		</div>
		        	</div>
		        	<caption>* Obligatorio</caption>
		  			<br>
		  			<div class="row form-group">
		  				<div class="col-md-2">
		  					<a class="btn btn-primary" href="{{ route('profileIndex') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
		  				</div>
		  				<div class="col-md-8">
		  						<button type="submit" id="updateProfile" class="btn btn-success" style="margin-left: 22em;">Registrar</button>	
		  				</div>

		  				<!-- profileIndex -->
		  				<div class="col-md-2"></div>
		  			</div>
        		</form>
		</div>
	</div>
@endsection

@section('js')

	<script type="text/javascript">
		$(document).ready(function(){
			$('#createProfile').on('click',function(){
				var idOperadora = $('#operadora').val();
				if(idOperadora == '' || idOperadora == 0){
					alert('Debe seleccionar una operadora valida');
				}
			});
		});
	</script>
@endsection
