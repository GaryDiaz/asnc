function eliminar_proy(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = id
            var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_proy';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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

function eliminar_acc(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_acc = id
            var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_acc';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_acc: id_items_acc
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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
