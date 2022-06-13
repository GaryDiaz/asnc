<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
  <div id="areaDeNotificacion"></div>
  <div id="areaLlamadoConcurso">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="text-center" id="tituloForm"><i class="ion-ios-list-outline"></i> Edición de Llamado a Concurso</h3>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Datos del Organo-Ente</legend>
          <div class="row">
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtRif">RIF</label>
              <input type="text" class="form-control" id="txtRif" placeholder="RIF" maxlength="10" disabled>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="lblSiglas">Siglas</label>
              <input type="text" readonly class="form-control-plaintext" id="txtSiglas">
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12">
              <label for="lblDescripcion">Descripción</label>
              <input type="text" readonly class="form-control-plaintext" id="txtDescripcion">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtDireccionOE">Dirección</label>
              <input type="text" readonly class="form-control-plaintext" id="txtDireccionOE">
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Datos del Llamado a Concurso</legend>
          <div class="row">
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtNumeroProceso">Número de Proceso</label>
              <input type="text" readonly class="form-control-plaintext" id="txtNumeroProceso">
              <small id="errNumeroProceso" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtFechaLlamado">Fecha de Llamado</label>
              <input type="date" class="form-control" id="txtFechaLlamado" placeholder="Fecha de llamado" require>
              <small id="errFechaLlamado" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12">
              <label for="txtDenominacionProceso">Denominación del Proceso</label>
              <input type="text" class="form-control" id="txtDenominacionProceso" placeholder="Denominación del Proceso" maxlength="100" require>
              <small id="errDenominacionProceso" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
          <div id="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtDescripcionContratacion">Descripción de Contratación</label>
              <input type="text" class="form-control" id="txtDescripcionContratacion" placeholder="Descripcion de Contratación" maxlength="250" require>
              <small id="errDescripcionContratacion" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
          <div id="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtObservaciones">Observaciones</label>
              <input type="text" class="form-control" id="txtObservaciones" placeholder="Si edita algo debe ser justificado en este campo" maxlength="200" require>
              <small id="errObservaciones" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Lapsos</legend>
          <div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-6">
              <label for="sltModalidad">Modalidad</label>
              <select id="sltModalidad" class="form-control">
                <option>Modalidad</option>
              </select>
              <small id="errModalidad" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6">
              <label for="sltMecanismo">Mecanismo</label>
              <select id="sltMecanismo" class="form-control">
                <option>Mecanismo</option>
              </select>
              <small id="errMecanismo" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6">
              <label for="sltObjetoContratacion">Objeto de Contratacion</label>
              <select id="sltObjetoContratacion" class="form-control">
                <option>Objeto de Contratacion</option>
              </select>
              <small id="errObjetoContratacion" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-6">
              <label for="txtDiasHabiles">Días Hábiles</label>
              <input type="text" readonly class="form-control-plaintext" id="txtDiasHabiles">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
              <label for="txtFechaDisponibleLlamado">Fecha de Disponibilidad del Llamado</label>
              <input type="date" class="form-control" id="txtFechaDisponibleLlamado" disabled>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-12">
              <label for="txtFechaFin">Fecha Fin</label>
              <input type="date" class="form-control" id="txtFechaFin" require>
              <small id="errFechaFin" class="form-text text-muted text-red-darker" hidden>Error</small>
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Datos de contacto</legend>
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtWebContratante">Página Web</label>
              <input type="text" class="form-control" id="txtWebContratante" placeholder="Página Web" maxlength="100">
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Dirección para la adquisición de retiro de pliego</legend>
          <div class="row">
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtHoraDesde">Hora desde</label>
              <input type="time" class="form-control" id="txtHoraDesde" placeholder="Hora Desde" require>
              <small id="errHoraDesde" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtHoraHasta">Hora hasta</label>
              <input type="time" class="form-control" id="txtHoraHasta" placeholder="Hora Hasta" require>
              <small id="errHoraHasta" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="sltEstado">Estado</label>
              <select id="sltEstado" class="form-control">
                <option>Estado</option>
              </select>
              <small id="errEstado" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="sltMunicipio">Municipio</label>
              <select id="sltMunicipio" class="form-control">
                <option>Municipio</option>
              </select>
              <small id="errMunicipio" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtDireccion">Dirección</label>
              <input type="text" class="form-control" id="txtDireccion" placeholder="Dirección" maxlength="250" require>
              <small id="errDireccion" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Períodos de Aclaratoria</legend>
          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
              <label for="txtFechaInicioAclaratoria">Fecha Inicio de Aclaratoria</label>
              <input type="date" class="form-control" id="txtFechaInicioAclaratoria" disabled>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
              <label for="txtFechaFinAclaratoria">Fecha Fin de Aclaratoria</label>
              <input type="date" class="form-control" id="txtFechaFinAclaratoria">
              <small id="errFechaFinAclaratoria" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
              <label for="txtFechaTope">Fecha Tope</label>
              <input type="date" class="form-control" id="txtFechaTope" disabled>
            </div>
          </div>
        </fieldset>
        <fieldset class="border border-success p-10 shadow-lg">
          <legend class="font-weight-bold">Apertura de Sobres</legend>
          <div class="row">
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtFechaEntrega">Fecha de Entrega</label>
              <input type="date" class="form-control" id="txtFechaEntrega" disabled>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="txtHoraDesdeSobre">Hora Desde</label>
              <input type="time" class="form-control" id="txtHoraDesdeSobre" require>
              <small id="errHoraDesdeSobre" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="sltEstadoSobre">Estado</label>
              <select id="sltEstadoSobre" class="form-control">
                <option>Estado</option>
              </select>
              <small id="errEstadoSobre" class="form-text text-muted text-red-darker"></small>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-12">
              <label for="sltMunicipioSobre">Municipio</label>
              <select id="sltMunicipioSobre" class="form-control">
                <option>Municipio</option>
              </select>
              <small id="errMunicipioSobre" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtDireccionSobre">Dirección</label>
              <input type="text" class="form-control" id="txtDireccionSobre" placeholder="Dirección" maxlength="250" require>
              <small id="errDireccionSobre" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
              <label for="txtLugarEntrega">Lugar Entrega</label>
              <input type="text" class="form-control" id="txtLugarEntrega" placeholder="Lugar de Entrega" maxlength="250" require>
              <small id="errLugarEntrega" class="form-text text-muted text-red-darker"></small>
            </div>
          </div>
        </fieldset>
        <br />
        <div class="footer ">
          <button type="button" class="btn btn-primary btn-lg float-right" id="btnGuardar"><i class="ion-compose"></i> Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  fieldset>legend {
    font-size: 12pt;
    margin-left: 8px;
  }

  fieldset {
    margin-bottom: 5px;
    margin-top: 5px;
    border-radius: 12px;
  }
</style>