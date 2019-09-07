@extends('layouts.app')

@section('content')
	<div class="container">
		<div class=" row">
			<div class="col-md-4">
				@foreach($areaCodes as $areaCode)
					@foreach($numbers as $number)
						{{$areaCode->CODE}}{{$number}}
						<br>
					@endforeach
					<br>
				@endforeach
			</div>

			<div class ="col-md-6">
				<a href="{{ route('exportar') }}" class="btn btn-success">Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	
@endsection