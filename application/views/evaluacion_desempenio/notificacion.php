<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div  class="panel panel-inverse">
                <div class="col-12">
                    <br>
                    <h3 class="text-center">Evaluaciones Registradas</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>Rif contratista</th>
                                <th>Denominación Razón Social</th>
                                <th>Calificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reportes as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['rif_contrat']?> </td>
                                <td><?=$data['nombre']?> </td>
                                <td><?=$data['calificacion']?> </td>
                                <td class="center">
                                    <a title="Visualizar e Imprimir la Evaluación de Desempeño" href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                        class="button">
                                        <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                    <a/>
                                    <a class="button">
                                        <i title="Indicar Metodo de Notificación" onclick="modal(<?php echo $data['id']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-envelope" style="color: red;"></i>
                                    <a/>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_not_2" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <input type="text" name="id" id="id">
                        <div class="form-group col-4">
                            <label>Medio de envio de la Notificación</label>
                            <select class="selected form-control" name="medio" id="medio" onchange="mostrar_medio();">
                                <option value="0">Seleccione</option>
                                <?php foreach ($med_not as $data): ?>
                                    <option value="<?=$data['id_medio_notf']?>"><?=$data['descripcion']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="resp_medi" class="form-group col-8" style="display:none;">
                            <label>Nro. al cual fue notificado</label>
                            <input type="text" class="form-control" id="nro_not" name="nro_not" placeholder="Nro. al cual fue notificado" />
                        </div>
                        <div id="correo" class="form-group col-8" style="display:none;">
                            <h5><b style="color:red;">Nota:</b> Si decea enviar la Evaluación de Desempeño que se registro, puede ingresar al <b>Sub-Módulo Notificación</b> y descargar la misma, para luego enviar al contratista.</h5>
                            <label>Correo Electronico al cual fue notificado</label>
                            <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo" />
                        </div>
                        <div id="adjunto" class="form-group col-8"  style="display:none;">
                            <h5><b style="color:red;">Nota:</b> Si no posee la Imagen o PDF, de la notificación de Evaluación de Desempeño, puede ingresar luego por el <b>Sub-Módulo Notificación</b> y realizar la misma.</h5>
                            <label>Acuse de Envio / Recibido <b style="color:red">*</b></label>
                            <input type="file" name="fileImagen" id="fileImagen" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_not();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/eval_desempenio/notificacion.js"></script>
