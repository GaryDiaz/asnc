<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
?>

<div id="content" class="content">
  <div id="areaDeNotificacion"></div>
  <div id="areaDeLlamadoConcurso">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><i class="ion-chatbox"></i> Llamado a Concurso</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLlamadoConcurso" aria-controls="navbarLlamadoConcurso" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarLlamadoConcurso">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="ion-ios-list-outline"> </i>Motrar Todos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#opcionesConsultaPropia" role="button" aria-expanded="false" aria-controls="opcionesConsultaPropia"><i class="ion-ios-search-strong"></i> Consulta Propios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#opcionesFiltroLlamado" role="button" aria-expanded="false" aria-controls="opcionesOpcionesFiltroLlamado"><i class="ion-android-options"></i> Filtro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>index.php/regllamadoconcurso"><i class="ion-plus"></i> Registrar</a>
          </li>
        </ul>
      </div>
    </nav>
    <div>
      <div class="collapse multi-collapse" id="opcionesConsultaPropia">
        <div class="card card-body">
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
    </div>
    <div class="collapse multi-collapse" id="opcionesFiltroLlamado">
      <div class="card card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
      </div>
    </div>
    <div id="resultadosLlamadoConcurso">
      No se ha encontrado ningún resultado
    </div>
  </div>
</div>