<div class="panel-heading">
    <h4 class="panel-title"><b>Datos de la Maxima Autoridad</b></h4>
</div>
<div class="panel-body">
    <div class="row">
        <div class="form-group col-3">
            <label>Nombre y Apellido Completo</label>
            <input type="text" name="nombre_max" class="form-control <?php echo form_error('nombre') ? 'is-invalid' : ''; ?>" placeholder="Nombre completo" value="<?php echo set_value('nombre'); ?>">
            <div class="invalid-feedback">
                <?php echo form_error('nombre'); ?>
            </div>
        </div>
        <div class="form-group col-3">
            <label>Cedula de Identidad</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="cedulamax" name="start" placeholder="ingrese la cedula sin punto ni coma" />
            </div>
        </div>
        <div class="form-group col-3">
            <label>Cargo</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="cargomax" name="start" placeholder="Cargo de la Maxima Autoridad" />

            </div>
        </div>
        <div class="form-group col-3">
            <label>Teléfono</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="tel_max" name="start" placeholder="Teléfono la Maxima Autoridad" />

            </div>
        </div>
        <div class="form-group col-3">
            <label>Oficina</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="oficina_max" name="oficina_max" placeholder="oficina la Maxima Autoridad" />

            </div>
        </div>
        <div class="form-group col-4">
            <label>Fecha de Designación</label>
            <div class="input-group input-daterange">
                <input type="text" class="form-control" id="oficina_max" name="oficina_max" placeholder="oficina la Maxima Autoridad" />
            </div>
        </div>
    </div>
</div>