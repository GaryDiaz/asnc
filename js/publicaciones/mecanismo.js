
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
//CRUD MECANISMO
	//GUARDAR
	function guardar_mec(){
		var id_modalidad = $("#id_modalidad").val();
		var descr_mecanismo = $("#descr_mecanismo").val();

		if (id_modalidad == '0') {
			document.getElementById("id_modalidad").focus();
		}else if(descr_mecanismo == ''){
			document.getElementById("descr_mecanismo").focus();
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
					var datos = new FormData($("#guardar_mec")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_mec';
					var base_url = '/index.php/publicaciones/registrar_mec';
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
	function modal_ver_mec(id){
		var datos = id;
		var dato = datos.split("/");
		id_mecanismo = dato[0];
		id_modalidad = dato[1];

		//var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_mec';
		var base_url = '/index.php/Publicaciones/consulta_mec';

		//var base_url1 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_modalidades';
		var base_url1 = '/index.php/Publicaciones/consulta_modalidades';

		//LLENA SELECT DENTRO DE MODAL DE MECANISMO
		$.ajax({
			url:base_url1,
			method: 'post',
			data: {id_modalidad: id_modalidad},
			dataType: 'json',
			success: function(data){
				$('#id_modalidad_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_modalidad_edit').append('<option value="'+response['id_modalidad']+'">'+response['decr_modalidad']+'</option>');
				});
			}
		})

		$.ajax({
			url: base_url,
			method:'post',
			data: {id_mecanismo: id_mecanismo,
						id_modalidad: id_modalidad},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_mecanismo']);
				$('#id_modalidadc').val(response['id_modalidad']);
				$('#decr_modalidadc').val(response['decr_modalidad']);
				$('#decr_mecanismo_edit').val(response['decr_mecanismo']);
			}
		});
	}
	//EDITAR
	function editar_mec(){
		var id_mecanismo = $("#id").val();
		var id_modalidadc = $("#id_modalidadc").val();
		var id_modalidad_edit = $("#id_modalidad_edit").val();
		var decr_mecanismo = $("#decr_mecanismo_edit").val();

		if (id_modalidad_edit =='0') {
			id_modalidad = id_modalidadc
		}else{
			id_modalidad = id_modalidad_edit
		}

		if (decr_mecanismo_edit == '') {
			document.getElementById("decr_mecanismo_edit").focus();
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
					//var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_mec';
					var base_urls = '/index.php/publicaciones/editar_mec';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_mecanismo: id_mecanismo,
							   id_modalidad: id_modalidad,
							   decr_mecanismo: decr_mecanismo
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
	function eliminar_mec(id){
		event.preventDefault();
		swal.fire({
			title: '¿Seguro que desea eliminar el registro?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: '¡Si, eliminar!'
		}).then((result) => {
			if (result.value == true) {
				var id_mecanismo = id
				//var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_mec';
				var base_url = '/index.php/publicaciones/eliminar_mec';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_mecanismo: id_mecanismo
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
