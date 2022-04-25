<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Cuenta Bancaria</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="guardar_datosb" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-6">
								<label>Línea de Banco <b title="Campo Obligatorio" style="color:red">*</b></label>
								<select id="id_banco" name="id_banco" class="default-select2 form-control">
									<option value="0">SELECCIONE</option>
									<?php foreach ($bancos as $data): ?>
										<option value="<?=$data['id_banco']?>"><?=$data['codigo_b']?> / <?=$data['nombre_b']?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-6">
								<label>Tipo de Cuenta <b title="Campo Obligatorio" style="color:red">*</b></label>
								<select id="id_tipocuenta" name="id_tipocuenta" class="form-control">
									<option value="0">SELECCIONE</option>
									<?php foreach ($tipocuenta as $data): ?>
										<option value="<?=$data['id_tipocuenta']?>"><?=$data['tipo_cuenta']?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-6">
								<label>Número de Cuenta <b title="Campo Obligatorio" style="color:red">*</b></label>
								<input class="form-control" onkeypress="return valideKey(event);" type="text" name="n_cuenta" id="n_cuenta" placeholder="Número de cuenta">
							</div>

							
							<div class="form-group col-6">
								<label>Beneficiario <b title="Campo Obligatorio" style="color:red">*</b></label>
								<input class="form-control"  type="text" name="beneficiario" id="beneficiario" placeholder="Beneficiario">
							</div>
							
						</div>
						<div class="form-group col 12 text-center">
                    		<button type="button" onclick="guardar_datosb();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    	</div>
					</div>
				<form>
            </div>

			<div class="col-lg-12">
                <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
					<table id="records" class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								<th>ID</th>
								<th>Banco</th>
								<th>Ttipo de Cuenta</th>
								<th>Cuenta</th>
								<th>Beneficiario</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($datosb as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_datosb']?> </td>
								<td><?=$data['nombre_b']?> </td>
								<td><?=$data['tipo_cuenta']?> </td>
                                <td><?=$data['n_cuenta']?> </td>
								<td><?=$data['beneficiario']?> </td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver(<?php echo $data['id_datosb']?>+'/'+<?php echo $data['id_banco']?>+'/'+<?php echo $data['id_tipocuenta']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									<a class="button"><i onclick="eliminar_datosb(<?php echo $data['id_datosb']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
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
<script src="<?=base_url()?>/js/publicaciones/datos_bancarios.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Datos Bancarios</h5>
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
                        <div class="form-group col-6">
                            <label>Banco</label>
							<input type="hidden" class="form-control" id="id_bancoc" name="id_bancoc" readonly>
							<input type="text" class="form-control" id="bancoc" name="bancoc" readonly>
							<select class="form-control" name="id_banco_edit" id="id_banco_edit">
                            	<option value="0">Seleccione</option>
                        	</select></div>
                        <div class="form-group col-6">
                            <label>Tipo de Cuenta</label>
							<input type="hidden" class="form-control" id="id_tipocuentac" name="id_tipocuentac" readonly>
							<input type="text" class="form-control" id="tipocuentac" name="tipocuentac" readonly>
                            <select class="form-control" name="id_tipocuenta_edit" id="id_tipocuenta_edit">
                            	<option value="0">Seleccione</option>
                        	</select>
						</div>
						<div class="form-group col-6">
                            <label>Número de Cuenta</label>
                            <input class="form-control" type="text" onkeypress="return valideKey(event);"  name="ncuenta_edit" id="ncuenta_edit">
                        </div>
                        <div class="form-group col-6">
                            <label>Beneficiario</label>
                            <input type="text" class="form-control"  onkeypress="may(this);" id="beneficiario_edit" name="beneficiario_edit">
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_datosb();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
