<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Servicio del Contratista a Consultar</label>
							<div class="row">
								<div class="col-5">
								<label>Nombre <b style="color:red">*</b></label>
									<input class="form-control" type="text" name="nombre" id="nombre"  placeholder="Ingrese el nombre completo de la Empresa"  onkeyup="mayusculas(this);" required>
								</div>

								<div class="form-group col-3">
								<label>Estado <b style="color:red">*</b></label>
									<select class="form-control" name="estado_id" id="estado_id" required>
										<option value="0">SELECCIONE</option>
										<?php foreach ($estados as $data): ?>
											<option value="<?=$data['id']?>"><?=$data['descedo']?></option>
										<?php endforeach; ?>
										</select>
									</div>
								<div class="form-group col-3">
								<label>Objeto de Contratación <b style="color:red">*</b></label>
									<select class="form-control" name="obj_cont" id="obj_cont" required>
										<option value="0">SELECCIONE</option>
										<?php foreach ($objcon as $data): ?>
                                        <option value="<?=$data['id']?>"><?=$data['descobjcont']?></option>
                                    <?php endforeach; ?>
									</select>
								</div>
								<div class="col-1">
									<button type="button" class="btn btn-default" onclick="consultar_objContr();" name="button"> <i class="fas fa-search"></i> </button>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Información del Contratista </b></h4>
                </div>
                <div class="panel-body" id="existe">
					<div class="row">
						<div class="col-12">
							<table id="tabla" class="table table-bordered table-hover">
								<thead style="background:#e4e7e8">
									<tr class="text-center">
										<th>RIF</th>
										<th>Razón Social</th>
										<th>Descripción Objeto de Contratación</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody class="text-center">
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function mayusculas(e) {
		e.value = e.value.toUpperCase();
	}
</script>
<script src="<?=base_url()?>/js/contratista/contratista.js"></script>
