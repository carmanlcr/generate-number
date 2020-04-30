<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>

<body>
	<div class="container">
		@include('admin.menu')
		@if ($errors->any())
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
		<br>
		<div class="card">
			<div class="card-body">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-xl" style="margin-left: 60em;">
				  Agregar
				</button>
				@include('admin.modalAdd')
				<br>
				<br>
		
			<div class="container">
				<table id="taskTable" class="table table-bordered table-striped dt-responsive">
					<caption>List of task</caption>
					<thead>
						<tr>
							<th>Red Social</th>
							<th>Campaña</th>
							<th>Genero</th>
							<th>Usuario</th>
							<th>Fecha</th>
							<th>Imagen</th>
							<th>Grupos a Publicar</th>
							<th>Cantidad Minima</th>
							<th>Accion</th>

						</tr>
					</thead>
				</table>
			</div>
				
			</div>
			
		</div>
		
	</div>
</body>
<!-- Scripts -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#taskTable').DataTable({
			language: {
	        	"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
	    	},
			serverSide: true,
			ajax: "{{ url('api/task') }}",
			createdRow: function ( row, data, index ) {

			    if ( data['active'] == 1 ) {
			    	$('td', row).removeClass();
			        $('td', row).addClass('table-info');
			    } else {
			        $('td', row).addClass('table-danger');
			    }

			    /*if(data['tasks_id'] == 1){
			    	$('td', row).removeClass();
			        $('td', row).addClass('table-success');
			    }*/
			},
			columns: [
				{data: 'Red_Social'},
				{data: 'campana'},
				{data: 'genero'},
				{data: 'user'},
				{data: 'fecha'},
				{data: 'image'},
				{data: 'quantity_groups'},
				{data: 'quantity_min'},
				{data: 'btn'}
			],
			
		});
	});
</script>
<script type="text/javascript" src="{{ asset('js/task/task.js') }}"></script>



</html>