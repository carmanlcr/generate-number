$(document).ready(function(){
	$('#idRrss').on('change',function(){
		var idRrss = $(this).val();
		if(idRrss.length != 0 && idRrss != 0){
			$('#idCampana').empty();
			$('#idGenere').empty();
			var textRedSocial = $('#idRrss option:selected').text();
			if(textRedSocial === 'Facebook'){
				$('#facebookPublication').removeAttr('hidden');
				$('#facebookMiembros').removeAttr('hidden');
				$('#facebookGroups').removeAttr('hidden');
			}else{
				$('#facebookMiembros').attr('hidden',true);
				$('#facebookPublication').attr('hidden',true);
				$('#facebookGroups').attr('hidden',true);
			}

			$('#idCampana').append("<option>Cargando...</option>");
			$.get('api/getCampaingForRrss',{idRrss: idRrss},function(campaign){
			}).done(function(campaign){
				$('#idCampana').empty();
				$('#idCampana').append("<option value='0'> Seleccione una opción </option>");
				$.each(campaign,function(index,value) {
					$('#idCampana').append("<option value='"+index+"'>"+value+"</option>");
				});
			}).fail(function(){
					$('#idCampana').empty();
				$('#idCampana').append("<option value='0' > OBTENIENDO DATOS</option>");
				
				});
		}else {
			$('#idCampana').empty();
			$('#idGenere').empty();
			$('#facebookMiembros').attr('hidden',true);
			$('#facebookPublication').attr('hidden',true);
		}
	});

	$('#idCampana').on('change',function(){
		var campaings_id = $(this).val();
		if(campaings_id != '' && campaings_id.length != 0 && campaings_id != 0){
			$('#idGenere').empty();
			$('#cardUsers').attr('hidden',true);
			$('#idGenere').append("<option>Cargando...</option>");
			$.get('api/getGeneres', {campaings_id: campaings_id}, function(generes){
			}).done(function(generes) {
				$('#idGenere').empty();
				$('#idGenere').append("<option value='0'> Seleccione una opción </option>");
				$.each(generes, function(index, value){
					$('#idGenere').append("<option value='"+index+"'>"+value+"</option>");
				});
				}).fail(function(){
					$('#idGenere').empty();
				$('#idGenere').append("<option value='0'> SIN GENERO</option>");
				
				});
		}
	});

	$('#idGenere').on('change',function(){
		var campaings_id = $('#idCampana').val();
		var rrss_id = $('#idRrss').val();
		if(campaings_id != '' || rrss_id != ''){
			console.log(rrss_id);
			var textRedSocial = $('#idRrss option:selected').text();
			$('#titleH5Users').text(textRedSocial);
			$('#cardUsers').removeAttr('hidden');
			$('#cardBody').empty();
			$('#cardBody').append("<h1> CARGANDO USUARIOS <div class='spinner-border' role='status'>  <span class='sr-only'>Loading...</span> </div> </h1>");
			$.get('api/getUsersForCategories',{campaings_id: campaings_id, rrss_id: rrss_id},function(users){
			}).done(function(users){
				$('#cardBody').empty();
				$.each(users, function(index, value){
					$('#cardBody').append("<span class='text-primary col-md-4'> <input type='checkbox' aria-label='Checkbox for following text input' value='"+index+"' name='users_id[]' id='users_id'> "+value+"</span>");
				});
			}).fail(function(){
				$('#cardBody').empty();
				$('#cardBody').append("<h1 class='text-danger'> ERROR AL CARGAR USUARIOS </h1>");
			});
		}
	});

	$('#isFanPage').on('change',function(){
		if( parseInt($(this).val()) == 1){
			$(this).val(0);
		}else{
			$(this).val(1);
		}
	});

	$('#isGroups').on('change',function(){
		if( parseInt($(this).val()) == 1){
			$(this).val(0);
		}else{
			$(this).val(1);
		}
	});

	$('#selectAll').click(function(){
		var users = $("input[type=checkbox]");
		users.prop('checked', $(this).prop('checked'));
	});
});