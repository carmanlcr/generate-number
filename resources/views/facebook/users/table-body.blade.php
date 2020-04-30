<tbody>
	<tr id="rowHidden">
		<th colspan="11" scope="col">
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

	<tr v-for="user in filteredEnqueries" id="rowSend">
	    <th scope="row" >@{{ user.username}} </th>
	    <th scope="row" >@{{ user.email}} </th>
	   <th scope="row">@{{ user.full_name}}</th>
	    <th scope="row">@{{ user.phone}}</th>
	    <th scope="row">@{{ user.password}}</th>
	    <th scope="row">@{{ user.creator}}</th>
	    <th scope="row">@{{ user.date_of_birth}}</th>
	    <th scope="row">@{{ user.active}}</th>
	    <th scope="row">@{{ user.sim_card_number}}</th>
	    <th scope="row">@{{ user.vpn}}</th>
	    <th scope="row">@{{ user.categories}}</th>
	    <th scrope="row">
	    	<div class="btn-group" role="group">
	    		<a type="button" class="btn btn-outline-primary" >Ver</a>
  				<a type="button" class="btn btn-outline-warning" v-bind:href="'/facebook/users/edit/'+user.users_id">Editar</a>
  			</div>
	    </th>
	</tr>
	
</tbody>