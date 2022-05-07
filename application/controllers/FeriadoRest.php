<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */

use ASNC\Libraries\RestController;
use Application\Model\Mensaje;

require_once APPPATH . "/libraries/RestController.php";
require_once APPPATH . "/libraries/Format.php";
require_once APPPATH . "/models/Mensaje.php";

/**
 * FeriadoRest
 *
 * Es un controlador que se encarga de servir todas peticiones CRUD relacionadas
 * con los Feriados Nacionales, Estadales, Municipales y de Fechas Específicas
 *
 * @author Gary Díaz
 */

class FeriadoRest extends RestController {

  //**************************************************************************
  //***             Solicitudes Rest de Feriados Especificos               ***
  //**************************************************************************

  public function feriado_especifico_delete($strfecha) {
    try {
      $fecha = $this->convertirStringDate($strfecha);
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->eliminarFeriadoEspecifico($strfecha);
      if ($rs) {
        $data = new Mensaje("El Feriado Específico ha sido eliminado satisfactoriamente: " . date_format($fecha, 'd-m-Y'));
        $datos = $this->FeriadoDAO->getFeriadosEspecificos();
        $data->setDatos($datos, "lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo eliminar el Feriado Específico: " . date_format($fecha, 'd-m-Y'));
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_especifico_get($strfecha) {
    try {
      $fecha = $this->convertirStringDate($strfecha);
      $this->load->model('dao/FeriadoDAO');
      $feriado = $this->FeriadoDAO->buscarFeriadoEspecifico($strfecha);
      if ($feriado) {
        $data = new Mensaje("Feriado Específico encontrado: " . date_format($fecha, 'd-m-Y'));
        $data->setDato($feriado, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró un feriado específico en la fecha: " . date_format($fecha, 'd-m-Y')), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_especifico_post() {
    try {
      $feriadoEspecifico = $this->_post_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->agregarFeriadoEspecifico($feriadoEspecifico);
      if ($rs) {
        $data = new Mensaje("El Feriado Específico ha sido agregado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosEspecificos();
        $data->setDatos($datos, "mixta", $feriadoEspecifico);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo agregar el Feriado Específico");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_especifico_put() {
    try {
      $feriadoEspecifico = $this->_put_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->editarFeriadoEspecifico($feriadoEspecifico);
      if ($rs) {
        $data = new Mensaje("El Feriado Específico ha sido editado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosEspecificos();
        $data->setDatos($datos, "mixta", $feriadoEspecifico);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo editar el Feriado Espec");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_especificos_cercanos_get($strfecha) {
    try {
      $fecha = $this->convertirStringDate($strfecha);
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosEspecificosCercanos($fecha);
      if ($feriados) {
        $data = new Mensaje("Feriados Especificos Cercanos a: " . date_format($fecha, 'd-m-Y'));
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados específicos cercanos a la fecha: " . date_format($fecha, 'd-m-Y')), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_especificos_por_anio_get($anio) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosEspecificosPorAnio($anio);
      if ($feriados) {
        $data = new Mensaje("Feriados Especificos en el año: " . $anio);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados específicos en el año: " . $anio), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_especificos_get() {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosEspecificos();
      if ($feriados) {
        $data = new Mensaje("Lista de Feriados Especificos");
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados específicos"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_especificos_put() {
    try {
      $descripcion = $this->_put_args['descripcion'];
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->buscarFeriadosEspecificos($descripcion);
      if ($feriados) {
        $data = new Mensaje("Feriados específicos encontrados con: " . $descripcion);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados específicos con el texto: " . $descripcion), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_especificos2_put() {
    try {
      $descripcion = $this->_put_args['descripcion'];
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->buscarFeriadosEspecificos2($descripcion, intval($this->_put_args['anio']));
      if ($feriados) {
        $data = new Mensaje("Feriados específicos encontrados con: " . $descripcion);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados específicos con el texto: " . $descripcion), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***            Solicitudes Rest de Feriados Nacionales                 ***
  //**************************************************************************

  public function feriado_nacional_delete($mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->eliminarFeriadoNacional($mes, $dia);
      if ($rs) {
        $data = new Mensaje("El Feriado Nacional ha sido eliminado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosNacionales();
        $data->setDatos($datos, "lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo eliminar el Feriado Nacional");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_nacional_get($mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriado = $this->FeriadoDAO->buscarFeriadoNacional($mes, $dia);
      if ($feriado) {
        $data = new Mensaje("Feriado Nacional encontrado");
        $data->setDato($feriado, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró un feriado nacional en la fecha indicada"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_nacional_post() {
    try {
      $feriadoNacional = $this->_post_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->agregarFeriadoNacional($feriadoNacional);
      if ($rs) {
        $data = new Mensaje("El Feriado Nacional ha sido agregado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosNacionales();
        $data->setDatos($datos, "mixta", $feriadoNacional);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo agregar el Feriado Nacional");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_nacional_put() {
    try {
      $feriadoNacional = $this->_put_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->editarFeriadoNacional($feriadoNacional);
      if ($rs) {
        $data = new Mensaje("El Feriado Nacional ha sido editado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosNacionales();
        $data->setDatos($datos, "mixta", $feriadoNacional);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo editar el Feriado Nacional");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_nacionales_cercanos_get($mes) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosNacionalesCercanos($mes);
      if ($feriados) {
        $data = new Mensaje("Feriados Nacionales Cercanos al mes: " . $mes);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados nacionales cercanos al mes: " . $mes), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_nacionales_get() {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosNacionales();
      if ($feriados) {
        $data = new Mensaje("Lista de Feriados Nacionales");
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados nacionales"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_nacionales_put() {
    try {
      $descripcion = $this->_put_args['descripcion'];
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->buscarFeriadosNacionales($descripcion);
      if ($feriados) {
        $data = new Mensaje("Feriados Nacionales encontrados con: " . $descripcion);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados nacionales con el texto: " . $descripcion), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***             Solicitudes Rest de Feriados Estadales                 *** 
  //**************************************************************************

  public function feriado_estadal_delete($id_estado, $mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->eliminarFeriadoEstadal($id_estado, $mes, $dia);
      if ($rs) {
        $data = new Mensaje("El Feriado Estadal ha sido eliminado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosEstadales($id_estado);
        $data->setDatos($datos, "lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo eliminar el Feriado Estadal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_estadal_get($id_estado, $mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriado = $this->FeriadoDAO->buscarFeriadoEstadal($id_estado, $mes, $dia);
      if ($feriado) {
        $data = new Mensaje("Feriado Estadal encontrado");
        $data->setDato($feriado, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró un feriado estadal en el estado fecha indicada"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_estadal_post() {
    try {
      $feriadoEstadal = $this->_post_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->agregarFeriadoEstadal($feriadoEstadal);
      if ($rs) {
        $data = new Mensaje("El Feriado Estadal ha sido agregado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosEstadales($feriadoEstadal['id_estado']);
        $data->setDatos($datos, "mixta", $feriadoEstadal);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo agregar el Feriado Estadal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_estadal_put() {
    try {
      $feriadoEstadal = $this->_put_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->editarFeriadoEstadal($feriadoEstadal);
      if ($rs) {
        $data = new Mensaje("El Feriado Estadal ha sido editado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosEstadales($feriadoEstadal['id_estado']);
        $data->setDatos($datos, "mixta", $feriadoEstadal);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo editar el Feriado Estadal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_estadales_get($idEstado) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosEstadales($idEstado);
      if ($feriados) {
        $this->load->model('dao/DireccionDAO');
        $estado = $this->DireccionDAO->getEstado($idEstado);
        $data = new Mensaje("Lista de Feriados del Estado: " . $estado->descedo);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados estadales"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_estadales_cercanos_get($idEstado, $mes) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosEstadalesCercanos($idEstado, $mes);
      if ($feriados) {
        $data = new Mensaje("Feriados Estadales Cercanos al mes: " . $mes);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados estadales cercanos al mes: " . $mes), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_estadales_put() {
    try {
      $args = $this->_put_args;
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->buscarFeriadosEstadales($args['id_estado'], $args['descripcion']);
      if ($feriados) {
        $data = new Mensaje("Feriados Estadales encontrados con: " . $args['descripcion']);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados estadales con el texto: " . $args['descripcion'] . " para ese estado"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***             Solicitudes Rest de Feriados Municipales               *** 
  //**************************************************************************

  public function feriado_municipal_delete($id_municipio, $mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->eliminarFeriadoMunicipal($id_municipio, $mes, $dia);
      if ($rs) {
        $data = new Mensaje("El Feriado Estadal ha sido eliminado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosMunicipales($id_municipio);
        $data->setDatos($datos, "lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo eliminar el Feriado Municipal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_municipal_get($id_municipio, $mes, $dia) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriado = $this->FeriadoDAO->buscarFeriadoMunicipal($id_municipio, $mes, $dia);
      if ($feriado) {
        $data = new Mensaje("Feriado Municipal encontrado");
        $data->setDato($feriado, 'singular');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró un feriado municipal en el estado fecha indicada"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_municipal_post() {
    try {
      $feriadoMunicipal = $this->_post_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->agregarFeriadoMunicipal($feriadoMunicipal);
      if ($rs) {
        $data = new Mensaje("El Feriado Estadal ha sido agregado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosMunicipales($feriadoMunicipal['id_municipio']);
        $data->setDatos($datos, "mixta", $feriadoMunicipal);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo agregar el Feriado Municipal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriado_municipal_put() {
    try {
      $feriadoMunicipal = $this->_put_args;
      $this->load->model('dao/FeriadoDAO');
      $rs = $this->FeriadoDAO->editarFeriadoMunicipal($feriadoMunicipal);
      if ($rs) {
        $data = new Mensaje("El Feriado Municipal ha sido editado satisfactoriamente");
        $datos = $this->FeriadoDAO->getFeriadosMunicipales($feriadoMunicipal['id_municipio']);
        $data->setDatos($datos, "mixta", $feriadoMunicipal);
        $this->response($data, self::HTTP_OK);
      } else {
        $data = new Mensaje("No se pudo editar el Feriado Municipal");
        $this->response($data, self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $data = new Mensaje($exc->getMessage());
      $this->response($data, self::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_municipales_get($idMunicipio) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosMunicipales($idMunicipio);
      if ($feriados) {
        $this->load->model('dao/DireccionDAO');
        $row = $feriados[0];
        //$municipio=$this->DireccionDAO->getMunicipio($idMunicipio);
        $data = new Mensaje("Lista de Feriados del Municipio: " . $row->municipio);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados municipales"), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_municipales_cercanos_get($idMunicipio, $mes) {
    try {
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->getFeriadosMunicipalesCercanos($idMunicipio, $mes);
      if ($feriados) {
        $data = new Mensaje("Feriados Municipales Cercanos al mes: " . $mes);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados municipales cercanos al mes: " . $mes), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function feriados_municipales_put() {
    try {
      $descripcion = $this->_put_args['descripcion'];
      $this->load->model('dao/FeriadoDAO');
      $feriados = $this->FeriadoDAO->buscarFeriadosMunicipales($this->_put_args['id_municipio'], $descripcion);
      if ($feriados) {
        $data = new Mensaje("Feriados Municipales encontrados con: " . $descripcion);
        $data->setDatos($feriados, 'lista');
        $this->response($data, RestController::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron feriados municipales con el texto: " . $descripcion), RestController::HTTP_NOT_FOUND);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  //**************************************************************************
  //***                        Funciones Internas                          *** 
  //**************************************************************************

  private function convertirStringDate(string $strfecha, string $formato = "Y-m-d") {
    $dt = DateTime::createFromFormat($formato, $strfecha);
    if (date_format($dt, $formato) == $strfecha) {
      return $dt;
    } else {
      throw new Exception('Debe introducir una fecha válida en formato (aaaa-mm-dd)');
    }
  }
}
