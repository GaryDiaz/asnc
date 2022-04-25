
 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Nueva ALICUOTA IVA</h4>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Nuevo
                        </button>

                        <!-- Modal insert -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear ALICUOTA IVA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="form">
                                            <div class="form-group">
                                                <label for="">desc_fuente_financiamiento</label>
                                                <input type="text" class="form-control" id="desc_alicuota_iva" placeholder="EJEMPLO 0.12">
                                            </div>
                                            <div class="form-group">
                                                <label for="">desc_fuente_financiamiento</label>
                                                <input type="text" class="form-control" id="desc_porcentaj"  placeholder="EJEMPLO 12%">
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
                                            <label for="">INGRESE LA CANTIDAD EXPRESADA EN DECIMALES</label>
                                            <input type="text" class="form-control" id="edit_desc_alicuota_iva" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">INGRESE LA CANTIDAD EXPRESADA EN PORCENTAJE</label>
                                            <input type="text" class="form-control" id="edit_desc_porcentaj">
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
                            <table class="table table-bordered table-hover" id="records">
                                <thead style="background:#e4e7e8">
                                    <tr>
                                        <th>Número de fila</th>
                                        <th>Decimal</th>
                                        <th>Porcentaje</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <!-- Toastr -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>     <!-- Font Awesome -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js"></script> -->

                <!-- Add Records -->
                <script>
                    $(document).on("click", "#add", function(e) {
                        e.preventDefault();

                        var desc_alicuota_iva = $("#desc_alicuota_iva").val();
                        var desc_porcentaj = $("#desc_porcentaj").val();
                        var id_usuario = 1; //esto debo arreglar
                        //var fecha = '12/15/2020'; //esto debo arreglar
                        //alert(desc_alicuota_iva + '' + desc_porcentaj);
                        if (desc_alicuota_iva == "" || desc_porcentaj == "") {
                            alert("Both field is required");
                        } else {
                            $.ajax({
                                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/savealicuota",
                                type: "post",
                                dataType: "json",
                                data: {
                                    desc_alicuota_iva: desc_alicuota_iva,
                                    desc_porcentaj: desc_porcentaj,
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

                    // Fetch Records

                    function fetch() {
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/fetchalicuota",
                            type: "post",
                            dataType: "json",
                            success: function(data) {
                                if (data.responce == "success") {

                                    var i = "1";
                                    $('#records').DataTable({
                                        "data": data.posts,
                                        "responsive": true,
                                        dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                            "<'row'<'col-sm-12'tr>>" +
                                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                                        buttons: [
                                            'copy', 'excel', 'pdf'
                                        ],
                                        "columns": [{
                                                "render": function() {
                                                    return a = i++;
                                                }
                                            },
                                            {
                                                "data": "desc_alicuota_iva"
                                            },
                                            {
                                                "data": "desc_porcentaj"
                                            },
                                            {
                                                "render": function(data, type, row, meta) {
                                                    var a = `

                                    <a href="#" value="${row.id_alicuota_iva}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                            `;
                                                    return a;
                                                }
                                            }
                                        ]
                                    });
                                } else {
                                    toastr["error"](data.message);
                                }

                            }
                        });

                    }

                    fetch();

                    // Delete Record

                    $(document).on("click", "#del", function(e) {
                        e.preventDefault();

                        var del_id = $(this).attr("value");

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger mr-2'
                            },
                            buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {

                                $.ajax({
                                    url: "<?php echo base_url(); ?>index.php/Fuentefinanc/deletealicuota",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        del_id: del_id
                                    },
                                    success: function(data) {
                                        if (data.responce == "success") {
                                            $('#records').DataTable().destroy();
                                            fetch();
                                            swalWithBootstrapButtons.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            );
                                        } else {
                                            swalWithBootstrapButtons.fire(
                                                'Cancelled',
                                                'Your imaginary file is safe :)',
                                                'error'
                                            );
                                        }

                                    }
                                });



                            } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your imaginary file is safe :)',
                                    'error'
                                )
                            }
                        });

                    });

                    // Edit Record

                    $(document).on("click", "#edit", function(e) {
                        e.preventDefault();

                        var edit_id = $(this).attr("value");

                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/editalicuota",
                            type: "post",
                            dataType: "json",
                            data: {
                                edit_id: edit_id
                            },
                            success: function(data) {
                                if (data.responce == "success") {
                                    $('#edit_modal').modal('show');
                                    $("#edit_record_id").val(data.post.id_alicuota_iva);
                                    $("#edit_desc_alicuota_iva").val(data.post.desc_alicuota_iva);
                                    $("#edit_desc_porcentaj").val(data.post.desc_porcentaj);
                                } else {
                                    toastr["error"](data.message);
                                }
                            }
                        });

                    });

                    // Update Record

                    $(document).on("click", "#update", function(e) {
                        e.preventDefault();

                        var edit_record_id = $("#edit_record_id").val();
                        var edit_desc_alicuota_iva = $("#edit_desc_alicuota_iva").val();
                        var edit_desc_porcentaj = $("#edit_desc_porcentaj").val();

                        if (edit_record_id == "" || edit_desc_alicuota_iva == "" || edit_desc_porcentaj == "") {
                            alert("Both field is required");
                        } else {
                            $.ajax({
                                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/updatealicuota",
                                type: "post",
                                dataType: "json",
                                data: {
                                    edit_record_id: edit_record_id,
                                    edit_desc_alicuota_iva: edit_desc_alicuota_iva,
                                    edit_desc_porcentaj: edit_desc_porcentaj
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
