
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
//CRUD CUENTA
	//GUARDAR
	function guardar_tc(){
		var tipo_cuenta = $("#tipo_cuenta").val();

		if (tipo_cuenta == '') {
			document.getElementById("tipo_cuenta").focus();
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
					var datos = new FormData($("#guardar_tcu")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_tc';
					var base_url = '/index.php/publicaciones/registrar_tc';
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
	function modal_ver_tc(id){
		var id_tipocuenta = id;
		//var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_tc';
		var base_url = '/index.php/Publicaciones/consulta_tc';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_tipocuenta: id_tipocuenta},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_tipocuenta']);
				$('#tipo_cuenta_edit').val(response['tipo_cuenta']);
			}
		});
	}
	//EDITAR BANCO
	function editar_tc(){
		var id_tipocuenta = $("#id").val();
		var tipo_cuenta = $("#tipo_cuenta_edit").val();

		if (tipo_cuenta == '') {
			document.getElementById("codigo_b").focus();
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
					//var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_tc';
					var base_urls = '/index.php/publicaciones/editar_tc';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_tipocuenta: id_tipocuenta,
							tipo_cuenta: tipo_cuenta
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
	function eliminar_tc(id){
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
				var id_tipocuenta = id
				//var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_tc';
				var base_url = '/index.php/publicaciones/eliminar_tc';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_tipocuenta: id_tipocuenta
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
