<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="tituloForm"><i class="ion-calendar"></i> &nbsp; Registro de Lapso</h5>
            <button type="button" class="close text-white" id="btnCerrarDialogoModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="areaDeNotificacionForm"></div>
            <form class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                    <label for="sltModalidad">Modalidad</label>
                    <select class="form-control" id="sltModalidad">
                        <option "0">[Modalidad]</option>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                    <label for="sltMecanismo">Mecanismo</label>
                    <select class="form-control" id="sltMecanismo">
                        <option "0">[Mecanismo]</option>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                    <label for="sltObjetoCont">Objeto de Contratación</label>
                    <select class="form-control" id="sltObjetoCont">
                        <option>[ObjetoCont]</option>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                    <label for="txtDiasHabiles">Día</label>
                    <input type="number" class="form-control" id="txtDiasHabiles" min="1", max="31">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnGuardar"><i class="ion-plus"></i> Registrar</button>
        </div>
    </div>
</div>
