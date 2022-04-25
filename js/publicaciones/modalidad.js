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
//CRUD MODALIDAD
	//GUARDAR
	function guardar_modalidad(){
		var decr_modalidad = $("#decr_modalidad").val();

		if (decr_modalidad == '') {
			document.getElementById("decr_modalidad").focus();
		}else{
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
					var datos = new FormData($("#guardar_modalidad")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_modalidad';
					var base_url = '/index.php/publicaciones/registrar_modalidad';
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
	function modal_ver_mod(id){
		var id_modalidad = id;
		//var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_mod';
		var base_url = '/index.php/Publicaciones/consulta_mod';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_modalidad: id_modalidad},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_modalidad']);
				$('#decr_modalidad_edit').val(response['decr_modalidad']);
			}
		});
	}
	//EDITAR BANCO
	function editar_m(){
		var id_modalidad = $("#id").val();
		var decr_modalidad = $("#decr_modalidad_edit").val();

		if (decr_modalidad == '') {
			document.getElementById("decr_modalidad").focus();
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
					//var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_m';
					var base_urls = '/index.php/publicaciones/editar_m';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_modalidad: id_modalidad,
							decr_modalidad: decr_modalidad
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
	function eliminar_m(id){
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
				var id_modalidad = id
				//var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_m';
				var base_url = '/index.php/publicaciones/eliminar_m';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_modalidad: id_modalidad
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
