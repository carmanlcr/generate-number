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
		<form class="form-group" href="{{ route('numberGenerate') }}" method="POST">
			@csrf
			@include('generate.generatecard')
			@include('generate.inputquantity')	
		</form>
		<div class="row">
			<div class="col-lg-4" id="columna">
				<div class="alert " role="alert" id="alert">
				
					<strong><div id='myWatch'></div></strong>
				</div>
			</div>
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
            success: function(data, textStatus) 
        	{ 

        		let nombreClassAlert = "alert-"+data.status;
        		$("#alert").addClass(nombreClassAlert);
        		$("#columna").show();
        		document.getElementById("myWatch").innerHTML = "   "+data.response;
        		await sleep(10000);
        		location.reload();
            },
            error: function(data){
            	console.log()
            }
        }).responseText;


        
        

        
    }

    //con esta funcion llamamos a la función getTimeAJAX cada 5 minutos para que valide e inserte 
    setInterval(getTimeAJAX,300000);

</script>
@endsection