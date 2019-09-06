@foreach($zonas as $zona)
	@if($zona->ZONES_ID % 2 != 0)
		<div class="row">
			<div class="col">
				<div class="card"> 
						<div class="card-header">
							<div class="form-check">
								<label class="form-check-label">
								<input type="checkbox" class="form-check-input" id="{{ $zona->ZONES_ID}}">{{$zona->NAME}}
								</label>
							</div>
						</div>
						<div class="card-body body-scrool">
						@include('generate.checkboxstate')
				  </div>
				</div>
			</div>
	@else
		<div class="col">
				<div class="card">
						<div class="card-header">
							<div class="form-check">
								<label class="form-check-label">
								<input type="checkbox" class="form-check-input" id="{{ $zona->ZONES_ID}}">{{$zona->NAME}}
								</label>
							</div>
						</div>
						<div class="card-body body-scrool">
						@include('generate.checkboxstate')
				  </div>
				</div>	
		</div>
		</div>
	@endif
	<br>
@endforeach