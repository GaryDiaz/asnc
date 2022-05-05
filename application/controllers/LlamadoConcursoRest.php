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
