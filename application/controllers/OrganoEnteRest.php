<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */
defined('BASEPATH') or exit('No direct script access allowed');

use ASNC\Libraries\RestController;
use Application\Model\Mensaje;

require_once APPPATH . "/libraries/RestController.php";
require_once APPPATH . "/libraries/Format.php";
require_once APPPATH . "/models/Mensaje.php";

/**
 * APIRest
 * es el controlador que atiende las consultas que se realizan desde el frontend
 * y devuelve las respuestas dentro de un objeto json para que sea manejada a 
 * gusto del desarrollador frontend
 *
 * @author Gary Díaz
 */
class OrganoEnteRest extends RestController {
  const ORGANO_PADRE = 0;
  const ORGANO_ADSCRITO = 1;
  const ENTE = 2;

  public function __construct($config = 'rest') {
    parent::__construct($config);
  }

  private function sesionIniciada() {
    if (!$this->session->userdata('session')) {
      redirect('login');
    }
  }

  public function rif_organoente_get() {
    $this->sesionIniciada();
    $session = $this->session->userdata;
    $this->response($session, 200);
  }

  public function organo_put() {
    try {
      $args = $this->_put_args;
      $this->load->model('dao/OrganoDAO');
      $rs = $this->OrganoDAO->editar($args);
      if ($rs) {
        $data = new Mensaje("Organo-Ente editado satisfactoriamente");
        $data->setDato($this->OrganoDAO->getOrganoEnte($args['id_organoente']), 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo editar la información del Organo-Ente"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function organos_get() {
    try {
      $this->load->model('dao/OrganoDAO');
      $organos = $this->OrganoDAO->getOrganos();
      if ($organos) {
        $data = new Mensaje("Lista de Órganos");
        $data->setDatos($organos, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron organos"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  private function organos_por_tipo($tipo) {
    try {
      $this->load->model('dao/OrganoDAO');
      $organos = $this->OrganoDAO->getOrganosPorTipo($tipo);
      if ($organos) {
        $data = new Mensaje("Lista de Órganos");
        $data->setDatos($organos, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron órganos-entes"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function organos_padres_get() {
    $this->organos_por_tipo(self::ORGANO_PADRE);
  }

  public function organos_adscritos_get() {
    $this->organos_por_tipo(self::ORGANO_ADSCRITO);
  }

  public function organo_get($id) {
    try {
      $this->load->model('dao/OrganoDAO');
      $organo = $this->OrganoDAO->getOrgano($id);
      if ($organo) {
        $data = new Mensaje("Órgano encontrado");
        $data->setDato($organo, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el órgano con id: " . $id), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function organo_por_rif_get($rif) {
    try {
      $this->load->model('dao/OrganoDAO');
      $organo = $this->OrganoDAO->getOrganoPorRIF($rif);
      if ($organo) {
        $data = new Mensaje("Órgano encontrado");
        $data->setDato($organo, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el órgano con RIF: " . $rif), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function organo_propio_get() {
    $this->sesionIniciada();
    $rif = $this->session->userdata['rif_organoente'];
    try {
      $this->load->model('dao/OrganoDAO');
      $organo = $this->OrganoDAO->buscarPorRif($rif);
      if ($organo) {
        $data = new Mensaje("Organo-Ente Propio");
        $data->setDato($organo);
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje('Organo propio no encontrado'), self::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje('Organo propio no encontrado: ' . $exc->getMessage()), self::HTTP_NOT_FOUND);
    }
  }

  public function organo_propio_detalle_get() {
    $this->sesionIniciada();
    $rif = $this->session->userdata['rif_organoente'];
    try {
      $this->load->model('dao/OrganoDAO');
      $organo = $this->OrganoDAO->buscarPorRifDetalle($rif);
      if ($organo) {
        $data = new Mensaje("Organo-Ente Propio");
        $data->setDato($organo);
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje('Organo propio no encontrado'), self::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje('Organo propio no encontrado: ' . $exc->getMessage()), self::HTTP_NOT_FOUND);
    }
  }
}
