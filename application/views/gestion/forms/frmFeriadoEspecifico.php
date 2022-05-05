<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="tituloForm"><i class="ion-calendar"></i> &nbsp; Registro de Feriado Específico</h5>
            <button type="button" class="close text-white" id="btnCerrarDialogoModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="areaDeNotificacionForm"></div>
            <form class="row">
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="txtFecha">Fecha</label>
                    <input type="date" class="form-control" id="txtFecha">
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sm-12">
                    <label for="txtDescripcion">Descripción</label>
                    <input type="text" class="form-control" id="txtDescripcion" placeholder="Motivo del Feriado" maxlength="50">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnGuardar"><i class="ion-plus"></i> Registrar</button>
        </div>
    </div>
</div>
