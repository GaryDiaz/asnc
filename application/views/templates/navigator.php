<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
  <div id="header" class="header navbar-default">
    <div class="navbar-header">
      <a href="." class="navbar-brand"><span class="navbar-logo"><i style="color:darkred" class="fas fa-briefcase"></i></span> <b>Sistema Integrado</b> SNC</a>
      <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <ul class="navbar-nav navbar-right">
      <li></li>
      <li class="dropdown"></li>
      <li class="dropdown navbar-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?= base_url() ?>Plantilla/admin/assets/img/user/user-13.jpg" alt="" />
          <span class="d-none d-md-inline"><?= $this->session->userdata('nombre') ?></span>
          <b class="caret"></b>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="<?= base_url() ?>index.php/login/logout" class="dropdown-item">Cerrar Sesión</a>
          <a href="<?= base_url() ?>index.php/login/v_camb_clave" class="dropdown-item">Cambio de Contraseña</a>
          <a href="<?= base_url() ?>index.php/perfilinstitucional" class="dropdown-item">Perfil Intitucional</a>

        </div>
      </li>
    </ul>
  </div>

  <div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
      <ul class="nav">
        <li class="nav-profile">
          <a href="javascript:;" data-toggle="nav-profile">
            <div class="cover with-shadow"></div>
            <div class="image text-center ml-5">
              <img src="<?= base_url() ?>Plantilla/admin/assets/img/user/user-13.jpg" alt="" />
            </div>
            <div class="info ml-5">
              <b class=""></b>
              <?= $this->session->userdata('nombre') ?>
              <small>Bienvenido</small>
            </div>
          </a>
        </li>
        <!-- <li>
                        <ul class="nav nav-profile">
                                <li><a href="javascript:;"><i class="ion-ios-cog"></i> Settings</a></li>
                                <li><a href="javascript:;"><i class="ion-ios-share-alt"></i> Send Feedback</a></li>
                                <li><a href="javascript:;"><i class="ion-ios-help"></i> Helps</a></li>
                        </ul>
                </li> -->
      </ul>
      <ul class="nav">
        <li class="nav-header">Navegador</li>
        <?php if (($this->session->userdata('perfil') == 1) || ($this->session->userdata('perfil') == 3)) : ?>
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              <i class="fas fa-sliders-h" style="background:darkred;"></i>
              <span>RNCE</span>
            </a>

            <ul class="sub-menu">
              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  <span>Programación</span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="<?= base_url() ?>index.php/programacion">
                      - Programación Anual
                    </a>
                  </li>
                </ul>
              </li>

              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  <span>Evaluación de</span>
                  <span class="ml-1">Desempeño</span>
                </a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio">Registrar</a></li>
                  <?php if (($this->session->userdata('perfil') == 1)) : ?>
                    <li class="has-sub">
                      <a href="javascript:;">
                        <b class="caret"></b>
                        Anulación
                      </a>
                      <ul class="sub-menu">
                        <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/anulacion">- Sol. Anulación</a></li>
                        <li><a href="<?= base_url() ?>index.php/Evaluacion_desempenio/proc_anulacion">- Proc. Anulaciones</a></li>
                      </ul>
                    </li>
                  <?php endif; ?>
                  <li class="has-sub">
                    <a href="javascript:;">
                      <b class="caret"></b>
                      Reportes
                    </a>
                    <ul class="sub-menu">
                      <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/reporte">- Comprobante Registro</a></li>
                      <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/consulta">- Estadistica</a></li>
                      <?php if (($this->session->userdata('perfil') == 1)) : ?>
                        <li><a href="<?= base_url() ?>index.php/Evaluacion_desempenio/estatus_contratista">- Comprobante de Empresa <b>NO REGISTRADA</b></a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  <span>Llamado a Concurso</span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="<?= base_url() ?>index.php/llamadoconcurso">
                      - Consultar
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url() ?>index.php/regllamadoconcurso">
                      - Registro llamado a consurso
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (($this->session->userdata('perfil') == 1) || ($this->session->userdata('perfil') == 3)) : ?>
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              <i class="fas fa-server" style="background:darkred;"></i>
              <span>RNC</span>
            </a>
            <ul class="sub-menu">
              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  <span>Consulta de Contratista</span>
                </a>
                <ul class="sub-menu">
                  <li><a href="<?= base_url() ?>index.php/Contratista/infor_contratista">- Planilla Resumen</a></li>
                  <li><a href="<?= base_url() ?>index.php/Contratista/infor_contrat_nombre">- Planilla Resumen por Nombre</a></li>
                  <li><a href="<?= base_url() ?>index.php/Contratista/infor_contrat_objCont">- Busqueda de Contratista</a></li>
                  <!-- <li><a>- Reprogramación</a></li> -->
                </ul>
              </li>
            </ul>

          </li>
        <?php endif; ?>
        <?php if (($this->session->userdata('perfil') <= 2)) : ?>
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              <i class="ion-gear-b fa-spin" style="background:darkred;"></i>
              <span>Configuración</span>
            </a>

            <ul class="sub-menu">
              <?php if (($this->session->userdata('perfil') <= 2)) : ?>
                <li class="has-sub">
                  <a href="javascript:;">
                    <b class="caret"></b>
                    Entes
                  </a>
                  <ul class="sub-menu">
                    <li class="has-sub">
                    <li>
                      <a href="<?= base_url() ?>index.php/configuracion/organismo">
                        <i class="fas fa-lg fa-fw m-r-10 fa-landmark"></i>Organismos
                      </a>
                    </li>
                    <li>
                      <a href="<?= base_url() ?>index.php/configuracion/entes">
                        <i class="fas fa-lg fa-fw m-r-10 fa-building"></i>Entes
                      </a>
                    </li>
                    <li>
                      <a href="<?= base_url() ?>index.php/configuracion/entes_adscritos">
                        <i class="fas fa-lg fa-fw m-r-10 fa-city"></i>Entes Adscritos
                      </a>
                    </li>
                </li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (($this->session->userdata('perfil') == 1)) : ?>
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              <span>Tablas Parametros</span>
            </a>
            <ul class="sub-menu">
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/index">
                  - Fuente de Financiamiento
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/alicuotaiva">
                  - Alicuota
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/partidap">
                  - Partida Presupuestaria
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/centra">
                  - Acción Centralizada
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/und">
                  - Unidad de Medida
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/ccnu">
                  - CCNU
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/diasferiados">
                  - Dias Feriados
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/estado">
                  - Estado
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/municipio">
                  - Municipio
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/parroquia">
                  - Parroquia
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/ciudades">
                  - Ciudades
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/operador">
                  - Operadora
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/proce">
                  - Procedimiento Selección de Contratista
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/supuestos">
                  - Supuestos de Procedimientos
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Fuentefinanc/edocivil">
                  - Estado Civil
                </a>
              </li>
            </ul>
          </li>
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              <span>Configuración de Públicaciones</span>
            </a>
            <ul class="sub-menu">
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/banco">
                  - Banco
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/tipo_cuenta">
                  - Tipo de Cuenta
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/datosbancarios">
                  - Datos Bancarios
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/modalidad">
                  - Modalidad
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/mecanismo">
                  - Mécanismo
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/Publicaciones/actividad">
                  - Actividad
                </a>
              </li>
              <li>
                <a href="<?= base_url() ?>index.php/gestionlapsos">
                  - Gestion: Lapsos
                </a>
              </li>

            </ul>
          </li>
        <?php endif; ?>
        <li class="has-sub">
          <a href="javascript:;">
            <span>Usuarios</span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="<?= base_url() ?>index.php/user">
                <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Registros
              </a>
            </li>
            <?php if ($this->session->userdata('perfil') <= 2) : ?>
              <li>
                <a href="<?= base_url() ?>index.php/user/int">
                  <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Registros Usuarios Externos
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
      </li>
    <?php endif; ?>

    <li class="mt-5"><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Cerrar Navegador</span></a></li>
    </ul>
    </div>
  </div>
  <div class="sidebar-bg"></div>