<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<div class="panel-heading">
					<h4 class="panel-title">Nuevo Usuario</h4>
				</div>
				<div class="panel-body">
					<form action="<?=base_url()?>index.php/User/save" class="form-horizontal" data-parsley-validate="true" name="demo-form" method="POST">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Perfil</label>
                                <select class="default-select2 form-control">
                                    <option>aca quiero una consulta a la bd </option>
                                </select>
                            </div>
                            <div class=" col-6 form-group">
                                <label>Organo</label>
                                <select id="id_unidad" name="id_unidad" class="default-select2 form-control">
                                    <option value="0">Seleccione</option>
                                    <optgroup label="Órganos">
                                        <?php foreach ($organo as $data): ?>
                                            <option value="<?=$data['codigo']?>"><?=$data['desc_organo']?> / <?=$data['rif']?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
    								<optgroup label="Entes">
                                        <?php foreach ($entes as $data): ?>
                                            <option value="<?=$data['codigo']?>"><?=$data['desc_entes']?> / <?=$data['rif']?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="Ente Adscrito">
                                        <?php foreach ($enteads as $data): ?>
                                            <option value="<?=$data['codigo']?>"><?=$data['desc_entes_ads']?> / <?=$data['rif']?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Unidad Ejecutora</label>
                                <select class="default-select2 form-control">
                                    <option>aca quiero una consulta a la bd </option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Nombre completo</label>
                                <input type="text" name="nombre" class="form-control <?php echo form_error('nombre') ? 'is-invalid':'' ; ?>" placeholder="Nombre completo" value="<?php echo set_value('nombre'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nombre'); ?>
                                    </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Correo Institucional</label>
                                <input type="text" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ; ?>" aria-describedby="emailHelp" placeholder="Correo eléctronico" value="<?php echo set_value('email'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('email'); ?>
                                    </div>
                            </div>
                            <div class="form-group col-6">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ; ?>"placeholder="Contraseña" value="<?php echo set_value('password'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('password'); ?>
                                        </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputPassword1">Repite la contraseña</label>
                                <input type="password" name="repeatPassord" class="form-control <?php echo form_error('repeatPassord') ? 'is-invalid':'' ; ?>" placeholder="Contraseña" value="">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('repeatPassord'); ?>
                                    </div>
                            </div>
                        </div>
						<div class="form-group col 12 text-center">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>

        <?php if($this->session->flashdata("success")): ?>

            Swal.fire({
                icon: 'success',
                title: 'Bien......',
                text: '<?php echo $this->session->flashdata("success"); ?>',
            });
        <?php endif; ?>

    </script>
