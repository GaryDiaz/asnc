
//TODO MAYUSCULA
function may(e){
	e.value = e.value.toUpperCase();
}
//SOLO NÚMEROS
function valideKey(evt){
	var code = (evt.which) ? evt.which : evt.keyCode;
	if(code==8) { // backspace.
		return true;
	}else if(code>=48 && code<=57) { // is a number.
		return true;
	}else{ // other keys.
		return false;
	}
}
//CRUD ACTIVIDAD
	function buscar_mec(){
		var id_modalidad = $('#id_modalidad').val();

		var base_url = window.location.origin+'/asnc/index.php/Publicaciones/buscar_mec';
		//var base_url = '/index.php/publicaciones/buscar_mec';
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
	//CARGAR MINIMO DE DÏAS POR OBJ DE CONTRATACIÓN
	function minimo_obj(){
		var id_obj_cont 	= $("#id_obj_cont").val();
		var dias 			= $("#dias").val();
	
		if (id_obj_cont == 1) {
			if (dias < '7'){
				swal({
					title: "¡ATENCION!",
					text: "La cantidad de días mínimo con el objeto de contratación 'Bien' debe ser mayor o igual a 7 días.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#00897b",
					confirmButtonText: "CONTINUAR",
					closeOnConfirm: false
				}, function(){
					swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
				$('#guardar').attr("disabled", true);
			}else {
				$('#guardar').attr("disabled", false);
			}
		}else if(id_obj_cont == 2){
			if (dias < '9'){
				swal({
					title: "¡ATENCION!",
					text: "La cantidad de días mínimo con el objeto de contratación 'Servicio' debe ser mayor o igual a 9 días.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#00897b",
					confirmButtonText: "CONTINUAR",
					closeOnConfirm: false
				}, function(){
					swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
				$('#guardar').attr("disabled", true);
			}else {
				$('#guardar').attr("disabled", false);
			}
		}else if(id_obj_cont == 3){
			if (dias < '11'){
				swal({
					title: "¡ATENCION!",
					text: "La cantidad de días mínimo con el objeto de contratación 'Obra' debe ser mayor o igual a 11 días.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#00897b",
					confirmButtonText: "CONTINUAR",
					closeOnConfirm: false
				}, function(){
					swal("Deleted!", "Your imaginary file has been deleted.", "success");
				});
				$('#guardar').attr("disabled", true);
			}else {
				$('#guardar').attr("disabled", false);
			}
		}
	}
	//GUARDAR BANCO
	function guardar_act(){
		var id_modalidad 	= $("#id_modalidad").val();
		var id_mecanismo 	= $("#id_mecanismo").val();
		var id_obj_cont     = $("#id_obj_cont").val();
		var dias		 	= $("#dias").val();

		if (id_modalidad == '0') {
			document.getElementById("id_modalidad").focus();
		}else if(id_mecanismo == '0'){
			document.getElementById("id_mecanismo").focus();
		}else if(id_obj_cont == '0'){
			document.getElementById("nombrid_obj_conte_b").focus();
		}else if(dias == ''){
			document.getElementById("dias").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: '¿Registrar?',
				text: '¿Esta seguro de Guardar?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#guardar_act")[0]);
					var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_act';
					//var base_url = '/index.php/publicaciones/registrar_act';
					$.ajax({
						url:base_url,
						method: 'POST',
						data: datos,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != '') {
								swal.fire({
									title: 'Registro Exitoso',
									type: 'success',
									showCancelButton: false,
									confirmButtonColor: '#3085d6',
									confirmButtonText: 'Ok'
								}).then((result) => {
									if (result.value == true){
										location.reload();
									}
								});
							}
						}
					})
				}
			});
		}
	}
	//BUSCAR BANCO PARA EDITAR
	function modal_ver_act(id){
		var datos = id;
		var inf = datos.split("/");
		id_actividad = inf[0];
		id_modalidad = inf[1];
		id_mecanismo = inf[2];
		id_obj_cont  = inf[3];

		var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_act';
		//var base_url = '/index.php/Publicaciones/consulta_act';

		var base_url1 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_modalidades';
		//var base_url1 = '/index.php/Publicaciones/consulta_modalidades';

		//var base_url2 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_mecanismos';
		var base_url2 = '/index.php/Publicaciones/consulta_mecanismos';

		var base_url3 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_objconta';
		//var base_url3 = '/index.php/Publicaciones/consulta_objconta';

		$.ajax({
			url: base_url1,
			method:'post',
			data: {id_modalidad: id_modalidad},
			dataType:'json',
			success: function(data){
				$('#id_modalidad_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_modalidad_edit').append('<option value="'+response['id_modalidad']+'">'+response['decr_modalidad']+'</option>');
				});
			}
		});

		$.ajax({
			url: base_url2,
			method:'post',
			data: {id_mecanismo: id_mecanismo},
			dataType:'json',

			success: function(data){
				$('#id_mecanismo_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_mecanismo_edit').append('<option value="'+response['id_mecanismo']+'">'+response['decr_mecanismo']+'</option>');
				});
			}
		});

		$.ajax({
			url: base_url3,
			method:'post',
			data: {id_obj_cont: id_obj_cont},
			dataType:'json',

			success: function(data){
				$('#id_obj_cont_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_obj_cont_edit').append('<option value="'+response['id_objeto_contrata']+'">'+response['desc_objeto_contrata']+'</option>');
				});
			}
		});

		$.ajax({
			url: base_url,
			method:'post',
			data: {id_actividad: id_actividad},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_actividad']);
				$('#id_modalidadc').val(response['id_modalidad']);
				$('#decr_modalidadc').val(response['decr_modalidad']);
				$('#id_mecanismoc').val(response['id_mecanismo']);
				$('#decr_mecanismoc').val(response['decr_mecanismo']);
				$('#id_obj_contc').val(response['id_obj_cont']);
				$('#id_obj_contc').val(response['id_obj_cont']);
				$('#desc_objeto_contratac').val(response['desc_objeto_contrata']);
				$('#dias_edit').val(response['dias']);
			}
		});
	}
	function editar_act(){
		var id_actividad = $("#id").val();
		var id_modalidadc = $("#id_modalidadc").val();
		var id_modalidad_edit = $("#id_modalidad_edit").val();
		var id_mecanismoc = $("#id_mecanismoc").val();
		var id_mecanismo_edit = $("#id_mecanismo_edit").val();
		var id_obj_contc = $("#id_obj_contc").val();
		var id_obj_cont_edit = $("#id_obj_cont_edit").val();
		var dias = $("#dias_edit").val();

		if (id_modalidad_edit == '0') {
			id_modalidad = id_modalidadc
		}else{
			id_modalidad = id_modalidad_edit
		}

		if (id_mecanismo_edit == '0') {
			id_mecanismo = id_mecanismoc
		}else{
			id_mecanismo = id_mecanismo_edit
		}

		if (id_obj_cont_edit == '0') {
			id_obj_cont = id_obj_contc
		}else{
			id_obj_cont = id_obj_cont_edit
		}

		if (dias_edit == '') {
			document.getElementById("dias_edit").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: 'Modificar?',
				text: '¿Esta seguro de Modificar este registro?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#editar")[0]);
					var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_act';
					//var base_urls = '/index.php/publicaciones/editar_act';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_actividad: id_actividad,
							id_modalidad: id_modalidad,
							id_mecanismo: id_mecanismo,
							id_obj_cont: id_obj_cont,
							dias: dias
						},
					dataType:'json',
						success: function(response){
							if(response != '') {
								swal.fire({
									title: 'Modificación Exitosa',
									type: 'success',
									showCancelButton: false,
									confirmButtonColor: '#3085d6',
									confirmButtonText: 'Ok'
								}).then((result) => {
									if (result.value == true){
										location.reload();
									}
								});
							}
						}
					})
				}
			});
		}
	}
	//ELIMINAR
	function eliminar_act(id){
		event.preventDefault();
		swal.fire({
			title: '¿Seguro que desea eliminar el registro?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: '¡Si, guardar!'
		}).then((result) => {
			if (result.value == true) {
				var id_actividad = id
				var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_act';
				//var base_url = '/index.php/publicaciones/eliminar_act';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_actividad: id_actividad
					},
					dataType: 'json',
					success: function(response){
						if(response == 1) {
							swal.fire({
								title: 'Eliminación Exitosa',
								type: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Ok'
							}).then((result) => {
								if (result.value == true) {
									location.reload();
								}
							});
						}
					}
				})
			}
		});
	}
