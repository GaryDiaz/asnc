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
//CRUD DATOS BANCARIOS
	//GUARDAR BANCO
	function guardar_datosb(){
		var id_banco 		= $("#id_banco").val();
		var id_tipocuenta   = $("#id_tipocuenta").val();
		var n_cuenta 		= $("#n_cuenta").val();
		var beneficiario    = $("#beneficiario").val();

		if (id_banco == '0') {
			document.getElementById("id_banco").focus();
		}else if(id_tipocuenta == '0'){
			document.getElementById("id_tipocuenta").focus();
		}else if(n_cuenta == ''){
			document.getElementById("n_cuenta").focus();
		}else if(beneficiario == ''){
			document.getElementById("beneficiario").focus();
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
					var datos = new FormData($("#guardar_datosb")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_datosb';
					var base_url = '/index.php/publicaciones/registrar_datosb';
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
	function modal_ver(id_datob){
		var datos = id_datob;
		var dbanco = datos.split("/");
		id_datob = dbanco[0];
		id_banco = dbanco[1];
		id_tipocuenta = dbanco[2];

		//var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_datosb';
		var base_url = '/index.php/Publicaciones/consulta_datosb';

		//var base_url1 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_bancoe';
		var base_url1 = '/index.php/Publicaciones/consulta_bancoe';

		//var base_url2 = window.location.origin+'/asnc/index.php/Publicaciones/consulta_tipocentae';
		var base_url2 = '/index.php/Publicaciones/consulta_tipocentae';

		//LLENA SELECT DENTRO DE MODAL DE BANCOS
		$.ajax({
			url:base_url1,
			method: 'post',
			data: {id_banco: id_banco},
			dataType: 'json',
			success: function(data){
				$('#id_banco_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_banco_edit').append('<option value="'+response['id_banco']+'">'+response['codigo_b']+' '+response['nombre_b']+'</option>');
				});
			}
		})
		//LLENA SELECT DENTRO DE MODAL DE TIPO DE CUENTA
		$.ajax({
			url:base_url2,
			method: 'post',
			data: {id_tipocuenta: id_tipocuenta},
			dataType: 'json',
			success: function(data){
				$('#id_tipocuenta_edit').find('option').not(':first').remove();
				$.each(data, function(index, response){
					$('#id_tipocuenta_edit').append('<option value="'+response['id_tipocuenta']+'">'+response['tipo_cuenta']+'</option>');
				});
			}
		})
		//LLENA EL MODAl
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_datob: id_datob},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_datosb']);
				$('#ncuenta_edit').val(response['n_cuenta']);
				$('#beneficiario_edit').val(response['beneficiario']);
				$('#id_bancoc').val(response['id_banco']);
				$('#bancoc').val(response['nombre_b']);
				$('#id_tipocuentac').val(response['id_tipocuenta']);
				$('#tipocuentac').val(response['tipo_cuenta']);
			}
		});
	}
	//EDITAR BANCO
	function editar_datosb(){
		var id_datosb = $("#id").val();

		var id_bancoc = $("#id_bancoc").val();
		var id_banco_edit = $("#id_banco_edit").val();

		if (id_banco_edit == '0') {
			id_banco = id_bancoc
		}else{
			id_banco = id_banco_edit
		}

		var id_tipocuentac = $("#id_tipocuentac").val();
		var id_tipocuenta_edit = $("#id_tipocuenta_edit").val();

		if (id_tipocuenta_edit == '0') {
			id_tipocuenta = id_tipocuentac
		}else{
			id_tipocuenta = id_tipocuenta_edit
		}

		var ncuenta_edit = $("#ncuenta_edit").val();
		var beneficiario_edit = $("#beneficiario_edit").val();

		if (ncuenta_edit == '') {
			document.getElementById("ncuenta_edit").focus();
		}else if(beneficiario_edit == ''){
			document.getElementById("beneficiario_edit").focus();
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
					//var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_datosb';
					var base_urls = '/index.php/publicaciones/editar_datosb';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_datosb : id_datosb,
								id_banco : id_banco,
								id_tipocuenta : id_tipocuenta,
								ncuenta_edit : ncuenta_edit,
								beneficiario_edit : beneficiario_edit
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
	function eliminar_datosb(id){
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
				var id_datosb = id
				//var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_datosb';
				var base_url = '/index.php/publicaciones/eliminar_datosb';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_datosb: id_datosb
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
