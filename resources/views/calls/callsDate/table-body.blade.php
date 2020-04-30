<tbody>
	@foreach($calls as $call)
		<tr>
		    <th scope="row">{{ $call->DAT}}</th>
		    <th scope="row" >{{ $call->ONE}}</th>
		    <th scope="row">{{ $call->TWO}}</th>
		    <th scope="row">{{ $call->THREE}}</th>
		    <th scope="row">{{ $call->THREE_TO_FIVE}}</th>
		    <th scope="row">{{ $call->MORE_THAN_FIVE}}</th>
		</tr>

		
</tbody>