<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Bancos</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="row">
						<div class="form-group col-6">
							<label>Código de Banco <b title="Campo Obligatorio" style="color:red">*</b></label>
							<input class="form-control" onkeypress="return valideKey(event);"  type="text" name="codigo_b" id="codigo_b" placeholder="XXXX">
							</select>
						</div>
						<div class="form-group col-6">
							<label>Nombre del Banco <b title="Campo Obligatorio" style="color:red">*</b></label>
							<input class="form-control" onkeypress="may(this);" type="text" name="nombre_b" id="nombre_b" placeholder="Nombre del Banco">
						</div>
						</div>
					</div>
					<div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_b();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    </div>
				</from>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
					<table id="records" class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								<th>Código</th>
								<th>Banco</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($bancos as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['codigo_b']?> </td>
                                <td><?=$data['nombre_b']?> </td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver(<?php echo $data['id_banco']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									<a class="button"><i onclick="eliminar_b(<?php echo $data['id_banco']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
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

<script src="<?=base_url()?>/js/publicaciones/banco.js"></script>

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
			    	<div class="row">
                        <div class="form-group col-4">
                            <label>ID Banco</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-8"></div>
                        <div class="form-group col-4">
                            <label>Código del Banco</label>
                            <input class="form-control" type="text" onkeypress="return valideKey(event);"  name="cod_banco_edit" id="cod_banco_edit">
                        </div>
                        <div class="form-group col-8">
                            <label>Nombre del Banco</label>
                            <input type="text" class="form-control"  onkeypress="may(this);" id="nombre_banco_edit" name="nombre_banco_edit">
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_b();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
