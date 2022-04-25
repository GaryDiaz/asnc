<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Actividad</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-body">
					<form class="form-horizontal" id="guardar_act" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="form-group col-6">
								<label>Modalidad <b title="Campo Obligatorio" style="color:red">*</b></label>
									<select class="form-control" name="id_modalidad" id="id_modalidad" onclick=buscar_mec();>
									<option value="0">SELECCIONE</option>
										<?php foreach ($modalidad as $data): ?>
											<option value="<?=$data['id_modalidad']?>"><?=$data['decr_modalidad']?></option>
										<?php endforeach; ?>
									</select>
							</div>
							<div class="form-group col-6">
								<label>Mecanismo <b title="Campo Obligatorio" style="color:red">*</b></label>
								<select class="form-control" name="id_mecanismo" id="id_mecanismo">
									<option value="0">SELECCIONE</option>
								</select>
							</div>
							<div class="form-group col-6">
								<label>Obj. de Contratación <b title="Campo Obligatorio" style="color:red">*</b></label>
								<select class="form-control" name="id_obj_cont" id="id_obj_cont">
									<option value="0">SELECCIONE</option>
										<?php foreach ($obj_contrat as $data): ?>
											<option value="<?=$data['id_objeto_contrata']?>"><?=$data['desc_objeto_contrata']?></option>
										<?php endforeach; ?>
									</select>
								</select>
							</div>
							<div class="form-group col-6">
								<label>Días <b title="Campo Obligatorio" style="color:red">*</b></label>
								<input class="form-control"  type="text" name="dias" onblur="minimo_obj();" id="dias" placeholder="Días (Mínimo)">
							</div>
						</div>
						<div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_act();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    </div>
				</form>
			</div>
		</div>

		<div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
					<table id="records" class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								<th>ID</th>
								<th>Modalidad</th>
								<th>Mécanisco</th>
								<th>Descripción</th>
								<th>Días</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($actividades as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_actividad']?> </td>
                                <td><?=$data['decr_modalidad']?> </td>
								<td><?=$data['decr_mecanismo']?> </td>
								<td><?=$data['desc_objeto_contrata']?> </td>
								<td><?=$data['dias']?> </td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver_act(<?php echo $data['id_actividad']?>+'/'+<?php echo $data['id_modalidad']?>+'/'+<?php echo $data['id_mecanismo']?>+'/'+<?php echo $data['id_obj_cont']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									<a class="button"><i onclick="eliminar_act(<?php echo $data['id_actividad']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
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
<script src="<?=base_url()?>/js/publicaciones/actividad.js"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="form-group col-4">
						<label>ID</label>
						<input class="form-control" type="text" name="id" id="id" readonly>
					</div>
				<div class="form-group col-12">
					<label>Modalidad <b title="Campo Obligatorio" style="color:red">*</b></label>
						<input  class="form-control" type="hidden" id="id_modalidadc" name="id_modalidadc">
						<input  class="form-control" type="text" id="decr_modalidadc" name="decr_modalidadc" readonly>
						<select class="form-control" name="id_modalidad_edit" id="id_modalidad_edit" onclick=buscar_mec_edit();>
						<option value="0">SELECCIONE</option>
						</select>
				</div>
				<div class="form-group col-12">
				<label>Mecanismo <b title="Campo Obligatorio" style="color:red">*</b></label>
					<input  class="form-control" type="hidden" id="id_mecanismoc" name="id_mecanismoc">
					<input  class="form-control" type="text" id="decr_mecanismoc" name="decr_mecanismoc" readonly>
					<select class="form-control" name="id_mecanismo_edit" id="id_mecanismo_edit">
						<option value="0">SELECCIONE</option>
					</select>
				</div>
				<div class="form-group col-12">
					<label>Obj. de Contratación <b title="Campo Obligatorio" style="color:red">*</b></label>
					<input  class="form-control" type="hidden" id="id_obj_contc" name="id_obj_contc">
					<input  class="form-control" type="text" id="desc_objeto_contratac" name="desc_objeto_contratac" readonly>
					<select class="form-control" name="id_obj_cont_edit" id="id_obj_cont_edit">
						<option value="0">SELECCIONE</option>
						</select>
					</select>
				</div>
				<div class="form-group col-12">
					<label>Días <b title="Campo Obligatorio" style="color:red">*</b></label>
					<input class="form-control"  type="text" name="dias_edit" id="dias_edit" placeholder="Beneficiario">
				</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_act();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
