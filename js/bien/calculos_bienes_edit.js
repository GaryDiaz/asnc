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
            $('#id_ccnu_acc').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#id_ccnu_acc').append('<option value="'+response['codigo_ccnu']+'/'+response['desc_ccnu']+'">'+response['desc_ccnu']+'</option>');
            });
        }
    })
}

function porc_acc(){
    var porcentaje_acc = $('#porcentaje_acc').val();
    console.log(porcentaje_acc);
    if (porcentaje_acc > 100) {
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
        $('#prueba2').attr("disabled", true);
    }else {
        $('#prueba2').attr("disabled", false);
    }
}

function calcular_bienes(){

    var cantidad_acc = $('#cantidad_acc').val();
    $('#cant_total_distribuir_acc').val(cantidad_acc);
    var i = $('#I_acc').val();
    var ii = $('#II_acc').val();
    var iii = $('#III_acc').val();
    var iv = $('#IV_acc').val();
    var cant_total_distribuir = cantidad_acc - i - ii - iii - iv


    var cantidad2 = Number(i) + Number(ii) + Number(iii) + Number(iv)
    $('#cant_total_distribuir_acc').val(cant_total_distribuir);

    if (cant_total_distribuir < 0) {
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a distribuir no puede ser menor a la Cantidad estipulada! Por favor modifique para seguir con la carga.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#costo_unitario_acc").prop('disabled', true);
        $("#id_alicuota_iva_acc").prop('disabled', true);
    }else{
        $("#costo_unitario_acc").prop('disabled', false);
        $("#id_alicuota_iva_acc").prop('disabled', false);
        //Remplazar decimales para caculos
        var costo_unitario = $('#costo_unitario_acc').val();
        var newstr = costo_unitario.replace('.', "");
        var newstr2 = newstr.replace('.', "");
        var newstr3 = newstr2.replace('.', "");
        var newstr4 = newstr3.replace('.', "");
        var precio = newstr4.replace(',', ".");

        var tota = cantidad2 * precio
        var tota2 = parseFloat(tota).toFixed(2);
        var precio_total_acc = Intl.NumberFormat("de-DE").format(tota2);
        $('#precio_total_acc').val(precio_total_acc);

        var id_alicuota_iva = $('#id_alicuota_iva_acc').val();
        var separar = id_alicuota_iva.split("/");
        var porcentaje = parseFloat(separar['0']);

        var newstr5 = precio_total_acc.replace('.', "");
        var newstr6 = newstr5.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var precio_total_ac = newstr8.replace(',', ".");

        var monto_iva_estimado = precio_total_ac*porcentaje;
        var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
        var iva_estimado_acc = Intl.NumberFormat("de-DE").format(iva_estimado);
        $('#iva_estimado_acc').val(iva_estimado_acc);

        var newstr9 = iva_estimado_acc.replace('.', "");
        var newstr10 = newstr9.replace('.', "");
        var newstr11 = newstr10.replace('.', "");
        var newstr12 = newstr11.replace('.', "");
        var iva_estimado_ac = newstr12.replace(',', ".");

        var monto_t_estimado = Number(precio_total_ac) + Number(iva_estimado_ac);
        var monto_total_estimadoo = parseFloat(monto_t_estimado).toFixed(2);
        var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_estimadoo);
        $('#monto_estimado_acc').val(monto_total_estimado);

        var primer =  parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(i)).toFixed(2);
        var primer_e = parseFloat(primer).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(primer_e);
        $('#estimado_i_acc').val(estimado_i);

        var segun = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(ii)).toFixed(2);
        var segun_e = parseFloat(segun).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(segun_e);
        $('#estimado_ii_acc').val(estimado_i);

        var terc = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iii)).toFixed(2);
        var terc_e = parseFloat(terc).toFixed(2);
        var estimado_iii = Intl.NumberFormat("de-DE").format(terc_e);
        $('#estimado_iii_acc').val(estimado_iii);


        var cuar = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iv)).toFixed(2);
        var cuar_e = parseFloat(cuar).toFixed(2);
        var estimado_iv = Intl.NumberFormat("de-DE").format(cuar_e);
        $('#estimado_iV_acc').val(estimado_iv);

        var total_e = Number(primer)+Number(segun)+Number(terc)+Number(cuar)
        var total_es = parseFloat(total_e).toFixed(2);
        var total_est = Intl.NumberFormat("de-DE").format(total_es);
        $('#estimado_total_t_acc').val(total_est);
    }
}

function control(){
    var acc_cargar_acc = $('#cambiar').val();

    if (acc_cargar_acc === '1') {
        $("#acc_acc").hide();
        $("#proyecto_acc").show();
    }else if (acc_cargar_acc === '2') {
        $("#proyecto_acc").hide();
        $("#acc_acc").show();
    }
}

$(document).ready(function(){
    $("#costo_unitario_acc").on({
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

    $("#costo_unitario_mod_b").on({
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
