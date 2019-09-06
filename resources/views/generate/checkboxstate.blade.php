@foreach($states as $state)		
	@foreach($state->zones as $zone)
		@if($zone->ZONES_ID == $zona->ZONES_ID)
			<div class="form-check">
		  <label class="form-check-label">
		    <input type="checkbox" class="form-check-input checkbox State{{$zone->ZONES_ID}}" name="state[{{$zone->ZONES_ID}}][{{$state->STATES_ID}}]" id="{{$state->NAME}}{{$zone->ZONES_ID}}">{{$state->NAME}}
		  </label>
		</div>
		@endif
	@endforeach	
@endforeach