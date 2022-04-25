$(document).ready(function(){
    $('#acc_cargar').change(function(){
        var acc_cargar = $(this).val();
        if (acc_cargar === '1') {
            $("#acc_s").hide();
            $("#proyecto_s").show();
        }else if (acc_cargar === '2') {
            $("#proyecto_s").hide();
            $("#acc_s").show();
        }
    });

    $('#fuente_financiamiento').change(function(){
        var fuente_financiamiento = $(this).val();
         var ff = fuente_financiamiento.split("/")[0];
        console.log(ff);
        if (ff === '12') {
            $("#desc_ff").show();
        }else{
            $("#desc_ff").hide();
        }
    });


    $("#precio_total").on({
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

    $("#prec_t").on({
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

    $("#costo_unitario").on({
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
});

function registrar_anio(){
    var anio  = $("#anio").val();

    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar el año?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#resgistrar_anio")[0]);
            var base_url =window.location.origin+'/asnc/index.php/programacion/agg_programacion_anio';
            //var base_url = '/index.php/programacion/agg_programacion_anio';
            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso',
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

function porc(){
    var porcentaje = $('#porcentaje').val();

    if (porcentaje > 100) {
        swal({
            title: "¡ATENCION!",
            text: "El porcentaje no puede ser mayor a 100.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else if (porcentaje < 0) {
        swal({
            title: "¡ATENCION!",
            text: "El porcentaje no puede ser menor a 0.",
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
        $('#ueba').attr("disabled", false);
    }
}

function verif_d(){
    var fecha_desde = $('#fecha_desde').val();
    var fecha_esti = $('#fecha_est').val();

     var anio_d = fecha_desde.split("/")[2];
    if (anio_d != fecha_esti) {
        swal({
            title: "¡ATENCION!",
            text: "El año en la Fecha Desde ingresada no puede ser diferente al de la Programación.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#especificacion").prop('disabled', true);
        $("#id_unidad_medida").prop('disabled', true);
        $("#precio_total").prop('disabled', true);
    }else {
        $("#especificacion").prop('disabled', false);
        $("#id_unidad_medida").prop('disabled', false);
        $("#precio_total").prop('disabled', false);
    }
}

function verif_h(){
    var fecha_hasta = $('#fecha_hasta').val();
    var fecha_esti = $('#fecha_est').val();

    var anio_h = fecha_hasta.split("/")[2];

    if (anio_h != fecha_esti) {
        swal({
            title: "¡ATENCION!",
            text: "El año en la Fecha Hasta ingresada no puede ser diferente al de la Programación.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#especificacion").prop('disabled', true);
        $("#id_unidad_medida").prop('disabled', true);
        $("#precio_total").prop('disabled', true);
    }else{
        $("#especificacion").prop('disabled', false);
        $("#id_unidad_medida").prop('disabled', false);
        $("#precio_total").prop('disabled', false);
    }
}

function habilitar_trim() {
    var fecha_desde = $('#fecha_desde').val();
    var mes_d = fecha_desde.split("/")[1];
    var fecha_hasta = $('#fecha_hasta').val();
    var mes_h = fecha_hasta.split("/")[1];

    if (mes_d >= 01 && mes_h <= 03) {
        $("#I").prop('disabled', false);
        $("#II").prop('disabled', true);
        $("#III").prop('disabled', true);
        $("#IV").prop('disabled', true);
    }else if (mes_d >= 01 && mes_h <= 06) {
        $("#I").prop('disabled', false);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', true);
        $("#IV").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 09) {
        $("#I").prop('disabled', false);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 12) {
        $("#I").prop('disabled', false);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', false);
    }

    if (mes_d >= 04 && mes_h <= 06){
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', true);
        $("#IV").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 09) {
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 12) {
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', false);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', false);
    }

    if (mes_d >= 06 && mes_h <= 09) {
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', true);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', true);
    }else if (mes_d >= 06 && mes_h <= 12) {
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', true);
        $("#III").prop('disabled', false);
        $("#IV").prop('disabled', false);
    }

    if (mes_d >= 09 && mes_h <= 12) {
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', true);
        $("#III").prop('disabled', true);
        $("#IV").prop('disabled', false);
    }
}
