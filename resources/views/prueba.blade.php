@extends('layouts.app')

@section('content')
	@foreach($areaCodes as $areaCode)
		@foreach($numbers as $number)
			{{$areaCode->CODE}}-{{$number}}
			<br>
		@endforeach
		<br>
	@endforeach
@endsection