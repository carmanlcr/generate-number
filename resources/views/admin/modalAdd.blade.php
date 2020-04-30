<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content ">
 			<div class="modal-header">
    			<h5 class="modal-title" id="exampleModalLongTitle">Agregar Tarea</h5>
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      			<span aria-hidden="true">&times;</span>
    			</button>
  			</div>
    		<div class="modal-body">
        		<form id="registerTask" action="{{ route('createTask') }}" method="POST" enctype="multipart/form-data">
        			@csrf
     				<div class="row form-group">
		        		<div class="col-sm-2 col-md-3 col-lg-3">
		        			<span>Redes Sociales</span>
		        		</div>	

		        		<div class="col-sm-10 col-md-9 col-lg-9">
		        			<select class="form-control custom-select" id="idRrss" name="rrss_id" required autofocus>
		        				<option value="0">Seleccione una opcion</option>
		   						@foreach($rrss as $rs)
									<option value="{{$rs->rrss_id}}">{{ $rs->name }}</option>
								@endforeach
		  					</select>
		        		</div>
		        	</div>
		    		<div class="row form-group">
						<div class="col-md-3">
							<span>
								Campañas
							</span>
						</div>

		                <div class="col-md-9">
		  					<select class="form-control" id="idCampana" name="campaings_id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
		  					</select>
						</div>
		        	</div>
		        	<div class="row form-group">
						<div class="col-md-3">
							<span>
								Generos
							</span>
						</div>
						<div class="col-md-9">
			                <select class="form-control" id="idGenere" data-toggle="dropdown" name="generes_id" aria-haspopup="true" aria-expanded="false" required>
			  				</select>
		  				</div>
		        	</div>
		        	<div class="row form-group">
		        		<div class="col-md-3">
		        			<span>Fecha de Publicacion</span>
		        		</div>	

		        		<div class="col-md-9">
		        			<input type="datetime-local" name="date_publication" class="form-control" min="{{$dateCurrent}}" required>
		        		</div>
		        	</div>
		        	<div class="row form-group">
		        		<div class="col-md-3">
		        			<span>Frase</span>
		        		</div>	
		        		<div class="col-md-9">
						    <textarea class="form-control" id="exampleFormControlTextarea1" name="phrase" rows="3" required></textarea>
		  				</div>        	
		  			</div>

		  			<div class="row form-group">
		        		<div class="col-md-3">
		        			<span>Imagen</span>
		        		</div>	
		        		<div class="col-md-9">
						    <input type="file" class="form-control" name="image">
		  				</div>        	
		  			</div>
		  			<div class="row form-group">
		  				<div class="col-md-2">
		  					<span>Usuarios</span>
		  				</div>
	  					<div class="col-md-10">
	  						<div class="card" hidden="hidden" id="cardUsers">
	  							<div class="card-header">
	  								<span>Seleccionar todo</span><input type="checkbox" class="form-check" id="selectAll">
	  								<h5 class="text-center" id="titleH5Users"></h5>
	  							</div>
								<div class="card-body row" id="cardBody" name="users[]">

								</div>
							</div>
	  					</div>
		  			</div>
		  			<div class="row form-group" id="facebookPublication" hidden="hidden">
		  				<div class="col-md-3">
		  					<span>Tipo de publicación</span>
		  				</div>
	  					<div class="col-md-9">
	  						<div class="card"  id="cardUsers">
	  							<span><input type='checkbox' id="isFanPage" name="isFanPage" aria-label='Checkbox for following text input' value='0'> Fan Page</span>
	  							<span><input type='checkbox' aria-label='Checkbox for following text input'name="isGroups" id="isGroups" value='0'> Grupos </span>
							</div>
	  					</div>
		  			</div>

		  			<div class="row form-group" id="facebookGroups" hidden="hidden">
		  				<div class="col-md-3">
		  					<span>Cantidad de Grupos a publicar</span>
		  				</div>
	  					<div class="col-md-9">
  							<input type='number'class="form-control" name='quantity_groups' placeholder="Cantidad de grupos"> 
	  					</div>
		  			</div>

		  			<div class="row form-group" id="facebookMiembros" hidden="hidden">
		  				<div class="col-md-3">
		  					<span>Cantidad de Miembros en grupo</span>
		  				</div>
	  					<div class="col-md-9">
  							<input type='number'class="form-control" name='quantity_min' placeholder="Cantidad Minima"> 
	  					</div>
		  			</div>
		  			
		  			<div class="row form-group">
		  				<div class="col-md-2"></div>
		  				<div class="col-md-8">
		  						<button type="submit" class="btn btn-success" style="margin-left: 22em;">Registrar</button>	
		  				</div>
		  				<div class="col-md-2"></div>
		  			</div>
        		</form>
  			</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
		</div>
	</div>
</div>