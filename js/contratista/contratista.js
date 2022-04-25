function consultar_rif() { //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b').val();
    if (rif_b == '') {
        swal({
            title: "¡ATENCION!",
            text: "El campo no puede estar vacio.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else{
        $("#items").show();
        //var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista';S
        var base_url = '/index.php/contratista/llenar_contratista';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { rif_b: rif_b },
            dataType: 'json',
            success: function (data) {
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                    $('#exitte').val(0);

                } else {
                    $("#existe").show();
                    $("#no_existe").hide();

                    $('#exitte').val(1);
                    $('#descedocont').val(data['descedocont']);
                    $('#infoadic').val(data['infoadic']);
                    $('#idedocontratistas').val(data['idedocontratistas']);
                    $('#rif_cont').val(data['rifced']);
                    $('#nombre').val(data['nombre']);
                    $('#tipopersona').val(data['tipopersona']);
                    $('#descdencom').val(data['descdencom']);
                    $('#descobjcont').val(data['descobjcont']);
                    $('#dirfiscal').val(data['dirfiscal']);
                    $('#percontacto').val(data['percontacto']);
                    $('#tele11').val(data['tele11']);
                    $('#fecactsusc_at').val(data['fecactsusc_at']);
                    $('#fecvencsusc_at').val(data['fecvencsusc_at']);
                    $('#numcertrnc2').val(data['numcertrnc2']);
                    $('#nro_correlativo').val(data['nro_correlativo']);
                    $('#fecinscrnc_at2').val(data['fecinscrnc_at2']);
                    $('#fecvencrnc_at2').val(data['fecvencrnc_at2']);
                    $('#situacionact').val(data['descedocont']);
                    $('#proceso_id').val(data['proceso_id']);
                }
            }
        });
    }
}


//PARA LLENAR LA TABLA DE BUSQUEDA POR NOMBRE
function consultar_nombre(){
	var nombre = $('#nombre').val();
	if (nombre == '') {
		swal({
			title: "¡ATENCION!",
			text: "El campo no puede estar vacio.",
			type: "warning",
			showCancelButton: false,
			confirmButtonColor: "#00897b",
			confirmButtonText: "CONTINUAR",
			closeOnConfirm: false
		}, function () {
			swal("Deleted!", "Your imaginary file has been deleted.", "success");
		});
		$('#ueba').attr("disabled", true);
	}else{
		$("#items").show();
		//var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_nombre';
		var base_url = '/index.php/Contratista/llenar_contratista_nombre';

		$.ajax({
			url: base_url,
			method: 'post',
			data: { nombre: nombre },
			dataType: 'json',
			success: function(data) {
				$('#tabla tbody').children().remove()
				$.each(data, function(index, response){
					$('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
														+ response['nombre'] + '</td><td>'
														+ response['descobjcont'] + '</td><td>'
														+ '<button class="boton2 btn"> <a href="llenar_contratista_nombre_ind?id='+ response['rifced'] +'">VER</button></td></tr>');
				});
			}
		});
	}
}

//PARA LLENAR LA TABLA DE BUSQUEDA POR OBJETO DE CONTRATACIÓN
function consultar_objContr(){
	var obj_cont = $('#obj_cont').val();
	var nombre = $('#nombre').val();
	var estado_id = $('#estado_id').val();
	if (obj_cont == '0' && estado_id == ''  && estado_id == '') {
		swal({
			title: "¡ATENCION!",
			text: "El campo no puede estar vacio.",
			type: "warning",
			showCancelButton: false,
			confirmButtonColor: "#00897b",
			confirmButtonText: "CONTINUAR",
			closeOnConfirm: false
		}, function () {
			swal("Deleted!", "Your imaginary file has been deleted.", "success");
		});
		$('#ueba').attr("disabled", true);
	}else{
		$("#items").show();

		//var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_objCont';
		var base_url = '/index.php/Contratista/llenar_contratista_objCont';

		$.ajax({
			url: base_url,
			method: 'post',
			data: { obj_cont: obj_cont,
					nombre: nombre,
					estado_id : estado_id},
			dataType: 'json',
			success: function(data) {
				$('#tabla tbody').children().remove()
				$.each(data, function(index, response){
					$('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
														+ response['nombre'] + '</td><td>'
														+ response['descobjcont'] + '</td><td>'
														+ '<button class="boton2 btn"> <a href="llenar_contratista_nombre_ind?id='+ response['rifced'] +'">VER</button></td></tr>');
				});
			}
		});
	}
}

function mayusculas(e) {
e.value = e.value.toUpperCase();
}

$(document).ready(function(){
	$('.action').click(function(){
		var st = $(this).attr('name');
		$('#id').attr('value',st);
		$('.send').click();
	});
});

function valideKey(evt) {
	var code = (evt.which) ? evt.which : evt.keyCode;
	if (code == 8) { // backspace.
		return true;
	} else if (code >= 48 && code <= 57) { // is a number.
		return true;
	} else { // other keys.
		return false;
	}
}

var call = function(id){
	var x = document.getElementById(id).value;
	//  alert(x);
	$.post("http://sistemaintegradoprueba.snc.gob.ve/index.php/Contratista/ver_comprobante",{"texto":x},function(respuesta){
		//	alert(respuesta);
	});
}

function enviar(){
		// Esta es la variable que vamos a pasar
		var miVariableJS=$("#rif_cont").val();

		// Enviamos la variable de javascript a archivo.php
		$.post("/index.php/Contratista/ver_comprobante",{"texto":miVariableJS},function(respuesta){
			//alert(respuesta);


		});
	redirect('/index.php/Contratista/ver_comprobante');
}
