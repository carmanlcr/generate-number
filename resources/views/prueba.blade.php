@extends('layouts.app')

@section('content')
	<div class="container">
		<div class=" row">


			@if(session()->has('mensaje-success'))
				<div class="col-md-4">
					<a href="{{ url('/generate') }}" class="btn btn-primary">Volver 
						<span class="glyphicon glyphicon-arrow-left"></span></a>
				</div>

				<div class ="col-md-2">
					<a href="{{ url('export-number',['date' => $date]) }}" class="btn btn-success">Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
				</div>
				<div class="col-md-4"> 
					<div class="alert alert-success">
					  {{ session()->get('mensaje-success') }}
					</div>
				</div> 
			@endif
		</div>
	</div>


	
@endsection