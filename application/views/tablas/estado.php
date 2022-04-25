<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Nuevo Estado</h4>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Estado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="form">
                                            <div class="form-group">
                                                <label for="">Nombre del Estado</label>
                                                <input type="text" class="form-control" id="desc_descedo" placeholder="Nombre del Estado">
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
                                            <label for="">Ingrese Nombre del estado</label>
                                            <input type="text" class="form-control" id="edit_descedo">
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
                <div class="col-1"></div>
                <div class="col-10 mt-3">
                    <table id="records" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>Número de fila</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Toastr -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> <!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js"></script>

<!-- Add Records -->
<script>
    $(document).on("click", "#add", function(e) {
        e.preventDefault();
        var desc_descedo = $("#desc_descedo").val();
            //alert(desc_descedo + '' + desc_porcentaj);
        if (desc_descedo == "") {
            alert("Both field is required");
        } else {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/saveestado",
                type: "post",
                dataType: "json",
                data: {
                    descedo: desc_descedo
                },
                success: function(data) {
                    if (data.responce === "success") {
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
            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/fetchestado",
            type: "post",
            dataType: "json",
            success: function(data) {
                if (data.responce === "success") {

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
                                "data": "descedo"
                            },

                            {
                                "render": function(data, type, row, meta) {
                                    var a = `

                                    <a href="#" value="${row.id}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
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
    // Edit Record
    $(document).on("click", "#edit", function(e) {
        e.preventDefault();

        var edit_id = $(this).attr("value");

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Fuentefinanc/editestado",
            type: "post",
            dataType: "json",
            data: {
                edit_id: edit_id
            },
            success: function(data) {
                if (data.responce == "success") {
                    $('#edit_modal').modal('show');
                    $("#edit_record_id").val(data.post.id);
                    $("#edit_descedo").val(data.post.descedo);

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
        var edit_descedo = $("#edit_descedo").val();
        if (edit_record_id == "" || edit_descedo == "") {
            alert("Both field is required");
        } else {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Fuentefinanc/updateestado",
                type: "post",
                dataType: "json",
                data: {
                    edit_record_id: edit_record_id,
                    edit_descedo: edit_descedo
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