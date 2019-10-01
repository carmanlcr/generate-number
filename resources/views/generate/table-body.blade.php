<tbody>

	
	@foreach($zonas as $key => $value)
	@php
		$value = json_encode($value,true);
		$value = str_replace("}","",$value);
	@endphp
		<tr>
		    <th scope="row">{{$key+1}}</th>
		    @for($i = 0; $i < strlen($value);$i++)
		    	@if(substr($value, $i,1) == 'l')
		    		@if(substr($value,$i+9,4)==1000)
		    			<th scope="row" >Zona 1</th>
		    		@elseif(substr($value,$i+9,4)==2000)
		    			<th scope="row">Zona 2</th>
		    		@elseif(substr($value,$i+9,4)==3000)
		    			<th scope="row">Zona 3</th>
		    		@elseif(substr($value,$i+9,4)==4000)
		    			<th scope="row">Zona 4</th>
		    		@endif
		    	@endif

		    	@if(substr($value, $i,1) == 'c')
		    		@if(substr($value, $i+7,1) == 0)
		    			<th scope="row" >{{substr($value, $i+7,1)}}</th>
		    		@elseif(substr($value, $i+7,4) % 10000 == 0 
		    				|| substr($value, $i+7,4) > 999 )
		    			<th scope="row">{{substr($value, $i+7,5)}}</th>
		    		@elseif(substr($value, $i+7,4)%1000 == 0 
		    				|| substr($value, $i+7,4)>99)
		    			<th scope="row">{{substr($value, $i+7,4)}}</th>

		    		@endif
		    		
		    	@endif
		    @endfor
		</tr>
	@endforeach

</tbody>