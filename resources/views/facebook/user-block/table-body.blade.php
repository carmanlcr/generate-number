<tbody>
	<tr id="rowHidden">
		<th colspan="2" scope="col">
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

	<tr v-for="bloc in facebook.block" id="rowSend">
	    <th scope="row">@{{ bloc.username}}</th>
	    <th scope="row" >@{{ bloc.comentario}}</th>

	</tr>
	

</tbody>