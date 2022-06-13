/**
 * @author GaryDíaz
 */

var llamadoConcursoFrm = {
	rif_organoente: "",
	numero_proceso: "",
	id_modalidad: "",
	id_mecanismo: "",
	id_objeto_contratacion: "",
	dias_habiles: "",
	fecha_llamado: "",
	fecha_disponible_llamado: "",
	fecha_fin_aclaratoria: "",
	fecha_tope: "",
	fecha_fin_llamado: "",
	denominacion_proceso: "",
	descripcion_contratacion: "",
	web_contratante: "",
	hora_desde: "",
	hora_hasta: "",
	id_estado: "",
	id_municipio: "",
	direccion: "",
	hora_desde_sobre: "",
	id_estado_sobre: "",
	id_municipio_sobre: "",
	direccion_sobre: "",
	lugar_entrega: "",
	observaciones: "",
	estatus: "",
};

var LlamadoConcurso = {
	agregar: function () {
		if (LlamadoConcurso.validarDatos()) {
			$.ajax({
				url: "apirest/llamadoConcurso",
				method: "POST",
				data: llamadoConcursoFrm,
				success: function (json) {
					alert(json.descripcion);
					sncApp.enviarNotificacion(json.descripcion);
					let salida = LlamadoConcurso.mostrarLlamado(json.dato);
					$("#areaLlamadoConcurso").html(salida);
					history.pushState(null, "", "llamadoconcurso");
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		} else {
			alert("Debe revisar los datos antes de enviarlos");
		}
	},
	buscar: function (rif, numeroProceso, idElemento) {
		let url = "apirest/llamadoConcurso/" + rif + "/" + numeroProceso;
		$.ajax({
			url: url,
			method: "GET",
			success: function (json) {
				let salida = LlamadoConcurso.mostrarLlamado(json.dato);
				$("#" + idElemento).html(salida);
			},
			error: function (error) {
				$("#resultadosLlamadoConcurso").html("No hay resultados para mostrar");
				sncApp.notificarError(error);
			},
		});
	},
	buscarPorNumeroProceso: function (numeroProceso) {
		let url = "apirest/llamadoConcurso/" + numeroProceso;
		LlamadoConcurso.consultaAjax(url);
	},
	buscarPorFecha: function (tipoFecha, desde, hasta, propio) {
		let x = propio ? 1 : 0;
		let url =
			"apirest/llamadoConcurso/" +
			tipoFecha +
			"/" +
			desde +
			"/" +
			hasta +
			"/" +
			x;
		LlamadoConcurso.consultaAjax(url, propio);
	},
	buscarPorTexto: function (textoABuscar, propio) {
		let x = propio ? 1 : 0;
		let url = "apirest/llamadoConcurso/" + textoABuscar + "/" + x;
		LlamadoConcurso.consultaAjax(url, propio);
	},
	consultaAjax: function (url, propio) {
		$.ajax({
			url: url,
			method: "GET",
			success: function (json) {
				LlamadoConcurso.mostrarTodos(json.datos, propio);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				$("#resultadosLlamadoConcurso").html("No hay resultados para mostrar");
				sncApp.notificarError(error);
			},
		});
	},
	cambioNumeroProceso: function () {
		llamadoConcursoFrm.numero_proceso = $("#txtNumeroProceso").val();
		if ($("#txtNumeroProceso").val() !== "") {
			$("#errNumeroProceso").html("");
		}
	},
	cambioSltModalidad: function () {
		let id = $("#sltModalidad").val();
		dataLapsos.id_modalidad = id;
		llamadoConcursoFrm.id_modalidad = id;
		if (id) {
			$("#errModalidad").html("");
		}
		LlamadoConcurso.calcularLapsos();
	},
	cambioSltMecanismo: function () {
		let id = $("#sltMecanismo").val();
		dataLapsos.id_mecanismo = id;
		llamadoConcursoFrm.id_mecanismo = id;
		if (id) {
			$("#errMecanismo").html("");
		}
		LlamadoConcurso.calcularLapsos();
	},
	cambioSltObjetoContratacion: function () {
		let id = $("#sltObjetoContratacion").val();
		dataLapsos.id_objeto_contratacion = id;
		llamadoConcursoFrm.id_objeto_contratacion = id;
		if (id) {
			$("#errObjetoContratacion").html("");
		}
		LlamadoConcurso.calcularLapsos();
	},
	cambioSltTipoFiltro: function () {
		$("#chkPropio").prop("disabled", false);
		switch ($("#sltTipoFiltro").val()) {
			case "opcMostrarTodos":
				$("#camposIdentificadores").hide();
				$("#camposFechas").hide();
				$("#camposTextos").hide();
				break;
			case "opcNumeroProceso":
				$("#chkPropio").prop("disabled", true);
				$("#chkPropio").prop("checked", false);
				$("#txtNumeroProceso").val("");
				$("#errNumeroProceso").html("");
				$("#camposIdentificadores").show();
				$("#camposFechas").hide();
				$("#camposTextos").hide();
				break;
			case "opcFechaLlamado":
			case "opcFechaFin":
				$("#txtDesde").val("");
				$("#errDesde").html("");
				$("#txtHasta").val("");
				$("#errHasta").html("");
				$("#camposIdentificadores").hide();
				$("#camposFechas").show();
				$("#camposTextos").hide();
				break;
			case "opcTexto":
				$("#txtTextoABuscar").val("");
				$("#errTextoABuscar").html("");
				$("#camposIdentificadores").hide();
				$("#camposFechas").hide();
				$("#camposTextos").show();
				break;
		}
	},
	cambioTxtFechaLlamado: function () {
		let fecha = $("#txtFechaLlamado").val();
		dataLapsos.fechallamado = fecha;
		llamadoConcursoFrm.fecha_llamado = fecha;
		if (fecha !== "") {
			$("#errFechaLlamado").html("");
		}
		LlamadoConcurso.calcularLapsos();
	},
	cambioTxtFechaFin: function () {
		let fechaFin = $("#txtFechaFin").val();
		let fchNueva = new Date(fechaFin);
		let fchLapso = new Date(lapsosFechas.fecha_fin_llamado);
		if (fchNueva.getTime() < fchLapso.getTime()) {
			$("#errFechaFin").prop("hidden", false);
		} else {
			$("#errFechaFin").prop("hidden", true);
			$.ajax({
				url:
					"apirest/recalcularLapsos/" +
					dataLapsos.rif +
					"/" +
					dataLapsos.fechallamado +
					"/" +
					fechaFin,
				method: "get",
				success: function (json) {
					llamadoConcursoFrm.fecha_fin_llamado = fechaFin;
					llamadoConcursoFrm.dias_habiles = json.datos.dias_habiles;
					llamadoConcursoFrm.fecha_tope = json.datos.fecha_tope;
					lapsosFechas.dias_habiles = json.datos.dias_habiles;
					lapsosFechas.fecha_tope = json.datos.fecha_tope;

					$("#txtFechaTope").val(lapsosFechas.fecha_tope);
					$("#txtDiasHabiles").val(lapsosFechas.dias_habiles);
					$("#txtFechaEntrega").val(fechaFin);
				},
			});
		}
	},
	cambioTxtFechaFinAclaratoria: function () {
		let fechaFinAclaratoria = $("#txtFechaFinAclaratoria").val();
		let fchNueva = new Date(fechaFinAclaratoria);
		let diaSem = fchNueva.getDay();
		let fchLapso = new Date(lapsosFechas.fecha_fin_aclaratoria);
		let fchTope = new Date(lapsosFechas.fecha_tope);
		if (fchNueva.getTime() >= fchLapso.getTime() && fchNueva < fchTope) {
			if (diaSem < 5) {
				llamadoConcursoFrm.fecha_fin_aclaratoria = fechaFinAclaratoria;
				$("#errFechaFinAclaratoria").html("");
			} else {
				$("#errFechaFinAclaratoria").html(
					"La fecha seleccionada está un fin de semana"
				);
			}
		} else {
			if (fchNueva < fchLapso) {
				$("#errFechaFinAclaratoria").html(
					"La fecha no puede ser menor a " +
						formatearFecha(lapsosFechas.fecha_fin_aclaratoria)
				);
			}
			if (fchNueva.getTime() >= fchTope.getTime()) {
				$("#errFechaFinAclaratoria").html(
					"La fecha no puede ser mayor o igual a " +
						formatearFecha(lapsosFechas.fecha_tope)
				);
			}
		}
	},
	cambioDenominacionProceso: function () {
		llamadoConcursoFrm.denominacion_proceso = $(
			"#txtDenominacionProceso"
		).val();
		if ($("#txtDenominacionProceso").val() !== "") {
			$("#errDenominacionProceso").html("");
		}
	},
	cambioDescripcionContratacion: function () {
		llamadoConcursoFrm.descripcion_contratacion = $(
			"#txtDescripcionContratacion"
		).val();
		if ($("#txtDescripcionContratacion").val() !== "") {
			$("#errDescripcionContratacion").html("");
		}
	},
	cambioWebContratante: function () {
		llamadoConcursoFrm.web_contratante = $("#txtWebContratante").val();
		if ($("#txtWebContratante").val() !== "") {
			$("#errWebContratante").html("");
		}
	},
	cambioHoraDesde: function () {
		llamadoConcursoFrm.hora_desde = $("#txtHoraDesde").val();
		if ($("#txtHoraDesde").val() !== "") {
			$("#errHoraDesde").html("");
		}
	},
	cambioHoraHasta: function () {
		llamadoConcursoFrm.hora_hasta = $("#txtHoraHasta").val();
		if ($("#txtHoraHasta").val() !== "") {
			$("#errHoraHasta").html("");
		}
	},
	cambioEstado: function () {
		$.ajax({
			url: "apirest/municipios/" + $("#sltEstado").val(),
			success: function (json) {
				let salida = "<option>[Municipio]</option>\n";
				$.each(json.datos, function (i, municipio) {
					salida +=
						"<option value=" +
						municipio.id +
						">" +
						municipio.descmun +
						"</option>\n";
				});
				$("#sltMunicipio").html(salida);
				llamadoConcursoFrm.id_estado = $("#sltEstado").val();
				$("#errEstado").html("");
			},
		});
	},
	cambioMunicipio: function () {
		llamadoConcursoFrm.id_municipio = $("#sltMunicipio").val();
		if ($("#sltMunicipio").val() !== "") {
			$("#errMunicipio").html("");
		}
	},
	cambioDireccion: function () {
		llamadoConcursoFrm.direccion = $("#txtDireccion").val();
		if ($("#txtDireccion").val() !== "") {
			$("#errDireccion").html("");
		}
	},
	cambioHoraDesdeSobre: function () {
		llamadoConcursoFrm.hora_desde_sobre = $("#txtHoraDesdeSobre").val();
		if ($("#txtHoraDesdeSobre").val() !== "") {
			$("#errHoraDesdeSobre").html("");
		}
	},
	cambioEstadoSobre: function () {
		$.ajax({
			url: "apirest/municipios/" + $("#sltEstadoSobre").val(),
			success: function (json) {
				let salida = "<option>[Municipio]</option>\n";
				$.each(json.datos, function (i, municipio) {
					salida +=
						"<option value=" +
						municipio.id +
						">" +
						municipio.descmun +
						"</option>\n";
				});
				$("#sltMunicipioSobre").html(salida);
				llamadoConcursoFrm.id_estado_sobre = $("#sltEstadoSobre").val();
				$("#errEstadoSobre").html("");
			},
		});
	},
	cambioMunicipioSobre: function () {
		llamadoConcursoFrm.id_municipio_sobre = $("#sltMunicipioSobre").val();
		if ($("#sltMunicipioSobre").val() !== "") {
			$("#errMunicipioSobre").html("");
		}
	},
	cambioObservaciones: function () {
		llamadoConcursoFrm.observaciones = $("#txtObservaciones").val();
		if ($("#txtObservaciones").val() !== "") {
			$("#errObservaciones").html("");
		}
	},
	cambioDireccionSobre: function () {
		llamadoConcursoFrm.direccion_sobre = $("#txtDireccionSobre").val();
		if ($("#txtDireccionSobre").val() !== "") {
			$("#errDireccionSobre").html("");
		}
	},
	cambioLugarEntrega: function () {
		llamadoConcursoFrm.lugar_entrega = $("#txtLugarEntrega").val();
		if ($("#txtLugarEntrega").val() !== "") {
			$("#errLugarEntrega").html("");
		}
	},
	calcularLapsos: function () {
		if (
			dataLapsos.fechallamado !== "" &&
			dataLapsos.id_modalidad > 0 &&
			dataLapsos.id_mecanismo > 0 &&
			dataLapsos.id_objeto_contratacion > 0
		) {
			$.ajax({
				url:
					"apirest/calcularLapsos/" +
					dataLapsos.rif +
					"/" +
					dataLapsos.fechallamado +
					"/" +
					dataLapsos.id_modalidad +
					"/" +
					dataLapsos.id_mecanismo +
					"/" +
					dataLapsos.id_objeto_contratacion,
				method: "get",
				success: function (json) {
					lapsosFechas = json.datos;
					llamadoConcursoFrm.fecha_disponible_llamado =
						lapsosFechas.fecha_disponible_llamado;
					llamadoConcursoFrm.fecha_fin_aclaratoria =
						lapsosFechas.fecha_fin_aclaratoria;
					llamadoConcursoFrm.fecha_tope = lapsosFechas.fecha_tope;
					llamadoConcursoFrm.fecha_fin_llamado = lapsosFechas.fecha_fin_llamado;
					llamadoConcursoFrm.dias_habiles = lapsosFechas.dias_habiles;

					$("#txtFechaInicioAclaratoria").val(lapsosFechas.fecha_llamado);
					$("#txtFechaDisponibleLlamado").val(
						lapsosFechas.fecha_disponible_llamado
					);
					$("#txtFechaFinAclaratoria").val(lapsosFechas.fecha_fin_aclaratoria);
					$("#txtFechaTope").val(lapsosFechas.fecha_tope);
					$("#txtFechaFin").val(lapsosFechas.fecha_fin_llamado);
					$("#txtFechaEntrega").val(lapsosFechas.fecha_fin_llamado);
					$("#txtDiasHabiles").val(lapsosFechas.dias_habiles);
					$("#errFechaFin").html(
						"No puede ser menor que: " +
							formatearFecha(lapsosFechas.fecha_fin_llamado)
					);
				},
			});
		}
	},
	datosEdicion: function (llamadoConcurso) {
		llamadoConcursoFrm = {
			id_modalidad: llamadoConcurso.id_modalidad,
			id_mecanismo: llamadoConcurso.id_mecanismo,
			id_objeto_contratacion: llamadoConcurso.id_objeto_contratacion,
			dias_habiles: llamadoConcurso.dias_habiles,
			fecha_llamado: llamadoConcurso.fecha_llamado,
			fecha_disponible_llamado: llamadoConcurso.fecha_disponible_llamado,
			fecha_fin_aclaratoria: llamadoConcurso.fecha_fin_aclaratoria,
			fecha_tope: llamadoConcurso.fecha_tope,
			fecha_fin_llamado: llamadoConcurso.fecha_fin_llamado,
			denominacion_proceso: llamadoConcurso.denominacion_proceso,
			descripcion_contratacion: llamadoConcurso.descripcion_contratacion,
			web_contratante: llamadoConcurso.web_contratante,
			hora_desde: llamadoConcurso.hora_desde,
			hora_hasta: llamadoConcurso.hora_hasta,
			id_estado: llamadoConcurso.id_estado,
			id_municipio: llamadoConcurso.id_municipio,
			direccion: llamadoConcurso.direccion,
			hora_desde_sobre: llamadoConcurso.hora_desde_sobre,
			id_estado_sobre: llamadoConcurso.id_estado_sobre,
			id_municipio_sobre: llamadoConcurso.id_municipio_sobre,
			direccion_sobre: llamadoConcurso.direccion_sobre,
			lugar_entrega: llamadoConcurso.lugar_entrega,
			observaciones: llamadoConcurso.observaciones,
			estatus: llamadoConcurso.estatus,
		};
	},
	editar: function () {
		if (LlamadoConcurso.validarDatos()) {
			let rif = $("#txtRif").val();
			let numeroProceso = $("#txtNumeroProceso").val();
			$.ajax({
				url: "../apirest/llamadoConcurso/" + rif + "/" + numeroProceso,
				method: "PUT",
				data: llamadoConcursoFrm,
				success: function (json) {
					sncApp.enviarNotificacion(json.descripcion);
					let salida = LlamadoConcurso.mostrarLlamado(json.dato);
					$("#areaLlamadoConcurso").html(salida);
					history.pushState(null, "", "../llamadoconcurso");
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		} else {
			alert("Debe revisar los datos antes de enviarlos");
		}
	},
	filtrar: function () {
		let propio = $("#chkPropio").is(":checked") ? true : false;
		let desde;
		let hasta;
		let ok;
		switch ($("#sltTipoFiltro").val()) {
			case "opcMostrarTodos":
				LlamadoConcurso.listar(propio);
				break;
			case "opcNumeroProceso":
				let numeroProceso = $("#txtNumeroProceso").val();
				if (numeroProceso !== "") {
					LlamadoConcurso.buscarPorNumeroProceso(numeroProceso);
				} else {
					$("#errNumeroProceso").html(
						"El campo número proceso no puede estar vacío"
					);
				}
				break;
			case "opcFechaLlamado":
				desde = $("#txtDesde").val();
				hasta = $("#txtHasta").val();
				ok = true;
				if (desde === "") {
					ok = false;
					$("#errDesde").html("Debe seleccionar una fecha");
				}
				if (hasta === "") {
					ok = false;
					$("#errHasta").html("Debe seleccionar una fecha");
				}
				if (ok) {
					LlamadoConcurso.buscarPorFecha("fechaLlamado", desde, hasta, propio);
				}
				break;
			case "opcFechaFin":
				desde = $("#txtDesde").val();
				hasta = $("#txtHasta").val();
				ok = true;
				if (desde === "") {
					ok = false;
					$("#errDesde").html("Debe seleccionar una fecha");
				}
				if (hasta === "") {
					ok = false;
					$("#errHasta").html("Debe seleccionar una fecha");
				}
				if (ok) {
					LlamadoConcurso.buscarPorFecha("fechaFin", desde, hasta, propio);
				}
				break;
			case "opcTexto":
				let texto = $("#txtTextoABuscar").val();
				if (texto !== "") {
					LlamadoConcurso.buscarPorTexto(texto, propio);
				} else {
					$("#errTextoABuscar").html("El campo no puede estar vacío");
				}
				break;
		}
	},
	listar: function (propio) {
		let url = propio
			? "apirest/llamadoConcursoPropio"
			: "apirest/llamadoConcurso";
		LlamadoConcurso.consultaAjax(url, propio);
	},
	mostrarLlamado: function (llamadoConcurso, propio) {
		let estatus =
			llamadoConcurso.estatus === "Iniciado" && propio
				? '<a href="editllamadoconcurso/' +
				  llamadoConcurso.numero_proceso +
				  '" class="btn btn-info">Editar Llamado</a> | \n\
		Estatus: ' +
				  llamadoConcurso.estatus +
				  "\n"
				: "Estatus: " + llamadoConcurso.estatus + "\n";
		let salida = "";
		salida +=
			'\n\
<div class="card shadow-sm p-3 mb-3">\n\
  <div class="card-header text-center bg-turquesa"> <i class="ion-ios-grid-view-outline"></i> Proceso: ' +
			llamadoConcurso.numero_proceso +
			' | <i class="ion-calendar"></i> Fecha de Llamado: ' +
			formatearFecha(llamadoConcurso.fecha_llamado) +
			'\n\
  </div>\n\
  <div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">LLAMADO A CONCURSO</h5>\n\
    <div class="row">\n\
			<div class="col-sm-4 col-md-4 col-lg-3 col-xl-2"><div class="font-weight-bold text-vinotinto">Número de Proceso: </div>' +
			llamadoConcurso.numero_proceso +
			'\n\
			</div>\n\
			<div class="col-sm-8 col-md-8 col-lg-9 col-xl-10"><div class="font-weight-bold text-vinotinto">Denominación del Proceso: </div>' +
			llamadoConcurso.denominacion_proceso +
			'\n\
			</div>\n\
			<div class="col-sm-4 col-md-4 col-lg-3 col-xl-2"><div class="font-weight-bold text-vinotinto">Fecha de Llamado: </div>' +
			formatearFecha(llamadoConcurso.fecha_llamado) +
			'\n\
			</div>\n\
			<div class="col-sm-8 col-md-8 col-lg-9 col-xl-10"><div class="font-weight-bold text-vinotinto">Descripción de Contratación: </div>' +
			llamadoConcurso.descripcion_contratacion +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">DATOS DEL ÓRGANO O ENTE</h5>\n\
    <div class="row">\n\
			<div class="col-6 col-sm-3 col-md-3 col-lg-2 col-xl-2"><div class="font-weight-bold text-vinotinto">Rif: </div>' +
			llamadoConcurso.rif_organoente +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-3 col-md-2 col-lg-2 col-xl-1"><div class="font-weight-bold text-vinotinto">Siglas: </div>' +
			llamadoConcurso.siglas +
			'\n\
			</div>\n\
			<div class="col-sm-6 col-md-7 col-lg-8 col-xl-6"><div class="font-weight-bold text-vinotinto">Descripción: </div>' +
			llamadoConcurso.organoente +
			'\n\
			</div>\n\
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-3"><div class="font-weight-bold text-vinotinto">Página Web: </div>' +
			llamadoConcurso.web_contratante +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">LAPSOS</h5>\n\
    <div class="row">\n\
			<div class="col-6 col-sm-4 col-md-4 col-lg-4"><div class="font-weight-bold text-vinotinto">Modalidad: </div>' +
			llamadoConcurso.modalidad +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4 col-md-4"><div class="font-weight-bold text-vinotinto">Mecanismo: </div>' +
			llamadoConcurso.mecanismo +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4 col-md-4"><div class="font-weight-bold text-vinotinto">Objeto de Contratación: </div>' +
			llamadoConcurso.objeto_contratacion +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4 col-md-4"><div class="font-weight-bold text-vinotinto">Días hábiles: </div>' +
			llamadoConcurso.dias_habiles +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4 col-md-4"><div class="font-weight-bold text-vinotinto">Fecha de Disponibilidad: </div>' +
			formatearFecha(llamadoConcurso.fecha_disponible_llamado) +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4 col-md-4"><div class="font-weight-bold text-vinotinto">Fecha Fin: </div>' +
			formatearFecha(llamadoConcurso.fecha_fin_llamado) +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">DIRECCIÓN PARA ADQUISICIÓN DE RETIRO DE PLIEGO</h5>\n\
    <div class="row">\n\
			<div class="col-6 col-sm-6 col-md-6 col-lg-2"><div class="font-weight-bold text-vinotinto">Hora desde: </div>' +
			formatearHora(llamadoConcurso.hora_desde) +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-6 col-md-6 col-lg-2"><div class="font-weight-bold text-vinotinto">Hora hasta: </div>' +
			formatearHora(llamadoConcurso.hora_hasta) +
			'\n\
			</div>\n\
			<div class="col-sm-12 col-md-12 col-lg-8"><div class="font-weight-bold text-vinotinto">Dirección: </div>' +
			llamadoConcurso.direccion +
			", Municipio " +
			llamadoConcurso.municipio +
			" (" +
			llamadoConcurso.estado +
			")" +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">PERÍODOS DE ACLARATORIA</h5>\n\
    <div class="row">\n\
			<div class="col-6 col-sm-4"><div class="font-weight-bold text-vinotinto">Fecha Inicio de Aclaratoria: </div>' +
			formatearFecha(llamadoConcurso.fecha_llamado) +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-4"><div class="font-weight-bold text-vinotinto">Fecha Fin de Aclaratoria: </div>' +
			formatearFecha(llamadoConcurso.fecha_fin_aclaratoria) +
			'\n\
			</div>\n\
			<div class="col-sm-4"><div class="font-weight-bold text-vinotinto">Fecha Tope: </div>' +
			formatearFecha(llamadoConcurso.fecha_tope) +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-body">\n\
    <h5 class="card-title text-center bg-dark text-light">APERTURA DE SOBRES</h5>\n\
    <div class="row">\n\
			<div class="col-6 col-sm-6 col-md-6 col-lg-2"><div class="font-weight-bold text-vinotinto">Fecha de Entrega: </div>' +
			formatearFecha(llamadoConcurso.fecha_fin_llamado) +
			'\n\
			</div>\n\
			<div class="col-6 col-sm-6 col-md-6 col-lg-2"><div class="font-weight-bold text-vinotinto">Hora Desde: </div>' +
			formatearHora(llamadoConcurso.hora_desde_sobre) +
			'\n\
			</div>\n\
			<div class="col-sm-12 col-md-12 col-lg-8"><div class="font-weight-bold text-vinotinto">Lugar de Entrega: </div>' +
			llamadoConcurso.lugar_entrega +
			'\n\
			</div>\n\
			<div class="col-sm-12 col-md-12 col-lg-12"><div class="font-weight-bold text-vinotinto">Dirección: </div>' +
			llamadoConcurso.direccion_sobre +
			", Municipio " +
			llamadoConcurso.municipio_sobre +
			" (" +
			llamadoConcurso.estado_sobre +
			")" +
			'\n\
			</div>\n\
		</div>\n\
  </div>\n\
	<div class="card-footer text-center bg-turquesa">\n\
    ' +
			estatus +
			"\n\
  </div>\n\
</div>";
		return salida;
	},
	mostrarTodos: function (list, propio) {
		//(contenedor = undefined) ? "#resultadosLlamadoConcurso" : contenedor;
		let salida = "";
		$.each(list, function (i, llamadoConcurso) {
			salida += LlamadoConcurso.mostrarLlamado(llamadoConcurso, propio);
		});
		$("#resultadosLlamadoConcurso").html(salida);
	},
	validarDatos: function () {
		let ok = true;
		if (llamadoConcursoFrm.numero_proceso === "") {
			$("#errNumeroProceso").html("Debe espepecificar el número de proceso");
			ok = false;
		}
		if (llamadoConcursoFrm.fecha_llamado === "") {
			$("#errFechaLlamado").html("Debe espepecificar la fecha de llamado");
			ok = false;
		}
		if (llamadoConcursoFrm.denominacion_proceso === "") {
			$("#errDenominacionProceso").html(
				"Debe espepecificar la denominación del proceso"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.descripcion_contratacion === "") {
			$("#errDescripcionContratacion").html(
				"Debe espepecificar la descripción de contratación"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.id_modalidad === "") {
			$("#errModalidad").html("Debe escoger la modalidad");
			ok = false;
		}
		if (llamadoConcursoFrm.id_mecanismo === "") {
			$("#errMecanismo").html("Debe escoger el mecanismo");
			ok = false;
		}
		if (llamadoConcursoFrm.id_objeto_contratacion === "") {
			$("#errObjetoContratacion").html(
				"Debe escoger el objeto de contratación"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.hora_desde === "") {
			$("#errHoraDesde").html("Debe escoger una hora desde...");
			ok = false;
		}
		if (llamadoConcursoFrm.hora_hasta === "") {
			$("#errHoraHasta").html("Debe escoger una hora hasta...");
			ok = false;
		}
		if (llamadoConcursoFrm.id_estado === "") {
			$("#errEstado").html("Debe escoger un Estado");
			ok = false;
		}
		if (llamadoConcursoFrm.id_municipio === "") {
			$("#errMunicipio").html("Debe escoger un Municipio");
			ok = false;
		}
		if (llamadoConcursoFrm.direccion === "") {
			$("#errDireccion").html("Debe ingresar la dirección");
			ok = false;
		}
		if (llamadoConcursoFrm.hora_desde_sobre === "") {
			$("#errHoraDesdeSobre").html(
				"Debe ingresar horas desde para la apertura de sobres"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.id_estado_sobre === "") {
			$("#errEstadoSobre").html(
				"Debe escoger el Estado para la apertura de sobres"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.id_municipio_sobre === "") {
			$("#errMunicipioSobre").html(
				"Debe escoger el Municipio para la apertura de sobres"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.direccion_sobre === "") {
			$("#errDireccionSobre").html(
				"Debe ingresar la dirección para la apertura de sobres"
			);
			ok = false;
		}
		if (llamadoConcursoFrm.lugar_entrega === "") {
			$("#errLugarEntrega").html(
				"Debe ingresar el lugar de entrega de los sobres"
			);
			ok = false;
		}
		return ok;
	},
};
