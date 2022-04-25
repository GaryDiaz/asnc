function llenar(){
	var id_modalidad = $('#id_modalidad').val();

	var base_url = window.location.origin+'/asnc/index.php/Publicaciones/buscar_mec';
	//var base_url = '/index.php/Publicaciones/buscar_mec';
	$.ajax({
		url: base_url,
		method:'post',
		data: {id_modalidad: id_modalidad},
		dataType:'json',

		success: function(response){
			$('#id_mecanismo').find('option').not(':first').remove();
			$.each(response, function(index, data){
				$('#id_mecanismo').append('<option value="'+data['id_mecanismo']+'">'+data['decr_mecanismo']+'</option>');
			});
		}
	});
}

function llenar_municipio(){
    var id_estado_n = $('#id_estado').val();
    var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_municipio';
    //var base_url = '/index.php/evaluacion_desempenio/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}

function llenar_parroquia(){
    var id_municipio_n = $('#id_estado').val();
    var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_parroquia';
    //var base_url = '/index.php/evaluacion_desempenio/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}

function llenar_municipio_n(){
    var id_estado_n = $('#id_estado_n').val();
    var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_municipio';
    //var base_url = '/index.php/evaluacion_desempenio/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}

function llenar_parroquia_n(){
    var id_municipio_n = $('#id_estado_n').val();
    var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_parroquia';
    //var base_url = '/index.php/evaluacion_desempenio/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}

function llenarca(){
	var id_modalidad = $('#id_modalidad').val();
	var id_mecanismo = $('#id_mecanismo').val();
	var id_obj_cont	 = $('#id_obj_cont').val();

	var base_url = window.location.origin+'/asnc/index.php/Publicaciones/buscar_act';
	//var base_url = '/index.php/Publicaciones/buscar_act';

	$.ajax({
		url: base_url,
		method:'post',
		data: {id_modalidad: id_modalidad,
			   id_mecanismo: id_mecanismo,
			   id_obj_cont: id_obj_cont},
		dataType:'json',

		success: function(response){
			$('#id_actividad').find('option').not(':first').remove();
			$.each(response, function(index, data){
				$('#id_actividad').append('<option value="'+data['id_actividad']+'">'+data['dias']+'</option>');
			});
		}
	});
}
//LLENA EL CAMPO DE DÍAS PARA EDITAR
function llenar_act(){
	var id_actividad = $('#id_actividad').val();

	var base_url = window.location.origin+'/asnc/index.php/Publicaciones/buscar_act_e';
	//var base_url = '/index.php/Publicaciones/buscar_act_e';

	$.ajax({
		url: base_url,
		method:'post',
		data: {id_actividad: id_actividad},
		dataType:'json',

		success: function(response){
			$('#act').val(response['dias']);
		}
	});
}

function verificar(){
	var check = document.getElementById('inlineCssCheckbox2').checked;
	if (check == true) {
		$("#datos1").show();
	}else{
		$("#datos1").hide();
	}
}

function verificar2(){
	var check = document.getElementById('inlineCssCheckbox3').checked;
	if (check == true) {
		$("#datos2").show();
	}else{
		$("#datos2").hide();
	}
}

function calcular_dias(){
	//la fecha
		var TuFecha = new Date($('#fecha_llamado').val());
		var numero = document.getElementById('act');
	//dias a sumar
		var numero_fij = 1;
		var dias = parseInt(numero.value);
		TuFecha.setDate(TuFecha.getDate() + numero_fij);
		console.log(TuFecha);
		//nueva fecha nueva a sumar
		var dias = parseInt(numero.value);
		TuFecha.setDate(TuFecha.getDate() + dias);
		//formato de salida para la fecha
		resultado.innerText = TuFecha.getDate() + '/' +
		(TuFecha.getMonth() + 1) + '/' + TuFecha.getFullYear();



}
