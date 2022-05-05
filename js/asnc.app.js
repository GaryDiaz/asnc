/**
 * @author GaryDíaz
 */

////******************************************************************************
//***                        VARIABLES GLOBALES                              ***
//******************************************************************************
var meses=["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
var estados;
var feriadoNacionalFrm={mes:0, dia:0, descripcion:""};
var feriadoEspecificoFrm={fecha:"", descripcion:""};
var feriadoEstadalFrm={id_estado:0, mes:0, dia:0, descripcion:""};
var feriadoMunicipalFrm={id_municipio:0, mes:0, dia:0, descripcion:""};
var modalidadFrm={id_modalidad:0, descripcion:''};
var mecanismoFrm={id_mecanismo:0, descripcion:''};
var objetocontFrm={id_objeto_contratacion:0, descripcion:''};
var lapsoFrm={id_modalidad: 0, id_mecanismo: 0, id_objeto_contratacion: 0, dias_habiles: 0};
var organoEnteFrm;
var llamadoConcursoFrm;
var dataLapsos={rif:'', fechallamado:'', id_modalidad:0, id_mecanismo:0, id_objeto_contratacion:0};
var lapsosFechas;

function formatearFecha(txtFecha){
    let arrayFecha=txtFecha.split('-');
    //return (fecha.getDay()+1)+' de '+ meses[fecha.getMonth()-1]+' de '+fecha.getFullYear();
    return arrayFecha[2]+'-'+arrayFecha[1]+'-'+arrayFecha[0];
}

/**
 * sncApp
 * 
 * Es el módulo que GESTIONA de manera general, las interfaces en el FRONT-END
 * @type type
 */
var sncApp={
    cargarDatosDePagina: function(uri){
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
                sncApp.inicializarRegistroLlamado();
        }
    },
    enviarNotificacion: function (descripcion, t, i, frm) {
        //    alert(descripcion);
        let titulo = (t === undefined) ? "ASNC" : t;
        let icono = (i === undefined) ? "ion-android-done" : i;
        let msj = '\n\
    <div class="alert alert-warning alert-dismissible fade show" role="alert">\
      <i class="'+icono+'"></i> &nbsp; <strong>..:: '+titulo+'::.. </strong> '+descripcion+'\
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
      </button>\
    </div>';
        if (frm===undefined) {
            $("#areaDeNotificacion").html(msj);
        }else{
            if ($("#areaDeNotificacionForm").length){
                $("#areaDeNotificacionForm").html(msj);
            }else if ($("#areaDeNotificacion").length){
                $("#areaDeNotificacion").html(msj);
            }else{
                alert(descripcion);
            }
        }
    },
    inicializarGestionLapsos:function(){
        Modalidad.listar();
        Mecanismo.listar();
        ObjetoContratacion.listar();
        Lapso.listar();
    },
    inicializarGestionFeriados:function(){
        FeriadoNacional.listar();
        $.ajax({
            url: "apirest/estados",
            success: function (json) {
                estados = json.datos;
                FeriadoEstadal.cargarSelector();
                FeriadoEstadal.listar();
                FeriadoMunicipal.cargarSelector();
                FeriadoMunicipal.listar();
            }
        });
        FeriadoEspecifico.cargarSelector();
        FeriadoEspecifico.listar();
    },
    inicializarOrganoEntePropio:function(){
        $("#txtRif").prop("disabled", true);
        OrganoEnte.dialogoPerfilInstitucional();
        $("#txtDescripcion").change(function(){
            organoEnteFrm.descripcion = $("#txtDescripcion").val();
        });
        $("#txtCodOnapre").change(function () {
            organoEnteFrm.codigo_onapre=$("#txtCodOnapre").val();
        });
        $("#txtSiglas").change(function () {
            organoEnteFrm.siglas=$("#txtSiglas").val();
        });
        $("#txtDireccion").change(function () {
            organoEnteFrm.direccion=$("#txtDireccion").val();
        });
        $("#txtGaceta").change(function () {
            organoEnteFrm.gaceta=$("#txtGaceta").val();
        });
        $("#txtFechaGaceta").change(function () {
            organoEnteFrm.fecha_gaceta=$("#txtFechaGaceta").val();
        });
        $("#txtPaginaWeb").change(function () {
            organoEnteFrm.pagina_web$("#txtPaginaWeb").val();
        });
        $("#txtCorreo").change(function () {
            organoEnteFrm.correo=$("#txtCorreo").val();
        });
        $("#txtTel1").change(function () {
            organoEnteFrm.tel1=$("#txtTel1").val();
        });
        $("#txtTel2").change(function () {
            organoEnteFrm.tel2=$("#txtTel2").val();
        });
        $("#txtMovil1").change(function () {
            organoEnteFrm.movil1=$("#txtMovil1").val();
        });
        $("#txtMovil2").change(function () {
            organoEnteFrm.movil2=$("#txtMovil2").val();
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
        $("#btnGuardar").click(function(){
            OrganoEnte.editar();
        });
    },
    inicializarRegistroLlamado: function(){
        $.ajax({
            url: "apirest/miperfilinstitucionaldetalle",
            method: 'GET',
            success: function(json){
                $("#txtRif").val(json.dato.rif);
                dataLapsos.rif=json.dato.rif;
                $("#txtSiglas").val(json.dato.siglas);
                $("#txtDescripcion").val(json.dato.descripcion);
                $("#txtDireccion").val(json.dato.direccion+', Municipio '+json.dato.municipio+', '+ json.dato.estado);
            }
        });
        $.ajax({
            url: "apirest/modalidades",
            success: function(json){
                let salida='<option>[Modalidad]</option>\n';
                $.each(json.datos, function (i, modalidad) {
                    salida+='<option value='+modalidad.id_modalidad+'>'+modalidad.descripcion+'</option>\n';
                });
                $("#sltModalidad").html(salida);
            }
        });
        $.ajax({
            url: "apirest/mecanismos",
            success: function(json){
                let salida='<option>[Mecanismo]</option>\n';
                $.each(json.datos, function (i, mecanismo) {
                    salida+='<option value='+mecanismo.id_mecanismo+'>'+mecanismo.descripcion+'</option>\n';
                });
                $("#sltMecanismo").html(salida);
            }
        });
        $.ajax({
            url: "apirest/objetoscont",
            success: function(json){
                let salida='<option>[Objeto de Contratación]</option>\n';
                $.each(json.datos, function (i, oc) {
                    salida+='<option value='+oc.id_objeto_contratacion+'>'+oc.descripcion+'</option>\n';
                });
                $("#sltObjetoContratacion").html(salida);
            }
        });
        $.ajax({
            url: "apirest/estados",
            success: function(json){
                let salida='<option>[Estado]</option>\n';
                $.each(json.datos, function (i, estado) {
                    salida+='<option value='+estado.id+'>'+estado.descedo+'</option>\n';
                });
                $("#sltEstado").html(salida);
            }
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
        $("#sltEstado").change(function () {
            $.ajax({
                url: "apirest/municipios/"+$("#sltEstado").val(),
                success: function (json) {
                    let salida = '<option>[Municipio]</option>\n';
                    $.each(json.datos, function (i, municipio) {
                        salida += '<option value=' + municipio.id + '>' + municipio.descmun + '</option>\n';
                    });
                    $("#sltMunicipio").html(salida);
                }
            });
        });
        $("#txtFechaLlamado").change(function () {
            LlamadoConcurso.cambioTxtFechaLlamado();
        });
        $("#txtFechaDisponibleLlamado").change(function(){
            LlamadoConcurso.cambioTxtFechaDisponibleLlamado();
        });
        $("#txtFechaFinAclaratoria").change(function(){
            LlamadoConcurso.cambioTxtFechaFinAclaratoria();
        });
        $("#txtFechaTope").change(function(){
            LlamadoConcurso.cambioTxtFechaTope();
        });
        $("#txtFechaFin").change(function(){
            LlamadoConcurso.cambioTxtFechaFin();
        });
    },
    notificarError: function(error){
        let json=JSON.parse(error.responseText);
        let icon="ion-alert-circled";
        switch (error.status) {
            case 400:
            case 408:
            case 409:
                icon="ion-close-circled";
                break;
            case 401:
                icon="ion-locked";
                break;
            case 403:
            case 404:
                icon="ion-android-hand";
                break;
        }
        if (json){
            sncApp.enviarNotificacion(json.descripcion, json.titulo, icon, true);
        }else{
            sncApp.enviarNotificacion(error.responseText, "Error", icon);
        }
    }
};

var FeriadoEspecifico={
    agregar: function(){
        $.ajax({
            url: "apirest/feriadoEspecifico",
            method: 'POST',
            data: feriadoEspecificoFrm,
            success: function (json) {
                FeriadoEspecifico.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    buscar: function(descripcion){
        let hoy=new Date();
        let criterio=$("#sltAnioFeridadoEspecifico").val();
        let url='apirest/feriadosEspecificos2';
        let data={descripcion:descripcion};
        let anio=hoy.getFullYear();
        switch (criterio) {
            case "todos":
                url="apirest/feriadosEspecificos";
                break;
            case "esteAnio":
                data={descripcion:descripcion, anio:anio};
                break;
            case "anioAnterior":
                data={descripcion:descripcion, anio:anio-1};
                break;
            case "anioSiguiente":
                data={descripcion:descripcion, anio:anio+1};
                break;
        }
        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            success: function(json){
                FeriadoEspecifico.mostrar(json);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    cambioDescripcionForm: function(){
        feriadoEspecificoFrm.descripcion=$("#txtDescripcion").val();
    },
    cambioFechaForm: function(){
        feriadoEspecificoFrm.fecha=$("#txtFecha").val();
    },
    cargarSelector: function(){
        let hoy=new Date();
        let salida='\n\
    <option value="esteAnio">Este año</option>\n\
    <option value="todos">Todos</option>\n\
    <option value="anioAnterior">El año pasado</option>\n\
    <option value="anioSiguiente">El año siguiente</option>';
        $("#sltAnioFeridadoEspecifico").html(salida);
    },
    dialogoConfirmarBorrar: function(fecha){
        if (fecha !== undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/feriadoEspecifico/" + fecha,
                    success: function (json) {
                        let fn = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el feriado nacional");
                        $("#elementoAEliminar").html(fn.descripcion);
                        $("#btnBorrar").click(function () {
                            FeriadoEspecifico.eliminar(fecha);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, fecha){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-calendar"></i> Edición de Feriado Especifico');
        $("#txtFecha").prop("disabled", true);
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            FeriadoEspecifico.editar();
        });
        $.ajax({
            url: "apirest/feriadoEspecifico/"+fecha,
            success: function (json) {
                let fn=json.dato;
                feriadoEspecificoFrm=json.dato;
                $("#txtFecha").val(fn.fecha);
                $("#txtDescripcion").val(fn.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $("#btnGuardar").click(function () {
            FeriadoEspecifico.agregar();
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/feriadoEspecifico",
            method: 'PUT',
            data: feriadoEspecificoFrm,
            success: function (json) {
                FeriadoEspecifico.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(fecha){
        $.ajax({
            url: "apirest/feriadoEspecifico/"+fecha,
            method: 'DELETE',
            success: function (json) {
                FeriadoEspecifico.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    form: function(fecha){
        $.get("frmFeriadoEspecifico", function (html) {
            if (fecha !== undefined) {
                FeriadoEspecifico.dialogoEditar(html, fecha);
            } else {
                FeriadoEspecifico.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            $("#txtFecha").change(function(){
                FeriadoEspecifico.cambioFechaForm();
            });
            $("#txtDescripcion").change(function(){
                FeriadoEspecifico.cambioDescripcionForm();
            });
        });
    },
    listar: function(){
        let hoy=new Date();
        let criterio=$("#sltAnioFeridadoEspecifico").val();
        switch (criterio) {
            case "todos":
                FeriadoEspecifico.listarTodos();
                break;
            case "esteAnio":
                FeriadoEspecifico.listarPorAnio(hoy.getFullYear());
                break;
            case "anioAnterior":
                FeriadoEspecifico.listarPorAnio(hoy.getFullYear()-1);
                break;
            case "anioSiguiente":
                FeriadoEspecifico.listarPorAnio(hoy.getFullYear()+1);
                break;
        }
    },
    listarTodos: function(){
        $.ajax({
            url: "apirest/feriadosEspecificos",
            success: function(json){
                FeriadoEspecifico.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    listarPorAnio: function(anio){
        $.ajax({
            url: "apirest/feriadosEspecificos/"+anio,
            success: function(json){
                FeriadoEspecifico.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let feriados = json.datos;
            $.each(feriados, function (i, feriado) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.fecha === feriado.fecha) {
                        tipoAlert = "info";
                    }
                }
                let arrayFecha=feriado.fecha.split('-');
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' + feriado.descripcion + '</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' + arrayFecha[2] + " de " + meses[Number(arrayFecha[1]) - 1] + ' de ' + arrayFecha[0] +'</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEspecifico.form(\'' + feriado.fecha + '\')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEspecifico.dialogoConfirmarBorrar(\''+ feriado.fecha +'\')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-frds-especificos").html(salida);
        }
    }
};

var FeriadoEstadal={
    agregar: function(){
        $.ajax({
            url: "apirest/feriadoEstadal",
            method: 'POST',
            data: feriadoEstadalFrm,
            success: function (json) {
                FeriadoEstadal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    buscar: function(descripcion){
        let idEstado=Number($("#sltEstadoFrdEstadal").val());
        if (idEstado!==0){
            let data = {id_estado: idEstado, descripcion: descripcion};
            $.ajax({
                url: "apirest/feriadosEstadales",
                method: 'PUT',
                data: data,
                success: function (json) {
                    FeriadoEstadal.mostrar(json);
                },
                error: function (error) {
                    sncApp.notificarError(error);
                }
            });
        }else{
            sncApp.enviarNotificacion("Debe seleccionar un estado");
        }
    },
    cambioDescripcionForm: function(){
        feriadoEstadalFrm.descripcion=$("#txtDescripcion").val();
    },
    cambioDiaForm: function(){
        if ($("#txtDia").val() !== "") {
            let dia = Number($("#txtDia").val());
            let max = Number($("#txtDia").attr("max"));
            if (dia < 1) {
                $("#txtDia").val('1');
            }else if (dia>max){
                $("#txtDia").val(max);
            }
            feriadoEstadalFrm.dia = $("#txtDia").val();
        }
    },
    cambioMesForm: function(){
        let mes = Number($("#sltMes").val());
        if  (mes!=="NaN"){
            feriadoEstadalFrm.mes=mes;
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
    cambioEstadoForm: function(){
        feriadoEstadalFrm.id_estado=$("#sltEstado").val();
    },
    cargarSelector: function(){
        let salida;
        $.each(estados, function (i, estado) {
            salida += '<option value="' + estado.id + '">' + estado.descedo + '</option>';
        });
        $("#sltEstadoFrdEstadal").html(salida);            
    },
    dialogoConfirmarBorrar: function(idEstado, mes, dia){
        if (mes !== undefined && dia !== undefined && idEstado!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/feriadoEstadal/"+idEstado+"/" + mes + "/" + dia,
                    success: function (json) {
                        let fn = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el feriado estadal");
                        $("#elementoAEliminar").html(fn.descripcion);
                        $("#btnBorrar").click(function () {
                            FeriadoEstadal.eliminar(idEstado, mes, dia);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idEstado, mes, dia){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-calendar"></i> Edición de Feriado Estadal');
        $("#sltEstado").prop("disabled", true);
        $("#sltMes").prop("disabled", true);
        $("#txtDia").prop("disabled", true);
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            FeriadoEstadal.editar();
        });
        let salida;
        $.each(estados, function (i, estado) {
            salida += '\n\
    <option value="' + estado.id + '">' + estado.descedo + '</option>';
        });
        $("#sltEstado").html(salida);
        $.ajax({
            url: "apirest/feriadoEstadal/"+idEstado+"/"+mes+"/"+dia,
            success: function (json) {
                let fn=json.dato;
                feriadoEstadalFrm={id_estado:fn.id_estado, mes:fn.mes, dia:fn.dia, descripcion:fn.descripcion};
                $("#sltEstado").val(fn.id_estado);
                $("#sltMes").val(fn.mes);
                $("#txtDia").val(fn.dia);
                $("#txtDescripcion").val(fn.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $.ajax({
            url: "apirest/estados",
            success: function(json){
                let salida='';
                $.each(json.datos, function(i, estado){
                    salida+='\n\
    <option value="'+estado.id+'">'+estado.descedo+'</option>';
                });
                $("#sltEstado").html(salida);
            }
        });
        $("#btnGuardar").click(function () {
            FeriadoEstadal.agregar();
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/feriadoEstadal",
            method: 'PUT',
            data: feriadoEstadalFrm,
            success: function (json) {
                FeriadoEstadal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idEstado, mes, dia){
        $.ajax({
            url: "apirest/feriadoEstadal/"+idEstado+"/"+mes+"/"+dia,
            method: 'DELETE',
            success: function (json) {
                FeriadoEstadal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    form: function(idEstado, mes, dia){
        $.get("frmFeriadoEstadal", function (html) {
            if (mes !== undefined && dia!== undefined && idEstado !== undefined) {
                FeriadoEstadal.dialogoEditar(html, idEstado, mes, dia);
            } else {
                FeriadoEstadal.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            $("#sltMes").change(function(){
                FeriadoEstadal.cambioMesForm();
            });
            $("#txtDia").change(function(){
                FeriadoEstadal.cambioDiaForm();
            });
            $("#sltEstado").change(function(){
                FeriadoEstadal.cambioEstadoForm();
            });
            $("#txtDescripcion").change(function(){
                FeriadoEstadal.cambioDescripcionForm();
            });
        });
    },
    listar: function(){
        let idEstado=Number($("#sltEstadoFrdEstadal").val());
        if (idEstado){
            $.ajax({
                url: "apirest/feriadosEstadales/"+idEstado,
                success: function(json){
                    FeriadoEstadal.mostrar(json);
                    sncApp.enviarNotificacion(json.descripcion);
                },
                error: function(error){
                    sncApp.notificarError(error);
                }
            });
        }
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let feriadosEstadales = json.datos;
            $.each(feriadosEstadales, function (i, feriado) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.mes === feriado.mes && json.dato.dia === feriado.dia && json.dato.id_estado ===feriado.id_estado) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' + feriado.descripcion + ' ('+feriado.estado+')</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' + feriado.dia + " de " + meses[feriado.mes - 1] + '</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEstadal.form(' +feriado.id_estado + ','+feriado.mes + ',' + feriado.dia+ ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoEstadal.dialogoConfirmarBorrar('+feriado.id_estado + ','+feriado.mes + ',' + feriado.dia+')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-frds-estadales").html(salida);
        }
    }
};

var FeriadoNacional={
    agregar: function(){
        $.ajax({
            url: "apirest/feriadoNacional",
            method: 'POST',
            data: feriadoNacionalFrm,
            beforeSend: function (xhr) {
                
            },
            success: function (json) {
                FeriadoNacional.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    buscar: function(descripcion){
        $.ajax({
            url: "apirest/feriadosNacionales",
            method: 'PUT',
            data: {descripcion:descripcion},
            success: function(json){
                FeriadoNacional.mostrar(json);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    cambioDescripcionForm: function(){
        feriadoNacionalFrm.descripcion=$("#txtDescripcion").val();
    },
    cambioDiaForm: function(){
        if ($("#txtDia").val() !== "") {
            let dia = Number($("#txtDia").val());
            let max = Number($("#txtDia").attr("max"));
            if (dia < 1) {
                $("#txtDia").val('1');
            }else if (dia>max){
                $("#txtDia").val(max);
            }
            feriadoNacionalFrm.dia = $("#txtDia").val();
        }
    },
    cambioMesForm: function(){
        let mes = Number($("#sltMes").val());
        if  (mes!=="NaN"){
            feriadoNacionalFrm.mes=mes;
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
    dialogoConfirmarBorrar: function(mes, dia){
        if (mes !== undefined && dia !== undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/feriadoNacional/" + mes + "/" + dia,
                    success: function (json) {
                        let fn = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el feriado nacional");
                        $("#elementoAEliminar").html(fn.descripcion);
                        $("#btnBorrar").click(function () {
                            FeriadoNacional.eliminar(mes, dia);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, mes, dia){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-calendar"></i> Edición de Feriado Nacional');
        $("#sltMes").prop("disabled", true);
        $("#txtDia").prop("disabled", true);
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            FeriadoNacional.editar();
        });
        $.ajax({
            url: "apirest/feriadoNacional/"+mes+"/"+dia,
            success: function (json) {
                let fn=json.dato;
                feriadoNacionalFrm=json.dato;
                $("#sltMes").val(fn.mes);
                $("#txtDia").val(fn.dia);
                $("#txtDescripcion").val(fn.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $("#btnGuardar").click(function () {
            FeriadoNacional.agregar();
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/feriadoNacional",
            method: 'PUT',
            data: feriadoNacionalFrm,
            success: function (json) {
                FeriadoNacional.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(mes, dia){
        $.ajax({
            url: "apirest/feriadoNacional/"+mes+"/"+dia,
            method: 'DELETE',
            success: function (json) {
                FeriadoNacional.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    form: function(mes, dia){
        $.get("frmFeriadoNacional", function (html) {
            if (mes !== undefined && dia!== undefined) {
                FeriadoNacional.dialogoEditar(html, mes, dia);
            } else {
                FeriadoNacional.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            $("#sltMes").change(function(){
                FeriadoNacional.cambioMesForm();
            });
            $("#txtDia").change(function(){
                FeriadoNacional.cambioDiaForm();
            });
            $("#txtDescripcion").change(function(){
                FeriadoNacional.cambioDescripcionForm();
            });
        });
    },
    listar: function(){
        $.ajax({
            url: "apirest/feriadosNacionales",
            success: function(json){
                FeriadoNacional.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let feriadosNacionales = json.datos;
            $.each(feriadosNacionales, function (i, fn) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.mes === fn.mes && json.dato.dia === fn.dia) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' + fn.descripcion + '</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' + fn.dia + " de " + meses[fn.mes - 1] + '</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoNacional.form(' + fn.mes + ',' + fn.dia + ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoNacional.dialogoConfirmarBorrar('+fn.mes + ',' + fn.dia+')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-frds-nacionales").html(salida);
        }
    }
};

var FeriadoMunicipal={
    agregar: function(){
        $.ajax({
            url: "apirest/feriadoMunicipal",
            method: 'POST',
            data: feriadoMunicipalFrm,
            success: function (json) {
                FeriadoMunicipal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    buscar: function(descripcion){
        let idMunicipio=Number($("#sltMunicipioFrdMunicipal").val());
        if (idMunicipio!=="NaN"){
            let data={id_municipio:idMunicipio,descripcion:descripcion};
            $.ajax({
                url: "apirest/feriadosMunicipales",
                method: 'PUT',
                data: data,
                success: function(json){
                    FeriadoMunicipal.mostrar(json);
                },
                error: function(error){
                    sncApp.notificarError(error);
                }
            });
        }else{
            sncApp.enviarNotificacion("Debe seleccionar un municipio");
        }
    },
    cambioDescripcionForm: function(){
        feriadoMunicipalFrm.descripcion=$("#txtDescripcion").val();
    },
    cambioDiaForm: function(){
        if ($("#txtDia").val() !== "") {
            let dia = Number($("#txtDia").val());
            let max = Number($("#txtDia").attr("max"));
            if (dia < 1) {
                $("#txtDia").val('1');
            }else if (dia>max){
                $("#txtDia").val(max);
            }
            feriadoMunicipalFrm.dia = $("#txtDia").val();
        }
    },
    cambioMesForm: function(){
        let mes = Number($("#sltMes").val());
        if  (mes!=="NaN"){
            feriadoMunicipalFrm.mes=mes;
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
    cambioEstadoForm: function(){
        FeriadoMunicipal.cargarSltMunicipioFrm();
    },
    cambioMunicipioForm: function(){
        feriadoMunicipalFrm.id_municipio=$("#sltMunicipio").val();
    },
    cargarSelector: function () {
        let salida;
        $.each(estados, function (i, estado) {
            salida += '<option value="' + estado.id + '">' + estado.descedo + '</option>';
        });
        $("#sltEstadoFrdMunicipal").html(salida);
    },
    cargarSltMunicipio: function () {
        let salida;
        $.ajax({
            url: "apirest/municipios/"+$("#sltEstadoFrdMunicipal").val(),
            success: function (json) {
                $.each(json.datos, function (i, municipio) {
                    salida += '<option value="' + municipio.id + '">' + municipio.descmun + '</option>';
                });
                $("#sltMunicipioFrdMunicipal").html(salida);
            }
        });
    },
    cargarSltMunicipioFrm: function () {
        let salida;
        $.ajax({
            url: "apirest/municipios/"+$("#sltEstado").val(),
            success: function (json) {
                $.each(json.datos, function (i, municipio) {
                    salida += '<option value="' + municipio.id + '">' + municipio.descmun + '</option>';
                });
                $("#sltMunicipio").html(salida);
            }
        });
    },
    dialogoConfirmarBorrar: function(idMunicipio, mes, dia){
        if (mes !== undefined && dia !== undefined && idMunicipio!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/feriadoMunicipal/"+idMunicipio+"/" + mes + "/" + dia,
                    success: function (json) {
                        let fn = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el feriado municipal");
                        $("#elementoAEliminar").html(fn.descripcion);
                        $("#btnBorrar").click(function () {
                            FeriadoMunicipal.eliminar(idMunicipio, mes, dia);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idMunicipio, mes, dia){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-calendar"></i> Edición de Feriado Municipal');
        $("#sltEstado").prop("disabled", true);
        $("#sltMunicipio").prop("disabled", true);
        $("#sltMes").prop("disabled", true);
        $("#txtDia").prop("disabled", true);
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            FeriadoMunicipal.editar();
        });
        let salida="";
        $.each(estados, function (i, estado) {
            salida += '<option value="' + estado.id + '">' + estado.descedo + '</option>';
        });
        $("#sltEstado").html(salida);
        $.ajax({
            url: "apirest/feriadoMunicipal/" + idMunicipio + "/" + mes + "/" + dia,
            success: function (json) {
                let fn = json.dato;
                feriadoMunicipalFrm = {id_municipio: fn.id_municipio, mes: fn.mes, dia: fn.dia, descripcion: fn.descripcion};
                $("#sltEstado").val(fn.id_estado);
                $("#sltMes").val(fn.mes);
                $("#txtDia").val(fn.dia);
                $("#txtDescripcion").val(fn.descripcion);
                $.ajax({
                    url: "apirest/municipios/" + fn.id_estado,
                    success: function (json2) {
                        salida="";
                        $.each(json2.datos, function (i, municipio) {
                            salida += '<option value="' + municipio.id + '">' + municipio.descmun + '</option>';
                        });
                        $("#sltMunicipio").html(salida);
                        $("#sltMunicipio").val(idMunicipio);
                    }
                });
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        let salida="";
        $.each(estados, function (i, estado) {
            salida += '<option value="' + estado.id + '">' + estado.descedo + '</option>';
        });
        $("#sltEstado").html(salida);
        $("#btnGuardar").click(function () {
            FeriadoMunicipal.agregar();
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/feriadoMunicipal",
            method: 'PUT',
            data: feriadoMunicipalFrm,
            success: function (json) {
                FeriadoMunicipal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idMunicipio, mes, dia){
        $.ajax({
            url: "apirest/feriadoMunicipal/"+idMunicipio+"/"+mes+"/"+dia,
            method: 'DELETE',
            success: function (json) {
                FeriadoMunicipal.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    form: function(idMunicipio, mes, dia){
        $.get("frmFeriadoMunicipal", function (html) {
            if (mes !== undefined && dia!== undefined && idMunicipio !== undefined) {
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
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            
            $("#txtDescripcion").change(function(){
                FeriadoMunicipal.cambioDescripcionForm();
            });
        });
    },
    listar: function(){
        let idMunicipio=Number($("#sltMunicipioFrdMunicipal").val());
        if (idMunicipio){
            $.ajax({
                url: "apirest/feriadosMunicipales/"+idMunicipio,
                success: function(json){
                    FeriadoMunicipal.mostrar(json);
                    sncApp.enviarNotificacion(json.descripcion);
                },
                error: function(error){
                    sncApp.notificarError(error);
                }
            });
        }
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let feriadosEstadales = json.datos;
            $.each(feriadosEstadales, function (i, feriado) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.mes === feriado.mes && json.dato.dia === feriado.dia && json.dato.id_estado ===feriado.id_estado) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-8 col-lg-6 font-weight-bold">' + feriado.descripcion + ' ('+feriado.estado+')</div>\n\
    <div class="col-sm-12 col-md-4 col-lg-3">' + feriado.dia + " de " + meses[feriado.mes - 1] + '</div>\n\
    <div class="col-sm-12 col-md-12 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoMunicipal.form(' +feriado.id_municipio + ','+feriado.mes + ',' + feriado.dia+ ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="FeriadoMunicipal.dialogoConfirmarBorrar('+feriado.id_municipio + ','+feriado.mes + ',' + feriado.dia+')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-frds-municipales").html(salida);
        }
    }
};

var Lapso={
    agregar: function(){
        $.ajax({
            url: "apirest/lapso",
            method: 'POST',
            data: lapsoFrm,
            success: function (json) {
                Lapso.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function (html) {
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-calendar-outline"></i> Registro de Lapso');
        $.ajax({
            url: "apirest/modalidades",
            success: function (jsonMod) {
                let modalidades = jsonMod.datos;
                let salida = '<option>[modalidad]</option>';
                $.each(modalidades, function (i, m) {
                    salida += '<option value="' + m.id_modalidad + '">' + m.descripcion + '</option>';
                });
                $("#sltModalidad").html(salida);
                $("#sltModalidad").change(function () {
                    Lapso.cambioModalidadForm();
                });
            }
        });
        $.ajax({
            url: "apirest/mecanismos",
            success: function (jsonMec) {
                let mecanismos = jsonMec.datos;
                let salida = '<option>[mecanismo]</option>';
                $.each(mecanismos, function (i, m) {
                    salida += '<option value="' + m.id_mecanismo + '">' + m.descripcion + '</option>';
                });
                $("#sltMecanismo").html(salida);
                $("#sltMecanismo").change(function () {
                    Lapso.cambioMecanismoForm();
                });
            }
        });
        $.ajax({
            url: "apirest/objetoscont",
            success: function (jsonMod) {
                let objetoscont = jsonMod.datos;
                let salida = '<option>[objetos de contratación]</option>';
                $.each(objetoscont, function (i, oc) {
                    salida += '<option value="' + oc.id_objeto_contratacion + '">' + oc.descripcion + '</option>';
                });
                $("#sltObjetoCont").html(salida);
                $("#sltObjetoCont").change(function () {
                    Lapso.cambioObjetoContForm();
                });
            }
        });
        $("#btnGuardar").click(function () {
            Lapso.agregar();
        });
    },
    dialogoConfirmarBorrar: function(idModalidad, idMecanismo, idObjetoCont){
        if (idModalidad!==undefined && idMecanismo!==undefined && idObjetoCont!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/lapso/"+idModalidad+"/"+idMecanismo+"/"+idObjetoCont,
                    success: function (json) {
                        let m = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el lapso");
                        $("#elementoAEliminar").html(m.descripcion);
                        $("#btnBorrar").click(function () {
                            Lapso.eliminar(idModalidad, idMecanismo,idObjetoCont);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idModalidad, idMecanismo, idObjetoCont){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Edición de Objeto de Contratación');
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            Lapso.editar();
        });
        $.ajax({
            url: "apirest/lapso/" + idModalidad + "/" + idMecanismo + "/" + idObjetoCont,
            success: function (json) {
                let l = json.dato;
                lapsoFrm = {id_modalidad: idModalidad, id_mecanismo: idMecanismo, id_objeto_contratacion: idObjetoCont, dias_habiles: l.dias_habiles};
                $.ajax({
                    url: "apirest/modalidades",
                    success: function (jsonMod) {
                        let modalidades = jsonMod.datos;
                        let salida = '<option>[modalidad]</option>';
                        $.each(modalidades, function (i, m) {
                            salida += '<option value="' + m.id_modalidad + '">' + m.descripcion + '</option>';
                        });
                        $("#sltModalidad").html(salida);
                        $("#sltModalidad").val(idModalidad);
                        $("#sltModalidad").prop("disabled", true);
                    }
                });
                $.ajax({
                    url: "apirest/mecanismos",
                    success: function (jsonMec) {
                        let mecanismos = jsonMec.datos;
                        let salida = '<option>[mecanismo]</option>';
                        $.each(mecanismos, function (i, m) {
                            salida += '<option value="' + m.id_mecanismo + '">' + m.descripcion + '</option>';
                        });
                        $("#sltMecanismo").html(salida);
                        $("#sltMecanismo").val(idMecanismo);
                        $("#sltMecanismo").prop("disabled", true);
                    }
                });
                $.ajax({
                    url: "apirest/objetoscont",
                    success: function (jsonMod) {
                        let objetoscont = jsonMod.datos;
                        let salida = '<option>[objetos de contratación]</option>';
                        $.each(objetoscont, function (i, oc) {
                            salida += '<option value="' + oc.id_objeto_contratacion + '">' + oc.descripcion + '</option>';
                        });
                        $("#sltObjetoCont").html(salida);
                        $("#sltObjetoCont").val(idObjetoCont);
                        $("#sltObjetoCont").prop("disabled", true);
                    }
                });
                
                $("#txtDiasHabiles").val(l.dias_habiles);
            }
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/lapso",
            method: 'PUT',
            data: lapsoFrm,
            success: function (json) {
                Lapso.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idModalidad, idMecanismo, idObjetoCont){
        $.ajax({
            url: "apirest/lapso/"+idModalidad+"/"+idMecanismo+"/"+idObjetoCont,
            method: 'DELETE',
            success: function (json) {
                Lapso.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    cambioModalidadForm: function(){
        lapsoFrm.id_modalidad=$("#sltModalidad").val();
    },
    cambioMecanismoForm: function(){
        lapsoFrm.id_mecanismo=$("#sltMecanismo").val();
    },
    cambioObjetoContForm: function(){
        lapsoFrm.id_objeto_contratacion=$("#sltObjetoCont").val();
    },
    cambioDiasHabilesForm: function(){
        lapsoFrm.dias_habiles=$("#txtDiasHabiles").val();
    },
    form: function(idModalidad, idMecanismo, idObjetoCont){
        $.get("frmLapso", function (html) {
            if (idModalidad!==undefined && idMecanismo!==undefined && idObjetoCont!==undefined) {
                Lapso.dialogoEditar(html, idModalidad, idMecanismo, idObjetoCont);
            } else {
                Lapso.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            
            $("#txtDiasHabiles").change(function(){
                Lapso.cambioDiasHabilesForm();
            });
        });
    },
    listar:function(){
        $.ajax({
            url: "apirest/lapsos",
            success: function(json){
                Lapso.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let lapsos = json.datos;
            if (json.datos) {
                salida+='\n\
<div class="accordion" id="listaLapsos">';
                $.each(lapsos, function (i, lapso) {
                    salida+=Lapso.mostrarCard(lapso);
                });
                salida+='\n\
</div>';
            }else{
                salida='<h1>'+json.descripcion+'</h1>';
            }
            $("#list-lapsos").html(salida);
        }
    },
    mostrarCard: function(lapso){
        let idLapso=lapso.id_modalidad+"-"+lapso.id_mecanismo+"-"+lapso.id_objeto_contratacion;
        let salida='\n\
<div class="card border shadow-sm">\n\
    <div class="card-header" id="encabezado'+idLapso+'">\n\
        <h5 class="mb-0">\n\
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#lapso'+idLapso+'" aria-expanded="true" aria-controls="lapso'+idLapso+'">\n\
                '+idLapso+' - '+lapso.objeto_contratacion+' - '+lapso.dias_habiles+' días hábiles\n\
            </button>\n\
        </h5>\n\
    </div>\n\
    <div id="lapso'+idLapso+'" class="collapse" aria-labelledby="encabezado'+idLapso+'" data-parent="#listaLapsos">\n\
        <div class="card-body row">\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Modalidad</div>\n\
                <div>' + lapso.modalidad + '</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Mecanismo</div>\n\
                <div>' + lapso.mecanismo + '</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-4">\n\
                <div class="font-weight-bold">Objeto de Contratación</div>\n\
                <div>' + lapso.objeto_contratacion + '</div>\n\
            </div>\n\
            <div class="col-sm-12 col-md-6 col-lg-6 font-weight-bold text-primary size-24">' + lapso.dias_habiles + ' días hábiles</div>\n\
            <div class="col-sm-12 col-md-12 col-lg-6 text-right">\n\
                <div class="btn-group" role="group">\n\
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                        onclick="Lapso.form('+lapso.id_modalidad+', '+lapso.id_mecanismo+', ' +lapso.id_objeto_contratacion + ')"><i class="ion-edit"></i> Editar</button>\n\
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                        onclick="Lapso.dialogoConfirmarBorrar('+lapso.id_modalidad+', '+lapso.id_mecanismo+', ' +lapso.id_objeto_contratacion +')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
                </div>\n\
            </div>\n\
        </div>\n\
    </div>\n\
</div>';
        return salida;
    }
};

var Mecanismo={
    agregar: function(){
        $.ajax({
            url: "apirest/mecanismo",
            method: 'POST',
            data: mecanismoFrm,
            success: function (json) {
                Mecanismo.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Registro de Modalidad');
        $("#btnGuardar").click(function () {
            Mecanismo.agregar();
        });
    },
    dialogoConfirmarBorrar: function(idMecanismo){
        if (idMecanismo!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/mecanismo/"+idMecanismo,
                    success: function (json) {
                        let m = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar la mecanismo");
                        $("#elementoAEliminar").html(m.descripcion);
                        $("#btnBorrar").click(function () {
                            Mecanismo.eliminar(idMecanismo);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idMecanismo){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Edición de Mecanismo');
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            Mecanismo.editar();
        });
        $.ajax({
            url: "apirest/mecanismo/" + idMecanismo,
            success: function (json) {
                let m = json.dato;
                mecanismoFrm = {id_mecanismo: m.id_mecanismo, descripcion: m.descripcion};
                $("#txtDescripcion").val(m.descripcion);
            }
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/mecanismo",
            method: 'PUT',
            data: mecanismoFrm,
            success: function (json) {
                Mecanismo.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idMecanismo){
        $.ajax({
            url: "apirest/mecanismo/"+idMecanismo,
            method: 'DELETE',
            success: function (json) {
                Mecanismo.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    cambioDescripcionForm: function(){
        mecanismoFrm.descripcion=$("#txtDescripcion").val();
    },
    form: function(idMecanismo){
        $.get("frmEntidadDescriptiva", function (html) {
            if (idMecanismo !== undefined) {
                Mecanismo.dialogoEditar(html, idMecanismo);
            } else {
                Mecanismo.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            
            $("#txtDescripcion").change(function(){
                Mecanismo.cambioDescripcionForm();
            });
        });
    },
    listar:function(){
        $.ajax({
            url: "apirest/mecanismos",
            success: function(json){
                Mecanismo.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let mecanismos = json.datos;
            $.each(mecanismos, function (i, mecanismo) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.id_mecanismo === mecanismo.id_mecanismo) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' + mecanismo.descripcion + '</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Mecanismo.form(' +mecanismo.id_mecanismo + ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Mecanismo.dialogoConfirmarBorrar('+mecanismo.id_mecanismo +')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-mecanismos").html(salida);
        }
    }
};
    
var Modalidad={
    agregar: function(){
        $.ajax({
            url: "apirest/modalidad",
            method: 'POST',
            data: modalidadFrm,
            success: function (json) {
                Modalidad.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Registro de Modalidad');
        $("#btnGuardar").click(function () {
            Modalidad.agregar();
        });
    },
    dialogoConfirmarBorrar: function(idModalidad){
        if (idModalidad!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/modalidad/"+idModalidad,
                    success: function (json) {
                        let m = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar la modalidad");
                        $("#elementoAEliminar").html(m.descripcion);
                        $("#btnBorrar").click(function () {
                            Modalidad.eliminar(idModalidad);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idModalidad){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Edición de Modalidad');
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            Modalidad.editar();
        });
        $.ajax({
            url: "apirest/modalidad/" + idModalidad,
            success: function (json) {
                let m = json.dato;
                modalidadFrm = {id_modalidad: m.id_modalidad, descripcion: m.descripcion};
                $("#txtDescripcion").val(m.descripcion);
            }
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/modalidad",
            method: 'PUT',
            data: modalidadFrm,
            success: function (json) {
                Modalidad.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idModalidad){
        $.ajax({
            url: "apirest/modalidad/"+idModalidad,
            method: 'DELETE',
            success: function (json) {
                Modalidad.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    cambioDescripcionForm: function(){
        modalidadFrm.descripcion=$("#txtDescripcion").val();
    },
    form: function(idModalidad){
        $.get("frmEntidadDescriptiva", function (html) {
            if (idModalidad !== undefined) {
                Modalidad.dialogoEditar(html, idModalidad);
            } else {
                Modalidad.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            
            $("#txtDescripcion").change(function(){
                Modalidad.cambioDescripcionForm();
            });
        });
    },
    listar:function(){
        $.ajax({
            url: "apirest/modalidades",
            success: function(json){
                Modalidad.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let modalidades = json.datos;
            $.each(modalidades, function (i, modalidad) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.id_modalidad === modalidad.id_modalidad) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' + modalidad.descripcion + '</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Modalidad.form(' +modalidad.id_modalidad + ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="Modalidad.dialogoConfirmarBorrar('+modalidad.id_modalidad +')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-modalidades").html(salida);
        }
    }
};

var ObjetoContratacion={
    agregar: function(){
        $.ajax({
            url: "apirest/objetocont",
            method: 'POST',
            data: objetocontFrm,
            success: function (json) {
                ObjetoContratacion.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    dialogoAgregar: function(html){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Registro de Objeto de Contratación');
        $("#btnGuardar").click(function () {
            ObjetoContratacion.agregar();
        });
    },
    dialogoConfirmarBorrar: function(idObjetoCont){
        if (idObjetoCont!==undefined) {
            $.get("frmConfirmarBorrar", function (html) {
                $("#sncModalDlg").html(html);
                $("#btnCerrarDialogoModal").click(function () {
                    $("#sncModalDlg").modal('hide');
                    $("#sncModalDlg").html("");
                });
                $.ajax({
                    url: "apirest/objetocont/"+idObjetoCont,
                    success: function (json) {
                        let m = json.dato;
                        $("#descripcionDeAccion").html("Está a punto de eliminar el objeto de contración");
                        $("#elementoAEliminar").html(m.descripcion);
                        $("#btnBorrar").click(function () {
                            ObjetoContratacion.eliminar(idObjetoCont);
                        });
                    },
                    error: function (error) {
                        sncApp.notificarError(error);
                    }
                });
            });
        }
    },
    dialogoEditar: function(html, idObjetoCont){
        $("#sncModalDlg").html(html);
        $("#tituloForm").html('<i class="ion-ios-location"></i> Edición de Objeto de Contratación');
        $("#btnGuardar").html('<i class="ion-edit"></i> Editar');
        $("#btnGuardar").click(function () {
            ObjetoContratacion.editar();
        });
        $.ajax({
            url: "apirest/objetocont/" + idObjetoCont,
            success: function (json) {
                let oc = json.dato;
                objetocontFrm = {id_objeto_contratacion: oc.id_objeto_contratacion, descripcion: oc.descripcion};
                $("#txtDescripcion").val(oc.descripcion);
            }
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/objetocont",
            method: 'PUT',
            data: objetocontFrm,
            success: function (json) {
                ObjetoContratacion.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    eliminar: function(idObjetoCont){
        $.ajax({
            url: "apirest/objetocont/"+idObjetoCont,
            method: 'DELETE',
            success: function (json) {
                ObjetoContratacion.mostrar(json);
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    },
    cambioDescripcionForm: function(){
        objetocontFrm.descripcion=$("#txtDescripcion").val();
    },
    form: function(idObjetoCont){
        $.get("frmEntidadDescriptiva", function (html) {
            if (idObjetoCont !== undefined) {
                ObjetoContratacion.dialogoEditar(html, idObjetoCont);
            } else {
                ObjetoContratacion.dialogoAgregar(html);
            }
            $("#btnCerrarDialogoModal").click(function(){
                $("#sncModalDlg").modal('hide');
                $("#sncModalDlg").html("");
            });
            
            $("#txtDescripcion").change(function(){
                ObjetoContratacion.cambioDescripcionForm();
            });
        });
    },
    listar:function(){
        $.ajax({
            url: "apirest/objetoscont",
            success: function(json){
                ObjetoContratacion.mostrar(json);
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    mostrar: function (json) {
        let salida = '';
        if (json.ok) {
            let objetoscont = json.datos;
            $.each(objetoscont, function (i, objetocont) {
                let tipoAlert = "light";
                if (json.dato) {
                    if (json.dato.id_objeto_contratacion === objetocont.id_objeto_contratacion) {
                        tipoAlert = "info";
                    }
                }
                salida += '\
<div class="row alert alert-' + tipoAlert + ' shadow-sm border-right">\n\
    <div class="col-sm-12 col-md-9 col-lg-9 font-weight-bold">' + objetocont.descripcion + '</div>\n\
    <div class="col-sm-12 col-md-3 col-lg-3 text-right">\n\
        <div class="btn-group" role="group">\n\
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="ObjetoContratacion.form(' +objetocont.id_objeto_contratacion + ')"><i class="ion-edit"></i> Editar</button>\n\
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#sncModalDlg" \n\
                onclick="ObjetoContratacion.dialogoConfirmarBorrar('+objetocont.id_objeto_contratacion +')" ><i class="ion-trash-a"></i> Eliminar</button>\n\
        </div>\n\
    </div>\n\
</div>';
            });
            $("#list-objetos-cont").html(salida);
        }
    }
};

var OrganoEnte={
    cambioSltTipoOrganoEnte: function(){
        let tipo=$("#sltTipoOrganoEnte").val();
        organoEnteFrm.tipo_organoente=tipo;
        OrganoEnte.cargarSltOrganoEnteAdc(tipo);
    },
    cambioSltOrganoEnteAds: function(){
        organoEnteFrm.id_organoenteads=$("#sltOrganoEnteAds").val();
    },
    cambioSltEstado: function(){
        let idEstado=$("#sltEstado").val();
        organoEnteFrm.id_estado=idEstado;
        OrganoEnte.cargarSltMunicipio(idEstado);
    },
    cambioSltMunicipio: function(){
        organoEnteFrm.id_municipio=$("#sltMunicipio").val();
    },
    cambioSltParroquia: function(){
        alert($("#sltParroquia").val());
        organoEnteFrm.id_parroquia=$("#sltParroquia").val();
    },
    cargarSltMunicipio: function(idEstado){
        $.ajax({
            url: "apirest/municipios/"+idEstado,
            method: 'GET',
            success: function (json) {
                let salida = '<option>[Municipio]<option/>\n';
                $.each(json.datos, function (i, mun) {
                    salida += '<option value="' + mun.id + '">' + mun.descmun + '<option/>\n';
                });
                $("#sltMunicipio").html(salida);
            }
        });
    },
    cargarSltParroquia: function(idEstado){
        $.ajax({
            url: "apirest/parroquias/"+idEstado,
            method: 'GET',
            success: function (json) {
                let salida = '<option>[Parroquia]<option/>\n';
                $.each(json.datos, function (i, parro) {
                    salida += '<option value="' + parro.id + '">' + parro.descparro + '<option/>\n';
                });
                $("#sltParroquia").html(salida);
            }
        });
    },
    cargarSltOrganoEnteAdc: function (tipoOrganoEnte) {
        switch (tipoOrganoEnte) {
            case "0":
                $("#sltOrganoEnteAds").prop('disabled', true);
                organoEnteFrm.id_organoenteads = 0;
                let salida = '<option value=0>No aplica<option/>';
                $("#sltOrganoEnteAds").html(salida);
                break;
            case "1":
                $.ajax({
                    url: "apirest/organospadres",
                    method: 'GET',
                    success: function (json) {
                        let salida = '<option>[Órgano Padre]<option/>\n';
                        $.each(json.datos, function (i, oe) {
                            salida += '<option value="' + oe.id_organoente + '">' + oe.descripcion + '<option/>\n';
                        });
                        $("#sltOrganoEnteAds").prop('disabled', false);
                        $("#sltOrganoEnteAds").html(salida);
                    }
                });
                break;
            case "2":
                $.ajax({
                    url: "apirest/organos",
                    method: 'GET',
                    success: function (json) {
                        let salida = '<option>[Órgano Adsctito]<option/>\n';
                        $.each(json.datos, function (i, oe) {
                            salida += '<option value="' + oe.id_organoente + '">' + oe.descripcion + '<option/>\n';
                        });
                        $("#sltOrganoEnteAds").prop('disabled', false);
                        $("#sltOrganoEnteAds").html(salida);
                    }
                });
                break;
        }
    },
    dialogoPerfilInstitucional: function(){
        $.ajax({
            url: "apirest/miperfilinstitucional",
            method: 'GET',
            success: function(json){
                organoEnteFrm=json.dato;
                let oe=json.dato;
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
                        let salida='<option>[Estado]</option>\n';
                        $.each(estados, function (i, estado) {
                            salida+='<option value='+estado.id+'>'+estado.descedo+'</option>\n';
                        });
                        $("#sltEstado").html(salida);
                        $("#sltEstado").val(oe.id_estado);
                        $.ajax({
                            url: "apirest/municipios/"+oe.id_estado,
                            success: function (json3) {
                                let municipios=json3.datos;
                                salida='<option>[Municipio]</option>';
                                $.each(municipios, function (i, mun) {
                                    salida+='<option value='+mun.id+'>'+mun.descmun+'</option>\n';
                                });
                                $("#sltMunicipio").html(salida);
                                $("#sltMunicipio").val(oe.id_municipio);
                                $.ajax({
                                    url: "apirest/parroquias/"+oe.id_estado,
                                    success: function (json4) {
                                        let parroquias = json4.datos;
                                        salida = '<option>[Parroquia]</option>';
                                        $.each(parroquias, function (i, prr) {
                                            salida += '<option value=' + prr.id + '>' + prr.descparro + '</option>\n';
                                        });
                                        $("#sltParroquia").html(salida);
                                        $("#sltParroquia").val(oe.id_parroquia);
                                    }
                                });
                            }
                        });    
                    }
                });
            },
            error: function(error){
                sncApp.notificarError(error);
            }
        });
    },
    editar: function(){
        $.ajax({
            url: "apirest/organo",
            method: 'PUT',
            data: organoEnteFrm,
            success: function (json) {
                sncApp.enviarNotificacion(json.descripcion);
            },
            error: function (error) {
                sncApp.notificarError(error);
            }
        });
    }
};

var LlamadoConcurso={
    cambioSltModalidad:function(){
        dataLapsos.id_modalidad=$('#sltModalidad').val();
        LlamadoConcurso.calcularLapsos();
    },
    cambioSltMecanismo:function(){
        dataLapsos.id_mecanismo=$('#sltMecanismo').val();
        LlamadoConcurso.calcularLapsos();
    },
    cambioSltObjetoContratacion:function(){
        dataLapsos.id_objeto_contratacion=$('#sltObjetoContratacion').val();
        LlamadoConcurso.calcularLapsos();
    },
    cambioTxtFechaLlamado:function(){
        dataLapsos.fechallamado=$('#txtFechaLlamado').val();
        LlamadoConcurso.calcularLapsos();
    },
    cambioTxtFechaDisponibleLlamado:function(){
        let fchNueva=new Date($("#txtFechaDisponibleLlamado").val());
        let fchLapso=new Date(lapsosFechas.fecha_disponible_llamado);
        if (fchNueva.getTime()<fchLapso.getTime()){
            $("#errFechaDisponibleLlamado").prop('hidden', false);
        }else{
            $("#errFechaDisponibleLlamado").prop('hidden', true);
        }
    },
    cambioTxtFechaFinAclaratoria:function(){
        let fchNueva=new Date($("#txtFechaFinAclaratoria").val());
        let fchLapso=new Date(lapsosFechas.fecha_fin_aclaratoria);
        if (fchNueva.getTime()<fchLapso.getTime()){
            $("#errFechaFinAclaratoria").prop('hidden', false);
        }else{
            $("#errFechaFinAclaratoria").prop('hidden', true);
        }
    },
    cambioTxtFechaTope:function(){
        let fchNueva=new Date($("#txtFechaTope").val());
        let fchLapso=new Date(lapsosFechas.fecha_tope);
        if (fchNueva.getTime()<fchLapso.getTime()){
            $("#errFechaTope").prop('hidden', false);
        }else{
            $("#errFechaTope").prop('hidden', true);
        }
    },
    cambioTxtFechaFin:function(){
        let fchNueva=new Date($("#txtFechaFin").val());
        let fchLapso=new Date(lapsosFechas.fecha_fin_llamado);
        if (fchNueva.getTime()<fchLapso.getTime()){
            $("#errFechaFin").prop('hidden', false);
        }else{
            $("#errFechaFin").prop('hidden', true);
        }
    },
    calcularLapsos: function(){
        if (dataLapsos.fechallamado!=='' && dataLapsos.id_modalidad>0 && dataLapsos.id_mecanismo>0 && dataLapsos.id_objeto_contratacion>0){
            $.ajax({
                url: "apirest/calcularLapsos/"+dataLapsos.rif+'/'+dataLapsos.fechallamado+'/'+dataLapsos.id_modalidad+'/'+dataLapsos.id_mecanismo+'/'+dataLapsos.id_objeto_contratacion,
                method: 'get',
                success: function (json) {
                    lapsosFechas=json.datos;
                    
                    $("#txtFechaInicioAclaratoria").val(lapsosFechas.fecha_llamado);
                    $("#txtFechaDisponibleLlamado").val(lapsosFechas.fecha_disponible_llamado);
                    $("#txtFechaFinAclaratoria").val(lapsosFechas.fecha_fin_aclaratoria);
                    $("#txtFechaTope").val(lapsosFechas.fecha_tope);
                    $("#txtFechaFin").val(lapsosFechas.fecha_fin_llamado);
                    $("#txtDiasHabiles").val(lapsosFechas.dias_habiles);
                    $("#errFechaDisponibleLlamado").html('No puede ser menor que: '+ formatearFecha(lapsosFechas.fecha_disponible_llamado));
                    $("#errFechaFinAclaratoria").html('No puede ser menor que: '+formatearFecha(lapsosFechas.fecha_fin_aclaratoria));
                    $("#errFechaTope").html('No puede ser menor que: '+formatearFecha(lapsosFechas.fecha_tope));
                    $("#errFechaFin").html('No puede ser menor que: '+formatearFecha(lapsosFechas.fecha_fin_llamado));   
                }
            });
        }
    }
};