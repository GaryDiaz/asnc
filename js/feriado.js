/**
 * @author GaryDíaz
 */

var feriadoNacionalFrm = { mes: 0, dia: 0, descripcion: "" };
var feriadoEspecificoFrm = { fecha: "", descripcion: "" };
var feriadoEstadalFrm = { id_estado: 0, mes: 0, dia: 0, descripcion: "" };
var feriadoMunicipalFrm = { id_municipio: 0, mes: 0, dia: 0, descripcion: "" };

var FeriadoEspecifico = {
	agregar: function () {
		$.ajax({
			url: "apirest/feriadoEspecifico",
			method: "POST",
			data: feriadoEspecificoFrm,
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	buscar: function (descripcion) {
		let hoy = new Date();
		let criterio = $("#sltAnioFeridadoEspecifico").val();
		let url = "apirest/feriadosEspecificos2";
		let data = { descripcion: descripcion };
		let anio = hoy.getFullYear();
		switch (criterio) {
			case "todos":
				url = "apirest/feriadosEspecificos";
				break;
			case "esteAnio":
				data = { descripcion: descripcion, anio: anio };
				break;
			case "anioAnterior":
				data = { descripcion: descripcion, anio: anio - 1 };
				break;
			case "anioSiguiente":
				data = { descripcion: descripcion, anio: anio + 1 };
				break;
		}
		$.ajax({
			url: url,
			method: "PUT",
			data: data,
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioDescripcionForm: function () {
		feriadoEspecificoFrm.descripcion = $("#txtDescripcion").val();
	},
	cambioFechaForm: function () {
		feriadoEspecificoFrm.fecha = $("#txtFecha").val();
	},
	cargarSelector: function () {
		let hoy = new Date();
		let salida =
			'\n\
    <option value="esteAnio">Este año</option>\n\
    <option value="todos">Todos</option>\n\
    <option value="anioAnterior">El año pasado</option>\n\
    <option value="anioSiguiente">El año siguiente</option>';
		$("#sltAnioFeridadoEspecifico").html(salida);
	},
	dialogoConfirmarBorrar: function (fecha) {
		if (fecha !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/feriadoEspecifico/" + fecha,
					success: function (json) {
						let fn = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar el feriado nacional"
						);
						$("#elementoAEliminar").html(fn.descripcion);
						$("#btnBorrar").click(function () {
							FeriadoEspecifico.eliminar(fecha);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, fecha) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-calendar"></i> Edición de Feriado Especifico'
		);
		$("#txtFecha").prop("disabled", true);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			FeriadoEspecifico.editar();
		});
		$.ajax({
			url: "apirest/feriadoEspecifico/" + fecha,
			success: function (json) {
				let fn = json.dato;
				feriadoEspecificoFrm = json.dato;
				$("#txtFecha").val(fn.fecha);
				$("#txtDescripcion").val(fn.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#btnGuardar").click(function () {
			FeriadoEspecifico.agregar();
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/feriadoEspecifico",
			method: "PUT",
			data: feriadoEspecificoFrm,
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (fecha) {
		$.ajax({
			url: "apirest/feriadoEspecifico/" + fecha,
			method: "DELETE",
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	form: function (fecha) {
		$.get("frmFeriadoEspecifico", function (html) {
			if (fecha !== undefined) {
				FeriadoEspecifico.dialogoEditar(html, fecha);
			} else {
				FeriadoEspecifico.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});
			$("#txtFecha").change(function () {
				FeriadoEspecifico.cambioFechaForm();
			});
			$("#txtDescripcion").change(function () {
				FeriadoEspecifico.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		let hoy = new Date();
		let criterio = $("#sltAnioFeridadoEspecifico").val();
		switch (criterio) {
			case "todos":
				FeriadoEspecifico.listarTodos();
				break;
			case "esteAnio":
				FeriadoEspecifico.listarPorAnio(hoy.getFullYear());
				break;
			case "anioAnterior":
				FeriadoEspecifico.listarPorAnio(hoy.getFullYear() - 1);
				break;
			case "anioSiguiente":
				FeriadoEspecifico.listarPorAnio(hoy.getFullYear() + 1);
				break;
		}
	},
	listarTodos: function () {
		$.ajax({
			url: "apirest/feriadosEspecificos",
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	listarPorAnio: function (anio) {
		$.ajax({
			url: "apirest/feriadosEspecificos/" + anio,
			success: function (json) {
				FeriadoEspecifico.mostrar(json);
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
			let feriados = json.datos;
			$.each(feriados, function (i, feriado) {
				let tipoAlert = "light";
				if (json.dato) {
					if (json.dato.fecha === feriado.fecha) {
						tipoAlert = "info";
					}
				}
				let arrayFecha = feriado.fecha.split("-");
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' +
					feriado.descripcion +
					'</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' +
					arrayFecha[2] +
					" de " +
					meses[Number(arrayFecha[1]) - 1] +
					" de " +
					arrayFecha[0] +
					'</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEspecifico.form(\'' +
					feriado.fecha +
					'\')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEspecifico.dialogoConfirmarBorrar(\'' +
					feriado.fecha +
					'\')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-frds-especificos").html(salida);
		}
	},
};

var FeriadoEstadal = {
	agregar: function () {
		$.ajax({
			url: "apirest/feriadoEstadal",
			method: "POST",
			data: feriadoEstadalFrm,
			success: function (json) {
				FeriadoEstadal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	buscar: function (descripcion) {
		let idEstado = Number($("#sltEstadoFrdEstadal").val());
		if (idEstado !== 0) {
			let data = { id_estado: idEstado, descripcion: descripcion };
			$.ajax({
				url: "apirest/feriadosEstadales",
				method: "PUT",
				data: data,
				success: function (json) {
					FeriadoEstadal.mostrar(json);
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		} else {
			sncApp.enviarNotificacion("Debe seleccionar un estado");
		}
	},
	cambioDescripcionForm: function () {
		feriadoEstadalFrm.descripcion = $("#txtDescripcion").val();
	},
	cambioDiaForm: function () {
		if ($("#txtDia").val() !== "") {
			let dia = Number($("#txtDia").val());
			let max = Number($("#txtDia").attr("max"));
			if (dia < 1) {
				$("#txtDia").val("1");
			} else if (dia > max) {
				$("#txtDia").val(max);
			}
			feriadoEstadalFrm.dia = $("#txtDia").val();
		}
	},
	cambioMesForm: function () {
		let mes = Number($("#sltMes").val());
		if (mes !== "NaN") {
			feriadoEstadalFrm.mes = mes;
			switch (mes) {
				case 2:
					$("#txtDia").attr("max", "29");
					break;
				case 4:
				case 6:
				case 9:
				case 11:
					$("#txtDia").attr("max", "30");
					break;
				default:
					$("#txtDia").attr("max", "31");
					break;
			}
		}
	},
	cambioEstadoForm: function () {
		feriadoEstadalFrm.id_estado = $("#sltEstado").val();
	},
	cargarSelector: function () {
		let salida;
		$.each(estados, function (i, estado) {
			salida +=
				'<option value="' + estado.id + '">' + estado.descedo + "</option>";
		});
		$("#sltEstadoFrdEstadal").html(salida);
	},
	dialogoConfirmarBorrar: function (idEstado, mes, dia) {
		if (mes !== undefined && dia !== undefined && idEstado !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/feriadoEstadal/" + idEstado + "/" + mes + "/" + dia,
					success: function (json) {
						let fn = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar el feriado estadal"
						);
						$("#elementoAEliminar").html(fn.descripcion);
						$("#btnBorrar").click(function () {
							FeriadoEstadal.eliminar(idEstado, mes, dia);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idEstado, mes, dia) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-calendar"></i> Edición de Feriado Estadal'
		);
		$("#sltEstado").prop("disabled", true);
		$("#sltMes").prop("disabled", true);
		$("#txtDia").prop("disabled", true);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			FeriadoEstadal.editar();
		});
		let salida;
		$.each(estados, function (i, estado) {
			salida +=
				'\n\
    <option value="' +
				estado.id +
				'">' +
				estado.descedo +
				"</option>";
		});
		$("#sltEstado").html(salida);
		$.ajax({
			url: "apirest/feriadoEstadal/" + idEstado + "/" + mes + "/" + dia,
			success: function (json) {
				let fn = json.dato;
				feriadoEstadalFrm = {
					id_estado: fn.id_estado,
					mes: fn.mes,
					dia: fn.dia,
					descripcion: fn.descripcion,
				};
				$("#sltEstado").val(fn.id_estado);
				$("#sltMes").val(fn.mes);
				$("#txtDia").val(fn.dia);
				$("#txtDescripcion").val(fn.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$.ajax({
			url: "apirest/estados",
			success: function (json) {
				let salida = "";
				$.each(json.datos, function (i, estado) {
					salida +=
						'\n\
    <option value="' +
						estado.id +
						'">' +
						estado.descedo +
						"</option>";
				});
				$("#sltEstado").html(salida);
			},
		});
		$("#btnGuardar").click(function () {
			FeriadoEstadal.agregar();
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/feriadoEstadal",
			method: "PUT",
			data: feriadoEstadalFrm,
			success: function (json) {
				FeriadoEstadal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idEstado, mes, dia) {
		$.ajax({
			url: "apirest/feriadoEstadal/" + idEstado + "/" + mes + "/" + dia,
			method: "DELETE",
			success: function (json) {
				FeriadoEstadal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	form: function (idEstado, mes, dia) {
		$.get("frmFeriadoEstadal", function (html) {
			if (mes !== undefined && dia !== undefined && idEstado !== undefined) {
				FeriadoEstadal.dialogoEditar(html, idEstado, mes, dia);
			} else {
				FeriadoEstadal.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});
			$("#sltMes").change(function () {
				FeriadoEstadal.cambioMesForm();
			});
			$("#txtDia").change(function () {
				FeriadoEstadal.cambioDiaForm();
			});
			$("#sltEstado").change(function () {
				FeriadoEstadal.cambioEstadoForm();
			});
			$("#txtDescripcion").change(function () {
				FeriadoEstadal.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		let idEstado = Number($("#sltEstadoFrdEstadal").val());
		if (idEstado) {
			$.ajax({
				url: "apirest/feriadosEstadales/" + idEstado,
				success: function (json) {
					FeriadoEstadal.mostrar(json);
					sncApp.enviarNotificacion(json.descripcion);
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		}
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let feriadosEstadales = json.datos;
			$.each(feriadosEstadales, function (i, feriado) {
				let tipoAlert = "light";
				if (json.dato) {
					if (
						json.dato.mes === feriado.mes &&
						json.dato.dia === feriado.dia &&
						json.dato.id_estado === feriado.id_estado
					) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' +
					feriado.descripcion +
					" (" +
					feriado.estado +
					')</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' +
					feriado.dia +
					" de " +
					meses[feriado.mes - 1] +
					'</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEstadal.form(' +
					feriado.id_estado +
					"," +
					feriado.mes +
					"," +
					feriado.dia +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEstadal.dialogoConfirmarBorrar(' +
					feriado.id_estado +
					"," +
					feriado.mes +
					"," +
					feriado.dia +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-frds-estadales").html(salida);
		}
	},
};

var FeriadoNacional = {
	agregar: function () {
		$.ajax({
			url: "apirest/feriadoNacional",
			method: "POST",
			data: feriadoNacionalFrm,
			beforeSend: function (xhr) {},
			success: function (json) {
				FeriadoNacional.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	buscar: function (descripcion) {
		$.ajax({
			url: "apirest/feriadosNacionales",
			method: "PUT",
			data: { descripcion: descripcion },
			success: function (json) {
				FeriadoNacional.mostrar(json);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	cambioDescripcionForm: function () {
		feriadoNacionalFrm.descripcion = $("#txtDescripcion").val();
	},
	cambioDiaForm: function () {
		if ($("#txtDia").val() !== "") {
			let dia = Number($("#txtDia").val());
			let max = Number($("#txtDia").attr("max"));
			if (dia < 1) {
				$("#txtDia").val("1");
			} else if (dia > max) {
				$("#txtDia").val(max);
			}
			feriadoNacionalFrm.dia = $("#txtDia").val();
		}
	},
	cambioMesForm: function () {
		let mes = Number($("#sltMes").val());
		if (mes !== "NaN") {
			feriadoNacionalFrm.mes = mes;
			switch (mes) {
				case 2:
					$("#txtDia").attr("max", "29");
					break;
				case 4:
				case 6:
				case 9:
				case 11:
					$("#txtDia").attr("max", "30");
					break;
				default:
					$("#txtDia").attr("max", "31");
					break;
			}
		}
	},
	dialogoConfirmarBorrar: function (mes, dia) {
		if (mes !== undefined && dia !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url: "apirest/feriadoNacional/" + mes + "/" + dia,
					success: function (json) {
						let fn = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar el feriado nacional"
						);
						$("#elementoAEliminar").html(fn.descripcion);
						$("#btnBorrar").click(function () {
							FeriadoNacional.eliminar(mes, dia);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, mes, dia) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-calendar"></i> Edición de Feriado Nacional'
		);
		$("#sltMes").prop("disabled", true);
		$("#txtDia").prop("disabled", true);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			FeriadoNacional.editar();
		});
		$.ajax({
			url: "apirest/feriadoNacional/" + mes + "/" + dia,
			success: function (json) {
				let fn = json.dato;
				feriadoNacionalFrm = json.dato;
				$("#sltMes").val(fn.mes);
				$("#txtDia").val(fn.dia);
				$("#txtDescripcion").val(fn.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		$("#btnGuardar").click(function () {
			FeriadoNacional.agregar();
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/feriadoNacional",
			method: "PUT",
			data: feriadoNacionalFrm,
			success: function (json) {
				FeriadoNacional.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (mes, dia) {
		$.ajax({
			url: "apirest/feriadoNacional/" + mes + "/" + dia,
			method: "DELETE",
			success: function (json) {
				FeriadoNacional.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	form: function (mes, dia) {
		$.get("frmFeriadoNacional", function (html) {
			if (mes !== undefined && dia !== undefined) {
				FeriadoNacional.dialogoEditar(html, mes, dia);
			} else {
				FeriadoNacional.dialogoAgregar(html);
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});
			$("#sltMes").change(function () {
				FeriadoNacional.cambioMesForm();
			});
			$("#txtDia").change(function () {
				FeriadoNacional.cambioDiaForm();
			});
			$("#txtDescripcion").change(function () {
				FeriadoNacional.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		$.ajax({
			url: "apirest/feriadosNacionales",
			success: function (json) {
				FeriadoNacional.mostrar(json);
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
			let feriadosNacionales = json.datos;
			$.each(feriadosNacionales, function (i, fn) {
				let tipoAlert = "light";
				if (json.dato) {
					if (json.dato.mes === fn.mes && json.dato.dia === fn.dia) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' +
					fn.descripcion +
					'</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' +
					fn.dia +
					" de " +
					meses[fn.mes - 1] +
					'</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoNacional.form(' +
					fn.mes +
					"," +
					fn.dia +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoNacional.dialogoConfirmarBorrar(' +
					fn.mes +
					"," +
					fn.dia +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-frds-nacionales").html(salida);
		}
	},
};

var FeriadoMunicipal = {
	agregar: function () {
		$.ajax({
			url: "apirest/feriadoMunicipal",
			method: "POST",
			data: feriadoMunicipalFrm,
			success: function (json) {
				FeriadoMunicipal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	buscar: function (descripcion) {
		let idMunicipio = Number($("#sltMunicipioFrdMunicipal").val());
		if (idMunicipio !== "NaN") {
			let data = { id_municipio: idMunicipio, descripcion: descripcion };
			$.ajax({
				url: "apirest/feriadosMunicipales",
				method: "PUT",
				data: data,
				success: function (json) {
					FeriadoMunicipal.mostrar(json);
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		} else {
			sncApp.enviarNotificacion("Debe seleccionar un municipio");
		}
	},
	cambioDescripcionForm: function () {
		feriadoMunicipalFrm.descripcion = $("#txtDescripcion").val();
	},
	cambioDiaForm: function () {
		if ($("#txtDia").val() !== "") {
			let dia = Number($("#txtDia").val());
			let max = Number($("#txtDia").attr("max"));
			if (dia < 1) {
				$("#txtDia").val("1");
			} else if (dia > max) {
				$("#txtDia").val(max);
			}
			feriadoMunicipalFrm.dia = $("#txtDia").val();
		}
	},
	cambioMesForm: function () {
		let mes = Number($("#sltMes").val());
		if (mes !== "NaN") {
			feriadoMunicipalFrm.mes = mes;
			switch (mes) {
				case 2:
					$("#txtDia").attr("max", "29");
					break;
				case 4:
				case 6:
				case 9:
				case 11:
					$("#txtDia").attr("max", "30");
					break;
				default:
					$("#txtDia").attr("max", "31");
					break;
			}
		}
	},
	cambioEstadoForm: function () {
		FeriadoMunicipal.cargarSltMunicipioFrm();
	},
	cambioMunicipioForm: function () {
		feriadoMunicipalFrm.id_municipio = $("#sltMunicipio").val();
	},
	cargarSelector: function () {
		let salida;
		$.each(estados, function (i, estado) {
			salida +=
				'<option value="' + estado.id + '">' + estado.descedo + "</option>";
		});
		$("#sltEstadoFrdMunicipal").html(salida);
	},
	cargarSltMunicipio: function () {
		let salida;
		$.ajax({
			url: "apirest/municipios/" + $("#sltEstadoFrdMunicipal").val(),
			success: function (json) {
				$.each(json.datos, function (i, municipio) {
					salida +=
						'<option value="' +
						municipio.id +
						'">' +
						municipio.descmun +
						"</option>";
				});
				$("#sltMunicipioFrdMunicipal").html(salida);
			},
		});
	},
	cargarSltMunicipioFrm: function () {
		let salida;
		$.ajax({
			url: "apirest/municipios/" + $("#sltEstado").val(),
			success: function (json) {
				$.each(json.datos, function (i, municipio) {
					salida +=
						'<option value="' +
						municipio.id +
						'">' +
						municipio.descmun +
						"</option>";
				});
				$("#sltMunicipio").html(salida);
			},
		});
	},
	dialogoConfirmarBorrar: function (idMunicipio, mes, dia) {
		if (mes !== undefined && dia !== undefined && idMunicipio !== undefined) {
			$.get("frmConfirmarBorrar", function (html) {
				$("#sncModalDlg").html(html);
				$("#btnCerrarDialogoModal").click(function () {
					$("#sncModalDlg").modal("hide");
					$("#sncModalDlg").html("");
				});
				$.ajax({
					url:
						"apirest/feriadoMunicipal/" + idMunicipio + "/" + mes + "/" + dia,
					success: function (json) {
						let fn = json.dato;
						$("#descripcionDeAccion").html(
							"Está a punto de eliminar el feriado municipal"
						);
						$("#elementoAEliminar").html(fn.descripcion);
						$("#btnBorrar").click(function () {
							FeriadoMunicipal.eliminar(idMunicipio, mes, dia);
						});
					},
					error: function (error) {
						sncApp.notificarError(error);
					},
				});
			});
		}
	},
	dialogoEditar: function (html, idMunicipio, mes, dia) {
		$("#sncModalDlg").html(html);
		$("#tituloForm").html(
			'<i class="ion-calendar"></i> Edición de Feriado Municipal'
		);
		$("#sltEstado").prop("disabled", true);
		$("#sltMunicipio").prop("disabled", true);
		$("#sltMes").prop("disabled", true);
		$("#txtDia").prop("disabled", true);
		$("#btnGuardar").html('<i class="ion-edit"></i> Editar');
		$("#btnGuardar").click(function () {
			FeriadoMunicipal.editar();
		});
		let salida = "";
		$.each(estados, function (i, estado) {
			salida +=
				'<option value="' + estado.id + '">' + estado.descedo + "</option>";
		});
		$("#sltEstado").html(salida);
		$.ajax({
			url: "apirest/feriadoMunicipal/" + idMunicipio + "/" + mes + "/" + dia,
			success: function (json) {
				let fn = json.dato;
				feriadoMunicipalFrm = {
					id_municipio: fn.id_municipio,
					mes: fn.mes,
					dia: fn.dia,
					descripcion: fn.descripcion,
				};
				$("#sltEstado").val(fn.id_estado);
				$("#sltMes").val(fn.mes);
				$("#txtDia").val(fn.dia);
				$("#txtDescripcion").val(fn.descripcion);
				$.ajax({
					url: "apirest/municipios/" + fn.id_estado,
					success: function (json2) {
						salida = "";
						$.each(json2.datos, function (i, municipio) {
							salida +=
								'<option value="' +
								municipio.id +
								'">' +
								municipio.descmun +
								"</option>";
						});
						$("#sltMunicipio").html(salida);
						$("#sltMunicipio").val(idMunicipio);
					},
				});
			},
		});
	},
	dialogoAgregar: function (html) {
		$("#sncModalDlg").html(html);
		let salida = "";
		$.each(estados, function (i, estado) {
			salida +=
				'<option value="' + estado.id + '">' + estado.descedo + "</option>";
		});
		$("#sltEstado").html(salida);
		$("#btnGuardar").click(function () {
			FeriadoMunicipal.agregar();
		});
	},
	editar: function () {
		$.ajax({
			url: "apirest/feriadoMunicipal",
			method: "PUT",
			data: feriadoMunicipalFrm,
			success: function (json) {
				FeriadoMunicipal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	eliminar: function (idMunicipio, mes, dia) {
		$.ajax({
			url: "apirest/feriadoMunicipal/" + idMunicipio + "/" + mes + "/" + dia,
			method: "DELETE",
			success: function (json) {
				FeriadoMunicipal.mostrar(json);
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
				sncApp.enviarNotificacion(json.descripcion);
			},
			error: function (error) {
				sncApp.notificarError(error);
			},
		});
	},
	form: function (idMunicipio, mes, dia) {
		$.get("frmFeriadoMunicipal", function (html) {
			if (mes !== undefined && dia !== undefined && idMunicipio !== undefined) {
				FeriadoMunicipal.dialogoEditar(html, idMunicipio, mes, dia);
			} else {
				FeriadoMunicipal.dialogoAgregar(html);
				$("#sltMes").change(function () {
					FeriadoMunicipal.cambioMesForm();
				});
				$("#txtDia").change(function () {
					FeriadoMunicipal.cambioDiaForm();
				});
				$("#sltEstado").change(function () {
					FeriadoMunicipal.cambioEstadoForm();
				});
				$("#sltMunicipio").change(function () {
					FeriadoMunicipal.cambioMunicipioForm();
				});
			}
			$("#btnCerrarDialogoModal").click(function () {
				$("#sncModalDlg").modal("hide");
				$("#sncModalDlg").html("");
			});

			$("#txtDescripcion").change(function () {
				FeriadoMunicipal.cambioDescripcionForm();
			});
		});
	},
	listar: function () {
		let idMunicipio = Number($("#sltMunicipioFrdMunicipal").val());
		if (idMunicipio) {
			$.ajax({
				url: "apirest/feriadosMunicipales/" + idMunicipio,
				success: function (json) {
					FeriadoMunicipal.mostrar(json);
					sncApp.enviarNotificacion(json.descripcion);
				},
				error: function (error) {
					sncApp.notificarError(error);
				},
			});
		}
	},
	mostrar: function (json) {
		let salida = "";
		if (json.ok) {
			let feriadosEstadales = json.datos;
			$.each(feriadosEstadales, function (i, feriado) {
				let tipoAlert = "light";
				if (json.dato) {
					if (
						json.dato.mes === feriado.mes &&
						json.dato.dia === feriado.dia &&
						json.dato.id_estado === feriado.id_estado
					) {
						tipoAlert = "info";
					}
				}
				salida +=
					'\
<div class="row alert alert-' +
					tipoAlert +
					' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' +
					feriado.descripcion +
					" (" +
					feriado.estado +
					')</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' +
					feriado.dia +
					" de " +
					meses[feriado.mes - 1] +
					'</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoMunicipal.form(' +
					feriado.id_municipio +
					"," +
					feriado.mes +
					"," +
					feriado.dia +
					')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoMunicipal.dialogoConfirmarBorrar(' +
					feriado.id_municipio +
					"," +
					feriado.mes +
					"," +
					feriado.dia +
					')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
			});
			$("#list-frds-municipales").html(salida);
		}
	},
};
