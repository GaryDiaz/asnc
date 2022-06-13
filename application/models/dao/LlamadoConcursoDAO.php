<?php

/**
 * Description of LlamadoConcursoDAO
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */
class LlamadoConcursoDAO extends \CI_Model {
  const TB_NOMBRE = 'public.llamado_concurso';
  const VW_NOMBRE = 'public.llamado_concurso_view';

  public function buscar($rif, $numeroProceso) {
    $this->db->where('rif_organoente', $rif);
    $this->db->where('numero_proceso', $numeroProceso);
    $query = $this->db->get(self::VW_NOMBRE);
    return $query->row();
  }

  public function buscarTodos() {
    $query = $this->db->get(self::VW_NOMBRE);
    return $query->result();
  }

  public function buscarPorRIF($rif) {
    $query = $this->db->get_where(self::VW_NOMBRE, array('rif_organoente' => $rif));
    return $query->result();
  }

  public function buscarPorNumeroProceso($numeroProceso) {
    $query = $this->db->get_where(self::VW_NOMBRE, array('numero_proceso' => $numeroProceso));
    return $query->result();
  }

  public function buscarPorTextoRIF($textoABuscar, $rif) {
    $this->db->like('denominacion_proceso', $textoABuscar);
    $this->db->or_like('descripcion_contratacion', $textoABuscar);
    if ($rif) {
      $this->db->where('rif_organoente', $rif);
    }
    $query = $this->db->get(self::VW_NOMBRE);
    return $query->result();
  }

  public function buscarPorFecha($campoFecha, $desde, $hasta, $rif) {
    $this->db->where($campoFecha . '>=', $desde);
    $this->db->where($campoFecha . '<=', $hasta);
    if ($rif) {
      $this->db->where('rif_organoente', $rif);
    }
    $query = $this->db->get(self::VW_NOMBRE);
    return $query->result();
  }

  public function agregar($llamadoConcurso) {
    if ($this->buscar($llamadoConcurso['rif_organoente'], $llamadoConcurso['numero_proceso'])) {
      throw new \Exception('El número proceso ya exciste');
    } else {
      return $this->db->insert(self::TB_NOMBRE, $llamadoConcurso);
    }
  }

  public function editar($rif, $numero_proceso, $llc) {
    if ($this->buscar($rif, $numero_proceso)) {
      $this->db->set($llc);
      $this->db->where("rif_organoente", $rif);
      $this->db->where("numero_proceso", $numero_proceso);
      return $this->db->update(self::TB_NOMBRE);
    } else {
      throw new \Exception('El número proceso que intenta editar, ya no exciste');
    }
  }

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
        if ($dh === 3 && $fechaFinAclaratoria === null) {
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
