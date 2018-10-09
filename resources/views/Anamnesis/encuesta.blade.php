@extends('plantillas.anamnesis')

@section('titulo', 'ENCUESTA MÉDICA')

@section('scripts')
<script type="text/javascript">
  function mostrar(bloque) { document.getElementById(bloque).style.display = 'block'; }
  function ocultar(bloque) { document.getElementById(bloque).style.display = 'none'; }
</script>
@endsection

@section('contenido')
	<form id="Habitos" class="card card-body">
		
		<fieldset> <!-- TAB1 : Encuenta sobre los HÁBITOS del cliente -->
			<legend>Por favor diligencie sus hábitos</legend>
			@foreach ($Habitos as $Habito)
				<div class="form-group">
					<label for="PH{{$loop->iteration}}"><b>{{$Habito['pregunta']}}</b></label>
					<input type="hidden" id="PH{{$loop->iteration}}"  name="PH{{$loop->iteration}}" value="{{$Habito['pregunta']}}" >
					@foreach ($Habito['opciones'] as $opcion)
						<div class="custom-control custom-radio">
					    <input type="radio" id="RHOp{{$loop->parent->iteration.$loop->iteration}}" name="RH{{$loop->parent->iteration}}" class="custom-control-input" value="{{$opcion}}">
					    <label class="custom-control-label" for="RHOp{{$loop->parent->iteration.$loop->iteration}}">{{$opcion}}</label>
					  </div>
				 	@endforeach
				</div>
			@endforeach
			<input type="button" name="habitos" class="next btn btn-info" value="Siguiente" />
		</fieldset>

		<fieldset> <!-- TAB2 : Encuesta de los antecedentes PERSONALES del cliente -->
			<legend>Por favor diligencie sus antecedentes personales</legend>
			@foreach ($APersonales as $APersonal)
				<div class="form-group">
					<label for="PP{{$loop->iteration}}"><b>{{$APersonal['pregunta']}}</b></label>
					<input type="hidden" id="PP{{$loop->iteration}}"  name="PP{{$loop->iteration}}" value="{{$APersonal['pregunta']}}" >
					@if($APersonal['tipo'] !== "opciones")
						<div class="col-lg-10">
							<div class="custom-control custom-radio">
				        <input type="radio" id="PNo{{$loop->iteration}}" name="RP{{$loop->iteration}}" class="custom-control-input" checked="" onclick="ocultar('PBloque{{$loop->iteration}}')">
				        <label class="custom-control-label" for="PNo{{$loop->iteration}}">No</label>
			      	</div>
				      <div class="custom-control custom-radio">
				        <input type="radio" id="PSi{{$loop->iteration}}" name="RP{{$loop->iteration}}" class="custom-control-input" onclick="mostrar('PBloque{{$loop->iteration}}')">
				        <label class="custom-control-label" for="PSi{{$loop->iteration}}">Si</label>
				      </div>
				      <div id='PBloque{{$loop->iteration}}' style="display: none;">
				      	@if($APersonal['tipo'] == "radio2")
					        <div>
					          <label>¿Cuáles?: </label> 
					          <input type="text" name="Cuales{{$loop->iteration}}" id="Cuales{{$loop->iteration}}" placeholder="digítelas por favor...">
					        </div>
					      @endif
				        <div>
				          <label>¿Desde qué año?: </label> 
				          <input type="number" min='1900' max="2100" value="2015" name="Anno{{$loop->iteration}}" id="Anno{{$loop->iteration}}">
				        </div>
				      </div>
				    </div>
					@else
						<div class="form-group">
					    <div class="col-lg-10">
					    	@foreach($APersonal['valores'] as $valor)
					      <div class="custom-control custom-checkbox">
					        <input type="checkbox" class="custom-control-input" id="{{$valor}}">
					        <label class="custom-control-label" for="{{$valor}}">{{$valor}}</label>
					      </div>
					      @endforeach
					    </div>
					  </div>
					@endif
				</div>
			@endforeach
			<input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
			<input type="button" name="next" class="next btn btn-info" value="Siguiente" />
		</fieldset>

		<fieldset> <!-- TAB3 : Encuesta sobre los antecedentes FAMILIARES del cliente -->
			<legend>por favor diligencie sus antecedentes familiares</legend>
			@foreach ($AFamiliares as $AFamiliar)
				<div class="form-group"> <!-- 1. muerte prematura -->
			    <label class="control-label"> {{$AFamiliar['pregunta']}} </label>
			    <input type="hidden" id="PF{{$loop->iteration}}"  name="PF{{$loop->iteration}}" value="{{$AFamiliar['pregunta']}}" >
			    <div class="col-lg-10">
			      <div class="custom-control custom-radio">
			        <input type="radio" id="FNo{{$loop->iteration}}" name="RF{{$loop->iteration}}" class="custom-control-input" checked="" onclick="ocultar('FBloque{{$loop->iteration}}')">
			        <label class="custom-control-label" for="FNo{{$loop->iteration}}">No</label>
			      </div>
			      <div class="custom-control custom-radio">
			        <input type="radio" id="FSi{{$loop->iteration}}" name="RF{{$loop->iteration}}" class="custom-control-input" onclick="mostrar('FBloque{{$loop->iteration}}')">
			        <label class="custom-control-label" for="FSi{{$loop->iteration}}">Si</label>
			      </div>
			      <div id='FBloque{{$loop->iteration}}' style="display: none;" class="col-lg-3">
			      	<small>(Señale quiénes)</small>
			        <small id="fileHelp" class="form-text text-muted"><b>Primer grado</b></small>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Pa{{$loop->iteration}}">
			          <label class="custom-control-label" for="Pa{{$loop->iteration}}">Padre </label>
			        </div>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Ma{{$loop->iteration}}">
			          <label class="custom-control-label" for="Ma{{$loop->iteration}}">Madre</label>
			        </div>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Hi{{$loop->iteration}}">
			          <label class="custom-control-label" for="Hi{{$loop->iteration}}">Hijo(a) </label>
			        </div>  
			        <small id="fileHelp" class="form-text text-muted"><b>Segundo Grado</b></small>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Ab{{$loop->iteration}}">
			          <label class="custom-control-label" for="Ab{{$loop->iteration}}">Abuelo(a)  </label>
			        </div>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="He{{$loop->iteration}}">
			          <label class="custom-control-label" for="He{{$loop->iteration}}">Hermano(a)</label>
			        </div>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Ni{{$loop->iteration}}">
			          <label class="custom-control-label" for="Ni{{$loop->iteration}}">Nieto(a) </label>
			        </div>
			        <small id="fileHelp" class="form-text text-muted"><b>Tercer Grado</b></small>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="Ti{{$loop->iteration}}">
			          <label class="custom-control-label" for="Ti{{$loop->iteration}}">Tío(a)  </label>
			        </div>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="So{{$loop->iteration}}">
			          <label class="custom-control-label" for="So{{$loop->iteration}}">Sobrino(a)</label>
			        </div>
			      </div>
	    		</div>
	  		</div>
	  	@endforeach
	  	<input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
	  	<button type="submit" class="btn btn-primary">Terminar</button>
	  	<!-- <input type="submit" name="submit" class="submit btn btn-success" value="Submit" id="submit_data" /> -->
	  </fieldset>

	</form>
@endsection