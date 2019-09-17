@extends('layouts.app')
@section('css')
<link href="{{ asset('css/generate.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<h1 class="text-center">
			GENERADOR DE NUMEROS
		</h1>
		<br>

		<div class="row">
			<table class="table">
			  @include('generate.table-cabecera')
			  @include('generate.table-body')
			</table>

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

            url: '/generador-automatico', //indicamos la ruta donde se genera la hora
            type: 'get',
            dataType: 'JSON',//indicamos que es de tipo texto plano
            async: false,     //ponemos el parámetro asyn a falso
            success: function(data) 
        	{ 

        		
        		location.reload();
        	
            },
            error: function(data){
            	console.log(data);
            }
        }).responseText;

    }

    //con esta funcion llamamos a la función getTimeAJAX cada 5 minutos para que valide e inserte 
    setInterval(getTimeAJAX,1200000);

</script>
@endsection