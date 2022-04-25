<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Mecanismo</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="guardar_mec" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-3">
								<label>Modalidad <b title="Campo Obligatorio" style="color:red">*</b></label>
								<select class="form-control" name="id_modalidad" id="id_modalidad">
								<option value="0">SELECCIONE</option>
									<?php foreach ($modalidad as $data): ?>
										<option value="<?=$data['id_modalidad']?>"><?=$data['decr_modalidad']?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-8">
								<label>Descripción Mecanismo<b title="Campo Obligatorio" style="color:red">*</b></label>
								<input class="form-control" onkeypress="may(this);" type="text" name="decr_mecanismo" id="decr_mecanismo" placeholder="Descripción">
							</div>
							<div class="form-group col 12 text-center">
                        		<button type="button" onclick="guardar_mec();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    		</div>
						</div>
					</div>
				</form>

				<div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
					<table id="records" class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								<th>ID</th>
								<th>Modalidad</th>
								<th>Descripción</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($mecanismos as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_mecanismo']?> </td>
                                <td><?=$data['decr_modalidad']?> </td>
                                <td><?=$data['decr_mecanismo']?> </td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver_mec(<?php echo $data['id_mecanismo']?>+'/'+<?php echo $data['id_modalidad']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									<a class="button"><i onclick="eliminar_mec(<?php echo $data['id_mecanismo']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
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
</div>
<script src="<?=base_url()?>/js/publicaciones/mecanismo.js"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Mecanismo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
			    	<div class="row">
                        <div class="form-group col-4">
                            <label>ID</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-8"></div>
                        <div class="form-group col-12">
                            <label>Modalidad</label>
							<input type="hidden" id="id_modalidadc" name="id_modalidadc">
							<input type="text" class="form-control" id="decr_modalidadc" name="decr_modalidadc" readonly>
							<select class="form-control" name="id_modalidad_edit" id="id_modalidad_edit">
                            	<option value="0">Seleccione</option>
                        	</select>
						</div>
                        <div class="form-group col-12">
                            <label>Descripción Mecanismo</label>
                            <input type="text" class="form-control"  onkeypress="may(this);" id="decr_mecanismo_edit" name="decr_mecanismo_edit">
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_mec();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
