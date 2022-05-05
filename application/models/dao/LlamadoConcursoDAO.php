<?php

/**
 * Description of LlamadoConcursoDAO
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */
class LlamadoConcursoDAO extends \CI_Model {
  public function calcularLapsos($fechaLlamado, int $diasHabiles, array $feriados) {
    $fechaDisponibleLlamado = null;
    $fechaFinAclaratoria = null;
    $fechaTope = null;
    $fechaFinLlamado = null;
    $fechaAux = $this->diaSiguiente($fechaLlamado);
    for ($dh = 1; $dh <= $diasHabiles;) {
      if (!$this->esFinDeSemana($fechaAux) && !$this->esFeriado($fechaAux, $feriados)) {
        if ($dh === 1 &&  $fechaDisponibleLlamado === null) {
          $fechaDisponibleLlamado = $fechaAux;
        }
        if ($dh === 2 && $fechaFinAclaratoria === null) {
          $fechaFinAclaratoria = $fechaAux;
        }
        if ($dh === $diasHabiles - 1 && $fechaTope === null) {
          $fechaTope = $fechaAux;
        }
        if ($dh === $diasHabiles && $fechaFinLlamado === null) {
          $fechaFinLlamado = $fechaAux;
        }
        $fechaAux = $this->diaSiguiente($fechaAux);
        $dh++;
      } else {
        $fechaAux = $this->diaSiguiente($fechaAux);
      }
    }
    $fechasLapsos = array(
      'dias_habiles' => $diasHabiles,
      'fecha_llamado' => $fechaLlamado,
      'fecha_disponible_llamado' => $fechaDisponibleLlamado,
      'fecha_fin_aclaratoria' => $fechaFinAclaratoria,
      'fecha_tope' => $fechaTope,
      'fecha_fin_llamado' => $fechaFinLlamado,
    );
    return $fechasLapsos;
  }

  public function recalcularLapsos($fechaLlamado, $fechaFinLlamado, array $feriados) {
    $fechaTope = null;
    $diasHabiles = null;
    $fechaAux = $this->diaSiguiente($fechaLlamado);
    for ($diasHabiles = 1; $fechaAux !== $fechaFinLlamado;) {
      if (!$this->esFinDeSemana($fechaAux) && !$this->esFeriado($fechaAux, $feriados)) {
        $fechaTope = $fechaAux;
        $fechaAux = $this->diaSiguiente($fechaAux);
        $diasHabiles++;
      } else {
        $fechaAux = $this->diaSiguiente($fechaAux);
      }
    }
    $fechasLapsos = array(
      'dias_habiles' => $diasHabiles,
      'fecha_tope' => $fechaTope,
    );
    return $fechasLapsos;
  }

  private function diaSiguiente($strfecha) {
    $arrFecha = explode('-', $strfecha);
    $fechaInt = mktime(0, 0, 0, intval($arrFecha[1]), intval($arrFecha[2]) + 1, intval($arrFecha[0]));
    return date('Y-m-d', $fechaInt);
  }

  private function esFinDeSemana($strfecha) {
    $fecha = DateTime::createFromFormat('Y-m-d', $strfecha);
    $diaDeSemana = $fecha->format('w');
    return ($diaDeSemana == 0 || $diaDeSemana == 6) ? true : false;
  }

  private function esFeriado($strfecha, $feriados) {
    $fecha = DateTime::createFromFormat('Y-m-d', $strfecha);
    $dia = $fecha->format('j');
    $mes = $fecha->format('n');
    $ok = false;
    foreach ($feriados['fEspecificos'] as $fEspecificos) {
      if ($strfecha == $fEspecificos->fecha) {
        $ok = true;
        break;
      }
    }
    foreach ($feriados['fNacionales'] as $fNacional) {
      if ($dia == $fNacional->dia && $mes == $fNacional->mes) {
        $ok = true;
        break;
      }
    }
    if (!$ok) {
      foreach ($feriados['fEstadales'] as $fEstadal) {
        if ($dia == $fEstadal->dia && $mes == $fEstadal->mes) {
          $ok = true;
          break;
        }
      }
    }
    if (!$ok) {
      foreach ($feriados['fMunicipales'] as $fMunicipal) {
        if ($dia == $fMunicipal->dia && $mes == $fMunicipal->mes) {
          $ok = true;
          break;
        }
      }
    }
    return $ok;
  }
}
