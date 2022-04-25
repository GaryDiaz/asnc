function modal(id){
    $('#id').val(id);
}

function mostrar_medio(){
    var medio = $('#medio').val();
    if (medio == '1' || medio == '4') {
        $("#adjunto").show();
        $("#resp_medi").hide();
        $("#correo").hide();
    }else if (medio == '2') {
        $("#correo").hide();
        $("#resp_medi").show();
        $("#adjunto").hide();
    }else if (medio == '3') {
        $("#correo").show();
        $("#resp_medi").hide();
        $("#adjunto").hide();
    }else {
        $("#correo").hide();
        $("#resp_medi").hide();
        $("#adjunto").hide();
    }
}

function guardar_not(){
    var medio        = $("#medio").val();
    if (medio == '0') {
        document.getElementById("medio").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Registrar?',
            text: '¿Esta seguro de Registrar la Notificación de Evaluación de Desempeño?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {

                event.preventDefault();
                var datos = new FormData($("#resgistrar_not_2")[0]);
                //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/registrar_not_2';
                var base_url = '/index.php/evaluacion_desempenio/registrar_not_2';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso',
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
