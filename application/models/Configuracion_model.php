<?php
    class Configuracion_model extends CI_model{
        public function consulta_tipo_rif(){
            $this->db->select('*');
            $query = $this->db->get('tipo_rif');
            return $result = $query->result_array();
        }

        public function consulta_paises(){
            $this->db->select('*');
            $query = $this->db->get('public.paises');
             return $response = $query->result_array();
        }

        public function consulta_estados(){
            $this->db->select('*');
            $query = $this->db->get('public.estados');
             return $response = $query->result_array();
        }
        public function consulta_modalidad(){
            $this->db->select('*');
            $this->db->order_by('id asc');
            $query = $this->db->get('evaluacion_desempenio.modalidad');
             return $response = $query->result_array();
        }

        public function listar_municipio($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_estado']);
            $query = $this->db->get('public.municipios');
            $response = $query->result_array();
            return $response;
        }

        public function listar_ciudades($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_estado']);
            $query = $this->db->get('public.ciudades');
            $response = $query->result_array();
            return $response;
        }

        public function listar_parroquia($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_municipio']);
            $query = $this->db->get('public.parroquias');
            $response = $query->result_array();
            return $response;
        }

        public function consulta_edo_civil(){
            $this->db->select('*');
            $query = $this->db->get('public.edo_civil');
            return $response = $query->result_array();
        }


        // Organismo
        public function save_organismo($data){
            $this->db->select('codigo');
            $this->db->order_by('codigo desc');
            $query = $this->db->get('organos');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            $this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('organos');
            $response2 = $query2->row_array();

            if ($response2) {
                return 'false';
            }else {
                $data = array(
        			'id_organoads'		=> $data['id_organoads'],
                    'codigo'            => $codigo,
        			'desc_organo'		=> $data['desc_organo'],
        			'cod_onapre'	 	=> $data['cod_onapre'],
        			'siglas' 			=> $data['siglas'],
        			'tipo_rif'			=> $data['tipo_rif'],
        			'rif' 				=> $data['rif'],
        			'id_clasificacion' 	=> $data['id_clasificacion'],
        			'tel1' 		        => $data['tel_local'],
        			'tel2' 		        => $data['tel_local_2'],
        			'movil1'			=> $data['tel_movil'],
        			'movil2' 		    => $data['tel_movil_2'],
        			'pagina_web' 		=> $data['pag_web'],
        			'correo'			=> $data['email'],
        			'id_estado' 		=> $data['id_estado'],
        			'id_municipio' 		=> $data['id_municipio'],
        			'id_parroquia' 		=> $data['id_parroquia'],
        			'direccion_fiscal' 	=> $data['direccion_fiscal'],
        			'gaceta'	        => $data['gaceta_oficial'],
        			'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
        		);
                $this->db->insert("organos",$data); //colo nombre de la tabla
                return true;
            }
        }

        // ENTES
        public function consulta_organismo(){
            $this->db->select('id_organo, desc_organo');
            $query = $this->db->get('organos');
            return $result = $query->result_array();
        }

        public function save_ente($data){

            $this->db->select('codigo');
            $this->db->where('id_organo', $data['id_organo']);
            $this->db->order_by('codigo desc');
            $query = $this->db->get('organos');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            $this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('entes');
            $response2 = $query2->row_array();

            if ($response2) {
                return 'false';
            }else {
                $data = array(
        			'id_organo'		    => $data['id_organo'],
                    'codigo'            => $codigo,
        			'desc_entes'		=> $data['ente'],
        			'cod_onapre'	 	=> $data['cod_onapre'],
        			'siglas' 			=> $data['siglas'],
        			'tipo_rif'			=> $data['tipo_rif'],
        			'rif' 				=> $data['rif'],
        			'id_clasificacion' 	=> $data['id_clasificacion'],
        			'tel1' 		        => $data['tel_local'],
        			'tel2' 		        => $data['tel_local_2'],
        			'movil1'			=> $data['tel_movil'],
        			'movil2' 		    => $data['tel_movil_2'],
        			'pagina_web' 		=> $data['pag_web'],
        			'correo'			=> $data['email'],
        			'id_estado' 		=> $data['id_estado'],
        			'id_municipio' 		=> $data['id_municipio'],
        			'id_parroquia' 		=> $data['id_parroquia'],
        			'direccion_fiscal' 	=> $data['direccion_fiscal'],
        			'gaceta'	        => $data['gaceta_oficial'],
        			'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
        		);
                $this->db->insert("entes",$data); //colo nombre de la tabla
                return true;
            }
        }

        // ENTES ADSCRITOS
        public function consulta_entes(){
            $this->db->select('id_entes, desc_entes');
            $this->db->order_by('id_entes');
            $query = $this->db->get('entes');
            return $result = $query->result_array();
        }

        public function save_ente_adscrito($data){

            $this->db->select('codigo');
            $this->db->where('id_entes', $data['id_entes']);
            $this->db->order_by('codigo desc');
            $query = $this->db->get('entes');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            $this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('entes_ads');
            $response2 = $query2->row_array();

            if ($response2) {
                return 'false';
            }else {
                $data = array(
                    'id_entes'		    => $data['id_entes'],
                    'codigo'            => $codigo,
                    'desc_entes_ads'	=> $data['ente'],
                    'cod_onapre'	 	=> $data['cod_onapre'],
                    'siglas' 			=> $data['siglas'],
                    'tipo_rif'			=> $data['tipo_rif'],
                    'rif' 				=> $data['rif'],
                    'id_clasificacion' 	=> $data['id_clasificacion'],
                    'tel1' 		        => $data['tel_local'],
                    'tel2' 		        => $data['tel_local_2'],
                    'movil1'			=> $data['tel_movil'],
                    'movil2' 		    => $data['tel_movil_2'],
                    'pagina_web' 		=> $data['pag_web'],
                    'correo'			=> $data['email'],
                    'id_estado' 		=> $data['id_estado'],
                    'id_municipio' 		=> $data['id_municipio'],
                    'id_parroquia' 		=> $data['id_parroquia'],
                    'direccion_fiscal' 	=> $data['direccion_fiscal'],
                    'gaceta'	        => $data['gaceta_oficial'],
                    'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
                );
                $this->db->insert("entes_ads",$data); //colo nombre de la tabla
                return true;
            }
        }
    }
?>
