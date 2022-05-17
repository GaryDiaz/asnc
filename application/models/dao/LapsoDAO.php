<?php


/**
 * ActividadDAO
 *
 * Esta Clase realiza las consultas a las tablas relacionadas con con las actividades
 * tales como: modalidad, mecanismo y objeto_contrata (objeto de contratación)
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */

class LapsoDAO extends \CI_Model {
  const VW_LAPSO = "public.lapso_view";
  const TB_LAPSO = "public.lapso";
  const TB_MECANISMO = "public.mecanismo";
  const TB_MODALIDAD = "public.modalidad";
  const TB_OBJETO_CONTRATACION = "public.objeto_contratacion";

  //**************************************************************************
  //***                        ACTIVIDAD                                   ***
  //**************************************************************************

  public function lapsoAgregar($lapso) {
    if ($this->lapsoBuscar($lapso['id_modalidad'], $lapso['id_mecanismo'], $lapso['id_objeto_contratacion'])) {
      throw new Exception("La combinación de modalidad, mecanismo y objeto de contratación ya existe");
    } else {
      return $this->db->insert(self::TB_LAPSO, $lapso);
    }
  }

  public function lapsoBuscar($id_modalidad, $id_mecanismo, $id_oc) {
    $this->db->where('id_modalidad =', $id_modalidad);
    $this->db->where('id_mecanismo =', $id_mecanismo);
    $this->db->where('id_objeto_contratacion =', $id_oc);
    $query = $this->db->get(self::TB_LAPSO);
    return $query->row();
  }

  public function lapsoEditar($lapso) {
    if ($this->lapsoBuscar($lapso['id_modalidad'], $lapso['id_mecanismo'], $lapso['id_objeto_contratacion'])) {
      $data = array('dias_habiles' => $lapso['dias_habiles']);
      $this->db->where('id_modalidad = ', $lapso['id_modalidad']);
      $this->db->where('id_mecanismo = ', $lapso['id_mecanismo']);
      $this->db->where('id_objeto_contratacion = ', $lapso['id_objeto_contratacion']);
      return $this->db->update(self::TB_LAPSO, $data);
    } else {
      throw new Exception("El lapso que intenta editar no existe");
    }
  }

  public function lapsoEliminar($id_modalidad, $id_mecanismo, $id_oc) {
    if ($this->lapsoBuscar($id_modalidad, $id_mecanismo, $id_oc)) {
      $this->db->where('id_modalidad = ', $id_modalidad);
      $this->db->where('id_mecanismo = ', $id_mecanismo);
      $this->db->where('id_objeto_contratacion = ', $id_oc);
      return $this->db->delete(self::TB_LAPSO);
    } else {
      throw new Exception("El lapso que intenta eliminar no existe");
    }
  }

  public function lapsoListar() {
    $query = $this->db->get(self::VW_LAPSO);
    return $query->result();
  }

  //**************************************************************************
  //***                        MECANISMO                                   ***
  //**************************************************************************

  /**
   * Insert para la tabla public.mecanismo
   * @param type $descripcion
   * @return type
   */
  public function mecanismoAgregar($descripcion) {
    $id = $this->siguienteId(self::TB_MECANISMO, 'id_mecanismo');
    $data = array('id_mecanismo' => $id, 'descripcion' => $descripcion);
    if ($this->db->insert(self::TB_MECANISMO, $data)) {
      return $this->mecanismoBuscar($id);
    } else {
      return 0;
    }
  }

  /**
   * Busca un registro único de mecanismo a partir del id
   * @param type $idMecanismo
   * @return type
   */
  public function mecanismoBuscar($idMecanismo) {
    $query = $this->db->get_where(self::TB_MECANISMO, array('id_mecanismo' => $idMecanismo));
    return $query->row();
  }
  /**
   * Editar la descripcion de un mecanismo
   * @param type $mecanismo
   * @return type
   * @throws Exception si no existe
   */
  public function mecanismoEditar($mecanismo) {
    if ($this->mecanismoBuscar($mecanismo['id_mecanismo'])) {
      $data = array('descripcion' => $mecanismo['descripcion']);
      $this->db->where('id_mecanismo = ', $mecanismo['id_mecanismo']);
      return $this->db->update(self::TB_MECANISMO, $data);
    } else {
      throw new Exception("La mecanismo que intenta editar no existe");
    }
  }
  /**
   * Elimina un mecanismo
   * @param type $id_mecanismo
   * @return type
   * @throws Exception si no existe
   */
  public function mecanismoEliminar($id_mecanismo) {
    if ($this->mecanismoBuscar($id_mecanismo)) {
      $this->db->where('id_mecanismo = ', $id_mecanismo);
      return $this->db->delete(self::TB_MECANISMO);
    } else {
      throw new Exception("La mecanismo que intenta eliminar no existe");
    }
  }
  /**
   * Devuelve una lista de todos los registro de la tabla mecanismo
   * @param type $id_mecanismo
   * @return type
   */
  public function mecanismoListar() {
    $query = $this->db->get(self::TB_MECANISMO);
    return $query->result();
  }

  //**************************************************************************
  //***                        MODALIDAD                                   ***
  //**************************************************************************
  /**
   * Inserta un registro en la tabla public.modalidad
   * @param type $descripcion
   * @return type
   */
  public function modalidadAgregar($descripcion) {
    $id = $this->siguienteId(self::TB_MODALIDAD, 'id_modalidad');
    $data = array('id_modalidad' => $id, 'descripcion' => $descripcion);
    if ($this->db->insert(self::TB_MODALIDAD, $data)) {
      return $this->modalidadBuscar($id);
    } else {
      return 0;
    }
  }
  /**
   * Busca un registro único en la tabla public.modalidad
   * @param type $idModalidad
   * @return type
   */
  public function modalidadBuscar($idModalidad) {
    $query = $this->db->get_where(self::TB_MODALIDAD, array('id_modalidad' => $idModalidad));
    return $query->row();
  }
  /**
   * Edita la descripción de un registro en public.modalidad
   * @param type $modalidad
   * @return type
   * @throws Exception si no existe
   */
  public function modalidadEditar($modalidad) {
    if ($this->modalidadBuscar($modalidad['id_modalidad'])) {
      $data = array('descripcion' => $modalidad['descripcion']);
      $this->db->where('id_modalidad = ', $modalidad['id_modalidad']);
      return $this->db->update(self::TB_MODALIDAD, $data);
    } else {
      throw new Exception("La modalidad que intenta editar no existe");
    }
  }
  /**
   * Elimina un registro en la tabla public.modalidad
   * @param type $id_modalidad
   * @return type
   * @throws Exception si no existe
   */
  public function modalidadEliminar($id_modalidad) {
    if ($this->modalidadBuscar($id_modalidad)) {
      $this->db->where('id_modalidad = ', $id_modalidad);
      return $this->db->delete(self::TB_MODALIDAD);
    } else {
      throw new Exception("La modalidad que intenta eliminar no existe");
    }
  }
  /**
   * Lista todas las modalidades de la tabla public.modalidad
   * @return type
   */
  public function modalidadListar() {
    $this->db->order_by('id_modalidad', 'ASC');
    $query = $this->db->get(self::TB_MODALIDAD);
    return $query->result();
  }

  //**************************************************************************
  //***                 OBJETO DE CONTRATACIÓN                             ***
  //**************************************************************************
  /**
   * Agregar un registro en la tabla public.objeto_contratacion
   * @param type $descripcion
   * @return type
   */
  public function objetoContratacionAgregar($descripcion) {
    $id = $this->siguienteId(self::TB_OBJETO_CONTRATACION, 'id_objeto_contratacion');
    $data = array('id_objeto_contratacion' => $id, 'descripcion' => $descripcion);
    if ($this->db->insert(self::TB_OBJETO_CONTRATACION, $data)) {
      return $this->objetoContratacionBuscar($id);
    } else {
      return 0;
    }
  }
  /**
   * Busca un registro único en la tabla public.objeto_contratacion
   * @param type $idOC
   * @return type
   */
  public function objetoContratacionBuscar($idOC) {
    $query = $this->db->get_where(self::TB_OBJETO_CONTRATACION, array('id_objeto_contratacion' => $idOC));
    return $query->row();
  }
  /**
   * Edita la descripción de un objeto de contratación
   * @param type $objetoContracion
   * @return type
   * @throws Exception si no existe
   */
  public function objetoContratacionEditar($objetoContracion) {
    if ($this->objetoContratacionBuscar($objetoContracion['id_objeto_contratacion'])) {
      $data = array('descripcion' => $objetoContracion['descripcion']);
      $this->db->where('id_objeto_contratacion = ', $objetoContracion['id_objeto_contratacion']);
      return $this->db->update(self::TB_OBJETO_CONTRATACION, $data);
    } else {
      throw new Exception("El objeto de contratación que intenta editar no existe");
    }
  }
  /**
   * Elimina un registro en la tabla public.objeto_contratacion
   * @param type $id_objeto_contratacion
   * @return type
   * @throws Exception
   */
  public function objetoContratacionEliminar($id_objeto_contratacion) {
    if ($this->objetoContratacionBuscar($id_objeto_contratacion)) {
      $this->db->where('id_objeto_contratacion = ', $id_objeto_contratacion);
      return $this->db->delete(self::TB_OBJETO_CONTRATACION);
    } else {
      throw new Exception("El objeto de contratación que intenta eliminar no existe");
    }
  }
  /**
   * Devuelve todos los registros de la tabla public.objeto_contratacion
   * @return type
   */
  public function objetoContratacionListar() {
    $query = $this->db->get(self::TB_OBJETO_CONTRATACION);
    return $query->result();
  }

  //**************************************************************************
  //***                           Siguiente Id                             ***
  //**************************************************************************
  /**
   * Función devuelve el siguiente id de la tabla según el último id registrado
   * 
   * @param type $tabla nombre de la tabla en la DDBB
   * @param type $campoId nombre del campo id
   * @return int es el valor de siguiente id
   */
  private function siguienteId($tabla, $campoId) {
    $this->db->select($campoId);
    $this->db->order_by($campoId, 'DESC');
    $this->db->limit(1);
    $row = $this->db->get($tabla)->row_array();

    if ($row) {
      return $row[$campoId] + 1;
    } else {
      return 1;
    }
  }
}
