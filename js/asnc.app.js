/**
 * @author GaryDíaz
 */

////******************************************************************************
//***                        VARIABLES GLOBALES                              ***
//******************************************************************************
var meses = [
	"enero",
	"febrero",
	"marzo",
	"abril",
	"mayo",
	"junio",
	"julio",
	"agosto",
	"septiembre",
	"octubre",
	"noviembre",
	"diciembre",
];
var estados;
function formatearFecha(txtFecha) {
	let arrayFecha = txtFecha.split("-");
	//return (fecha.getDay()+1)+' de '+ meses[fecha.getMonth()-1]+' de '+fecha.getFullYear();
	return arrayFecha[2] + "-" + arrayFecha[1] + "-" + arrayFecha[0];
}

function formatearHora(txtHora) {
	let arrayHora = txtHora.split(":");
	let hora = arrayHora[0];
	let minuto = arrayHora[1];
	let meridian = "am";
	if (Number(hora) < 12) {
		if (Number(hora) === 0) {
			hora = "12";
		}
	} else {
		if (Number(hora) > 12) {
			if (Number(hora) >= 22) {
				hora = toString(Number(hora) - 12);
			} else {
				hora = "0" + (Number(hora) - 12);
			}
			meridian = "pm";
		}
	}
	//return (fecha.getDay()+1)+' de '+ meses[fecha.getMonth()-1]+' de '+fecha.getFullYear();
	return hora + ":" + minuto + " " + meridian;
}

/**
 * sncApp
 * Es el módulo que GESTIONA de manera general, las interfaces en el FRONT-END
 * @type type
 */
var sncApp = {
	cargarDatosDePagina: function (uri) {
		switch (uri) {
			case "/diasferiados":
				sncApp.inicializarGestionFeriados();
				break;
			case "/gestionlapsos":
				sncApp.inicializarGestionLapsos();
				break;
			case "/perfilinstitucional":
				sncApp.inicializarOrganoEntePropio();
				break;
			case "/llamadoconcurso":
				sncApp.inicializarLlamadoConcurso();
				break;
			case "/regllamadoconcurso":
				sncApp.inicializarRegistroLlamado();
				break;
		}
	},
	enviarNotificacion: function (descripcion, t, i, frm) {
		//    alert(descripcion);
		let titulo = t === undefined ? "ASNC" : t;
		let icono = i === undefined ? "ion-android-done" : i;
		let msj =
			'\n\
    <div class="alert alert-warning alert-dismissible fade show" role="alert">\
      <i class="' +
			icono +
			'"></i> &nbsp; <strong>..:: ' +
			titulo +
			"::.. </strong> " +
			descripcion +
			'\
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
      </button>\
    </div>';
		if (frm === undefined) {
			$("#areaDeNotificacion").html(msj);
		} else {
			if ($("#areaDeNotificacionForm").length) {
				$("#areaDeNotificacionForm").html(msj);
			} else if ($("#areaDeNotificacion").length) {
				$("#areaDeNotificacion").html(msj);
			} else {
				alert(descripcion);
			}
		}
	},
	inicializarGestionLapsos: function () {
		Modalidad.listar();
		Mecanismo.listar();
		ObjetoContratacion.listar();
		Lapso.listar();
	},
	inicializarGestionFeriados: function () {
		FeriadoNacional.listar();
		$.ajax({
			url: "apirest/estados",
			success: function (json) {
				estados = json.datos;
				FeriadoEstadal.cargarSelector();
				FeriadoEstadal.listar();
				FeriadoMunicipal.cargarSelector();
				FeriadoMunicipal.listar();
			},
		});
		FeriadoEspecifico.cargarSelector();
		FeriadoEspecifico.listar();
	},
	inicializarOrganoEntePropio: function () {
		$("#txtRif").prop("disabled", true);
		OrganoEnte.dialogoPerfilInstitucional();
		$("#txtDescripcion").change(function () {
			organoEnteFrm.descripcion = $("#txtDescripcion").val();
		});
		$("#txtCodOnapre").change(function () {
			organoEnteFrm.codigo_onapre = $("#txtCodOnapre").val();
		});
		$("#txtSiglas").change(function () {
			organoEnteFrm.siglas = $("#txtSiglas").val();
		});
		$("#txtDireccion").change(function () {
			organoEnteFrm.direccion = $("#txtDireccion").val();
		});
		$("#txtGaceta").change(function () {
			organoEnteFrm.gaceta = $("#txtGaceta").val();
		});
		$("#txtFechaGaceta").change(function () {
			organoEnteFrm.fecha_gaceta = $("#txtFechaGaceta").val();
		});
		$("#txtPaginaWeb").change(function () {
			organoEnteFrm.pagina_web$("#txtPaginaWeb").val();
		});
		$("#txtCorreo").change(function () {
			organoEnteFrm.correo = $("#txtCorreo").val();
		});
		$("#txtTel1").change(function () {
			organoEnteFrm.tel1 = $("#txtTel1").val();
		});
		$("#txtTel2").change(function () {
			organoEnteFrm.tel2 = $("#txtTel2").val();
		});
		$("#txtMovil1").change(function () {
			organoEnteFrm.movil1 = $("#txtMovil1").val();
		});
		$("#txtMovil2").change(function () {
			organoEnteFrm.movil2 = $("#txtMovil2").val();
		});
		$("#sltTipoOrganoEnte").change(function () {
			OrganoEnte.cambioSltTipoOrganoEnte();
		});
		$("#sltOrganoEnteAds").change(function () {
			OrganoEnte.cambioSltOrganoEnteAds();
		});
		$("#sltEstado").change(function () {
			OrganoEnte.cambioSltEstado();
		});
		$("#sltMunicipio").change(function () {
			OrganoEnte.cambioSltMunicipio();
		});
		$("#sltParroquia").change(function () {
			OrganoEnte.cambioSltParroquia();
		});
		$("#btnGuardar").click(function () {
			OrganoEnte.editar();
		});
	},
	inicializarLlamadoConcurso: function () {
		LlamadoConcurso.cambioSltTipoFiltro();
		$("#sltTipoFiltro").change(function () {
			LlamadoConcurso.cambioSltTipoFiltro();
		});
		LlamadoConcurso.listar();
		$("#btnFiltrarLlamados").click(function () {
			LlamadoConcurso.filtrar();
		});
	},
	inicializarRegistroLlamado: function () {
		$.ajax({
			url: "apirest/miperfilinstitucionaldetalle",
			method: "GET",
			success: function (json) {
				$("#txtRif").val(json.dato.rif);
				dataLapsos.rif = json.dato.rif;
				llamadoConcursoFrm.rif_organoente = json.dato.rif;
				$("#txtSiglas").val(json.dato.siglas);
				$("#txtDescripcion").val(json.dato.descripcion);
				$("#txtDireccionOE").val(
					json.dato.direccion +
						", Municipio " +
						json.dato.municipio +
						", " +
						json.dato.estado
				);
			},
		});
		$.ajax({
			url: "apirest/modalidades",
			success: function (json) {
				let salida = "<option>[Modalidad]</option>\n";
				$.each(json.datos, function (i, modalidad) {
					salida +=
						"<option value=" +
						modalidad.id_modalidad +
						">" +
						modalidad.descripcion +
						"</option>\n";
				});
				$("#sltModalidad").html(salida);
			},
		});
		$.ajax({
			url: "apirest/mecanismos",
			success: function (json) {
				let salida = "<option>[Mecanismo]</option>\n";
				$.each(json.datos, function (i, mecanismo) {
					salida +=
						"<option value=" +
						mecanismo.id_mecanismo +
						">" +
						mecanismo.descripcion +
						"</option>\n";
				});
				$("#sltMecanismo").html(salida);
			},
		});
		$.ajax({
			url: "apirest/objetoscont",
			success: function (json) {
				let salida = "<option>[Objeto de Contratación]</option>\n";
				$.each(json.datos, function (i, oc) {
					salida +=
						"<option value=" +
						oc.id_objeto_contratacion +
						">" +
						oc.descripcion +
						"</option>\n";
				});
				$("#sltObjetoContratacion").html(salida);
			},
		});
		$.ajax({
			url: "apirest/estados",
			success: function (json) {
				let salida = "<option>[Estado]</option>\n";
				$.each(json.datos, function (i, estado) {
					salida +=
						"<option value=" + estado.id + ">" + estado.descedo + "</option>\n";
				});
				$("#sltEstado").html(salida);
				$("#sltEstadoSobre").html(salida);
			},
		});
		$("#txtNumeroProceso").change(function () {
			LlamadoConcurso.cambioNumeroProceso();
		});
		$("#txtFechaLlamado").change(function () {
			LlamadoConcurso.cambioTxtFechaLlamado();
		});
		$("#txtDenominacionProceso").change(function () {
			LlamadoConcurso.cambioDenominacionProceso();
		});
		$("#txtDescripcionContratacion").change(function () {
			LlamadoConcurso.cambioDescripcionContratacion();
		});
		$("#sltModalidad").change(function () {
			LlamadoConcurso.cambioSltModalidad();
		});
		$("#sltMecanismo").change(function () {
			LlamadoConcurso.cambioSltMecanismo();
		});
		$("#sltObjetoContratacion").change(function () {
			LlamadoConcurso.cambioSltObjetoContratacion();
		});
		$("#txtFechaFin").change(function () {
			LlamadoConcurso.cambioTxtFechaFin();
		});
		$("#txtFechaFinAclaratoria").change(function () {
			LlamadoConcurso.cambioTxtFechaFinAclaratoria();
		});
		$("#txtWebContratante").change(function () {
			LlamadoConcurso.cambioWebContratante();
		});
		$("#txtHoraDesde").change(function () {
			LlamadoConcurso.cambioHoraDesde();
		});
		$("#txtHoraHasta").change(function () {
			console.log("la hora hasta ha cambiado");
			LlamadoConcurso.cambioHoraHasta();
		});
		$("#sltEstado").change(function () {
			LlamadoConcurso.cambioEstado();
		});
		$("#sltMunicipio").change(function () {
			LlamadoConcurso.cambioMunicipio();
		});
		$("#txtDireccion").change(function () {
			console.log("la direccion cambio");
			LlamadoConcurso.cambioDireccion();
		});
		$("#txtHoraDesdeSobre").change(function () {
			LlamadoConcurso.cambioHoraDesdeSobre();
		});
		$("#sltEstadoSobre").change(function () {
			LlamadoConcurso.cambioEstadoSobre();
		});
		$("#sltMunicipioSobre").change(function () {
			LlamadoConcurso.cambioMunicipioSobre();
		});
		$("#txtDireccionSobre").change(function () {
			LlamadoConcurso.cambioDireccionSobre();
		});
		$("#txtLugarEntrega").change(function () {
			LlamadoConcurso.cambioLugarEntrega();
		});
		$("#btnGuardar").click(function () {
			LlamadoConcurso.agregar();
		});
	},
	notificarError: function (error) {
		let json = JSON.parse(error.responseText);
		let icon = "ion-alert-circled";
		switch (error.status) {
			case 400:
			case 408:
			case 409:
				icon = "ion-close-circled";
				break;
			case 401:
				icon = "ion-locked";
				break;
			case 403:
			case 404:
				icon = "ion-android-hand";
				break;
		}
		if (json) {
			sncApp.enviarNotificacion(json.descripcion, json.titulo, icon, true);
		} else {
			sncApp.enviarNotificacion(error.responseText, "Error", icon);
		}
	},
};
