<tbody >
		<tr id="rowHidden">
			<th colspan="3" scope="col">
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

	
		<tr v-for="pos in facebook.post" id="rowSend">
		    <th scope="row">@{{ pos.username}}</th>
		    <th scope="row" >@{{ pos.cant}} </a>  </th>
		    <th scope="row">@{{ pos.categoria}}</th>
		</tr>

		<tr>
			<th>Total:</th>
			<th colspan="2">
				@{{facebook.cantPost}}
			</th>
		</tr>
	
</tbody>