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
        // var base_url =window.location.origin+'/asnc/index.php/user/llenar';
        var base_url = '/index.php/user/llenar';
        //var base_url2 =window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

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
                    $('#unidad_1').val(data['codigo']);
                    $('#rif_cont').val(data['rif']);
                    $('#nombre').val(data['desc_organo']);
                    $('#cod_onapre').val(data['cod_onapre']);
                    $('#siglas').val(data['siglas']);
                    $('#direccion_fiscal').val(data['direccion_fiscal']);

                  //  var user_id = data['user_id'];

                }
            }
        })
    }

}

function mayus(e) {
    e.value = e.value.toUpperCase();
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
