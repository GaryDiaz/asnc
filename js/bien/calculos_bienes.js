function buscar_ccnu(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
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
    console.log(porcentaje);
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
        $('#prueba2').attr("disabled", true);
    }else {
        $('#prueba2').attr("disabled", false);
    }
}

function calcular_bienes(){

    var cantidad = $('#cantidad').val();
    $('#cant_total_distribuir').val(cantidad);
    var i = $('#I').val();
    var ii = $('#II').val();
    var iii = $('#III').val();
    var iv = $('#IV').val();
    var cant_total_distribuir = cantidad - i - ii - iii - iv


    var cantidad2 = Number(i) + Number(ii) + Number(iii) + Number(iv)
    $('#cant_total_distribuir').val(cant_total_distribuir);

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

        $("#costo_unitario").prop('disabled', true);
        $("#id_alicuota_iva").prop('disabled', true);
    }else{
        $("#costo_unitario").prop('disabled', false);
        $("#id_alicuota_iva").prop('disabled', false);
        //Remplazar decimales para caculos
            var costo_unitario = $('#costo_unitario').val();
            var newstr = costo_unitario.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

            var tota = cantidad2 * precio
            var tota2 = parseFloat(tota).toFixed(2);
            var precio_total = Intl.NumberFormat("de-DE").format(tota2);
            $('#precio_total').val(precio_total);

        var id_alicuota_iva = $('#id_alicuota_iva').val();
        var separar = id_alicuota_iva.split("/");
        var porcentaje = parseFloat(separar['0']);

        var newstr5 = precio_total.replace('.', "");
        var newstr6 = newstr5.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var precio_total_ac = newstr8.replace(',', ".");

        var monto_iva_estimado = precio_total_ac*porcentaje;
        var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
        var iva_estimado = Intl.NumberFormat("de-DE").format(iva_estimado);
        $('#iva_estimado').val(iva_estimado);

        var newstr9 = iva_estimado.replace('.', "");
        var newstr10 = newstr9.replace('.', "");
        var newstr11 = newstr10.replace('.', "");
        var newstr12 = newstr11.replace('.', "");
        var iva_estimado_ac = newstr12.replace(',', ".");

        var monto_t_estimado = Number(precio_total_ac) + Number(iva_estimado_ac);
        var monto_total_estimadoo = parseFloat(monto_t_estimado).toFixed(2);
        var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_estimadoo);
        $('#monto_estimado').val(monto_total_estimado);

        var primer =  parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(i)).toFixed(2);
        var primer_e = parseFloat(primer).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(primer_e);
        $('#estimado_i').val(estimado_i);

        var segun = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(ii)).toFixed(2);
        var segun_e = parseFloat(segun).toFixed(2);
        var estimado_i = Intl.NumberFormat("de-DE").format(segun_e);
        $('#estimado_ii').val(estimado_i);

        var terc = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iii)).toFixed(2);
        var terc_e = parseFloat(terc).toFixed(2);
        var estimado_iii = Intl.NumberFormat("de-DE").format(terc_e);
        $('#estimado_iii').val(estimado_iii);


        var cuar = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iv)).toFixed(2);
        var cuar_e = parseFloat(cuar).toFixed(2);
        var estimado_iv = Intl.NumberFormat("de-DE").format(cuar_e);
        $('#estimado_IV').val(estimado_iv);

        var total_e = Number(primer)+Number(segun)+Number(terc)+Number(cuar)
        var total_es = parseFloat(total_e).toFixed(2);
        var total_est = Intl.NumberFormat("de-DE").format(total_es);
        $('#estimado_total_t').val(total_est);
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
