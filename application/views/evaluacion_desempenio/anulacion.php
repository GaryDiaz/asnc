<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12"><br>
                    <h3 class="text-center">Evaluaciones Registradas Para Solicitar Anulación</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Fecha Reg. Evaluación</th>
                                <th>Rif contratista</th>
                                <th>Denominación Razón Social</th>
                                <th>Clasificación</th>
                                <th>Estatus de Notificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($evaluaciones as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id']?> </td>
                                <td><?=$data['fecha']?> </td>
                                <td><?=$data['rif_contrat']?> </td>
                                <td><?=$data['nombre']?> </td>
                                <td><?=$data['calificacion']?></td>
                                <td><?=$data['descripcion']?></td>
                                <td class="center">
                                    <a title="Visualizar e Imprimir la Evaluación de Desempeño" href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                        class="button">
                                        <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                    <a/>
                                    <?php if ($data['id_estatus'] == 1): ?>
                                        <a class="button">
                                            <i title="Solicitar Anulación de Desempeño" onclick="modal(<?php echo $data['id']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-times" style="color: red;"></i>
                                        <a/>
                                    <?php endif; ?>
                                    <?php if ($data['id_estatus'] != 1): ?>
                                        <a class="button">
                                            <i title="Ver datos de Anulación de Desempeño" onclick="modal_ver(<?php echo $data['id']?>);" data-toggle="modal" data-target="#exampleModal_ver" class="fas fa-lg fa-fw fa-file-excel" style="color: blue;"></i>
                                        <a/>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA INGRESAR LA INFORMACIÓN DE LA ANULACIÓN DE DESEMPEÑO -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitud de Anulación de Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control text-center" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio" id="nro_oficicio">
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="datepicker-default" name="fec_solicitud" placeholder="Seleccionar Fecha"/>
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente" id="nro_expediente">
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta, Resolución o Providencia</label>
                            <input class="form-control" type="text" name="nro_gacet_resol" id="nro_gacet_resol">
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc" id="cedula_solc">
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc" id="telf_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc" id="nom_ape_solc">
                        </div>

                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo">
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control" rows="2" name="descp_anul" id="descp_anul"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_anulacion();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA MOSTRAR LA INFORMACIÓN DE LA ANULACION -->
<div class="modal fade" id="exampleModal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la Anulación de Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control text-center" type="text" name="id_ver" id="id_ver" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio_ver" id="nro_oficicio_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="fec_solicitud_ver" name="fec_solicitud_ver" readonly />
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente_ver" id="nro_expediente_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta, Resolución o Providencia</label>
                            <input class="form-control" type="text" name="nro_gacet_resol_ver" id="nro_gacet_resol_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc_ver" id="cedula_solc_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc_ver" id="telf_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc_ver" id="nom_ape_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_ver" id="cargo_ver" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control" rows="2" name="descp_anul_ver" id="descp_anul_ver" readonly></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/eval_desempenio/anulacion.js"></script>
