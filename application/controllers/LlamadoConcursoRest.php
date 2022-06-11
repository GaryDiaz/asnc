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
 * LlamadoConcursoRest
 * &&
 * @author Gary Díaz
 */
class LlamadoConcursoRest extends RestController {
  private function sesionIniciada() {
    if (!$this->session->userdata('session')) {
      $this->response(new Mensaje("Debe iniciar sesión, espacio no autorizado"), self::HTTP_UNAUTHORIZED);
    }
  }

  public function calcular_lapsos_get(string $rif, $fechaLlamado, int $idModalidad, int $idMecanismo, int $idOC) {
    try {
      $oe = $this->buscarOrganoEntePorRif($rif);
      $lapso = $this->buscarLapso($idModalidad, $idMecanismo, $idOC);
      $feriados = $this->buscarFeriadosCercanos($oe->id_estado, $oe->id_municipio, $fechaLlamado);
      //$x= array('organoente'=>$oe, 'lapso'=>$lapso, 'feriados'=>$feriados);
      $this->load->model('dao/LlamadoConcursoDAO');
      $fechasLapsos = $this->LlamadoConcursoDAO->calcularLapsos($fechaLlamado, $lapso->dias_habiles, $feriados);
      if ($fechasLapsos) {
        $data = new Mensaje("Fecha calculadas según los parámetros");
        $data->setDatos($fechasLapsos, 'Fechas Lapsos');
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudieron calcular las fechas"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_todos_get() {
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscarTodos();
      if ($res) {
        $data = new Mensaje("Lista de Llamado a concurso");
        $data->setDatos($res, "Lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron llamados a concurso"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_todos_propios_get() {
    $this->sesionIniciada();
    $rif = $this->session->userdata['rif_organoente'];
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscarPorRIF($rif);
      if ($res) {
        $data = new Mensaje("Lista de Llamado a concurso propios");
        $data->setDatos($res, "Lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron llamados a concurso propios"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_por_numero_proceso_get($numeroProceso) {
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscarPorNumeroProceso($numeroProceso);
      if ($res) {
        $data = new Mensaje("Lista de Llamado a concurso por número de proceso");
        $data->setDatos($res, "Lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron llamados a concurso por el número de proceso: " . $numeroProceso), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_por_rif_y_numero_proceso_get($rif, $numeroProceso) {
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscar($rif, $numeroProceso);
      if ($res) {
        $data = new Mensaje("Llamado a concurso encontrado satisfactoriamente");
        $data->setDato($res, "Llamado a concurso");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontró el llamado a concurso especificado"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_por_texto_get($textoABuscar, $propio) {
    $rif = null;
    if ($propio) {
      $this->sesionIniciada();
      $rif = $this->session->userdata['rif_organoente'];
    }
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscarPorTextoRIF($textoABuscar, $rif);
      if ($res) {
        $data = new Mensaje("Lista de Llamado a concurso por texto a buscar");
        $data->setDatos($res, "Lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron llamados a concurso por el texto: " . $textoABuscar), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function buscar_por_fecha_get($tipoFecha, $desde, $hasta, $propio) {
    $rif = null;
    if ($propio) {
      $this->sesionIniciada();
      $rif = $this->session->userdata['rif_organoente'];
    }
    $campoFecha = ($tipoFecha === "fechaFin") ? 'fecha_fin_llamado' : 'fecha_llamado';
    try {
      $this->load->model('dao/LlamadoConcursoDAO');
      $res = $this->LlamadoConcursoDAO->buscarPorFecha($campoFecha, $desde, $hasta, $rif);
      if ($res) {
        $data = new Mensaje("Lista de Llamado a concurso por fecha");
        $data->setDatos($res, "Lista");
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se encontraron llamados a concurso entre las fechas especificadas: "), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), self::HTTP_BAD_REQUEST);
    }
  }

  public function recalcular_lapsos_get(string $rif, $fechaLlamado, $fecha_fin_llamado) {
    try {
      $oe = $this->buscarOrganoEntePorRif($rif);
      $feriados = $this->buscarFeriadosCercanos($oe->id_estado, $oe->id_municipio, $fechaLlamado);
      //$x= array('organoente'=>$oe, 'lapso'=>$lapso, 'feriados'=>$feriados);
      $this->load->model('dao/LlamadoConcursoDAO');
      $fechasLapsos = $this->LlamadoConcursoDAO->recalcularLapsos($fechaLlamado, $fecha_fin_llamado, $feriados);
      if ($fechasLapsos) {
        $data = new Mensaje("Fecha recalculadas según los parámetros");
        $data->setDatos($fechasLapsos, 'Fechas Lapsos');
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudieron calcular las fechas"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function llamado_concurso_post() {
    try {
      $llamadoConcurso = $this->_post_args;
      $llamadoConcurso['estatus'] = "Iniciado";
      $this->load->model('dao/LlamadoConcursoDAO');
      $rs = $this->LlamadoConcursoDAO->agregar($llamadoConcurso);
      if ($rs) {
        $data = new Mensaje("El llamado a concurso ha sido registrado satisfactoriamente");
        $data->setDato($this->LlamadoConcursoDAO->buscar($llamadoConcurso['rif_organoente'], $llamadoConcurso['numero_proceso']));
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pundo registrar el llamado a concurso"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  public function llamado_concurso_put($rif, $numero_proceso) {
    try {
      $llc = $this->_put_args;
      $this->load->model('dao/LlamadoConcursoDAO');
      $rs = $this->LlamadoConcursoDAO->editar($rif, $numero_proceso, $llc);
      if ($rs) {
        $data = new Mensaje("El llamado a concurso ha sido editado satisfactoriamente");
        $data->setDato($this->LlamadoConcursoDAO->buscar($rif, $numero_proceso));
        $this->response($data, self::HTTP_OK);
      } else {
        $this->response(new Mensaje("No se pudo registrar el llamado a concurso"), self::HTTP_BAD_REQUEST);
      }
    } catch (Exception $exc) {
      $this->response(new Mensaje($exc->getMessage()), RestController::HTTP_BAD_REQUEST);
    }
  }

  private function buscarOrganoEntePorRif($rif) {
    try {
      $this->load->model('dao/OrganoDAO');
      $oe = $this->OrganoDAO->buscarPorRif($rif);
      if ($oe) {
        return $oe;
      } else {
        throw new Exception("No encontro un Órgano-Ente con RIF: " . $rif);
      }
    } catch (Exception $exc) {
      throw $exc;
    }
  }

  private function buscarLapso(int $idModalidad, int $idMecanismo, int $idOC) {
    try {
      $this->load->model('dao/LapsoDAO');
      $lapso = $this->LapsoDAO->lapsoBuscar($idModalidad, $idMecanismo, $idOC);
      if ($lapso) {
        return $lapso;
      } else {
        throw new Exception("No de encontraron lapsos para los parámetros suministrados");
      }
    } catch (Exception $exc) {
      throw $exc;
    }
  }

  private function buscarFeriadosCercanos(int $idEstado, int $idMunicipio, $strfecha) {
    try {
      $fecha = $this->convertirStringDate($strfecha);
      $mes = date_format($fecha, 'm');
      $this->load->model('dao/FeriadoDAO');
      $fNacionales = $this->FeriadoDAO->getFeriadosNacionalesCercanos($mes);
      $fEspecificos = $this->FeriadoDAO->getFeriadosEspecificosCercanos($fecha);
      $fEstadales = $this->FeriadoDAO->getFeriadosEstadalesCercanos($idEstado, $mes);
      $fMunicipales = $this->FeriadoDAO->getFeriadosMunicipalesCercanos($idMunicipio, $mes);
      $feriados = array(
        'fEspecificos' => $fEspecificos,
        'fNacionales' => $fNacionales,
        'fEstadales' => $fEstadales,
        'fMunicipales' => $fMunicipales
      );
      return $feriados;
    } catch (Exception $exc) {
      throw $exc;
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
