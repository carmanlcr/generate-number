@extends('layouts.app')
@section('css')
<link href="{{ asset('css/generate.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<h1 class="text-center">
			<strong class="text-primary">GENERADOR DE NUMEROS</strong>
		</h1>
		<br>

		<div class="row">
			<table class="table table-bordered">
			  @include('generate.table-cabecera')
			  @include('generate.table-body')
			</table>
			<span id = "2"></span>
		</div>
		
		
		
		
	</div>
@endsection

@section('js')	
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<script src="{{ asset('js/generate.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		//getTimeAJAX();
		$("#columna").hide();
     function getTimeAJAX() {

    	
    	

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
        $.ajax({

            url: '/generador-automatico', //indicamos la ruta donde se genera los numeros aleatorios
            type: 'get',
            dataType: 'JSON',//indicamos que es de tipo texto plano
            async: false,     //ponemos el parámetro asyn a falso
            success: function(data) 
        	{ 

        		console.log(data.response);
        	
            },
            error: function(data){
            	console.log(data.responseJSON.message);
            }
        }).responseText;

    }

    //con esta funcion llamamos a la función getTimeAJAX cada 5 minutos para que valide e inserte 
    setInterval(getTimeAJAX,300000);
    

</script>
@endsection