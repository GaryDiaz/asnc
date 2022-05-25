/**
 * @author GaryDíaz
 */

var organoEnteFrm;
var OrganoEnte = {
	cambioSltTipoOrganoEnte: function () {
		let tipo = $("#sltTipoOrganoEnte").val();
		organoEnteFrm.tipo_organoente = tipo;
		OrganoEnte.cargarSltOrganoEnteAdc(tipo);
	},
	cambioSltOrganoEnteAds: function () {
		organoEnteFrm.id_organoenteads = $("#sltOrganoEnteAds").val();
	},
	cambioSltEstado: function () {
		let idEstado = $("#sltEstado").val();
		organoEnteFrm.id_estado = idEstado;
		OrganoEnte.cargarSltMunicipio(idEstado);
	},
	cambioSltMunicipio: function () {
		organoEnteFrm.id_municipio = $("#sltMunicipio").val();
	},
	cambioSltParroquia: function () {
		alert($("#sltParroquia").val());
		organoEnteFrm.id_parroquia = $("#sltParroquia").val();
	},
	cargarSltMunicipio: function (idEstado) {
		$.ajax({
			url: "apirest/municipios/" + idEstado,
			method: "GET",
			success: function (json) {
				let salida = "<option>[Municipio]<option/>\n";
				$.each(json.datos, function (i, mun) {
					salida +=
						'<option value="' + mun.id + '">' + mun.descmun + "<option/>\n";
				});
				$("#sltMunicipio").html(salida);
			},
		});
	},
	cargarSltParroquia: function (idEstado) {
		$.ajax({
			url: "apirest/parroquias/" + idEstado,
			method: "GET",
			success: function (json) {
				let salida = "<option>[Parroquia]<option/>\n";
				$.each(json.datos, function (i, parro) {
					salida +=
						'<option value="' +
						parro.id +
						'">' +
						parro.descparro +
						"<option/>\n";
				});
				$("#sltParroquia").html(salida);
			},
		});
	},
	cargarSltOrganoEnteAdc: function (tipoOrganoEnte) {
		switch (tipoOrganoEnte) {
			case "0":
				$("#sltOrganoEnteAds").prop("disabled", true);
				organoEnteFrm.id_organoenteads = 0;
				let salida = "<option value=0>No aplica<option/>";
				$("#sltOrganoEnteAds").html(salida);
				break;
			case "1":
				$.ajax({
					url: "apirest/organospadres",
					method: "GET",
					success: function (json) {
						let salida = "<option>[Órgano Padre]<option/>\n";
						$.each(json.datos, function (i, oe) {
							salida +=
								'<option value="' +
								oe.id_organoente +
								'">' +
								oe.descripcion +
								"<option/>\n";
						});
						$("#sltOrganoEnteAds").prop("disabled", false);
						$("#sltOrganoEnteAds").html(salida);
					},
				});
				break;
			case "2":
				$.ajax({
					url: "apirest/organos",
					method: "GET",
					success: function (json) {
						let salida = "<option>[Órgano Adsctito]<option/>\n";
						$.each(json.datos, function (i, oe) {
							salida +=
								'<option value="' +
								oe.id_organoente +
								'">' +
								oe.descripcion +
								"<option/>\n";
						});
						$("#sltOrganoEnteAds").prop("disabled", false);
						$("#sltOrganoEnteAds").html(salida);
					},
				});
				break;
		}
	},
	dialogoPerfilInstitucional: function () {
		$.ajax({
			url: "apirest/miperfilinstitucional",
			method: "GET",
			success: function (json) {
				organoEnteFrm = json.dato;
				let oe = json.dato;
				$("#txtRif").val(oe.rif);
				$("#txtDescripcion").val(oe.descripcion);
				$("#txtCodOnapre").val(oe.cod_onapre);
				$("#txtSiglas").val(oe.siglas);
				$("#txtDireccion").val(oe.direccion);
				$("#txtGaceta").val(oe.gaceta);
				$("#txtFechaGaceta").val(oe.fecha_gaceta);
				$("#txtPaginaWeb").val(oe.pagina_web);
				$("#txtCorreo").val(oe.correo);
				$("#txtTel1").val(oe.tel1);
				$("#txtTel2").val(oe.tel2);
				$("#txtMovil1").val(oe.movil1);
				$("#txtMovil2").val(oe.movil2);
				$("#sltTipoOrganoEnte").val(oe.tipo_organoente);
				OrganoEnte.cambioSltTipoOrganoEnte();
				$.ajax({
					url: "apirest/estados",
					success: function (json2) {
						estados = json2.datos;
						let salida = "<option>[Estado]</option>\n";
						$.each(estados, function (i, estado) {
							salida +=
								"<option value=" +
								estado.id +
								">" +
								estado.descedo +
								"</option>\n";
						});
						$("#sltEstado").html(salida);
						$("#sltEstado").val(oe.id_estado);
						$.ajax({
							url: "apirest/municipios/" + oe.id_estado,
							success: function (json3) {
								let municipios = json3.datos;
								salida = "<option>[Municipio]</option>";
								$.each(municipios, function (i, mun) {
									salida +=
										"<option value=" +
										mun.id +
										">" +
										mun.descmun +
										"</option>\n";
								});
								$("#sltMunicipio").html(salida);
								$("#sltMunicipio").val(oe.id_municipio);
								$.ajax({
									url: "apirest/parroquias/" + oe.id_estado,
									success: function (json4) {
										let parroquias = json4.datos;
										salida = "<option>[Parroquia]</option>";
										$.each(parroquias, function (i, prr) {
											salida +=
												"<option value=" +
												prr.id +
												">" +
												prr.descparro +
												"</option>\n";
										});
										$("#sltParroquia").html(salida);
										$("#sltParroquia").val(oe.id_parroquia);
									},
								});
							},
						});
					},
				});
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/organo",
			method: "PUT",
			data: organoEnteFrm,
			success: function (json) {
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
};
