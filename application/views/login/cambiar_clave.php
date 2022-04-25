<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <h3>Cambio de Contraseña</h3>
            <form class="form-horizontal" id="camb_clave" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
    			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-6 mt-3 form-group" id="proyecto_s">
                                <label>Nueva Contraseña <b style="color:red">*</b></label>
                                <input id="clave" name="clave" type="password" class="form-control" required>
                            </div>
                            <div class="col-6 mt-3 form-group" id="proyecto_s">
                                <label>Confirmar Contraseña <b style="color:red">*</b></label>
                                <input id="c_clave" name="c_clave"type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="camb_clave();" class="btn btn-default mb-3">Cambiar Contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/camb_clave.js"></script>
