@extends('layouts.app')
@section('title')
<title>{{ config('app.name') }}</title>
@endsection
@section('css')
<link href="{{ asset('css/generate.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<h1 class="text-center">
			<strong class="text-primary">GENERADOR DE NUMEROS</strong>
		</h1>
		<br>

		<div class="row" id="generate">

			<table class="table table-bordered">
				<thead class="thead-dark">
				    <tr>
				      <th scope="col">Zona</th>
				      <th scope="col">Cantidad Actual</th>
				    </tr>
				</thead>
				<tbody>
					<tr v-for="generat in generate.array">
						<th scope="row">@{{ generat.list_id}}</th>
						<th scope="row" >@{{ generat.count}}</th>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="alert" role="alert" id="alert">
		 
		</div>
		
		
	</div>
@endsection
