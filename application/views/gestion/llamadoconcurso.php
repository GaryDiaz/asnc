<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
  <div id="areaDeLlamadoConcurso">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="btn btn-light btn-lg" data-toggle="tooltip" data-placement="bottom" title="Mostrar todos"><i class="ion-chatbox"></i> Llamado a Concurso</button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLlamadoConcurso" aria-controls="navbarLlamadoConcurso" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarLlamadoConcurso">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <button class="btn btn-light btn-lg" data-toggle="collapse" href="#opcionesFiltroLlamado" role="button" aria-expanded="false" aria-controls="opcionesOpcionesFiltroLlamado"><i class="ion-android-options"></i> Filtro</button>
          </li>
          <?php if ($this->session->userdata('session')) { ?>
            <li class="nav-item">
              <a class="btn btn-light btn-lg" href="<?= base_url() ?>index.php/regllamadoconcurso"><i class="ion-plus"></i> Registrar</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
    <div class="collapse multi-collapse" id="opcionesFiltroLlamado">
      <div class="card card-body">
        <div class="d-flex flex-column flex-sm-column flex-lg-row bd-highlight mb-3">
          <div class="p-2 bd-highlight">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01"><i class="ion-android-options"></i></label>
              </div>
              <select class="custom-select" id="sltTipoFiltro" data-toggle="tooltip" data-placement="bottom" title="Tipo de Filtro">
                <option selected value="opcMostrarTodos">Mostrar todos</option>
                <option value="opcNumeroProceso">Número de Proceso</option>
                <option value="opcFechaLlamado">Fecha de Llamado</option>
                <option value="opcFechaFin">Fecha Fin (Entrega)</option>
                <option value="opcTexto">Texto a buscar</option>
              </select>
            </div>
          </div>
          <div class="p-2 flex-fill bd-highlight" id="camposIdentificadores">
            <div class="form-group">
              <label for="txtNumeroProceso"><i class="ion-ios-grid-view-outline"></i> Número de Proceso</label>
              <input type="text" class="form-control" placeholder="Número de Proceso" id="txtNumeroProceso" />
              <small id="errNumeroProceso" class="form-text text-danger"></small>
            </div>
          </div>
          <div class="p-2 flex-fill bd-highlight" id="camposFechas">
            <div>
              <div class="form-group">
                <label for="txtDesde"><i class="ion-calendar"></i> Desde</label>
                <input type="date" class="form-control" placeholder="Desde" id="txtDesde" />
                <small id="errDesde" class="form-text text-danger"></small>
              </div>
              <div class="form-group">
                <label for="txtHasta"><i class="ion-calendar"></i> Hasta</label>
                <input type="date" class="form-control" placeholder="Hasta" id="txtHasta" />
                <small id="errHasta" class="form-text text-danger"></small>
              </div>
            </div>
          </div>
          <div class="p-2 flex-fill bd-highlight" id="camposTextos">
            <div class="form-group">
              <label for="txtTextoABuscar"><i class="ion-document-text"></i> Texto a buscar</label>
              <input type="text" class="form-control" placeholder="Texto a buscar" id="txtTextoABuscar" />
              <small id="errTextoABuscar" class="form-text text-danger"></small>
            </div>
          </div>
          <?php if ($this->session->userdata('session')) { ?>
            <div class="p-2 ml-auto bd-highlight">
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="chkPropio">
                <label class="form-check-label" for="chkPropio">Llamados Propios</label>
              </div>
            </div>
          <?php } ?>
          <div class="ml-auto p-2 bd-highlight"><button class="btn btn-primary btn-lg" id="btnFiltrarLlamados"><i class="ion-search"> </i>Filtrar</button></div>
        </div>
      </div>
    </div>
    <div>
      <div class="collapse multi-collapse" id="opcionesConsultaPropia">
        <div class="card card-body">

        </div>
      </div>
    </div>
    <div id="areaDeNotificacion"></div>
    <div id="resultadosLlamadoConcurso">
      No se ha encontrado ningún resultado
    </div>
  </div>
</div>
<?php if (!$this->session->userdata('session')) { ?>
  <style>
    .content {
      margin-left: 0;
    }
  </style>
<?php } ?>