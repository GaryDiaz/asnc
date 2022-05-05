<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="tituloForm"><i class="ion-calendar"></i> &nbsp; Registro de Feriado Municipal</h5>
            <button type="button" class="close text-white" id="btnCerrarDialogoModal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="areaDeNotificacionForm"></div>
            <form class="row">
                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                    <label for="sltEstado">Estado</label>
                    <select class="form-control" id="sltEstado">
                        <option "0">[Estado]</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                    <label for="sltMunicipio">Municipio</label>
                    <select class="form-control" id="sltMunicipio">
                        <option "0">[Municipio]</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                    <label for="sltMes">Mes</label>
                    <select class="form-control" id="sltMes">
                        <option>[Mes]</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-6">
                    <label for="txtDia">Día</label>
                    <input type="number" class="form-control" id="txtDia" min="1", max="31">
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
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
