function consultar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b').val();
    if (rif_b == ''){
        swal({
            title: "¡ATENCION!",
            text: "El campo no puede estar vacio.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else{
        $("#items").show();
        //var base_url  = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista';
        //var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/evaluacion_desempenio/llenar_contratista';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                    $('#exitte').val(0);

                }else{
                    $("#existe").show();
                    $("#no_existe").hide();

                    $('#exitte').val(1);

                    $('#rif_cont').val(data['rifced']);
                    $('#nombre').val(data['nombre']);
                    $('#estado').val(data['descedo']);
                    $('#municipio').val(data['descmun']);
                    $('#ciudad').val(data['descciu']);
                    $('#persona_cont').val(data['percontacto']);
                    $('#tel_cont').val(data['telf1']);

                    var rif_cont_nr = data['rifced'];
                    var ultprocaprob = data['ultprocaprob'];
                    $.ajax({
                        url:base_url2,
                        method: 'post',
                        data: {ultprocaprob: ultprocaprob,
                              rif_cont_nr: rif_cont_nr},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, response){
                               $('#tabla_rep tbody').append('<tr><td>' + response['cedrif'] + '</td><td>' + response['repr'] + '</td><td>' + response['cargo'] + '</td></tr>');
                            });
                        }
                    });
                }
            }
        })
    }
}

$("#monto").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});

function hab_campo(){
    var otro = document. getElementById('cssRadio5').checked;
    if (otro == true) {
        $("#hab_campo_esp").show();
    }else {
        $('#hab_campo_esp').hide();
    }
}

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

function llenar_municipio(){
    var id_estado_n = $('#id_estado_n').val();
    //var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_municipio';
    var base_url = '/index.php/evaluacion_desempenio/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}

function llenar_parroquia(){
    var id_municipio_n = $('#id_estado_n').val();
    //var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_parroquia';
    var base_url = '/index.php/evaluacion_desempenio/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}

function listar_ciudades(){
    var id_estado_n = $('#id_estado_n').val();
    //var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/listar_ciudades';
    var base_url = '/index.php/evaluacion_desempenio/listar_ciudades';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',
        success: function(response){
            console.log(response);
            $('#ciudad_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#ciudad_n').append('<option value="'+data['id']+'">'+data['descciu']+'</option>');
            });
        }
    });
}

function llenar_sub_mod(){
    var id_modalidad = $('#id_modalidad').val();
    //var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_sub_modalidad';
    var base_url = '/index.php/evaluacion_desempenio/llenar_sub_modalidad';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_modalidad: id_modalidad},
        dataType:'json',

        success: function(response){
            $('#id_sub_modalidad').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_sub_modalidad').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
            });
        }
    });
}

function evaluar(){
    var bienes = document. getElementById('cssCheckbox1').checked;
    var servicios = document. getElementById('cssCheckbox2').checked;
    var obras = document. getElementById('cssCheckbox3').checked;

    if (bienes == false && servicios == false && obras == false) {
        swal({
            title: "¡ATENCION!",
            text: "Debe Seleccionar al menos un Objeto de Contratación.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#calidad').attr("disabled", true);
        $('#responsabilidad').attr("disabled", true);
        $('#conocimiento').attr("disabled", true);
        $('#oportunidad').attr("disabled", true);
    }else {
        $('#calidad').attr("disabled", false);
        $('#responsabilidad').attr("disabled", false);
        $('#conocimiento').attr("disabled", false);
        $('#oportunidad').attr("disabled", false);

        var rif_b = $('#rif_b').val();

        var calidad = $('#calidad').val();
        var responsabilidad = $('#responsabilidad').val();
        var conocimiento = $('#conocimiento').val();
        var oportunidad = $('#oportunidad').val();

        var calidad_p = 25
        var responsabilidad_p = 25
        var conocimiento_p = 25
        var oportunidad_p = 25

        var calidad_t = calidad * calidad_p
        $('#total1').val(calidad_t);
        var responsabilidad_t = responsabilidad * responsabilidad_p
        $('#total2').val(responsabilidad_t);
        var conocimiento_t = conocimiento * conocimiento_p
        $('#total3').val(conocimiento_t);
        var oportunidad_t = oportunidad * oportunidad_p
        $('#total4').val(oportunidad_t);
        var total = calidad_t + responsabilidad_t + conocimiento_t + oportunidad_t

        $('#total_claf').val(total);

        if (total == 100) {
            var calificacion = 'EXCELENTE'
            $('#calificacion').val(calificacion);
        }

        if (total == 75) {
            var calificacion = 'BUENO'
            $('#calificacion').val(calificacion);
        }

        if (total == 50) {
            var calificacion = 'REGULAR'
            $('#calificacion').val(calificacion);
        }

        if (total == 25) {
            var calificacion = 'DEFICIENTE'
            $('#calificacion').val(calificacion);
        }

        if (total == 0) {
            var calificacion = 'SIN CALIFICACIÓN'
            $('#calificacion').val(calificacion);
        }
    }
}

function validar_fecha(){
    var fecha_hasta = $('#fecha_hasta').val();
    var fecha_ntf = $('#datepicker-default').val();

    var separar = fecha_hasta.split("/");
    var dia_d = separar['0'];
    var mes_d = separar['1'];
    var anio_d = separar['2'];

    var separar_2 = fecha_ntf.split("/");
    var dia_ntf = separar_2['0'];
    var mes_ntf = separar_2['1'];
    var anio_ntf = separar_2['2'];


    if (dia_ntf <= dia_d || mes_ntf < mes_d || anio_ntf < anio_d) {
        swal({
            title: "¡ATENCION!",
            text: "La fecha de notificación debe ser mayor a la de Finalización de Contrato.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#registrar_eval').attr("disabled", true);
        $('#medio').attr("disabled", true);
        $('#nro_oc_os').attr("disabled", true);
        $('#fileImagen').attr("disabled", true);
    }
    if (dia_ntf <= dia_d && mes_ntf == mes_d && anio_ntf == anio_d) {
        swal({
            title: "¡ATENCION!",
            text: "La fecha de notificación debe ser mayor a la de Finalización de Contrato.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#registrar_eval').attr("disabled", true);
        $('#medio').attr("disabled", true);
        $('#nro_oc_os').attr("disabled", true);
        $('#fileImagen').attr("disabled", true);
    }else{
        $('#registrar_eval').attr("disabled", false);
        $('#medio').attr("disabled", false);
        $('#nro_oc_os').attr("disabled", false);
        $('#fileImagen').attr("disabled", false);
    }
}

function registrar(){
    var exitte            = $("#exitte").val();

    var rif_cont_n        = $("#rif_cont_n").val();
    var nombre_n          = $("#nombre_n").val();
    var id_estado_n       = $("#id_estado_n").val();
    var id_municipio_n    = $("#id_municipio_n").val();
    var id_parroquia_n    = $("#id_parroquia_n").val();
    var ciudad_n          = $("#ciudad_n").val();

    var id_pais_n         = $("#id_pais_n").val();
    var ced_rep_leg_n     = $("#ced_rep_leg_n").val();
    var nom_rep_leg_n     = $("#nom_rep_leg_n").val();
    var ape_rep_leg_n     = $("#ape_rep_leg_n").val();
    var edo_civil_n       = $("#edo_civil_n").val();
    var cargo_rep_leg_n   = $("#cargo_rep_leg_n").val();
    var operadora_n       = $("#operadora_n").val();
    var numero_n          = $("#numero_n").val();

    var id_modalidad      = $("#id_modalidad").val();
    var id_sub_modalidad  = $("#id_sub_modalidad").val();
    var fecha_desde       = $("#fecha_desde").val();
    var fecha_hasta       = $("#fecha_hasta").val();
    var nro_procedimiento = $("#nro_procedimiento").val();
    var nro_cont_oc_os    = $("#nro_cont_oc_os").val();
    var id_estado_dc      = $("#id_estado_dc").val();
    var cssCheckbox1      = $("#cssCheckbox1").val();
    var cssCheckbox2      = $("#cssCheckbox2").val();
    var cssCheckbox3      = $("#cssCheckbox3").val();
    var desc_contratacion = $("#desc_contratacion").val();
    var monto             = $("#monto").val();
    var cssRadio1         = $("#cssRadio1").val();
    var cssRadio2         = $("#cssRadio2").val();
    var cssRadio3         = $("#cssRadio3").val();
    var cssRadio4         = $("#cssRadio4").val();

    var calidad           = $("#calidad").val();
    var responsabilidad   = $("#responsabilidad").val();
    var conocimiento      = $("#conocimiento").val();
    var oportunidad       = $("#oportunidad").val();

    var total_claf        = $("#total_claf").val();
    var calificacion      = $("#calificacion").val();

    var fecha_not       = $("#datepicker-default").val();
    var medio           = $("#medio").val();
    var nro_oc_os       = $("#nro_oc_os").val();
    var fileImagen      = $("#fileImagen").val();

    var fileSize = $('#fileImagen')[0].files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
    if (siezekiloByte >  $('#fileImagen').attr('size')) {
        alert("Imagen muy grande");
        return false;
    }

    var tipo = fileImagen.split(".")[1];
    if (exitte == '0'){
        if (rif_cont_n == '') {
            document.getElementById("rif_cont_n").focus();
        }else if (nombre_n == '') {
            document.getElementById("nombre_n").focus();
        }else if (id_estado_n == '0') {
            document.getElementById("id_estado_n").focus();
        }else if (id_municipio_n == '0') {
            document.getElementById("id_municipio_n").focus();
        }else if (id_parroquia_n == '0') {
            document.getElementById("id_parroquia_n").focus();
        }else if (ciudad_n == '0') {
            document.getElementById("ciudad_n").focus();
        }else if (id_pais_n == '0') {
            document.getElementById("id_pais_n").focus();
        }else if (ced_rep_leg_n == '') {
            document.getElementById("ced_rep_leg_n").focus();
        }else if (nom_rep_leg_n == '') {
            document.getElementById("nom_rep_leg_n").focus();
        }else if (ape_rep_leg_n == '') {
            document.getElementById("ape_rep_leg_n").focus();
        }else if (edo_civil_n == '0') {
            document.getElementById("edo_civil_n").focus();
        }else if (cargo_rep_leg_n == '') {
            document.getElementById("cargo_rep_leg_n").focus();
        }else if (operadora_n == '0') {
            document.getElementById("operadora_n").focus();
        }else if (numero_n == '') {
            document.getElementById("numero_n").focus();
        }else if (id_modalidad == '0') {
            document.getElementById("id_modalidad").focus();
        }else if (id_sub_modalidad == '0') {
            document.getElementById("id_sub_modalidad").focus();
        }else if (fecha_desde == '') {
            document.getElementById("fecha_desde").focus();
        }else if (fecha_hasta == '') {
            document.getElementById("fecha_hasta").focus();
        }else if (nro_procedimiento == '') {
            document.getElementById("nro_procedimiento").focus();
        }else if (nro_cont_oc_os == '') {
            document.getElementById("nro_cont_oc_os").focus();
        }else if (id_estado_dc == '0') {
            document.getElementById("id_estado_dc").focus();
        }else if (desc_contratacion == '') {
            document.getElementById("desc_contratacion").focus();
        }else if (monto == '') {
            document.getElementById("monto").focus();
        }else if (calidad == '3') {
            document.getElementById("calidad").focus();
        }else if (responsabilidad == '3') {
            document.getElementById("responsabilidad").focus();
        }else if (conocimiento == '3') {
            document.getElementById("conocimiento").focus();
        }else if (oportunidad == '3') {
            document.getElementById("oportunidad").focus();
        }else if (total_claf == '') {
            document.getElementById("total_claf").focus();
        }else if (calificacion == '') {
            document.getElementById("calificacion").focus();
        }
        else if (fecha_not == '') {
            document.getElementById("datepicker-default").focus();
        }else if (medio == '0') {
            document.getElementById("medio").focus();
        }else if (nro_oc_os == '') {
            document.getElementById("nro_oc_os").focus();
        }
        else if (fileImagen == '') {
            document.getElementById("fileImagen").focus();
        }else if (tipo != 'pdf' && tipo != 'jpg' && tipo != 'img'&& tipo != 'png' && tipo != 'jpeg') {
            swal("Mensaje de alerta!", "El tipo de archivo debe ser en formato pdf, jpg, img, png o jpeg.")
            document.getElementById("fileImagen").focus();
        }else{
            var calificacion = $('#calificacion').val();
            if (calificacion == 'DEFICIENTE' || calificacion == 'SIN CALIFICACIÓN'){
                event.preventDefault();
                swal.fire({
                    title: 'ALERTA',
                    text: 'Con base al resultado de la evaluación de desempeño, deberá remitir al Servicio Nacional de Contrataciones, el Expediente Administrativo contentivo de la decisión del contratante con respecto a los supuestos generadores de sanción, así como la liquidación correspondiente a la multa por trecientas (300) UCAU, a beneficio del Servicio Nacional de Contrataciones de conformidad a lo establecido en los artículos 167 y 168 del Decreto con Rango, Valor y Fuerza de Ley de Contrataciones Públicas.                                                 ¿Esta Seguro de Registrar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Si, guardar!'
                }).then((result) => {
                    if (result.value == true) {
                        event.preventDefault();
                        var datos = new FormData($("#resgistrar_eva")[0]);
                        //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/registrar';
                        var base_url = '/index.php/evaluacion_desempenio/registrar';
                        $.ajax({
                            url:base_url,
                            method: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            success: function(response){
                                if(response != '') {
                                    var menj = 'Identificador de Evaluación de Desempeño: ';
                                    swal.fire({
                                        title: 'Registro Exitoso',
                                        text: menj + response,
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        console.log(result.value);
                                        if (result.value == true){
                                            location.reload();
                                        }
                                    });
                                }
                            }
                        })
                    }
                });
            }else {
                event.preventDefault();
                swal.fire({
                    title: '¿Registrar?',
                    text: '¿Esta seguro de Registrar la Evaluación de Desempeño?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Si, guardar!'
                }).then((result) => {
                    if (result.value == true) {
                        event.preventDefault();
                        var datos = new FormData($("#resgistrar_eva")[0]);
                        //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/registrar';
                        var base_url = '/index.php/evaluacion_desempenio/registrar';
                        $.ajax({
                            url:base_url,
                            method: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            success: function(response){
                                console.log(response);
                                if(response != '') {
                                    console.log(response);
                                        var menj = 'Identificador de Evaluación de Desempeño: ';
                                    swal.fire({
                                        title: 'Registro Exitoso',
                                        text: menj + response,
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
    }else if (exitte == '1'){
        if (id_modalidad == '0') {
            document.getElementById("id_modalidad").focus();
        }else if (id_sub_modalidad == '0') {
            document.getElementById("id_sub_modalidad").focus();
        }else if (fecha_desde == '') {
            document.getElementById("fecha_desde").focus();
        }else if (fecha_hasta == '') {
            document.getElementById("fecha_hasta").focus();
        }else if (nro_procedimiento == '') {
            document.getElementById("nro_procedimiento").focus();
        }else if (nro_cont_oc_os == '') {
            document.getElementById("nro_cont_oc_os").focus();
        }else if (id_estado_dc == '0') {
            document.getElementById("id_estado_dc").focus();
        }else if (desc_contratacion == '') {
            document.getElementById("desc_contratacion").focus();
        }else if (monto == '') {
            document.getElementById("monto").focus();
        }else if (calidad == '3') {
            document.getElementById("calidad").focus();
        }else if (responsabilidad == '3') {
            document.getElementById("responsabilidad").focus();
        }else if (conocimiento == '3') {
            document.getElementById("conocimiento").focus();
        }else if (oportunidad == '3') {
            document.getElementById("oportunidad").focus();
        }else if (total_claf == '') {
            document.getElementById("total_claf").focus();
        }else if (calificacion == '') {
            document.getElementById("calificacion").focus();
        }
        else if (fecha_not == '') {
            document.getElementById("datepicker-default").focus();
        }else if (medio == '0') {
            document.getElementById("medio").focus();
        }else if (nro_oc_os == '') {
            document.getElementById("nro_oc_os").focus();
        }else if (fileImagen == '') {
            document.getElementById("fileImagen").focus();
        }else if (tipo != 'pdf' && tipo != 'jpg' && tipo != 'img'&& tipo != 'png' && tipo != 'jpeg') {
            swal("Mensaje de alerta!", "El tipo de archivo debe ser en formato pdf, jpg, img, png o jpeg.")
            document.getElementById("fileImagen").focus();
        }else{
            var calificacion = $('#calificacion').val();
            if (calificacion == 'DEFICIENTE' || calificacion == 'SIN CALIFICACIÓN'){
                event.preventDefault();
                swal.fire({
                    title: 'ALERTA',
                    text: 'Con base al resultado de la evaluación de desempeño, deberá remitir al Servicio Nacional de Contrataciones, el Expediente Administrativo contentivo de la decisión del contratante con respecto a los supuestos generadores de sanción, así como la liquidación correspondiente a la multa por trecientas (300) UCAU, a beneficio del Servicio Nacional de Contrataciones de conformidad a lo establecido en los artículos 167 y 168 del Decreto con Rango, Valor y Fuerza de Ley de Contrataciones Públicas.                                                 ¿Esta Seguro de Registrar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Si, guardar!'
                }).then((result) =>{
                    if (result.value == true){
                        event.preventDefault();
                        var datos = new FormData($("#resgistrar_eva")[0]);
                        //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/registrar';
                         var base_url = '/index.php/evaluacion_desempenio/registrar';
                        $.ajax({
                            url:base_url,
                            method: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            success: function(response){
                                if(response != '') {
                                    var menj = 'Identificador de Evaluación de Desempeño: ';
                                    swal.fire({
                                        title: 'Registro Exitoso',
                                        text: menj + response,
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
            }else{
                event.preventDefault();
                swal.fire({
                    title: '¿Registrar?',
                    text: '¿Esta seguro de Registrar la Evaluación de Desempeño?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Si, guardar!'
                }).then((result) => {
                    if (result.value == true) {

                        event.preventDefault();
                        var datos = new FormData($("#resgistrar_eva")[0]);
                        //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/registrar';
                         var base_url = '/index.php/evaluacion_desempenio/registrar';
                        $.ajax({
                            url:base_url,
                            method: 'POST',
                            data: datos,
                            contentType: false,
                            processData: false,
                            success: function(response){
                                var menj = 'Identificador de Evaluación de Desempeño: ';

                                if(response != '') {
                                    swal.fire({
                                        title: 'Registro Exitoso',
                                        text: menj + response,
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.value == true){
                                            location.reload();
                                            // $('#registrar_eval').attr("disabled", true)
                                            // $('#exampleModal').modal('show');
                                            // $('#id').val(response);
                                        }
                                    });
                                }
                            }
                        })
                    }
                });
            }
        }
    }
}
