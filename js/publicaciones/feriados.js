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
//GUARDAR BANCO
function guardar_fer(){
	var dia = $("#dia").val();
	var descripcion = $("#descripcion").val();

	console.log(dia);

	if (dia == '') {
		document.getElementById("dia").focus();
	}else if(descripcion == ''){
		document.getElementById("descripcion").focus();
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
				var datos = new FormData($("#guardar_feri")[0]);
				var base_url =window.location.origin+'/asnc/index.php/publicaciones/registrar_fer';
				//var base_url = '/index.php/publicaciones/registrar_fer';
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
	var id_feriado_n = id;
	var base_url = window.location.origin+'/asnc/index.php/Publicaciones/consulta_d';
	//var base_url = '/index.php/Publicaciones/consulta_d';
	$.ajax({
		url: base_url,
		method:'post',
		data: {id_feriado_n: id_feriado_n},
		dataType:'json',

		success: function(response){
			$('#id').val(response['id_feriado_n']);
			$('#dia_edit').val(response['dia']);
			$('#descripcion_edit').val(response['descripcion']);
		}
	});
}
//EDITAR BANCO
function editar_d(){
	var id_feriado = $("#id").val();
	var dia = $("#dia_edit").val();
	var descripcion = $("#descripcion_edit").val();

	if (dia == '') {
		document.getElementById("dia_edit").focus();
	}else if(descripcion == ''){
		document.getElementById("descripcion_edit").focus();
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
				var base_urls =window.location.origin+'/asnc/index.php/publicaciones/editar_d';
				//var base_urls = '/index.php/publicaciones/editar_d';
				$.ajax({
					url: base_urls,
					method:'post',
					data: {id_feriado: id_feriado,
							dia: dia,
							descripcion: descripcion
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
function eliminar_d(id){
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
			var id_feriado_n = id
			var base_url =window.location.origin+'/asnc/index.php/publicaciones/eliminar_d';
			//var base_url = '/index.php/publicaciones/eliminar_d';

			$.ajax({
				url:base_url,
				method: 'post',
				data:{
					id_feriado_n: id_feriado_n
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
