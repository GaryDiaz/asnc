<?php

/**
 * Descripcion de la Clase DireccionDAO
 *
 * Esta clase realiza las consultas a la tablas de la base de datos relacionadas
 * con la Dirección
 *
 * @author Gary Diaz <garyking1982@gmail.com>
 */
class DireccionDAO extends \CI_Model  {

    /**
     * Lista la tabla Estados
     * @return array de la tabla
     */
    public function getEstados() {
        $query=$this->db->get('public.estados');
        return $query->result();
    }
    /**
     * Devuelve el estado con el id consultado
     * @param type $id del Estado a consultar
     */
    public function getEstado($id) {
        $query=$this->db->get_where('public.estados', array('id'=>$id));
        return $query->row();
    }

    /**
     * Lista todos los Municipios que pertenecen al Estado
     * @param type $idEstado
     */
    public function getMunicipios($idEstado) {
        $query=$this->db->get_where('public.municipios', array('estado_id'=>$idEstado));
        return $query->result();
    }

    /**
     * Lista todos los Municipios que pertenecen al Estado
     * @param type $id
     */
    public function getMunicipio($id) {
        $query=$this->db->get_where('public.municipios', array('id'=>$id));
        return $query->result();
    }

    public function getParroquias($idEstado) {
        $query=$this->db->get_where('public.parroquias', array('estado_id'=>$idEstado));
        return $query->result();
    }

    public function getParroquia($id) {
        $query=$this->db->get_where('public.parroquias', array('id'=>$id));
        return $query->result();
    }
}
