
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
    var i = $('#I').val();
    var ii = $('#II').val();
    var iii = $('#III').val();
    var iv = $('#IV').val();

    var cantidad_total = Number(i) + Number(ii) + Number(iii) + Number(iv)

    var can_x_distr =   cantidad - i - ii - iii - iv
    $('#cant_total_distribuir').val(can_x_distr);

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
    }else{
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
