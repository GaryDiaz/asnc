$(document).ready(function(){
    $('#id_marca').change(function(){
      var id_marca = $(this).val();
      var base_url = window.location.origin+'/teg_equipo/';

      $.ajax({
          url:base_url+'index.php/equipos/get_modelo',
          method: 'post',
          data: {this_id_marca: id_marca},
          dataType: 'json',

          success: function(response){
            // Remove options
            $('#id_modelo').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
            $('#id_modelo').append('<option value="'+data['id_modelo']+'">'+data['descripcion']+'</option>');
            });

          }
      })
    });

    $('#id_marca_edit').change(function(){
        var id_marca_edit  = $(this).val();
        var id_modelo_edit = $("#id_modelo_edit").val();
        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/equipos/get_modelo_edit',
            method: 'post',
            data: {this_id_marca: id_marca_edit,
                   this_id_modelo: id_modelo_edit},
            dataType: 'json',

            success: function(response){
                // Remove options
                $('#id_modelo_edit').find('option').not(':first').remove();
                $('#imei_edit').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#id_modelo_edit').append('<option value="'+data['id_modelo']+'">'+data['descripcion']+'</option>');
                });
            }
        })
    });

    $('#id_gerencia').change(function(){
        var id_gerencia = $(this).val();
        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_gerencia',
            method: 'post',
            data: {this_id_gerencia: id_gerencia},
            dataType: 'json',

            success: function(response){
                // Remove options
                $('#id_coordinacion').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#id_coordinacion').append('<option value="'+data['id_coordinacion']+'">'+data['nombre_coordinacion']+'</option>');
                });
            }
        })
    });

    $('#id_modelo').change(function(){
        var id_marca = $("#id_marca").val();
        var id_modelo = $(this).val();
        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_equipos',
            method: 'post',
            data: {this_id_marca: id_marca,
                   this_id_modelo: id_modelo},
            dataType: 'json',

            success: function(response){
                //Remove options
                $('#imei').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#imei').append('<option value="'+data['id_equipo']+'">'+data['imei']+'</option>');
                });
            }
        })
    });

    $('#id_modelo_edit').change(function(){
        var id_marca_edit = $("#id_marca_edit").val();
        var id_modelo_edit = $(this).val();
        var id_imei_edit = $("#imei_edit").val();

        $('#imei_edit').find('option').not(':first').remove();

        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_equipos_edit',
            method: 'post',
            data: {this_id_marca: id_marca_edit,
                   this_id_modelo: id_modelo_edit,
                   this_id_imei: id_imei_edit},
            dataType: 'json',

            success: function(response){
                //Remove options
                //$('#imei').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#imei_edit').append('<option value="'+data['id_equipo']+'">'+data['imei']+'</option>');
                });
            }
        })
    });

    $('#imei').change(function(){
        var id_equipo = $(this).val();
        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_equipos_completa',
            method: 'post',
            data: {this_id_equipo: id_equipo},
            dataType: 'json',

            success: function(response){
                //Remove options
                // $('#imei').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#serial').val(data['nro_serial']);
                    $('#nro_bien').val(data['nro_bien']);
                    $('#nro_telefono').val(data['nro_telefono']);
                    $('#sim_card').val(data['sim_card']);
                    $('#id_equipo').val(data['id_equipo']);
                });
            }
        })
    });

    $('#imei_edit').change(function(){
        var id_equipo = $(this).val();
        var base_url = window.location.origin+'/teg_equipo/';



        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_equipos_completa',
            method: 'post',
            data: {this_id_equipo: id_equipo},
            dataType: 'json',

            success: function(response){
                console.log(response);
                //Remove options
                $('#serial').remove();
                $('#nro_bien').remove();
                $('#nro_telefono').remove();
                $('#sim_card').remove();
                $('#id_equipo').remove();
                // $('#id_equipo').find('option').not(':first').remove();
                // Add options
                $.each(response,function(index,data){
                    $('#serial').val(data['nro_serial']);
                    $('#nro_bien').val(data['nro_bien']);
                    $('#nro_telefono').val(data['nro_telefono']);
                    $('#sim_card').val(data['sim_card']);
                    $('#id_equipo').val(data['id_equipo']);
                });
            }
        })
    });

    $('#id_gerencia_edit').change(function(){
        var id_gerencia_edit = $(this).val();
        var id_coordinacion = $("#id_coordinacion_edit").val();

        $('#id_coordinacion_edit').find('option').not(':first').remove();

        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_equipos/get_gerencia_edit',
            method: 'post',
            data: {this_id_gerencia: id_gerencia_edit,
                   this_id_coord: id_coordinacion},
            dataType: 'json',

            success: function(response){
                // Add options
                $.each(response,function(index,data){
                    $('#id_coordinacion_edit').append('<option value="'+data['id_coordinacion']+'">'+data['nombre_coordinacion']+'</option>');
                });
            }
        })
    });

    $('#id_computadoras').change(function(){
        var id_computadoras = $(this).val();

        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_pc/get_compu',
            method: 'post',
            data: {this_id_computadoras: id_computadoras},
            dataType: 'json',

            success: function(response){

                console.log(response);
                // Add options
                 $.each(response,function(index,data){
                    $('#id_marca_cpu').val(data['id_marca_cpu']);
                    $('#nro_bien_cpu').val(data['nro_bien_cpu']);
                    $('#id_marca_tec').val(data['id_marca_tec']);
                    $('#nro_bien_tec').val(data['nro_bien_tec']);

                    $('#id_marca_mouse').val(data['id_marca_mouse']);
                    $('#nro_bien_mouse').val(data['nro_bien_mouse']);
                    $('#id_marca_monitor').val(data['id_marca_monitor']);
                    $('#nro_bien_monitor').val(data['nro_bien_monitor']);

                    $('#sistema_operativo').val(data['sistema_operativo']);
                    $('#ram').val(data['ram']);
                    $('#disco_duro').val(data['disco_duro']);
                    $('#procesador').val(data['procesador']);
                    $('#nro_regulador').val(data['nro_regulador']);
                    $('#registro_unico').val(data['id_computadoras']);

                });
            }
        })
    });

    $('#id_computadoras_edit').change(function(){
        var id_computadoras = $(this).val();

        var base_url = window.location.origin+'/teg_equipo/';

        $.ajax({
            url:base_url+'index.php/asignacion_pc/get_compu',
            method: 'post',
            data: {this_id_computadoras: id_computadoras},
            dataType: 'json',

            success: function(response){
                console.log(response);
                $('#id_marca_cpu').remove();
                $('#nro_bien_cpu').remove();
                $('#id_marca_tec').remove();
                $('#nro_bien_tec').remove();
                $('#id_marca_mouse').remove();
                $('#nro_bien_mouse').remove();
                $('#id_marca_monitor').remove();
                $('#nro_bien_monitor').remove();
                $('#sistema_operativo').remove();
                $('#ram').remove();
                $('#disco_duro').remove();
                $('#procesador').remove();
                $('#nro_regulador').remove();
                $('#registro_unico').remove();
                // Add options
                 $.each(response,function(index,data){
                    $('#id_marca_cpu').val(data['id_marca_cpu']);
                    $('#nro_bien_cpu').val(data['nro_bien_cpu']);
                    $('#id_marca_tec').val(data['id_marca_tec']);
                    $('#nro_bien_tec').val(data['nro_bien_tec']);

                    $('#id_marca_mouse').val(data['id_marca_mouse']);
                    $('#nro_bien_mouse').val(data['nro_bien_mouse']);
                    $('#id_marca_monitor').val(data['id_marca_monitor']);
                    $('#nro_bien_monitor').val(data['nro_bien_monitor']);

                    $('#sistema_operativo').val(data['sistema_operativo']);
                    $('#ram').val(data['ram']);
                    $('#disco_duro').val(data['disco_duro']);
                    $('#procesador').val(data['procesador']);
                    $('#nro_regulador').val(data['nro_regulador']);
                    $('#registro_unico').val(data['id_computadoras']);

                });
            }
        })
    });
});
