<div class="sidebar-bg"></div>
<div id="content" class="content">
<h2>Registro de Llamado Concurso</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-8">
							<label>Número de Proceso <b title="Campo Obligatorio" style="color:red">*</b></label>
							<input class="form-control" onkeypress="may(this);" type="text" name="num_proceso" id="num_proceso" placeholder="Descripcion de Número de Proceso">
						</div>
						<div class="form-group col-4">
							<label>Fecha de Llamado <b title="Campo Obligatorio" style="color:red">*</b></label>
							<input class="form-control" type="date" name="fecha_llamado" id="fecha_llamado">
						</div>
						<div class="form-group col-3">
							<label>Modalidad <b title="Campo Obligatorio" style="color:red">*</b></label>
							<select class="form-control" name="id_modalidad" id="id_modalidad" onclick=llenar();>
							<option value="0">SELECCIONE</option>
								<?php foreach ($modalidades as $data): ?>
									<option value="<?=$data['id_modalidad']?>"><?=$data['decr_modalidad']?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-3">
							<label>Mecanismo <b title="Campo Obligatorio" style="color:red">*</b></label>
							<select class="form-control" name="id_mecanismo" id="id_mecanismo">
								<option value="0">SELECCIONE</option>
							</select>
						</div>
						<div class="form-group col-2">
							<label>Objeto de Contratación <b title="Campo Obligatorio" style="color:red">*</b></label>
							<select class="form-control" name="id_obj_cont" id="id_obj_cont" onclick=llenarca();>
							<option value="0">SELECCIONE</option>
									<?php foreach ($obj_contrat as $data): ?>
										<option value="<?=$data['id_objeto_contrata']?>"><?=$data['desc_objeto_contrata']?></option>
									<?php endforeach; ?>
								</select>
							</select>
						</div>
						<div class="form-group col-2">
							<label>Actividad <b title="Campo Obligatorio" style="color:red">*</b></label>
							<select class="form-control" name="id_actividad" id="id_actividad" onclick="llenar_act();calcular_dias();">
								<option value="0">SELECCIONE</option>
							</select>
						</div>
						<div class="form-group col-2">
							<label>Modificar cantd. de Días</label>
							<input class="form-control" type="text" name="act" id="act">
							<p>Resultado: <span id="resultado"></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>/js/publicaciones/registro_llamado.js"></script>
