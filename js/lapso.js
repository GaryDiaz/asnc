/**
 * @author GaryDíaz
 */

var modalidadFrm = { id_modalidad: 0, descripcion: "" };
var mecanismoFrm = { id_mecanismo: 0, descripcion: "" };
var objetocontFrm = { id_objeto_contratacion: 0, descripcion: "" };
var lapsoFrm = {
	id_modalidad: 0,
	id_mecanismo: 0,
	id_objeto_contratacion: 0,
	dias_habiles: 0,
};
var dataLapsos = {
	rif: "",
	fechallamado: "",
	id_modalidad: 0,
	id_mecanismo: 0,
	id_objeto_contratacion: 0,
};
var lapsosFechas;

var Lapso = {
	agregar: function () {
		$.ajax({
			url: "apirest/lapso",
			method: "POST",
			data: lapsoFrm,
			success: function (json) {
				Lapso.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-calendar-outline"></i> Registro de Lapso'
		);
		$.ajax({
			url: "apirest/modalidades",
			success: function (jsonMod) {
				let modalidades = jsonMod.datos;
				let salida = "<option>[modalidad]</option>";
				$.each(modalidades, function (i, m) {
					salida +=
						'<option value="' +
						m.id_modalidad +
						'">' +
						m.descripcion +
						"</option>";
				});
				$("#sltModalidad").html(salida);
				$("#sltModalidad").change(function () {
					Lapso.cambioModalidadForm();
				});
			},
		});
		$.ajax({
			url: "apirest/mecanismos",
			success: function (jsonMec) {
				let mecanismos = jsonMec.datos;
				let salida = "<option>[mecanismo]</option>";
				$.each(mecanismos, function (i, m) {
					salida +=
						'<option value="' +
						m.id_mecanismo +
						'">' +
						m.descripcion +
						"</option>";
				});
				$("#sltMecanismo").html(salida);
				$("#sltMecanismo").change(function () {
					Lapso.cambioMecanismoForm();
				});
			},
		});
		$.ajax({
			url: "apirest/objetoscont",
			success: function (jsonMod) {
				let objetoscont = jsonMod.datos;
				let salida = "<option>[objetos de contratación]</option>";
				$.each(objetoscont, function (i, oc) {
					salida +=
						'<option value="' +
						oc.id_objeto_contratacion +
						'">' +
						oc.descripcion +
						"</option>";
				});
				$("#sltObjetoCont").html(salida);
				$("#sltObjetoCont").change(function () {
					Lapso.cambioObjetoContForm();
				});
			},
		});
		$("#btnGuardar").click(function () {
			Lapso.agregar();
		});
	},
	dialogoConfirmarBorrar: function (idModalidad, idMecanismo, idObjetoCont) {
		if (
			idModalidad !== undefined &&
			idMecanismo !== undefined &&
			idObjetoCont !== undefined
		) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url:
						"apirest/lapso/" +
						idModalidad +
						"/" +
						idMecanismo +
						"/" +
						idObjetoCont,
					success: function (json) {
						let m = json.dato;
						$("#descripcionDeAccion").html("Está a punto de eliminar el lapso");
						$("#elementoAEliminar").html(m.descripcion);
						$("#btnBorrar").click(function () {
							Lapso.eliminar(idModalidad, idMecanismo, idObjetoCont);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idModalidad, idMecanismo, idObjetoCont) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Edición de Objeto de Contratación'
		);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			Lapso.editar();
		});
		$.ajax({
			url:
				"apirest/lapso/" + idModalidad + "/" + idMecanismo + "/" + idObjetoCont,
			success: function (json) {
				let l = json.dato;
				lapsoFrm = {
					id_modalidad: idModalidad,
					id_mecanismo: idMecanismo,
					id_objeto_contratacion: idObjetoCont,
					dias_habiles: l.dias_habiles,
				};
				$.ajax({
					url: "apirest/modalidades",
					success: function (jsonMod) {
						let modalidades = jsonMod.datos;
						let salida = "<option>[modalidad]</option>";
						$.each(modalidades, function (i, m) {
							salida +=
								'<option value="' +
								m.id_modalidad +
								'">' +
								m.descripcion +
								"</option>";
						});
						$("#sltModalidad").html(salida);
						$("#sltModalidad").val(idModalidad);
						$("#sltModalidad").prop("disabled", true);
					},
				});
				$.ajax({
					url: "apirest/mecanismos",
					success: function (jsonMec) {
						let mecanismos = jsonMec.datos;
						let salida = "<option>[mecanismo]</option>";
						$.each(mecanismos, function (i, m) {
							salida +=
								'<option value="' +
								m.id_mecanismo +
								'">' +
								m.descripcion +
								"</option>";
						});
						$("#sltMecanismo").html(salida);
						$("#sltMecanismo").val(idMecanismo);
						$("#sltMecanismo").prop("disabled", true);
					},
				});
				$.ajax({
					url: "apirest/objetoscont",
					success: function (jsonMod) {
						let objetoscont = jsonMod.datos;
						let salida = "<option>[objetos de contratación]</option>";
						$.each(objetoscont, function (i, oc) {
							salida +=
								'<option value="' +
								oc.id_objeto_contratacion +
								'">' +
								oc.descripcion +
								"</option>";
						});
						$("#sltObjetoCont").html(salida);
						$("#sltObjetoCont").val(idObjetoCont);
						$("#sltObjetoCont").prop("disabled", true);
					},
				});

				$("#txtDiasHabiles").val(l.dias_habiles);
			},
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/lapso",
			method: "PUT",
			data: lapsoFrm,
			success: function (json) {
				Lapso.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idModalidad, idMecanismo, idObjetoCont) {
		$.ajax({
			url:
				"apirest/lapso/" + idModalidad + "/" + idMecanismo + "/" + idObjetoCont,
			method: "DELETE",
			success: function (json) {
				Lapso.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioModalidadForm: function () {
		lapsoFrm.id_modalidad = $("#sltModalidad").val();
	},
	cambioMecanismoForm: function () {
		lapsoFrm.id_mecanismo = $("#sltMecanismo").val();
	},
	cambioObjetoContForm: function () {
		lapsoFrm.id_objeto_contratacion = $("#sltObjetoCont").val();
	},
	cambioDiasHabilesForm: function () {
		lapsoFrm.dias_habiles = $("#txtDiasHabiles").val();
	},
	form: function (idModalidad, idMecanismo, idObjetoCont) {
		$.get("frmLapso", function (html) {
			if (
				idModalidad !== undefined &&
				idMecanismo !== undefined &&
				idObjetoCont !== undefined
			) {
				Lapso.dialogoEditar(html, idModalidad, idMecanismo, idObjetoCont);
			} else {
				Lapso.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});

			$("#txtDiasHabiles").change(function () {
				Lapso.cambioDiasHabilesForm();
			});
		});
	},
	listar: function () {
		$.ajax({
			url: "apirest/lapsos",
			success: function (json) {
				Lapso.mostrar(json);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let lapsos = json.datos;
			if (json.datos) {
				salida += '\n\
<div class="accordion" id="listaLapsos">';
				$.each(lapsos, function (i, lapso) {
					salida += Lapso.mostrarCard(lapso);
				});
				salida += "\n\
</div>";
			} else {
				salida = "<h1>" + json.descripcion + "</h1>";
			}
			$("#list-lapsos").html(salida);
		}
	},
	mostrarCard: function (lapso) {
		let idLapso =
			lapso.id_modalidad +
			"-" +
			lapso.id_mecanismo +
			"-" +
			lapso.id_objeto_contratacion;
		let salida =
			'\n\
<div class="card border shadow-sm">\n\
    <div class="card-header" id="encabezado' +
			idLapso +
			'">\n\
        <h5 class="mb-0">\n\
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#lapso' +
			idLapso +
			'" aria-expanded="true" aria-controls="lapso' +
			idLapso +
			'">\n\
                ' +
			idLapso +
			" - " +
			lapso.objeto_contratacion +
			" - " +
			lapso.dias_habiles +
			' días hábiles\n\
            </button>\n\
        </h5>\n\
    </div>\n\
    <div id="lapso' +
			idLapso +
			'" class="collapse" aria-labelledby="encabezado' +
			idLapso +
			'" data-parent="#listaLapsos">\n\
        <div class="card-body row">\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Modalidad</div>\n\
                <div>' +
			lapso.modalidad +
			'</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Mecanismo</div>\n\
                <div>' +
			lapso.mecanismo +
			'</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Objeto de Contratación</div>\n\
                <div>' +
			lapso.objeto_contratacion +
			'</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-6 font-weight-bold text-primary size-24">' +
			lapso.dias_habiles +
			' días hábiles</div>\n\
            <div class="col-sm-12 col-md-12 col-lg-6 text-right">\n\
                <div class="btn-group" role="group">\n\
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                        onclick="Lapso.form(' +
			lapso.id_modalidad +
			", " +
			lapso.id_mecanismo +
			", " +
			lapso.id_objeto_contratacion +
			')"><i class="ion-edit"></i> Editar</button>\n\
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                        onclick="Lapso.dialogoConfirmarBorrar(' +
			lapso.id_modalidad +
			", " +
			lapso.id_mecanismo +
			", " +
			lapso.id_objeto_contratacion +
			')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
                </div>\n\
            </div>\n\
        </div>\n\
    </div>\n\
</div>';
		return salida;
	},
};

var Mecanismo = {
	agregar: function () {
		$.ajax({
			url: "apirest/mecanismo",
			method: "POST",
			data: mecanismoFrm,
			success: function (json) {
				Mecanismo.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Registro de Modalidad'
		);
		$("#btnGuardar").click(function () {
			Mecanismo.agregar();
		});
	},
	dialogoConfirmarBorrar: function (idMecanismo) {
		if (idMecanismo !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/mecanismo/" + idMecanismo,
					success: function (json) {
						let m = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar la mecanismo"
						);
						$("#elementoAEliminar").html(m.descripcion);
						$("#btnBorrar").click(function () {
							Mecanismo.eliminar(idMecanismo);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idMecanismo) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Edición de Mecanismo'
		);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			Mecanismo.editar();
		});
		$.ajax({
			url: "apirest/mecanismo/" + idMecanismo,
			success: function (json) {
				let m = json.dato;
				mecanismoFrm = {
					id_mecanismo: m.id_mecanismo,
					descripcion: m.descripcion,
				};
				$("#txtDescripcion").val(m.descripcion);
			},
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/mecanismo",
			method: "PUT",
			data: mecanismoFrm,
			success: function (json) {
				Mecanismo.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idMecanismo) {
		$.ajax({
			url: "apirest/mecanismo/" + idMecanismo,
			method: "DELETE",
			success: function (json) {
				Mecanismo.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioDescripcionForm: function () {
		mecanismoFrm.descripcion = $("#txtDescripcion").val();
	},
	form: function (idMecanismo) {
		$.get("frmEntidadDescriptiva", function (html) {
			if (idMecanismo !== undefined) {
				Mecanismo.dialogoEditar(html, idMecanismo);
			} else {
				Mecanismo.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});

			$("#txtDescripcion").change(function () {
				Mecanismo.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		$.ajax({
			url: "apirest/mecanismos",
			success: function (json) {
				Mecanismo.mostrar(json);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let mecanismos = json.datos;
			$.each(mecanismos, function (i, mecanismo) {
				let tipoAlert = "light";
				if (json.dato) {
					if (json.dato.id_mecanismo === mecanismo.id_mecanismo) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' +
					mecanismo.descripcion +
					'</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Mecanismo.form(' +
					mecanismo.id_mecanismo +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Mecanismo.dialogoConfirmarBorrar(' +
					mecanismo.id_mecanismo +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-mecanismos").html(salida);
		}
	},
};

var Modalidad = {
	agregar: function () {
		$.ajax({
			url: "apirest/modalidad",
			method: "POST",
			data: modalidadFrm,
			success: function (json) {
				Modalidad.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Registro de Modalidad'
		);
		$("#btnGuardar").click(function () {
			Modalidad.agregar();
		});
	},
	dialogoConfirmarBorrar: function (idModalidad) {
		if (idModalidad !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/modalidad/" + idModalidad,
					success: function (json) {
						let m = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar la modalidad"
						);
						$("#elementoAEliminar").html(m.descripcion);
						$("#btnBorrar").click(function () {
							Modalidad.eliminar(idModalidad);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idModalidad) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Edición de Modalidad'
		);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			Modalidad.editar();
		});
		$.ajax({
			url: "apirest/modalidad/" + idModalidad,
			success: function (json) {
				let m = json.dato;
				modalidadFrm = {
					id_modalidad: m.id_modalidad,
					descripcion: m.descripcion,
				};
				$("#txtDescripcion").val(m.descripcion);
			},
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/modalidad",
			method: "PUT",
			data: modalidadFrm,
			success: function (json) {
				Modalidad.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idModalidad) {
		$.ajax({
			url: "apirest/modalidad/" + idModalidad,
			method: "DELETE",
			success: function (json) {
				Modalidad.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioDescripcionForm: function () {
		modalidadFrm.descripcion = $("#txtDescripcion").val();
	},
	form: function (idModalidad) {
		$.get("frmEntidadDescriptiva", function (html) {
			if (idModalidad !== undefined) {
				Modalidad.dialogoEditar(html, idModalidad);
			} else {
				Modalidad.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});

			$("#txtDescripcion").change(function () {
				Modalidad.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		$.ajax({
			url: "apirest/modalidades",
			success: function (json) {
				Modalidad.mostrar(json);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let modalidades = json.datos;
			$.each(modalidades, function (i, modalidad) {
				let tipoAlert = "light";
				if (json.dato) {
					if (json.dato.id_modalidad === modalidad.id_modalidad) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' +
					modalidad.descripcion +
					'</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Modalidad.form(' +
					modalidad.id_modalidad +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Modalidad.dialogoConfirmarBorrar(' +
					modalidad.id_modalidad +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-modalidades").html(salida);
		}
	},
};

var ObjetoContratacion = {
	agregar: function () {
		$.ajax({
			url: "apirest/objetocont",
			method: "POST",
			data: objetocontFrm,
			success: function (json) {
				ObjetoContratacion.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Registro de Objeto de Contratación'
		);
		$("#btnGuardar").click(function () {
			ObjetoContratacion.agregar();
		});
	},
	dialogoConfirmarBorrar: function (idObjetoCont) {
		if (idObjetoCont !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/objetocont/" + idObjetoCont,
					success: function (json) {
						let m = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar el objeto de contración"
						);
						$("#elementoAEliminar").html(m.descripcion);
						$("#btnBorrar").click(function () {
							ObjetoContratacion.eliminar(idObjetoCont);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idObjetoCont) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-ios-location"></i> Edición de Objeto de Contratación'
		);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			ObjetoContratacion.editar();
		});
		$.ajax({
			url: "apirest/objetocont/" + idObjetoCont,
			success: function (json) {
				let oc = json.dato;
				objetocontFrm = {
					id_objeto_contratacion: oc.id_objeto_contratacion,
					descripcion: oc.descripcion,
				};
				$("#txtDescripcion").val(oc.descripcion);
			},
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/objetocont",
			method: "PUT",
			data: objetocontFrm,
			success: function (json) {
				ObjetoContratacion.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idObjetoCont) {
		$.ajax({
			url: "apirest/objetocont/" + idObjetoCont,
			method: "DELETE",
			success: function (json) {
				ObjetoContratacion.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioDescripcionForm: function () {
		objetocontFrm.descripcion = $("#txtDescripcion").val();
	},
	form: function (idObjetoCont) {
		$.get("frmEntidadDescriptiva", function (html) {
			if (idObjetoCont !== undefined) {
				ObjetoContratacion.dialogoEditar(html, idObjetoCont);
			} else {
				ObjetoContratacion.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});

			$("#txtDescripcion").change(function () {
				ObjetoContratacion.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		$.ajax({
			url: "apirest/objetoscont",
			success: function (json) {
				ObjetoContratacion.mostrar(json);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let objetoscont = json.datos;
			$.each(objetoscont, function (i, objetocont) {
				let tipoAlert = "light";
				if (json.dato) {
					if (
						json.dato.id_objeto_contratacion ===
						objetocont.id_objeto_contratacion
					) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' +
					objetocont.descripcion +
					'</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="ObjetoContratacion.form(' +
					objetocont.id_objeto_contratacion +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="ObjetoContratacion.dialogoConfirmarBorrar(' +
					objetocont.id_objeto_contratacion +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-objetos-cont").html(salida);
		}
	},
};
