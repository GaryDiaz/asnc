<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Nueva Fuente de Fianciamiento</h4>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2 mb-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Nuevo
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Fuente de Financiamiento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="form">
                                            <div class="form-group">
                                                <label for="">Descripcion Fuente Financiamiento</label>
                                                <input type="text" class="form-control" id="desc_fuente_financiamiento">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="add">AGREGAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="update_form">
                                        <input type="hidden" id="edit_record_id" name="edit_record_id" value="">
                                        <div class="form-group">
                                            <label for="">Descripci??n</label>
                                            <input type="text" class="form-control" id="edit_desc_fuente_financiamiento">
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" id="update">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-md-10 mt-4">
                        <div class="table-responsive">
                            <table id="records" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr>
                                        <th>N??mero de fila</th>
                                        <th>Descripci??n</th>
                                        <th>Acci??n</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <!-- Toastr -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- Font Awesome -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js"></script> -->

        <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            $(document).on("click", "#add", function(e) {
                e.preventDefault();
                //  alert("test");
                var desc_fuente_financiamiento = $("#desc_fuente_financiamiento").val();
                var id_usuario = 1; //esto debo arreglar
                // var fecha = '12-15-2020';
                if (desc_fuente_financiamiento == "") {
                    alert("debe ingresar un dato, REQUERIDO");
                } else {
                    //  alert(name);
                    $.ajax({
                        url: "<?= base_url() ?>index.php/Fuentefinanc/save",
                        type: "post",
                        dataType: "json",
                        data: {
                            desc_fuente_financiamiento: desc_fuente_financiamiento,
                            id_usuario: id_usuario
                        },
                        success: function(data) {
                            if (data.responce == "success") {
                                $('#records').DataTable().destroy();
                                fetch();
                                $('#exampleModal').modal('hide');
                                toastr["success"](data.message);
                            } else {
                                toastr["error"](data.message);
                            }

                        }
                    });

                    $("#form")[0].reset();

                }

            });

            function fetch() {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Fuentefinanc/fetch",
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        //  console.log(data);
                        // if (data.responce == "success") {

                        var i = "1";
                        $('#records').DataTable({
                            "data": data.posts,
                            "columns": [{
                                    "render": function() {
                                        return a = i++;
                                    }
                                },
                                {
                                    "data": "desc_fuente_financiamiento"
                                },
                                {
                                    "render": function(data, type, row, meta) {
                                        var a = `
                                    <a href="#" value="${row.id_fuente_financiamiento}" id="del" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                                    <a href="#" value="${row.id_fuente_financiamiento}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                            `;
                                        return a;
                                    }
                                }
                            ]
                        });
                        //}else{
                        // toastr["error"](data.message);

                    }

                    // }
                });

            }
            fetch();
            $(document).on("click", "#del", function(e) {
                e.preventDefault();

                // alert("delet");
                var del_id = $(this).attr("value");
                // alert(del_id);
                if (del_id == "") {
                    alert("Delete id required");
                } else {

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger m-2'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: '??Esta Seguro de borrar este Registro?',
                        text: "No se Podra revertir esta Acci??n!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si, Borrar!',
                        cancelButtonText: 'No, Cancelar!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            $.ajax({
                                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/delete",
                                type: "post",
                                dataType: "json",
                                data: {
                                    del_id: del_id
                                },
                                success: function(data) {
                                    fetch();
                                    if (data.response === 'success') {
                                        swalWithBootstrapButtons.fire(
                                            'BORRADO!',
                                            'El Registro Fue Borrado Con Exito.',
                                            'success'
                                        )
                                    }
                                }
                            });

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelado',
                                'El Registro esta salvo :)',
                                'error'
                            )
                        }
                    })
                }

            });
            //edit
            $(document).on("click", "#edit", function(e) {
                e.preventDefault();
                var edit_id = $(this).attr("value");
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/Fuentefinanc/edit",
                    type: "post",
                    dataType: "json",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(data) {
                        if (data.responce == "success") {
                            $('#edit_modal').modal('show');
                            $("#edit_record_id").val(data.post.id_fuente_financiamiento);
                            $("#edit_desc_fuente_financiamiento").val(data.post.desc_fuente_financiamiento);
                        } else {
                            toastr["error"](data.message);
                        }
                    }
                });

            });
            //update
            $(document).on("click", "#update", function(e) {
                e.preventDefault();

                var edit_record_id = $("#edit_record_id").val();
                var edit_desc_fuente_financiamiento = $("#edit_desc_fuente_financiamiento").val();
                if (edit_record_id == "" || edit_desc_fuente_financiamiento == "") {
                    alert("No se puede Dejar el Campo Vacio, REQUERIDO");
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/Fuentefinanc/update",
                        type: "post",
                        dataType: "json",
                        data: {
                            edit_record_id: edit_record_id,
                            edit_desc_fuente_financiamiento: edit_desc_fuente_financiamiento,
                        },
                        success: function(data) {
                            if (data.responce == "success") {
                                $('#records').DataTable().destroy();
                                fetch();
                                $('#edit_modal').modal('hide');
                                toastr["success"](data.message);
                            } else {
                                toastr["error"](data.message);
                            }
                        }
                    });

                }

            });
        </script>
