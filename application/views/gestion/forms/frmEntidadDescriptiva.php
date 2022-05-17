<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="tituloForm">Título de Entidad</h5>
            <button type="button" class="close text-white" id="btnCerrarDialogoModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="areaDeNotificacionForm"></div>
            <form>
                <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <input type="text" class="form-control" id="txtDescripcion" placeholder="Descripción" maxlength="70">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnGuardar"><i class="ion-plus"></i> Registrar</button>
        </div>
    </div>
</div>