<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Formulario
 *
 * Es el controlador encargado ser servir los formularios
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */

class Formulario extends CI_Controller {
  public function feriado_especifico() {
    $this->load->view('gestion/forms/frmFeriadoEspecifico.php');
  }

  public function feriado_estadal() {
    $this->load->view('gestion/forms/frmFeriadoEstadal.php');
  }

  public function feriado_municipal() {
    $this->load->view('gestion/forms/frmFeriadoMunicipal.php');
  }

  public function feriado_nacional() {
    $this->load->view('gestion/forms/frmFeriadoNacional.php');
  }

  public function entidad_descriptiva() {
    $this->load->view('gestion/forms/frmEntidadDescriptiva.php');
  }

  public function lapso() {
    $this->load->view('gestion/forms/frmLapso.php');
  }

  public function confirmar_borrar() {
    $this->load->view('gestion/forms/frmConfirmarBorrar.php');
  }
}
