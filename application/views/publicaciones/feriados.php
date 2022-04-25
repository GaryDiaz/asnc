<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Mecanismo</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="guardar_feri" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-3">
								<label>Día Feriado <b title="Campo Obligatorio" style="color:red">*</b></label>
								<input  class="form-control" type="date" name="dia" id="dia">
							</div>
							<div class="form-group col-9">
								<label>Descripción<b title="Campo Obligatorio" style="color:red">*</b></label>
								<input class="form-control" onkeypress="may(this);" type="text" name="descripcion" id="descripcion" placeholder="Natalicio del Libertador">
							</div>
							<div class="form-group col 12 text-center">
                        		<button type="button" onclick="guardar_fer();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    		</div>
						</div>
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
								<th>Día</th>
								<th>Deescripción</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($dias as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_feriado_n']?> </td>
                                <td><?=$data['dia']?></td>
								<td><?=$data['descripcion']?></td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver(<?php echo $data['id_feriado_n']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									<a class="button"><i onclick="eliminar_d(<?php echo $data['id_feriado_n']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
					</table>
				</div>
            </div>
	</div>
</div>
<script src="<?=base_url()?>/js/publicaciones/feriados.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Día Feriado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
			    	<div class="row">
                        <div class="form-group col-4">
                            <label>ID Día Feriado</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-8"></div>
                        <div class="form-group col-4">
                            <label>Día</label>
                            <input class="form-control" type="date"  name="dia_edit" id="dia_edit">
                        </div>
                        <div class="form-group col-8">
                            <label>Descripción</label>
                            <input type="text" class="form-control"  onkeypress="may(this);" id="descripcion_edit" name="descripcion_edit_edit">
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_d();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
