<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$data['organo']  = $this->User_model->consultar_organos();
		$data['entes']   = $this->User_model->consultar_entes();
		$data['enteads'] = $this->User_model->consultar_enteads();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('user/add.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function save()
	{
		$nombre = $this->input->post("nombre");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$repeatPassord = $this->input->post("repeatPassord");

		$id_unidad = $this->input->post("id_unidad");
		$this->form_validation->set_rules('nombre', 'Nombre completo', 'required|min_length[6]');
		$this->form_validation->set_rules('email', 'Correo eléctronico', 'required|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|min_length[8]|alpha_numeric');
		$this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('user/add.php', $data);
			$this->load->view('templates/footer.php');
		} else {

			$clave = password_hash(
				base64_encode(
					hash('sha256', $password, true)
				),
				PASSWORD_DEFAULT
			);

			$data = array(
				"nombre" => $nombre,
				"password" => $clave,
				"email" => $email,
				"foto" => 2,
				"perfil" => 1,
				"estado" => 1,
				"ultimo_login" => date("Y-m-d h:m:s"),
				"fecha" => date("Y-m-d"),
				"intentos" => 1,
				"unidad" => $id_unidad,
				"fecha_update" => date("Y-m-d"),
			);

			$this->User_model->save($data);
			$this->session->set_flashdata('success', 'Se guardo los datos correctamente');
			redirect('user/index');
		}
	}
	// guardar organismo externo
	public function save_organismo()
	{

		$data = array(
			'id_organoads'		=> $this->input->post("id_organoads"),
			'desc_organo'		=> $this->input->post("organo"),
			'cod_onapre'	 	=> $this->input->post("cod_onapre"),
			'siglas' 			=> $this->input->post("siglas"),
			'tipo_rif'			=> $this->input->post("tipo_rif"),
			'rif' 				=> $this->input->post("rif"),
			'id_clasificacion' 	=> $this->input->post("id_clasificacion"),
			'tel_local' 		=> $this->input->post("tel_local"),
			'tel_local_2' 		=> $this->input->post("tel_local_2"),
			'tel_movil'			=> $this->input->post("tel_movil"),
			'tel_movil_2' 		=> $this->input->post("tel_movil_2"),
			'pag_web' 			=> $this->input->post("pag_web"),
			'email'				=> $this->input->post("email"),
			'id_estado' 		=> $this->input->post("id_estado"),
			'id_municipio' 		=> $this->input->post("id_municipio"),
			'id_parroquia' 		=> $this->input->post("id_parroquia"),
			'direccion_fiscal' 	=> $this->input->post("direccion_fiscal"),
			'gaceta_oficial'	=> $this->input->post("gaceta_oficial"),
			'fecha_gaceta'		=> $this->input->post("fecha_gaceta"),
			'usuario' 			=> $this->session->userdata('id_user')
		);
		$data = $this->Configuracion_model->save_organismo($data);
		$this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		redirect('user/cuentadante');
	}
	//_________________________________________________________________________________________________________________________________________________________
      //crerar usuario externo
	  public function int()
	{
		$data['organo']  = $this->User_model->consultar_organos();
		$data['entes']   = $this->User_model->consultar_entes();
		$data['enteads'] = $this->User_model->consultar_enteads();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('user/usuarioexterno.php', $data);
		$this->load->view('templates/footer.php');
	}
		public function chk_password_expression($str)
			{
			if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[^a-zA-Z\d])(?=.*[a-z])(?=.*[A-Z]).*$/", $str))
			{
				$this->form_validation->set_message('chk_password_expression', '%s debe tener al menos 6
				caracteres y debe contener al menos una Caracter Especial ,una letra Minúscula, una Letra Mayúscula y un Número');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
			}
		function select_validate($selectValue)
				{
				// 'none' is the first option and the text says something like "-Choose one-"
				if($selectValue == 'none')
				{
				$this->form_validation->set_message('select_validate', 'Selecione una opción');
				return false;
				}
				else // user picked something
				{
				return true;
				}
				}
		public function savedante()
	{
		$nombrefun = $this->input->post("nombrefun");
		$apellido = $this->input->post("apellido");
		$tipo_ced = $this->input->post("tipo_ced");
		$cedula = $this->input->post("cedula");
		$cargo = $this->input->post("cargo");
		$tele_1 = $this->input->post("tele_1");
		$tele_2 = $this->input->post("tele_2");
		$oficina = $this->input->post("oficina");
		$fecha_designacion = $this->input->post("fecha_designacion");
		$numero_gaceta = $this->input->post("numero_gaceta");
		$obser = $this->input->post("obser");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$repeatPassord = $this->input->post("repeatPassord");
		$usuario = $this->input->post("usuario");
		$unidad = $this->input->post("id_unidad");
		$perfil = $this->input->post("perfil");
		//aca empiezo las validaciones
		$this->form_validation->set_rules('perfil', 'perfil', 'required|callback_select_validate');
		$this->form_validation->set_rules('nombrefun', 'Nombre ', 'required|min_length[3]');
		$this->form_validation->set_rules('apellido', 'Apellido ', 'required|min_length[4]');
		$this->form_validation->set_rules('tipo_ced', 'tipo_ced ', 'required|min_length[1]');
		$this->form_validation->set_rules('cedula', 'cedula de dentidad', 'required|min_length[6]|is_natural');
		$this->form_validation->set_rules('cargo', 'cargo ', 'required|min_length[1]');
		$this->form_validation->set_rules('tele_1', 'tele_1 comleto', 'required|min_length[6]|is_natural');
		$this->form_validation->set_rules('oficina', 'oficina ', 'required|min_length[1]');
		$this->form_validation->set_rules('cargo', 'cargo ', 'required|min_length[1]');
		$this->form_validation->set_rules('fecha_designacion', 'fecha designacion ', 'required|min_length[1]');
		$this->form_validation->set_rules('numero_gaceta', 'numero gaceta ', 'required|min_length[1]');
		$this->form_validation->set_rules('email', 'Correo eléctronico ', 'required|valid_email|is_unique[usuarios.email]');
		/*$this-> form_validation -> set_rules (
			'email' ,  'email' ,
			'required | valid_email | is_unique [usuarios.email]' ,
			array (
					'required'       =>  'No ha proporcionado % s. ' ,
					' is_unique '      =>  ' Este% s ya existe. '
					)
				); */

		$this->form_validation->set_rules( 'password', 'Contraseña', 'trim|required|min_length[6]|max_length[15]|callback_chk_password_expression');
		$this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[5]|is_unique[usuarios.nombre]|callback_chk_password_expression');


		if ($this->form_validation->run() == FALSE) {
			$data['organo']  = $this->User_model->consultar_organos();
			$data['entes']   = $this->User_model->consultar_entes();
			$data['enteads'] = $this->User_model->consultar_enteads();
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('user/usuarioexterno.php', $data);
			$this->load->view('templates/footer.php');

		} else {

			$clave = password_hash(
				base64_encode(
					hash('sha256', $password, true)
				),
				PASSWORD_DEFAULT
			);
			//esto es lo que va a la primera tabla usuarios
			$data = array(
				"nombre" => $usuario,
				"password" => $clave,
				"email" => $email,
				"perfil" => $perfil,
				"foto" => 2,
				"estado" => 1,
				"ultimo_login" => date("Y-m-d h:m:s"),
				"fecha" => date("Y-m-d"),
				"intentos" => 1,
				"unidad" => $unidad

			);

			$data2 = array(
				"nombrefun" => $nombrefun,
				"apellido" => $apellido,
				"tipo_cedula" => $tipo_ced,
				"cedula" => $cedula,
				"tele_1" => $tele_1,
				"tele_2" => $tele_2,
				"cargo" => $cargo,
				"oficina" => $oficina,
				"fecha_designacion" => $fecha_designacion,
				"numero_gaceta" => $numero_gaceta,
				"email" => $email,
				"obser" => $obser,
				"tipo_funcionario" => 3, // revisar que es esto
				"unidad" => $unidad,
				"id_usuario" => null
			);

			$this->User_model->savedante($data, $data2);
			$this->session->set_flashdata('success', 'El usuario Registrado es de uso personal, no se debe compartir.');
			redirect('user/int');
		}
	}



	//______________________________________________________________________________________________________________________________________________________
/*
	// CUENTA DANTE
	public function contrato()
	{
		$this->load->view('contrato.php');
	}

	public function cuentadante()
	{

		$data['organo'] = $this->User_model->consultar_organos();
		$data['entes'] = $this->User_model->consultar_entes();
		$data['organismos'] = $this->Configuracion_model->consulta_organismo();
		$data['tipo_rif'] 	= $this->Configuracion_model->consulta_tipo_rif();
		$data['estados'] 	= $this->Configuracion_model->consulta_estados();
		$this->load->view('user/reg_cuentadante.php', $data);
	}
	public function llenar()
	{
		$data = $this->input->post();
		$data =	$this->User_model->llenarm($data);
		echo json_encode($data);
	}
	///guardar Cuenta dante
	public function savedante()
	{
		$nombrefun = $this->input->post("nombrefun");
		$apellido = $this->input->post("apellido");
		$tipo_ced = $this->input->post("tipo_ced");
		$cedula = $this->input->post("cedula");
		$cargo = $this->input->post("cargo");
		$tele_1 = $this->input->post("tele_1");
		$tele_2 = $this->input->post("tele_2");
		$oficina = $this->input->post("oficina");
		$fecha_designacion = $this->input->post("fecha_designacion");
		$numero_gaceta = $this->input->post("numero_gaceta");
		$obser = $this->input->post("obser");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$usuario = $this->input->post("usuario");
		$unidad = $this->input->post("unidad_1");

		$repeatPassord = $this->input->post("repeatPassord");

		//aca empiezo las validaciones
		//$this->form_validation->set_rules('nombrefun', 'Nombre completo', 'required|min_length[6]');
		//$this->form_validation->set_rules('apellido', 'Apellido completo', 'required|min_length[6]');
		//$this->form_validation->set_rules('tipo_ced', 'tipo_ced completo', 'required|min_length[1]');
		//$this->form_validation->set_rules('cedula', 'cedula completo', 'required|min_length[6]');
		//$this->form_validation->set_rules('cargo', 'cargo completo', 'required|min_length[1]');
		//$this->form_validation->set_rules('tele_1', 'tele_1 completo', 'required|min_length[6]');
		//$this->form_validation->set_rules('oficina', 'oficina completo', 'required|min_length[1]');
		//$this->form_validation->set_rules('cargo', 'cargo completo', 'required|min_length[1]');
		//$this->form_validation->set_rules('fecha_designacion', 'fecha_designacion completo', 'required|min_length[1]');
		//$this->form_validation->set_rules('numero_gaceta', 'numero_gaceta completo', 'required|min_length[1]');
		$this->form_validation->set_rules('email', 'Correo eléctronico', 'required|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|min_length[8]|alpha_numeric');
		$this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');
		$this->form_validation->set_rules('usuario', 'Usuario completo', 'required|min_length[5]');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('user/reg_cuentadante.php');
		} else {

			$clave = password_hash(
				base64_encode(
					hash('sha256', $password, true)
				),
				PASSWORD_DEFAULT
			);
			//esto es lo que va a la primera tabla usuarios
			$data = array(
				"nombre" => $usuario,
				"password" => $clave,
				"email" => $email,
				"foto" => 2,
				"perfil" => 3,
				"estado" => 1,
				"ultimo_login" => date("Y-m-d h:m:s"),
				"fecha" => date("Y-m-d"),
				"intentos" => 1,
				"unidad" => $unidad
			);

			$data2 = array(
				"nombrefun" => $nombrefun,
				"apellido" => $apellido,
				"tipo_cedula" => $tipo_ced,
				"cedula" => $cedula,
				"tele_1" => $tele_1,
				"tele_2" => $tele_2,
				"cargo" => $cargo,
				"oficina" => $oficina,
				"fecha_designacion" => $fecha_designacion,
				"numero_gaceta" => $numero_gaceta,
				"email" => $email,
				"obser" => $obser,
				"tipo_funcionario" => 3,
				"id_usuario" => null

			);

			$this->User_model->savedante($data, $data2);
			$this->session->set_flashdata('success', 'El usuario Registrado es de uso personal, no se debe compartir.');
			redirect('user/cuentadante');
		}
	}*/
}
