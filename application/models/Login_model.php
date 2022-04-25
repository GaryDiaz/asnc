<?php

class Login_model extends CI_model {

    public function iniciar($usuario, $contrasena) {
        $this->db->select('*');
        $this->db->where('nombre', $usuario);
        $this->db->from('seguridad.usuarios');
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
            $id_estatus = $result->row('id_estatus');
            if ($id_estatus == 1) {
                $db_clave = $result->row('password');
                $unidad = $result->row('unidad');
                if (password_verify(base64_encode(hash('sha256', $contrasena, true)), $db_clave)) {
                    return $result->row_array();
                } else {
                    $intento = $result->row('intentos');
                    if ($intento <= 1) {
                        $intento = $intento + 1;
                        $this->db->set('intentos', $intento);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    } else {
                        $this->db->set('id_estatus', 4);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    }
                }
            } else {
                return 'BLOQUEADO';
            }
        } else {
            return 'FALSE';
        }
    }

    public function consultar_organo($id_unidad) {
        $this->db->select('o.id_organo,
                               o.codigo,
                               o.cod_onapre,
                               concat(tr.desc_rif, \' - \' ,o.rif) as rif,
                               o.desc_organo');
        $this->db->join('tipo_rif tr', 'tr.id_rif = o.tipo_rif');
        $this->db->where('o.codigo', $id_unidad);
        $this->db->from('organos o');
        $result = $this->db->get();

        if ($result->num_rows() != 1) {
            $this->db->select('e.id_organo,
                                   e.id_entes,
                                   e.codigo,
                            	   e.rif,
                            	   e.desc_entes as desc_organo,
                            	   e.cod_onapre,
                            	   e.siglas,
                            	   e.direccion_fiscal');
            $this->db->where('e.codigo', $id_unidad);
            $this->db->from('entes e');
            $result = $this->db->get();

            if ($result->num_rows() != 1) {
                $this->db->select('ea.id_entes,
                                       ea.id_entes_ads,
                                       ea.codigo,
                                       ea.rif,
                                       ea.desc_entes_ads as desc_organo,
                                       ea.cod_onapre,
                                       ea.siglas,
                                       ea.direccion_fiscal');
                $this->db->where('ea.codigo', $id_unidad);
                $this->db->from('entes_ads ea');
                $result = $this->db->get();
                return $result->row_array();
            } else {
                return $result->row_array();
            }
        } else {
            return $result->row_array();
        }
    }

    public function cambiar_clave($id_usuario, $data) {
        $this->db->where('id', $id_usuario);
        $update = $this->db->update('seguridad.usuarios', $data);
        return $update;
    }

}

?>
