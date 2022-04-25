<?php
    class Publicaciones_model extends CI_model{

	//CRUP BANCO
		function consultar_b(){
			$this->db->select('*');
			$this->db->from('publicaciones.banco');
			$this->db->order_by("codigo_b", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_b($data){
			$this->db->insert('publicaciones.banco',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_b($data){
			$this->db->select('*');
			$this->db->from('publicaciones.banco');
			$this->db->where('id_banco', $data['id_banco']);
			$this->db->order_by("codigo_b", "Asc");
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_b($data){
			$this->db->where('id_banco', $data['id_banco']);
			$update = $this->db->update('publicaciones.banco', $data);
			return true;
		}
		//ELIMAR
		function eliminar_b($data){
			$this->db->where('id_banco', $data['id_banco']);
			$query = $this->db->delete('publicaciones.banco');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP CUENTA
		function consultar_tc(){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->order_by("id_tipocuenta", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_tc($data){
			$this->db->insert('publicaciones.tipocuenta',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_tc($data){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$this->db->order_by("id_tipocuenta", "Asc");
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}//EDITAR
		function editar_tc($data){
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$update = $this->db->update('publicaciones.tipocuenta', $data);
			return true;
		}
		//ELIMAR
		function eliminar_tc($data){
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$query = $this->db->delete('publicaciones.tipocuenta');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS BANCARIOS
		function consultar_datosb($usuario){
			$this->db->select('d.id_datosb,
								d.id_banco,
								b.nombre_b,
								d.id_tipocuenta,
								t.tipo_cuenta,
								concat(b.codigo_b,\' \',b.nombre_b) as nombre_b,
								d.n_cuenta,
								d.beneficiario');
			$this->db->join('publicaciones.banco b', 'b.id_banco = d.id_banco');
			$this->db->join('publicaciones.tipocuenta t', 't.id_tipocuenta = d.id_tipocuenta');
			$this->db->from('publicaciones.datosbancarios d');
			$this->db->where('d.id_usuario', $usuario);
			$this->db->order_by("d.id_datosb", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_datosb($data){
			$this->db->insert('publicaciones.datosbancarios',$data);
			return true;
		}
		//EDITAR
		function consulta_datosba($data){
			$this->db->select('d.id_datosb,
								d.id_banco,
								b.nombre_b,
								d.id_tipocuenta,
								t.tipo_cuenta,
								concat(b.codigo_b,\' \',b.nombre_b) as nombre_b,
								d.n_cuenta,
								d.beneficiario');
			$this->db->join('publicaciones.banco b', 'b.id_banco = d.id_banco');
			$this->db->join('publicaciones.tipocuenta t', 't.id_tipocuenta = d.id_tipocuenta');
			$this->db->from('publicaciones.datosbancarios d');
			$this->db->where('d.id_datosb', $data['id_datob']);
			$this->db->order_by("d.id_datosb", "Asc");
			$query = $this->db->get();
			return $query->row();
		}
		//CONSULTAS
		function consulta_bancoe($data){
				$this->db->select('*');
				$this->db->from('publicaciones.banco');
				$this->db->where('id_banco !=', $data['id_banco']);
				$this->db->order_by("codigo_b", "Asc");
				$query = $this->db->get();
				if (count($query->result()) > 0) {
					return $query->result_array();
				}
		}
		function consulta_tipocentae($data){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->where('id_tipocuenta !=', $data['id_tipocuenta']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->result_array();
			}
		}
		function editar_datosb($data, $id_datosb){
			$this->db->where('id_datosb', $id_datosb);
			$update = $this->db->update('publicaciones.datosbancarios', $data);
			return true;
		}
		//ELIMAR
		function eliminar_datosb($data){
			$this->db->where('id_datosb', $data['id_datosb']);
			$query = $this->db->delete('publicaciones.datosbancarios');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS MODALIDAD
		function consultar_m(){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->order_by("id_modalidad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_modalidad($data){
			$this->db->insert('publicaciones.modalidad',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_mod($data){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_m($data){
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$update = $this->db->update('publicaciones.modalidad', $data);
			return true;
		}
		//ELIMAR
		function eliminar_m($data){
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->delete('publicaciones.modalidad');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS MECANISMO
		function consultar_mec(){
			$this->db->select('m.id_mecanismo,
								m.id_modalidad,
								m.decr_mecanismo,
								m2.decr_modalidad');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->join('publicaciones.modalidad m2', 'm2.id_modalidad = m.id_modalidad');
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_mec($data){
			$this->db->insert('publicaciones.mecanismo',$data);
			return true;
		}

		function consulta_modalidades($data){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->where('id_modalidad !=', $data['id_modalidad']);
			$this->db->order_by("id_modalidad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}

		function consulta_mec($data){
			$this->db->select('m.id_mecanismo,
								m.id_modalidad,
								m.decr_mecanismo,
								m2.decr_modalidad');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->join('publicaciones.modalidad m2', 'm2.id_modalidad = m.id_modalidad');
      		$this->db->where('m.id_mecanismo', $data['id_mecanismo']);
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->row_array();
		}
		//EDITAR
		function editar_mec($data){
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$update = $this->db->update('publicaciones.mecanismo', $data);
			return true;
		}
		//ELIMAR
		function eliminar_mec($data){
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$query = $this->db->delete('publicaciones.mecanismo');
			return true;
		}
	/////////////
	//CRUD ACTIVIDAD
		function consulta_actividades(){
			$this->db->select('a.id_actividad,
								a.id_modalidad,
								m.decr_modalidad,
								a.id_mecanismo,
								m2.decr_mecanismo,
								a.id_obj_cont,
								oc.desc_objeto_contrata,
								a.dias');
			$this->db->from('publicaciones.actividad a');
			$this->db->join('publicaciones.modalidad m', 'm.id_modalidad = a.id_modalidad');
			$this->db->join('publicaciones.mecanismo m2', 'm2.id_mecanismo = a.id_mecanismo');
			$this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = a.id_obj_cont ');
			$this->db->order_by("id_actividad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}

		function buscar_mec($data){
			$this->db->select('*');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->where('m.id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_obj_cont(){
            $this->db->select('*');
            $query = $this->db->get('programacion.objeto_contrata');
            return $result = $query->result_array();
        }
		//GUARDAR
		function registrar_act($data){
			$this->db->insert('publicaciones.actividad',$data);
			return true;
		}
		function consulta_mecanismos($data){
			$this->db->select('*');
			$this->db->from('publicaciones.mecanismo');
			$this->db->where('id_mecanismo !=', $data['id_mecanismo']);
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_objconta($data){
			$this->db->select('*');
			$this->db->from('programacion.objeto_contrata');
			$this->db->where('id_objeto_contrata !=', $data['id_obj_cont']);
			$this->db->order_by("id_objeto_contrata", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_act($data){
			$this->db->select('a.id_actividad,
								a.id_modalidad,
								m.decr_modalidad,
								a.id_mecanismo,
								m2.decr_mecanismo,
								a.id_obj_cont,
								oc.desc_objeto_contrata,
								a.dias');
			$this->db->from('publicaciones.actividad a');
			$this->db->join('publicaciones.modalidad m', 'm.id_modalidad = a.id_modalidad');
			$this->db->join('publicaciones.mecanismo m2', 'm2.id_mecanismo = a.id_mecanismo');
			$this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = a.id_obj_cont ');
			$this->db->where('id_actividad', $data['id_actividad']);
			$this->db->order_by("id_actividad", "Asc");
			$query = $this->db->get();
			return $query->row_array();
		}
		//EDITAR
		function editar_act($data){
			$this->db->where('id_actividad', $data['id_actividad']);
			$update = $this->db->update('publicaciones.actividad', $data);
			return true;
		}
		//ELIMAR
		function eliminar_act($data){
			$this->db->where('id_actividad', $data['id_actividad']);
			$query = $this->db->delete('publicaciones.actividad');
			return true;
		}
	//CRUD FERIADOS NACIONALES
		function consultar_d(){
			$this->db->select('*');
			$this->db->from('publicaciones.feriados_nacionales');
			$this->db->order_by("id_feriado_n", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_fer($data){
			$this->db->insert('publicaciones.feriados_nacionales',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_d($data){
			$this->db->select('*');
			$this->db->from('publicaciones.feriados_nacionales');
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_d($data){
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$update = $this->db->update('publicaciones.feriados_nacionales', $data);
			return true;
		}
		//ELIMAR
		function eliminar_d($data){
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$query = $this->db->delete('publicaciones.feriados_nacionales');
			return true;
		}
	//CRUD FERIADOS ESTADALES
		
	//LLAMADO A CONCURSO
		function buscar_act($data){
			$this->db->select('*');
			$this->db->from('publicaciones.actividad');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$this->db->where('id_obj_cont', $data['id_obj_cont']);
			$query = $this->db->get();
			return $query->result_array();
		}
		function buscar_act_e($data){
			$this->db->select('*');
			$this->db->from('publicaciones.actividad');
			$this->db->where('id_actividad', $data['id_actividad']);
			$query = $this->db->get();
			return $query->row_array();
		}
		function buscar_obj($data){
			$this->db->select('*');
			$this->db->from('programacion.objeto_contrata');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			return $query->result_array();
		}
	}
?>
