<?php

/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */

class FeriadoDAO extends \CI_Model {

  //**************************************************************************
  //********  Funciones de la tabla public.feriado_especifico
  //**************************************************************************

  public function agregarFeriadoEspecifico($feriadoEspecifico) {
    if ($this->buscarFeriadoEspecifico($feriadoEspecifico['fecha'])) {
      throw new Exception("Ya existe, un feriado especifico en esa fecha, si son distintos agréguelo a la descripción del que ya existe");
    } else {
      return $this->db->insert('public.feriado_especifico', $feriadoEspecifico);
    }
  }

  public function buscarFeriadoEspecifico($fecha) {
    $this->db->where('fecha =', $fecha);
    $query = $this->db->get('public.feriado_especifico');
    return $query->row();
  }

  public function buscarFeriadosEspecificos(string $descripcion) {
    $this->db->like('descripcion', $descripcion);
    $this->db->order_by('fecha');
    $query = $this->db->get('public.feriado_especifico');
    return $query->result();
  }

  public function buscarFeriadosEspecificos2(string $descripcion, $anio) {
    $this->db->like('descripcion', $descripcion);
    $this->db->where('extract (year from fecha)=', $anio);
    $this->db->order_by('fecha');
    $query = $this->db->get('public.feriado_especifico');
    return $query->result();
  }

  public function editarFeriadoEspecifico($feriadoEspecifico) {
    if ($this->buscarFeriadoEspecifico($feriadoEspecifico['fecha'])) {
      $data = array('descripcion' => $feriadoEspecifico['descripcion']);
      $this->db->where('fecha', $feriadoEspecifico['fecha']);
      return $this->db->update('public.feriado_especifico', $data);
    } else {
      throw new Exception("El feriado que intenta editar no existe");
    }
  }

  public function eliminarFeriadoEspecifico($fecha) {
    $fn = $this->buscarFeriadoEspecifico($fecha);
    if ($fn) {
      $this->db->where('fecha', $fecha);
      return $this->db->delete('public.feriado_especifico');
    } else {
      throw new Exception("El feriado que intenta eliminar no existe");
    }
  }

  public function getFeriadosEspecificos() {
    $this->db->order_by('fecha');
    $query = $this->db->get('public.feriado_especifico');
    return $query->result();
  }

  public function getFeriadosEspecificosCercanos($fecha) {
    $mes = date_format($fecha, 'm');
    $anio = date_format($fecha, 'Y');
    $this->db->where('extract (year from fecha)=', $anio);
    $this->db->where_in('extract (month from fecha)', array($mes, $mes + 1));
    $query = $this->db->get('public.feriado_especifico');
    return $query->result();
  }

  public function getFeriadosEspecificosPorAnio($anio) {
    $this->db->where('extract (year from fecha)=', $anio);
    $query = $this->db->get('public.feriado_especifico');
    return $query->result();
  }

  //**************************************************************************
  //********  Funciones de la tabla public.feriado_nacional
  //**************************************************************************

  public function agregarFeriadoNacional($feriadoNacional) {
    if ($this->buscarFeriadoNacional($feriadoNacional['mes'], $feriadoNacional['dia'])) {
      throw new Exception("Ya existe, un feriado nacional en esa fecha, si son distintos agréguelo a la descripción del que ya existe");
    } else {
      return $this->db->insert('public.feriado_nacional', $feriadoNacional);
    }
  }

  public function buscarFeriadoNacional($mes, $dia) {
    $this->db->where('mes=', $mes);
    $this->db->where('dia=', $dia);
    $query = $this->db->get('public.feriado_nacional');
    return $query->row();
  }

  public function buscarFeriadosNacionales(string $descripcion) {
    $this->db->like('descripcion', $descripcion);
    $this->db->order_by('mes ASC, dia ASC');
    $query = $this->db->get('public.feriado_nacional');
    return $query->result();
  }

  public function editarFeriadoNacional($feriadoNacional) {
    if ($this->buscarFeriadoNacional($feriadoNacional['mes'], $feriadoNacional['dia'])) {
      $data = array('descripcion' => $feriadoNacional['descripcion']);
      $this->db->where('mes', $feriadoNacional['mes']);
      $this->db->where('dia', $feriadoNacional['dia']);
      return $this->db->update('public.feriado_nacional', $data);
    } else {
      throw new Exception("El feriado que intenta editar no existe");
    }
  }

  public function eliminarFeriadoNacional($mes, $dia) {
    $fn = $this->buscarFeriadoNacional($mes, $dia);
    if ($fn) {
      $this->db->where('mes', $mes);
      $this->db->where('dia', $dia);
      return $this->db->delete('public.feriado_nacional');
    } else {
      throw new Exception("El feriado que intenta eliminar no existe");
    }
  }

  public function getFeriadosNacionales() {
    $this->db->order_by('mes ASC, dia ASC');
    $query = $this->db->get('public.feriado_nacional');
    return $query->result();
  }

  public function getFeriadosNacionalesCercanos($mes) {
    $this->db->select();
    $this->db->from('public.feriado_nacional');
    $this->db->where_in('mes', array($mes, $mes + 1));
    $query = $this->db->get();
    return $query->result();
  }

  //**************************************************************************
  //********  Funciones de la tabla public.feriado_estadal
  //**************************************************************************

  public function agregarFeriadoEstadal($feriadoEstadal) {
    if ($this->buscarFeriadoEstadal($feriadoEstadal['id_estado'], $feriadoEstadal['mes'], $feriadoEstadal['dia'])) {
      throw new Exception("Ya existe, un feriado estadal en esa fecha, si son distintos agréguelo a la descripción del que ya existe");
    } else {
      return $this->db->insert('public.feriado_estadal', $feriadoEstadal);
    }
  }

  public function buscarFeriadoEstadal($id_estado, $mes, $dia) {
    $this->db->where('id_estado=', $id_estado);
    $this->db->where('mes=', $mes);
    $this->db->where('dia=', $dia);
    $query = $this->db->get('public.feriado_estadal_view');
    return $query->row();
  }

  public function buscarFeriadosEstadales($id_estado, string $descripcion) {
    $this->db->where('id_estado', $id_estado);
    $this->db->like('descripcion', $descripcion);
    $this->db->order_by('mes ASC, dia ASC');
    $query = $this->db->get('public.feriado_estadal_view');
    return $query->result();
  }

  public function editarFeriadoEstadal($feriadoEstadal) {
    if ($this->buscarFeriadoEstadal($feriadoEstadal['id_estado'], $feriadoEstadal['mes'], $feriadoEstadal['dia'])) {
      $data = array('descripcion' => $feriadoEstadal['descripcion']);
      $this->db->where('id_estado', $feriadoEstadal['id_estado']);
      $this->db->where('mes', $feriadoEstadal['mes']);
      $this->db->where('dia', $feriadoEstadal['dia']);
      return $this->db->update('public.feriado_estadal', $data);
    } else {
      throw new Exception("El feriado que intenta editar no existe");
    }
  }

  public function eliminarFeriadoEstadal($id_estado, $mes, $dia) {
    if ($this->buscarFeriadoEstadal($id_estado, $mes, $dia)) {
      $this->db->where('id_estado', $id_estado);
      $this->db->where('mes', $mes);
      $this->db->where('dia', $dia);
      return $this->db->delete('public.feriado_estadal');
    } else {
      throw new Exception("El feriado que intenta eliminar no existe");
    }
  }

  public function getFeriadosEstadales($idEstado) {
    $query = $this->db->get_where('public.feriado_estadal_view', array('id_estado' => $idEstado));
    return $query->result();
  }

  public function getFeriadosEstadalesCercanos($idEstado, $mes) {
    $this->db->select();
    $this->db->from('public.feriado_estadal_view');
    $this->db->where('id_estado =', $idEstado);
    $this->db->where_in('mes', array($mes, $mes + 1));
    $query = $this->db->get();
    return $query->result();
  }

  //**************************************************************************
  //********  Funciones de la tabla public.feriado_municipal
  //**************************************************************************

  public function agregarFeriadoMunicipal($feriadoMunicipal) {
    if ($this->buscarFeriadoMunicipal($feriadoMunicipal['id_municipio'], $feriadoMunicipal['mes'], $feriadoMunicipal['dia'])) {
      throw new Exception("Ya existe, un feriado municipal en esa fecha, si son distintos agréguelo a la descripción del que ya existe");
    } else {
      return $this->db->insert('public.feriado_municipal', $feriadoMunicipal);
    }
  }

  public function buscarFeriadoMunicipal($id_municipio, $mes, $dia) {
    $this->db->where('id_municipio', $id_municipio);
    $this->db->where('mes=', $mes);
    $this->db->where('dia=', $dia);
    $query = $this->db->get('public.feriado_municipal_view');
    return $query->row();
  }

  public function buscarFeriadosMunicipales($id_municipio, string $descripcion) {
    $this->db->where('id_municipio', $id_municipio);
    $this->db->like('descripcion', $descripcion);
    $this->db->order_by('mes ASC, dia ASC');
    $query = $this->db->get('public.feriado_municipal_view');
    return $query->result();
  }

  public function editarFeriadoMunicipal($feriadoMunicipal) {
    if ($this->buscarFeriadoMunicipal($feriadoMunicipal['id_municipio'], $feriadoMunicipal['mes'], $feriadoMunicipal['dia'])) {
      $data = array('descripcion' => $feriadoMunicipal['descripcion']);
      $this->db->where('id_municipio', $feriadoMunicipal['id_municipio']);
      $this->db->where('mes', $feriadoMunicipal['mes']);
      $this->db->where('dia', $feriadoMunicipal['dia']);
      return $this->db->update('public.feriado_municipal', $data);
    } else {
      throw new Exception("El feriado que intenta editar no existe");
    }
  }

  public function eliminarFeriadoMunicipal($id_municipio, $mes, $dia) {
    if ($this->buscarFeriadoMunicipal($id_municipio, $mes, $dia)) {
      $this->db->where('id_municipio', $id_municipio);
      $this->db->where('mes', $mes);
      $this->db->where('dia', $dia);
      return $this->db->delete('public.feriado_municipal');
    } else {
      throw new Exception("El feriado que intenta eliminar no existe");
    }
  }

  public function getFeriadosMunicipales($idMunicipio) {
    $query = $this->db->get_where('public.feriado_municipal_view', array('id_municipio' => $idMunicipio));
    return $query->result();
  }

  public function getFeriadosMunicipalesCercanos($idMunicipio, $mes) {
    $this->db->select();
    $this->db->from('public.feriado_municipal_view');
    $this->db->where('id_municipio=', $idMunicipio);
    $this->db->where_in('mes', array($mes, $mes + 1));
    $query = $this->db->get();
    return $query->result();
  }
}
