function buscar_ccnnu(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b = $('#ccnu_b').val();

    //var base_url =window.location.origin+'/asnc/index.php/Programacion/llenar_selc_ccnu_m';
    var base_url = '/index.php/Programacion/llenar_selc_ccnu_m';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b},
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#id_ccnu').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#id_ccnu').append('<option value="'+response['codigo_ccnu']+'/'+response['desc_ccnu']+'">'+response['desc_ccnu']+'</option>');
            });
        }
    })
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
        $('#btn_agregar').attr("disabled", true);
        $("#btn_editar").prop('disabled', true);
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
        $('#btn_agregar').attr("disabled", true);
        $("#btn_editar").prop('disabled', true);

    }else{
        $('#btn_agregar').prop("disabled", false);
        $('#btn_editar').prop("disabled", false);
    }
}

function cant_total(){

    var cant_total = $('#cant_total_distribuir').val();

    if (cant_total != '0') {
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a Distribuir debe quedar en 0, para continuar.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#precio_total").prop('disabled', true);
        $("#id_alicuota_iva").prop('disabled', true);
    }else {
        $("#precio_total").prop('disabled', false);
        $("#id_alicuota_iva").prop('disabled', false);
    }
}

function calculo(){

    var cantidad = 100;
    var i = $('#i').val();
    var ii = $('#ii').val();
    var iii = $('#iii').val();
    var iv = $('#iv').val();

    var cantidad_total = Number(i) + Number(ii) + Number(iii) + Number(iv)

    if (cantidad_total > 100) {
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a distribuir no puede ser mayor a 100! Por favor modifique para seguir con la carga.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#precio_total").prop('disabled', true);
        $("#id_alicuota_iva").prop('disabled', true);
    }else {
        $("#precio_total").prop('disabled', false);
        $("#id_alicuota_iva").prop('disabled', false);
        //Calculo Cantidad x DIstribuir
            var can_x_distr =   cantidad - i - ii - iii - iv
            $('#cant_total_distribuir').val(can_x_distr);

        //Remplazar decimales para caculos
            var precio_total = $('#precio_total').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de Iva Estimado
            var id_alicuota_iva = $('#id_alicuota_iva').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = precio*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado').val(iva_estimado2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#monto_estimado').val(monto_total_estimado);

        //Calculo estimado por Trimestre

            var primer = (monto_total_est/cantidad_total)*i;
            var primer_i = parseFloat(primer).toFixed(2);
            var i_trim  = Intl.NumberFormat("de-DE").format(primer_i);
            $('#estimado_i').val(i_trim);


            var segun = (monto_total_est/cantidad_total)*ii;
            var segun_ii = parseFloat(segun).toFixed(2);
            var ii_trim  = Intl.NumberFormat("de-DE").format(segun_ii);
            $('#estimado_ii').val(ii_trim);

            var tercer = (monto_total_est/cantidad_total)*iii;
            var tercer_iii = parseFloat(tercer).toFixed(2);
            var iii_trim  = Intl.NumberFormat("de-DE").format(tercer_iii);
            $('#estimado_iii').val(iii_trim);

            var cuarto = (monto_total_est/cantidad_total)*iv;
            var cuarto_iv = parseFloat(cuarto).toFixed(2);
            var iv_trim  = Intl.NumberFormat("de-DE").format(cuarto_iv);
            $('#estimado_iV').val(iv_trim);

        // Calculo total estimado trimestres
            var total_est = primer+segun+tercer+cuarto
            var total_estim = parseFloat(total_est).toFixed(2);
            var estimado_total_t  = Intl.NumberFormat("de-DE").format(total_estim);
            $('#estimado_total_t').val(estimado_total_t);
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
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', true);
        $("#iii").prop('disabled', true);
        $("#iv").prop('disabled', true);
        $("#btn_editar").prop('disabled', true);
    }else {
        $("#especificacion").prop('disabled', false);
        $("#id_unidad_medida").prop('disabled', false);
        $("#precio_total").prop('disabled', false);
        $("#btn_editar").prop('disabled', false);
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
        $("#I").prop('disabled', true);
        $("#II").prop('disabled', true);
        $("#III").prop('disabled', true);
        $("#IV").prop('disabled', true);
    }else{
        $("#especificacion").prop('disabled', false);
        $("#id_unidad_medida").prop('disabled', false);
        $("#precio_total").prop('disabled', false);
    }
}

function habilitar_trim(){
    var fecha_desde = $('#fecha_desde').val();
    var mes_d = fecha_desde.split("/")[1];
    var fecha_hasta = $('#fecha_hasta').val();
    var mes_h = fecha_hasta.split("/")[1];

    if (mes_d >= 01 && mes_h <= 03) {
        $("#i").prop('disabled', false);
        $("#ii").prop('disabled', true);
        $("#iii").prop('disabled', true);
        $("#iv").prop('disabled', true);
    }else if (mes_d >= 01 && mes_h <= 06) {
        $("#i").prop('disabled', false);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', true);
        $("#iv").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 09) {
        $("#i").prop('disabled', false);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 12) {
        $("#i").prop('disabled', false);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', false);
    }
    if (mes_d >= 04 && mes_h <= 06) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', true);
        $("#iv").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 09) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 12) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', false);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', false);
    }

    if (mes_d >= 06 && mes_h <= 09) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', true);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', true);
    }else if (mes_d >= 06 && mes_h <= 12) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', true);
        $("#iii").prop('disabled', false);
        $("#iv").prop('disabled', false);
    }

    if (mes_d >= 09 && mes_h <= 12) {
        $("#i").prop('disabled', true);
        $("#ii").prop('disabled', true);
        $("#iii").prop('disabled', true);
        $("#iv").prop('disabled', false);
    }
}

$(document).ready(function(){
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
});
