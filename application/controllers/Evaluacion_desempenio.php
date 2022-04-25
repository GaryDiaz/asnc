<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluacion_desempenio extends CI_Controller {

	public function index(){
		if(!$this->session->userdata('session'))redirect('login');
		$data['estados'] 	 = $this->Configuracion_model->consulta_estados();
		$data['pais'] 		 = $this->Configuracion_model->consulta_paises();
		$data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
		$data['operadora'] 	 = $this->Evaluacion_desempenio_model->consulta_operadora();
		$data['modalidades'] = $this->Evaluacion_desempenio_model->consulta_modalidades();
		$data['med_not'] 	 = $this->Evaluacion_desempenio_model->consulta_med_notf();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/registro.php', $data);
        $this->load->view('templates/footer.php');
	}

	//Registro de Evaluacion Desempenio
	public function listar_municipio(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_municipio($data);
		echo json_encode($data);
	}

	public function listar_parroquia(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_parroquia($data);
		echo json_encode($data);
	}

	public function listar_ciudades(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_ciudades($data);
		echo json_encode($data);
	}

	//Consulta si existe el contrastis
	public function llenar_contratista(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista($data);
		echo json_encode($data);
	}

	public function llenar_contratista_rp(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista_rp($data);
		echo json_encode($data);
	}
	//-------------------------------------------------

	public function llenar_sub_modalidad(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_sub_modalidad($data);
		echo json_encode($data);
	}

	public function registrar(){
		if(!$this->session->userdata('session'))redirect('login');

		//los datos se traen de la vista Evaluación Desempeño medianto el js(AJAX)

		$rif_cont = $this->input->POST('rif_cont');
		$rif_cont_n = $this->input->POST('rif_cont_n');

		$exitte = $this->input->POST('exitte');

		if ($rif_cont == '') {
			$rif_contrat = $rif_cont_n;
		}else {
			$rif_contrat = $rif_cont;
		}

		$data = array(
			'user_id' 			 => $this->session->userdata('id_user'),
			'edocontratista_id'  => 1,
			'objcontratista_id'  => 0,
			'nivelfinanciero_id' => 0,
			'racoficina_id' 	 => 0,
			'tipocontratista' 	 => 0,
			'estado_id' 		 => $this->input->POST('id_estado_n'),
			'ciudade_id' 		 => $this->input->POST('ciudad_n'),
			'municipio_id' 		 => $this->input->POST('id_municipio_n'),
			'parroquia_id' 		 => $this->input->POST('id_parroquia_n'),
			'rifced' 			 => $rif_contrat,
			'nombre' 			 => $this->input->POST('nombre_n'),
			'tipopersona' 		 => 0, //tipo de rif
			'dencomerciale_id' 	 => 0,
			'ultprocaprob' 		 =>0,
			'procactual' 		 => 0,
			'dirfiscal' 		 => 'no',
			'percontacto' 		 => 'N/A',
			'telf1' 		  	 => 'N/A',
			'fecactsusc_at' 	 =>  '2020-01-01',
			'fecvencsusc_at' 	 => '2020-01-01',
			'fecinscrnc_at'	     => '2020-01-01',
			'fecvencrnc_at' 	 => '2020-01-01',
			'numcertrnc' 	     => '0',
			'numcontrol_certrnc' => '0',
			'contimp_certrnc'    => '0',
			'contimp_copiarnc'   => '0',
			'codedocont' 		 => '0',
			'loginant' 			 => '0',
			'fecvencrechazo_at'  => '2020-01-01',
			'recibido' 			 => '0'
		);

		$data_repr_legal= array(
				'rif_contratista' => $rif_contrat,
				'paise_id' 		  => $this->input->POST('id_pais_n'),
				'apeacc' 		  => $this->input->POST('ape_rep_leg_n'),
				'nomacc' 		  => $this->input->POST('nom_rep_leg_n'),
				'tipo' 			  => '',
				'cedrif' 		  => $this->input->POST('ced_rep_leg_n'),
				'edocivil' 		  => $this->input->POST('ced_rep_leg_n'),
				'acc' 			  => '0',
				'jd' 			  => '0',
				'rl' 			  => '0',
				'porcacc' 		  => '0',
				'cargo' 		  => $this->input->POST('cargo_rep_leg_n'),
				'tipobl' 		  => '',
				'id_operadora' 	  => $this->input->POST('operadora_n'),
				'telf' 		      => $this->input->POST('numero_n'),
				'correo' 		  => $this->input->POST('correo_rep_leg_n')
		);

		if (!empty($_FILES['fileImagen']['name'])){
			$config['upload_path'] = './imagenes';;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			// $config['max_size'] = '1000px';
			// $config['max_width'] = '1000px';
			// $config['max_height'] = '1000px';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('fileImagen')){
				$img = $this->upload->data();
			}else{
				$img = 'N/A';
				echo $this->upload->display_errors();
			}
		}
		if(!isset($img_1['file_name'])){$img_1['file_name'] = "";}

		$dato = $_POST['radio_css'];

		if ($dato == 1){
			$bolivares = 'on';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		}elseif ($dato == 2){
			$bolivares = '';
			$petros  = 'on';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		}
		elseif ($dato == 3){
			$bolivares = '';
			$petros  = '';
			$dolar  = 'on';
			$euro  = '';
			$otro  = '';
		}
		elseif ($dato == 4){
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = 'on';
			$otro  = '';
		}elseif ($dato == 5){
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = 'on';
		}

		$data_ev = array('rif_contrat' 			=> $rif_contrat,
						 'id_modalidad' 		=> $this->input->POST('id_modalidad'),
						 'id_sub_modalidad' 	=> $this->input->POST('id_sub_modalidad'),
					 	 'fec_inicio_cont'	 	=> $this->input->POST('start'),
				 	     'fec_fin_cont' 		=> $this->input->POST('end'),
					 	 'nro_procedimiento' 	=> $this->input->POST('nro_procedimiento'),
					 	 'nro_contrato' 		=> $this->input->POST('nro_cont_oc_os'),
					 	 'id_estado_contrato' 	=> $this->input->POST('id_estado_dc'),
				 		 'bienes' 				=> $this->input->POST('cssCheckbox1'),
						 'servicios' 			=> $this->input->POST('cssCheckbox2'),
						 'obras' 				=> $this->input->POST('cssCheckbox3'),
						 'descr_contrato' 		=> $this->input->POST('desc_contratacion'),
						 'monto' 				=> $this->input->POST('monto'),
						 'dolar' 				=> $dolar,
						 'euro' 				=> $euro,
						 'petros' 				=> $petros,
						 'bolivares' 			=> $bolivares,
						 'calidad' 				=> $this->input->POST('calidad'),
						 'responsabilidad' 		=> $this->input->POST('responsabilidad'),
						 'conocimiento' 		=> $this->input->POST('conocimiento'),
						 'oportunidad' 			=> $this->input->POST('oportunidad'),
						 'total_calif' 			=> $this->input->POST('total_claf'),
						 'calificacion' 		=> $this->input->POST('calificacion'),
						 'notf_cont' 			=> 0,
					 	 'fecha_not' 			=> $this->input->POST('fec_notificacion'),
				 	  	 'medio' 				=> $this->input->POST('medio'),
			 		 	 'nro_oc_os' 			=> $this->input->POST('nro_oc_os'),
		 			 	 'fileimagen' 			=> $img['file_name'],
						 'id_usuario' 			=> $this->session->userdata('id_user'),
						 'id_estatus'			=> 1,
						 'otro' 				=> $otro,
						 'mod_otro' 			=> $this->input->POST('mod_otro')
		);
		$data =	$this->Evaluacion_desempenio_model->registrar($exitte,$data,$data_ev,$data_repr_legal);
		echo json_encode($data);
	}

	//Para consultar las evaluaciones que tiene el usuarios registradas
	public function reporte(){
		if(!$this->session->userdata('session'))redirect('login');

		$usuario = $this->session->userdata('id_user');
		$data['reportes'] 	= $this->Evaluacion_desempenio_model->consulta_eval($usuario);
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/reporte.php', $data);
        $this->load->view('templates/footer.php');
	}

	public function ver_evaluacion(){
		if(!$this->session->userdata('session'))redirect('login');
		$id_evaluacion = $this->input->get('id');
		$data['eval_ind'] 	= $this->Evaluacion_desempenio_model->consulta_eval_ind($id_evaluacion);
		$data['dt_eval']	= $this->Evaluacion_desempenio_model->consutar_dt_eval($id_evaluacion);

		$fecha_d = $data['eval_ind']['fec_inicio_cont'];
		$date_d = date("d-m-Y", strtotime($fecha_d));
		$data['fec_inicio_cont'] = $date_d;

		$fecha_h = $data['eval_ind']['fec_fin_cont'];
		$date_h = date("d-m-Y", strtotime($fecha_h));
		$data['fec_fin_cont'] = $date_h;

		$fecha_r = $data['eval_ind']['fecha_reg_eval'];
		$date_r = date("d-m-Y", strtotime($fecha_r));
		$data['fecha_reg_eval'] = $date_r;

		$img = $data['eval_ind']['fileimagen'];
		$separar  = explode(".", $img);
		$data['tipo_img'] = $separar['1'];

		$calidad = $data['eval_ind']['calidad'];
		$data['calc_cald'] = $calidad * 25;

		$responsabilidad = $data['eval_ind']['responsabilidad'];
		$data['calc_responsabilidad'] = $responsabilidad * 25;

		$conocimiento = $data['eval_ind']['conocimiento'];
		$data['calc_conocimiento'] = $conocimiento * 25;

		$oportunidad = $data['eval_ind']['oportunidad'];
		$data['calc_oportunidad'] = $oportunidad * 25;

		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/pdf_eval.php', $data);
        $this->load->view('templates/footer.php');
	}

	//Para La Consulta de Gráficos
	public function consulta(){
		if(!$this->session->userdata('session'))redirect('login');
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/consulta.php');
        $this->load->view('templates/footer_g.php');
	}

	public function graficos(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->graficos($data);
		echo json_encode($data);
	}

	public function inf_tabla(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->inf_tabla($data);
		echo json_encode($data);
	}

	public function inf_tabla2(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->inf_tabla2($data);
		echo json_encode($data);
	}

	// CONSULTA DE CONTRATISTAS QUE CONTRATARON A NOREG

	public function estatus_contratista(){
		if(!$this->session->userdata('session'))redirect('login');

		$data['contrat']	= $this->Evaluacion_desempenio_model->consulta_contr_nr();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/estatus_contratista.php', $data);
		$this->load->view('templates/footer.php');
	}

	//Anulacion de Evaluacion de Desempeños
	public function anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
		$usuario = $this->session->userdata('id_user');
		$data['evaluaciones']	= $this->Evaluacion_desempenio_model->consulta_eval_anul($usuario);

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/anulacion.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function resgistrar_anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
		$id = $this->input->POST('id');
		$d_anulacion = array(
			'id_evaluacion'   => $this->input->POST('id'),
            'nro_oficicio'    => $this->input->POST('nro_oficicio'),
            'fecha_anulacion' => $this->input->POST('fec_solicitud'),
            'nro_expediente'  => $this->input->POST('nro_expediente'),
			'nro_gacet_resol' => $this->input->POST('nro_gacet_resol'),
            'cedula_solc'     => $this->input->POST('cedula_solc'),
			'nom_ape_solc'    => $this->input->POST('nom_ape_solc'),
			'cargo'        	  => $this->input->POST('cargo'),
			'telf_solc'       => $this->input->POST('telf_solc'),
			'descp_anul'	  => $this->input->POST('descp_anul'),
			'id_usuario' 	  => $this->session->userdata('id_user'),
			'fecha_aprv_anul' => date('Y-m-d'),
        );

		$data = $this->Evaluacion_desempenio_model->save_anulacion($id, $d_anulacion);
        echo json_encode($data);
	}

	public function consulta_anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->consulta_anulacion($data);
		echo json_encode($data);
	}

	public function proc_anulacion(){
		if(!$this->session->userdata('session'))redirect('login');

		$data['anulaciones']	= $this->Evaluacion_desempenio_model->consl_proc_anulacion();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/proc_anulacion.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function resgistrar_aprv_anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
		// $id_evaluacion = $this->input->POST('id_evaluacion');
		$data = $this->input->post();
		$data = $this->Evaluacion_desempenio_model->aprv_anulacion($data);
        echo json_encode($data);
	}
}
