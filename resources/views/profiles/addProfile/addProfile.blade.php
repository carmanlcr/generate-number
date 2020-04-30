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
				<strong class="text-primary">Agregar Usuarios</strong>
			</h1>
		</div>

		<div class="card-body">
			<form id="registerTask" action="{{ route('profileCreate') }}" method="POST" enctype="multipart/form-data">
        			@csrf
		    		<div class="row form-group">
						<div class="col-md-3">
							<span>
								Numero de Telefono*
							</span>
						</div>

		                <div class="col-md-9">
		  					<input type="tex" name="phone" class="form-control" required autofocus>
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
			               <input type="numeric" name="sim_card_number" class="form-control">	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Codigo de Barra*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="number_sim" class="form-control" required>	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								PIN Simcard*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="pin_simcard" class="form-control" required>	
		  				</div>
		        	</div>

		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								PUK Simcard*
							</span>
						</div>
						<div class="col-md-9">
			               <input type="tex" name="puk_simcard" class="form-control" required>	
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
		   						<option value="{{ $opera->operators_id }}">{{$opera->name}}</option>
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
			               <select class="form-control custom-select" id="gender" name="etnia" required>
		        				<option value="2">Seleccione una opcion</option>
		        				@foreach($etnia as $et)
		   							<option value="{{ $et->ethnicitys_id }}">{{$et->name}}</option>
		   						@endforeach
		  					</select>
		  				</div>
		        	</div>

		        	<div class="row form-group">
		        		<div class="col-md-3">
		        			<span>Fotos* 
		        				@if($genere == 1)
		        					(Mujer)
		        				@else
		        					(Hombre)
		        				@endif
		        			</span>
		        			<input type="text" name="genere" value="{{$genere}}" hidden="hidden">
		        		</div>	

		        		<div class="col-md-3">
							<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvas"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fPerfil" id="fPerfil" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*"> <span>Perfil</span>
		        		</div>
		        		<div class="col-md-3">
		        			<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvasP"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fPortada" id="fPortada" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*"> <span>Portada</span>
		        		</div>
		        		<div class="col-md-3">
		        			<div class="preview-wrapper" hidden="hidden">
							    <canvas id="canvasA"></canvas>
							    <p class="process-message"></p>
							</div>
		        			<input type="file" name="fAdicional" id="fAdicional" class="form-control" accept=".jpg, .png, .jpeg, .tiff|image/*">	<span>Adicional</span>
		        		</div>
		        	</div>
		        	<caption>* Obligatorio</caption>
		  			<br>
		  			<div class="row form-group">
		  				<div class="col-md-2">
		  					<a class="btn btn-primary" href="{{ route('profileIndex') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
		  				</div>
		  				<div class="col-md-8">
		  						<button type="submit" id="createProfile" class="btn btn-success" style="margin-left: 22em;">Registrar</button>	
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
	<!-- Usando un CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/camanjs/4.0.0/caman.full.min.js"></script>
	<script type="text/javascript">
		var img = new Image();
		var canvas = document.getElementById('canvas');
		var ctx = canvas.getContext('2d');
		var fileName = '';
		 
		$("#f-perfil").on("change", function(){
		    var file = document.querySelector('#f-perfil').files[0];
		    var reader = new FileReader();
		    if (file) {
		        fileName = file.name;
		        reader.readAsDataURL(file);
		    }
		    reader.addEventListener("load", function () {
		        img = new Image();
		        img.src = reader.result;
		        img.onload = function () {
		            canvas.width = img.width;
		            canvas.height = img.height;
		            ctx.drawImage(img, 0, 0, img.width, img.height);
		            $("#canvas").removeAttr("data-caman-id");
		        }
		    }, false);
		});

		$("#f-portada").on("change", function(){
		    var file = document.querySelector('#f-portada').files[0];
		    var reader = new FileReader();
		    if (file) {
		        fileName = file.name;
		        reader.readAsDataURL(file);
		    }
		    reader.addEventListener("load", function () {
		        img = new Image();
		        img.src = reader.result;
		        canvas = document.getElementById('canvasP');
		        img.onload = function () {
		            canvas.width = img.width;
		            canvas.height = img.height;
		            ctx.drawImage(img, 0, 0, img.width, img.height);
		            $("#canvasP").removeAttr("data-caman-id");
		        }
		    }, false);
		});

		$("#f-adicional").on("change", function(){
		    var file = document.querySelector('#f-adicional').files[0];
		    var reader = new FileReader();
		    if (file) {
		        fileName = file.name;
		        reader.readAsDataURL(file);
		    }
		    reader.addEventListener("load", function () {
		        img = new Image();
		        img.src = reader.result;
		        canvas = document.getElementById('canvasA');
		        img.onload = function () {
		            canvas.width = img.width;
		            canvas.height = img.height;
		            ctx.drawImage(img, 0, 0, img.width, img.height);
		            $("#canvasA").removeAttr("data-caman-id");
		        }
		    }, false);
		});
	</script>
@endsection