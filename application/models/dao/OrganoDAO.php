<?php
/**
 * @author Gary Diaz <garyking1982@gmail.com>
 */

class OrganoDAO extends \CI_Model{
    const TB_NOMBRE='public.organoente';


    /**
     * Lista todos los Organos en la Base de datos
     * @return type result con todos los Órganos
     */
    public function getOrganos() {
        $this->db->where('tipo_organoente<',2);
        $query=$this->db->get(self::TB_NOMBRE);
        return $query->result();
    }
    
    /**
     * Busca el Órgano mediante el id espeíficado
     * @param type $id
     * @return type row si encuentra alguna coincidencia
     */
    public function getOrganoEnte($id) {
        $query=$this->db->get_where(self::TB_NOMBRE, array('id_organoente'=>$id));
        return $query->row();
    }
    
    /**
     * Busca el Órgano mediante el RIF especificado
     * @param type $rif
     * @return type row si encuentra alguna coincidencia
     */
    public function buscarPorRif($rif) {
        $query=$this->db->get_where(self::TB_NOMBRE, array('rif'=>$rif));
        return $query->row();
    }
    
    public function buscarPorRifDetalle($rif) {
        $query=$this->db->get_where('public.organoente_view', array('rif'=>$rif));
        return $query->row();
    }
    
    public function getOrganosPorTipo($tipoOrganoEnte) {
        $this->db->where('tipo_organoente=', $tipoOrganoEnte);
        $query=$this->db->get(self::TB_NOMBRE);
        return $query->result();
    }
    
    public function editar($organoEnte) {
        $this->db->where('id_organoente =', $organoEnte['id_organoente']);
        return $this->db->update(self::TB_NOMBRE, $this->dataActilizable($organoEnte));
    }

    public function dataActilizable($oe) {
        return array(
            'id_organoenteads'=>$oe['id_organoenteads'],
            'tipo_organoente'=>$oe['tipo_organoente'],
            'descripcion'=>$oe['descripcion'],
            'cod_onapre'=>$oe['cod_onapre'],
            'id_estado'=>$oe['id_estado'],
            'id_municipio'=>$oe['id_municipio'],
            'id_parroquia'=>$oe['id_parroquia'],
            'siglas'=>$oe['siglas'],
            'direccion'=>$oe['direccion'],
            'gaceta'=>$oe['gaceta'],
            'fecha_gaceta'=>$oe['fecha_gaceta'],
            'pagina_web'=>$oe['pagina_web'],
            'correo'=>$oe['correo'],
            'tel1'=>$oe['tel1'],
            'tel2'=>$oe['tel2'],
            'movil1'=>$oe['movil1'],
            'movil2'=>$oe['movil2'],
            'movil2'=>$oe['movil2'],
        );
    }
}

