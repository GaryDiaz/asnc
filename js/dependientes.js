$(document).ready(function(){

    $('#id_estado').change(function(){
        var id_estado = $(this).val();
        //var base_url = window.location.origin+'/asnc/index.php/configuracion/listar_municipio';
        var base_url = '/index.php/Programacion/listar_municipio';

        $.ajax({
            url: base_url,
            method:'post',
            data: {id_estado: id_estado},
            dataType:'json',

            success: function(response){
                console.log(response);

                $('#id_municipio').find('option').not(':first').remove();
                $('#id_parroquia').find('option').not(':first').remove();
                $.each(response, function(index, data){
                    $('#id_municipio').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
                });
            }
        });
    });

    $('#id_estado').change(function(){
        var id_municipio = $(this).val();
        //var base_url = window.location.origin+'/asnc/index.php/configuracion/listar_parroquia';
        var base_url = '/index.php/Programacion/listar_parroquia';
        $.ajax({
            url: base_url,
            method:'post',
            data: {id_municipio: id_municipio},
            dataType:'json',

            success: function(response){
                console.log(response);
                $('#id_parroquia').find('option').not(':first').remove();

                $.each(response, function(index, data){
                    $('#id_parroquia').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
                });
            }
        });
    });
});
