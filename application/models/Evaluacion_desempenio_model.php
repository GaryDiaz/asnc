<?php
    class Evaluacion_desempenio_model extends CI_model{

        public function __construct(){
            parent::__construct();
            // Este metodo conecta a nuestra segunda conexión
            // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
            $this->db_c = $this->load->database('SNCenlinea', true);
        }

        public function consulta_operadora(){
            $this->db->select('*');
            $query = $this->db->get('public.operadora');
            return $response = $query->result_array();
        }
//-------------------------------------------------------
        public function consulta_med_notf(){
            $this->db->select('*');
            $query = $this->db->get('public.medio_notf');
            return $response = $query->result_array();
        }
//-------------------------------------------------------
        public function llenar_contratista($data){
            $this->db_c->select('c.user_id,
                                c.edocontratista_id,
                                c.rifced,
                                c.nombre,
                                c.dirfiscal,
                                e.descedo,
                                c.ciudade_id,
                                c2.descciu,
                                m.descmun,
                                c.percontacto,
                                c.telf1,
                                c.ultprocaprob');
            $this->db_c->join('public.estados e', 'e.id = c.estado_id');
            $this->db_c->join('public.municipios m', 'm.id = c.municipio_id');
            $this->db_c->join('public.ciudades c2', 'c2.id = c.ciudade_id');
            $this->db_c->where('c.rifced',$data['rif_b']);
            $query = $this->db_c->get('public.contratistas c');
            $result = $query->row_array();
                if ($result == '') {
                    $this->db->select('c.user_id,
                                	     c.edocontratista_id,
                                	     c.rifced,
                                	     c.nombre,
                                	     c.dirfiscal,
                                	     e.descedo,
                                	     m.descmun,
                                	     c.percontacto,
                                	     c.telf1,
                                         c.procactual');
                    $this->db->join('public.estados e', 'e.id = c.estado_id');
                    $this->db->join('public.municipios m', 'm.id = c.municipio_id');
                    $this->db->where('c.rifced',$data['rif_b']);
                    $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
                    return $result = $query->row_array();
                }else {
                    return $result;
                }
        }
//-------------------------------------------------------
        public function llenar_contratista_rp($data){
            $this->db_c->select('proceso_id,
                        	   cedrif,
                               concat(nomacc, \'\' ,apeacc) as repr,
                        	   cargo ');
            $this->db_c->where('proceso_id', $data['ultprocaprob']);
            $query = $this->db_c->get('public.accionistas');
            $result = $query->result_array();

            if ($result == Array ()) {
                $this->db->select('cedrif,
                                   concat(nomacc, \'\' ,apeacc) as repr,
                            	   cargo ');
                $this->db->where('rif_contratista', $data['rif_cont_nr']);
                $query = $this->db->get('evaluacion_desempenio.accionistas_nr');

                return $result = $query->result_array();
            }else {
                return $result;
            }
        }
//-------------------------------------------------------
        public function consulta_modalidades(){
            $this->db->select('*');
            $query = $this->db->get('evaluacion_desempenio.modalidad');
            return $result = $query->result_array();
        }
//-------------------------------------------------------
        public function llenar_sub_modalidad($data){
            $this->db->select('*');
            $this->db->where('id_modalidad', $data['id_modalidad']);
            $query = $this->db->get('evaluacion_desempenio.sub_modalidad');
            return $result = $query->result_array();
        }
//-------------------------------------------------------
        public function registrar($exitte,$data,$data_ev,$data_repr_legal){
            $existe = $exitte;
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->row_array();
            if ($response){
                $id = $response['id'] + 1 ;
                $data_eval = array(
                    'id' 		        => $id,
                    'rif_contrat' 		 => $data_ev['rif_contrat'],
        			'id_modalidad' 		 => $data_ev['id_modalidad'],
        			'id_sub_modalidad' 	 => $data_ev['id_sub_modalidad'],
        			'fec_inicio_cont' 	 => $data_ev['fec_inicio_cont'],
        			'fec_fin_cont' 		 => $data_ev['fec_fin_cont'],
        			'nro_procedimiento'  => $data_ev['nro_procedimiento'],
        			'nro_contrato' 		 => $data_ev['nro_contrato'],
        			'id_estado_contrato' => $data_ev['id_estado_contrato'],
        			'bienes' 			 => $data_ev['bienes'],
        			'servicios' 		 => $data_ev['servicios'],
        			'obras' 			 => $data_ev['obras'],
        			'descr_contrato' 	 => $data_ev['descr_contrato'],
        			'monto' 			 => $data_ev['monto'],
        			'dolar' 			 => $data_ev['dolar'],
        			'euro' 				 => $data_ev['euro'],
        			'petros' 			 => $data_ev['petros'],
        			'bolivares' 		 => $data_ev['bolivares'],
        			'calidad' 			 => $data_ev['calidad'],
        			'responsabilidad' 	 => $data_ev['responsabilidad'],
        			'conocimiento' 		 => $data_ev['conocimiento'],
        			'oportunidad' 		 => $data_ev['oportunidad'],
        			'total_calif' 		 => $data_ev['total_calif'],
        			'calificacion' 		 => $data_ev['calificacion'],
                    'notf_cont' 		 => $data_ev['notf_cont'],
        			'fecha_not' 		 => $data_ev['fecha_not'],
        			'medio' 			 => $data_ev['medio'],
        			'nro_oc_os' 		 => $data_ev['nro_oc_os'],
        		 	'fileimagen' 		 => $data_ev['fileimagen'],
        			'id_usuario' 		 => $data_ev['id_usuario'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'mod_otro'           => $data_ev['mod_otro'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'otro'               => $data_ev['otro'],
                );
                $quers =$this->db->insert('evaluacion_desempenio.evaluacion', $data_eval);

                // if ($quers2) {
                //     $this->db->select('max(e.id) as id');
                //     $query = $this->db->get('evaluacion_desempenio.evaluacion e');
                //     $response2 = $query->row_array();
                //     return $response2;
                // }

                if ($existe == 0){
                    $quers1 = $this->db->insert('evaluacion_desempenio.contratistas_nr',$data);
                    $quers2 = $this->db->insert('evaluacion_desempenio.accionistas_nr',$data_repr_legal);
                    return $id;
                }
                return $id;
            }
        }
//-------------------------------------------------------
        // public function consulta_eval_not($usuario){
        //     $this->db->select('ed.id,
        //                     	 ed.rif_contrat,
        //                     	 concat(cn.nombre,\'\',c.nombre ) as nombre,
        //                          ed.calificacion
        //                        ');
        //     $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
        //     $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
        //     $this->db->where('ed.id_usuario', $usuario);
        //     $this->db->where('id_estatus', 1);
        //     $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
        //     return $response = $query->result_array();
        // }
//-------------------------------------------------------
        //Registrar notificacion
        public function registrar_not($data){
            $id_evaluacion = $data['id_evaluacion'];
            $separar        = explode('"', $id_evaluacion);
            //print_r($separar);die;
            $id_evaluacion = $separar['3'];

            $data_reg = array(
                        'id_evaluacion' => $id_evaluacion,
                        'medio' => $data['medio'],
                        'nro_not' => $data['nro_not'],
                        'correo' => $data['correo'],
                        'fileimagen' => $data['fileimagen'],
                        'id_usuario' => $data['id_usuario'],
            );
            $quers =$this->db->insert('evaluacion_desempenio.not_evaluacion', $data_reg);
            if ($quers){
                $data1 = array('id_estatus' => $data['id_estatus']);
                $this->db->where('id', $id_evaluacion);
                $update = $this->db->update('evaluacion_desempenio.evaluacion', $data1);
                return true;
            }
            return true;
        }
//-------------------------------------------------------
        // public function registrar_not_2($data){
        //     $id_evaluacion = $data['id_evaluacion'];
        //
        //     $data_reg = array(
        //                 'id_evaluacion' => $id_evaluacion,
        //                 'medio' => $data['medio'],
        //                 'nro_not' => $data['nro_not'],
        //                 'correo' => $data['correo'],
        //                 'fileimagen' => $data['fileimagen'],
        //                 'id_usuario' => $data['id_usuario'],
        //     );
        //     $quers =$this->db->insert('evaluacion_desempenio.not_evaluacion', $data_reg);
        //
        //     if ($quers){
        //         $data1 = array('id_estatus' => $data['id_estatus']);
        //         $this->db->where('id', $id_evaluacion);
        //         $update = $this->db->update('evaluacion_desempenio.evaluacion', $data1);
        //         return true;
        //     }
        //
        //     return true;
        // }
//-------------------------------------------------------
        // Reporte de Evaluacion de Desempeño por Usuario
        public function consulta_eval($usuario){
            // $this->db->select('ed.id,
            //                    ed.rif_contrat,
            //                    DATE_FORMAT(21/21/2221,'%Y-%m') as fecha,
            //                    concat(cn.nombre,\'\',c.nombre ) as nombre,
            //                    ed.calificacion,
            //                    e.descripcion
            // ');
            // $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
            // $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
            // $this->db->join('public.estatus e', 'e.id = ed.id_estatus');
            // $this->db->where('ed.id_usuario', $usuario);
            // $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            // return $response = $query->result_array();

            $query = $this->db->query("SELECT ed.id,
                                	   to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
                                       ed.rif_contrat,
                                       concat(cn.nombre,'',c.nombre ) as nombre,
                                       ed.calificacion,
                                       ed.id_estatus,
                                       e.descripcion
                                       FROM evaluacion_desempenio.evaluacion as ed
                                       left join evaluacion_desempenio.contratistas c on  c.rifced = ed.rif_contrat
                                       left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                                       join public.estatus e on e.id = ed.id_estatus
                                       where ed.id_usuario = '$usuario'");
            return $query->result_array();

        }

        //Se consulta la Evaluación de desempeño. Tomando en cuenta que hay dos tablas de consultas de los contratistas (Solicitado de esa forma).
        public function consulta_eval_ind($id_evaluacion){
            $this->db->select('ed.id,
                                ed.id_usuario,
                                u.unidad,
                                concat(tr.desc_rif,\'\',o.rif,\'\',tr2.desc_rif,\'\',e4.rif,\'\',tr3.desc_rif,\'\',ea.rif) as rif_organo,
                                concat(o.desc_organo,\'\',e4.desc_entes,\'\',ea.desc_entes_ads) as organo,
                                 ed.rif_contrat,
                                 concat(cn.nombre,\'\',c.nombre) as nom_comer,
                                 concat(e2.descedo,\'\', e3.descedo) as est_contratista,
                                 concat(m.descmun,\'\', m2.descmun) as mun_contratista,
                                 concat(c2.descciu,\'\', c3.descciu) as ciudad,
                                 concat(c.percontacto,\'\', cn.percontacto) as per_cont,
                                 concat(c.telf1,\'\', cn.telf1) as tef_cont,
                                 m3.descripcion as modalidad,
                                 sm.descripcion as sub_modalidad,
                                 ed.fec_inicio_cont,
                            	 ed.fec_fin_cont,
                            	 ed.nro_procedimiento,
                            	 ed.nro_contrato,
                            	 e.descedo as estado_contrato,
                            	 ed.descr_contrato,
                            	 ed.bienes,
                            	 ed.servicios,
                            	 ed.obras,
                            	 ed.monto,
                            	 ed.dolar,
                            	 ed.euro,
                            	 ed.petros,
                            	 ed.bolivares,
                            	 ed.calidad,
                            	 ed.responsabilidad,
                            	 ed.conocimiento,
                            	 ed.oportunidad,
                            	 ed.total_calif,
                            	 ed.calificacion,
                                 ed.notf_cont,
                                 ed.fecha_not,
                                 ed.medio,
                                 ed.nro_oc_os,
                                 ed.fileimagen,
                                 ed.otro,
                                 ed.mod_otro,
                                 ed.id_estatus,
                                 e5.descripcion,
                                 ed.fecha_reg_eval');
            $this->db->join('seguridad.usuarios u', 'u.id = ed.id_usuario');
            $this->db->join('public.organos o', 'o.codigo = u.unidad', 'left');
            $this->db->join('public.entes e4', 'e4.codigo = u.unidad', 'left');
            $this->db->join('public.entes_ads ea', 'ea.codigo = u.unidad', 'left');
            $this->db->join('public.tipo_rif tr', 'tr.id_rif = o.tipo_rif', 'left');
            $this->db->join('public.tipo_rif tr2', 'tr2.id_rif = e4.tipo_rif', 'left');
            $this->db->join('public.tipo_rif tr3', 'tr3.id_rif = ea.tipo_rif', 'left');

            $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
            $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
            $this->db->join('public.estados e', 'e.id = ed.id_estado_contrato');
            $this->db->join('public.estados e2', 'e2.id = c.estado_id', 'left');
            $this->db->join('public.estados e3', 'e3.id = cn.estado_id', 'left');
            $this->db->join('public.municipios m', 'm.id = c.municipio_id', 'left');
            $this->db->join('public.municipios m2', 'm2.id = cn.municipio_id', 'left');
            $this->db->join('public.ciudades c3', 'c3.id = c.ciudade_id', 'left');
            $this->db->join('public.ciudades c2', 'c2.id = cn.ciudade_id', 'left');
            $this->db->join('evaluacion_desempenio.modalidad m3', 'm3.id = ed.id_modalidad');
            $this->db->join('evaluacion_desempenio.sub_modalidad sm', 'sm.id = ed.id_sub_modalidad');
            $this->db->join('public.estatus e5', 'e5.id = ed.id_estatus');
            $this->db->where('ed.id', $id_evaluacion);
            $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            return $response = $query->row_array();
        }

        public function consutar_dt_eval($id_evaluacion){
            $this->db->select('*');
            $this->db->where('a.id_evaluacion', $id_evaluacion);
            $query = $this->db->get('evaluacion_desempenio.anulacion a');
            return $response = $query->row_array();
        }

        public function graficos($data){
            $response = array();
            $this->db->select('count(e.calificacion) as t_calificacion,
	                           e.calificacion');
            $this->db->group_by('e.calificacion');
            $this->db->order_by('e.calificacion');
            $this->db->where('e.rif_contrat', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->result_array();
            return $response;
        }

        public function inf_tabla($data){
            $this->db->select('fecha_evaluacion,
                        	   rif_contratista,
                        	   razon_social as contratista,
                        	   nombre_ente,
                        	   calificacion,
                        	   nombre_calificacion,
                        	   num_contrato,
                        	   numero_procedimiento');
            $this->db->where('eca.rif_contratista', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion_contratistas_ant eca');
            $response = $query->result_array();
            return $response;
        }

        public function inf_tabla2($data){
            $this->db->select('e.rif_contrat rif_contratista,
                        	   e.fecha_reg_eval fecha_evaluacion,
                        	   e.calificacion nombre_calificacion,
                        	   e.id_usuario,
                        	   u.nombre,
                        	   u.unidad,
                        	   concat(o.desc_organo,\'\', e2.desc_entes) nombre_ente');
            $this->db->join('seguridad.usuarios u', 'u.id = e.id_usuario');
            $this->db->join('public.organos o', 'o.codigo = u.unidad', 'left');
            $this->db->join('public.entes e2', 'e2.codigo = u.unidad', 'left');
            $this->db->where('e.rif_contrat', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->result_array();
            return $response;
        }

        public function consulta_contr_nr(){
            $this->db->select('cn.id,
                        	   cn.user_id,
                        	   cn.rifced rif_contratante,
                        	   cn.nombre contratante,
                        	   u.unidad,
                               concat(tr.desc_rif,\'\',o.rif, tr2.desc_rif,\'\', e.rif, tr3.desc_rif,\'\',ea.rif) as rif_contratista,
                        	   concat(o.desc_organo,\'\', e.desc_entes, \'\', ea.desc_entes_ads) as contratista');
            $this->db->join('seguridad.usuarios u', 'u.id = cn.user_id');
            $this->db->join('public.organos o', 'o.codigo = u.unidad' ,'left');
            $this->db->join('public.entes e', 'e.codigo = u.unidad' ,'left');
            $this->db->join('public.entes_ads ea', 'ea.codigo = u.unidad' ,'left');
            $this->db->join('public.tipo_rif tr', 'tr.id_rif = o.tipo_rif' ,'left');
            $this->db->join('public.tipo_rif tr2', 'tr2.id_rif = e.tipo_rif' ,'left');
            $this->db->join('public.tipo_rif tr3', 'tr3.id_rif = ea.tipo_rif' ,'left');
            $query = $this->db->get('evaluacion_desempenio.contratistas_nr cn');
            $response = $query->result_array();
            return $response;
        }

        // Consulta de Evaluacion completas para anulación
        public function consulta_eval_anul($usuario){
            $query = $this->db->query("SELECT ed.id,
                                    		to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
                                        ed.rif_contrat,
                                        concat(cn.nombre,'',c.nombre ) as nombre,
                                        ed.calificacion,
                                        ed.id_estatus,
                                        e.descripcion
                                    from evaluacion_desempenio.evaluacion ed
                                    left join evaluacion_desempenio.contratistas c on c.rifced = ed.rif_contrat
                                    left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                                    join public.estatus e on e.id = ed.id_estatus
                                    where ed.id_usuario = '$usuario'");
            return $query->result_array();
        }

        public function save_anulacion($id, $d_anulacion){
            $quers =$this->db->insert('evaluacion_desempenio.anulacion', $d_anulacion);
            $data2 = array(
                'id_estatus' => 2,
            );
            $this->db->where('id', $id);
            $update = $this->db->update('evaluacion_desempenio.evaluacion', $data2);
            return $id;
        }

        public function consulta_anulacion($data){
            $this->db->select('*');
            $this->db->where('id_evaluacion', $data['id_evaluacion']);
            $query = $this->db->get('evaluacion_desempenio.anulacion');
            return $response = $query->row_array();
        }

        public function consl_proc_anulacion(){
            // $this->db->select('ed.id,
            //                    ed.rif_contrat,
            //                    concat(cn.nombre,\'\',c.nombre ) as nombre,
            //                    ed.calificacion,
            //                    ed.id_estatus,
            //                    e.descripcion
            // ');
            // $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
            // $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
            // $this->db->join('public.estatus e', 'e.id = ed.id_estatus');
            // $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            // return $response = $query->result_array();

            $query = $this->db->query("SELECT a.id_anulacion,
                                        	   a.id_evaluacion,
                                        	   e.rif_contrat,
                                        	   concat(c.nombre, '', cn.nombre) AS contratante,
                                               e.calificacion,
                                        	   e.id_estatus,
                                        	   e2.descripcion AS estatus,
                                        	   to_char(a.fecha_reg_anulacion, 'dd-mm-yyyy') AS fech_reg
                                        FROM evaluacion_desempenio.anulacion a
                                        JOIN evaluacion_desempenio.evaluacion e ON e.id = a.id_evaluacion
                                        LEFT JOIN evaluacion_desempenio.contratistas c ON c.rifced = e.rif_contrat
                                        LEFT JOIN evaluacion_desempenio.contratistas_nr cn ON cn.rifced = e.rif_contrat
                                        JOIN public.estatus e2 ON e2.id = e.id_estatus ");
            return $query->result_array();
        }

        public function aprv_anulacion($data){

            $data1 = array(
                'fecha_aprv_anul' => date('Y-m-d'),
            );
            $this->db->where('id_evaluacion', $data['id_evaluacion']);
            $update = $this->db->update('evaluacion_desempenio.anulacion', $data1);


            $data2 = array(
                'id_estatus' => 3,
            );
            $this->db->where('id', $data['id_evaluacion']);
            $update = $this->db->update('evaluacion_desempenio.evaluacion', $data2);

            return $data['id_evaluacion'];
        }
    }
?>
