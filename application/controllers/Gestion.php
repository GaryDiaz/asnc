<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */


class Gestion extends CI_Controller {
  private function sesionIniciada() {
    if (!$this->session->userdata('session')) {
      redirect('login');
    }
  }

  public function dias_feriados() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/feriados.php');
    $this->load->view('templates/footer.php');
  }

  public function lapsos() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/lapsos.php');
    $this->load->view('templates/footer.php');
  }

  public function perfilinstitucional() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/organoente.php');
    $this->load->view('templates/footer.php');
  }

  public function registrollamado() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/regllamadoconcurso.php');
    $this->load->view('templates/footer.php');
  }

  public function editarllamado($numeroProceso) {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/editllamadoconcurso.php');
    $this->load->view('templates/footer.php');
  }

  public function llamadoconcurso() {
    if (!$this->session->userdata('session')) {
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('gestion/llamadoconcurso.php');
      $this->load->view('templates/footer.php');
    } else {
      $this->load->view('templates/header.php');
      $this->load->view('templates/navigator.php');
      $this->load->view('gestion/llamadoconcurso.php');
      $this->load->view('templates/footer.php');
    }
  }
}
