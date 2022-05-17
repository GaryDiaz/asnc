<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */

defined('BASEPATH') or exit('No direct script access allowed');

//use LapsoDAO;
use Application\Model\Mensaje;
use ASNC\Libraries\RestController;

require_once APPPATH . "/libraries/RestController.php";
require_once APPPATH . "/libraries/Format.php";
require_once APPPATH . "/models/Mensaje.php";

/**
 * ActividadRest
 * es el controlador que atiende las consultas que se realizan desde el frontend
 * y funciona como CRUD de Modalidad, Mecanismo, Objeto de Contracion y 
 * Actividad
 *
 * @author Gary Díaz
 */
class LapsoRest extends RestController {

  public function __construct($config = 'rest') {
    parent::__construct($config);
  }

  //**************************************************************************
  //***                           ACTIVIDAD                                ***
  //**************************************************************************

  public function lapso_delete($id_modalidad, $id_mecanismo, $id_oc) {
    try {
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->lapsoEliminar($id_modalidad, $id_mecanismo, $id_oc);
      if ($rs) {
        $data = new Mensaje("El lapso ha sido eliminado satisfactoriamente");
        $lapsos = $this->LapsoDAO->lapsoListar();
        $data->setDatos($lapsos, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo eliminar el lapso"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo eliminar el lapso" . $exc->getMessage()), RestController::HTTP_NOT_FOUND);
    }
  }

  public function lapso_get($id_modalidad, $id_mecanismo, $id_oc) {
    try {
      $this->load->model('dao/LapsoDAO');
      $lapso = $this->LapsoDAO->lapsoBuscar($id_modalidad, $id_mecanismo, $id_oc);
      if ($lapso) {
        $data = new Mensaje("Lapso encontrado");
        $data->setDato($lapso, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el lapso con id: " . $id_modalidad . '-' . $id_mecanismo . '-' . $id_oc), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function lapso_post() {
    try {
      $lapso = $this->_post_args;
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->lapsoAgregar($lapso);
      if ($rs) {
        $data = new Mensaje("Actividad agregada");
        $data->setDatos($this->LapsoDAO->lapsoListar(), "mixto", $rs);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo agregar el lapso"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo agregar el lapso: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function lapso_put() {
    try {
      $lapso = $this->_put_args;
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->lapsoEditar($lapso);
      if ($rs) {
        $data = new Mensaje("Lapso editada");
        $data->setDatos($this->LapsoDAO->actividadListar(), "mixto", $lapso);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo editar el lapso"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo editar el lapso: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function lapsos_get() {
    try {
      $this->load->model('dao/LapsoDAO');
      $lapso = $this->LapsoDAO->lapsoListar();
      if ($lapso) {
        $data = new Mensaje("Lista de Lapsos");
        $data->setDatos($lapso, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron lapsos"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***                           MECANISMO                                ***
  //**************************************************************************

  public function mecanismo_delete($id_mecanismo) {
    try {
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->mecanismoEliminar($id_mecanismo);
      if ($rs) {
        $data = new Mensaje("El mecanismo ha sido eliminado satisfactoriamente");
        $data->setDatos($this->LapsoDAO->mecanismoListar(), 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo eliminar el mecanismo"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo eliminar el mecanismo" . $exc->getMessage()), RestController::HTTP_NOT_FOUND);
    }
  }

  public function mecanismo_get($id_mecanismo) {
    try {
      $this->load->model('dao/LapsoDAO');
      $mecanismo = $this->LapsoDAO->mecanismoBuscar($id_mecanismo);
      if ($mecanismo) {
        $data = new Mensaje("Mecanismo encontrado");
        $data->setDato($mecanismo, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el Mecanismo con id: " . $id_mecanismo), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function mecanismo_post() {
    try {
      $mecanismo = $this->_post_args['descripcion'];
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->mecanismoAgregar($mecanismo);
      if ($rs) {
        $data = new Mensaje("Mecanismo agregado");
        $data->setDatos($this->LapsoDAO->mecanismoListar(), "mixto", $rs);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo agregar el mecanismo"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo agregar el mecanismo: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function mecanismo_put() {
    try {
      $mecanismo = $this->_put_args;
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->mecanismoEditar($mecanismo);
      if ($rs) {
        $data = new Mensaje("Mecanismo editado");
        $data->setDatos($this->LapsoDAO->mecanismoListar(), "mixto", $mecanismo);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo editar el mecanismo"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo editar el mecanismo: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function mecanismos_get() {
    try {
      $this->load->model('dao/LapsoDAO');
      $mecanismos = $this->LapsoDAO->mecanismoListar();
      if ($mecanismos) {
        $data = new Mensaje("Lista de Mecanismos");
        $data->setDatos($mecanismos, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron Mecanismos"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***                           MODALIDAD                                ***
  //**************************************************************************

  public function modalidad_delete($id_modalidad) {
    try {
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->modalidadEliminar($id_modalidad);
      if ($rs) {
        $data = new Mensaje("La modalidad ha sido eliminada satisfactoriamente");
        $data->setDatos($this->LapsoDAO->modalidadListar(), 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo eliminar la modalidad"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo eliminar la modalidad" . $exc->getMessage()), RestController::HTTP_NOT_FOUND);
    }
  }

  public function modalidad_get($id_modalidad) {
    try {
      $this->load->model('dao/LapsoDAO');
      $modalidad = $this->LapsoDAO->modalidadBuscar($id_modalidad);
      if ($modalidad) {
        $data = new Mensaje("Modalidad encontrada");
        $data->setDato($modalidad, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró Modalidad con id: " . $id_modalidad), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function modalidad_post() {
    try {
      $modalidad = $this->_post_args['descripcion'];
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->modalidadAgregar($modalidad);
      if ($rs) {
        $data = new Mensaje("Modalidad agregado");
        $data->setDatos($this->LapsoDAO->modalidadListar(), "mixto", $rs);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo agregar la modalidad"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo agregar la modalidad: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function modalidad_put() {
    try {
      $modalidad = $this->_put_args;
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->modalidadEditar($modalidad);
      if ($rs) {
        $data = new Mensaje("Modalidad editada");
        $data->setDatos($this->LapsoDAO->modalidadListar(), "mixto", $modalidad);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo editar la modalidad"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo editar la modalidad: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function modalidades_get() {
    try {
      $this->load->model('dao/LapsoDAO');
      $modalidades = $this->LapsoDAO->modalidadListar();
      if ($modalidades) {
        $data = new Mensaje("Lista de Modalidades");
        $data->setDatos($modalidades, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron Modalidades"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***                     OBJETO DE CONTRATACION                         ***
  //**************************************************************************

  public function objeto_contratacion_delete($id_oc) {
    try {
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->objetoContratacionEliminar($id_oc);
      if ($rs) {
        $data = new Mensaje("El objeto de contratacion ha sido eliminadao satisfactoriamente");
        $data->setDatos($this->LapsoDAO->objetoContratacionListar(), 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo eliminar el objeto de contratacion"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo eliminar el objeto de contratacion" . $exc->getMessage()), RestController::HTTP_NOT_FOUND);
    }
  }

  public function objeto_contratacion_get($id_oc) {
    try {
      $this->load->model('dao/LapsoDAO');
      $objeto = $this->LapsoDAO->objetoContratacionBuscar($id_oc);
      if ($objeto) {
        $data = new Mensaje("Objeto de Contración encontrado");
        $data->setDato($objeto, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el Objeto de Contración con id: " . $id_oc), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function objeto_contratacion_post() {
    try {
      $oc = $this->_post_args['descripcion'];
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->objetoContratacionAgregar($oc);
      if ($rs) {
        $data = new Mensaje("Objeto de contratacion agregado");
        $data->setDatos($this->LapsoDAO->objetoContratacionListar(), "mixto", $rs);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo agregar el objeto de contratación"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo agregar el objeto de contratación: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function objeto_contratacion_put() {
    try {
      $oc = $this->_put_args;
      $this->load->model('dao/LapsoDAO');
      $rs = $this->LapsoDAO->objetoContratacionEditar($oc);
      if ($rs) {
        $data = new Mensaje("Objeto de contratacion editado");
        $data->setDatos($this->LapsoDAO->objetoContratacionListar(), "mixto", $oc);
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo editar el objeto de contratación"), RestController::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje("No se pudo editar el objeto de contratación: " . $exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function objetos_contratacion_get() {
    try {
      $this->load->model('dao/LapsoDAO');
      $objetos = $this->LapsoDAO->objetoContratacionListar();
      if ($objetos) {
        $data = new Mensaje("Lista de Objetos de Contratación");
        $data->setDatos($objetos, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron Objetos de Contración"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }
}
