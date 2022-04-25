
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

//CRUD BANCO
	//GUARDAR BANCO
	function guardar_b(){
		var codigo_b = $("#codigo_b").val();
		var nombre_b = $("#nombre_b").val();

		if (codigo_b == '') {
			document.getElementById("codigo_b").focus();
		}else if(nombre_b == ''){
			document.getElementById("nombre_b").focus();
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
					var datos = new FormData($("#guardar_ba")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_b';
					var base_url = '/index.php/publicaciones/registrar_b';
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
	function modal_ver(id){
		var id_banco = id;
		//var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_b';
		var base_url = '/index.php/Publicaciones/consulta_b';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_banco: id_banco},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_banco']);
				$('#cod_banco_edit').val(response['codigo_b']);
				$('#nombre_banco_edit').val(response['nombre_b']);
			}
		});
	}
	//EDITAR BANCO
	function editar_b(){
		var id_banco = $("#id").val();
		var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (codigo_b == '') {
			document.getElementById("codigo_b").focus();
		}else if(nombre_b == ''){
			document.getElementById("nombre_b").focus();
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
					//var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_b';
					var base_urls = '/index.php/publicaciones/editar_b';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							codigo_b: codigo_b,
							nombre_b: nombre_b
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
	function eliminar_b(id){
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
				var id_banco = id
				//var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_b';
				var base_url = '/index.php/publicaciones/eliminar_b';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_banco: id_banco
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
