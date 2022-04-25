<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contratista extends CI_Controller
{


	public function infor_contratista()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/infor_contratista.php');
		$this->load->view('templates/footer.php');
	}

	///VISTAS PARA INFORMACION POR NOMBRE
	public function infor_contrat_nombre()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/infor_contrat_nombre.php');
		$this->load->view('templates/footer.php');
	}

	public function llenar_contratista_nombre(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Contratista_model->llenar_contratista_nombre($data);
		echo json_encode($data);
	}

	public function llenar_contratista_nombre_ind(){
		if(!$this->session->userdata('session'))redirect('login');

		$data['rif_consultado'] = $this->input->get('id');

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/llenar_contratista_inf.php', $data);
		$this->load->view('templates/footer.php');
	}
	/////FIN DE POR NOMBRE
	///VISTAS PARA INFORMACION POR OBJETO DE CONTRATACION
	public function infor_contrat_objCont()
	{
		$data['estados'] 	 = $this->Contratista_model->consulta_estados();
		$data['objcon'] 	 = $this->Contratista_model->consulta_objcon();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/infor_contrat_objCont.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function llenar_contratista_objCont(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Contratista_model->llenar_contratista_objCont($data);
		echo json_encode($data);
	}
	/////FIN DE POR NOMBRE
	
	public function ver_cont(){
		$parametros = $this->input->get('id');
		print_r($parametros);die;
	}


	public function llenar_contratista()
	{
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Contratista_model->llenar_contratista($data);
		echo json_encode($data);
	}

	public function planillaresumen()
	{
		if(!$this->session->userdata('session'))redirect('login');
		$rifced = $this->input->post("rif_cont");
		$rif = $this->input->post("rif_cont");
		$proceso_id = $this->input->post("proceso_id");
		$data1['rifced']= $this->Contratista_model->consulta_planillaresumen($rifced);
		$data1['mercantil']= $this->Contratista_model->consulta_planillaresumen2($rif);
		$data1['accionistas']= $this->Contratista_model->consulta_accionistas($rif,$proceso_id);
		$data1['comisarios']= $this->Contratista_model->consulta_comisarios($rif,$proceso_id);
		$data1['actividad']= $this->Contratista_model->consulta_activ_prod_clasif_compr_edo($rif,$proceso_id);
		$data1['obraservicio']= $this->Contratista_model->consulta_rel_obr_serv($rif,$proceso_id);
		$data1['relservicio']= $this->Contratista_model->consulta_rel_cliente($rif,$proceso_id);
		$data1['inforproduc']= $this->Contratista_model->Informe_producto($rif,$proceso_id);
		$data1['consultadictamen']= $this->Contratista_model->consulta_dictamen($rif,$proceso_id);
		$data1['consulta_Balance']= $this->Contratista_model->consulta_Balance($rif,$proceso_id);
		$data1['edoresultados']= $this->Contratista_model->consulta_edoresultados($rif,$proceso_id);
		$data1['anafinancieros']= $this->Contratista_model->consulta_anafinancieros($rif,$proceso_id);

  $data1['proceso_id'] = $this->Contratista_model->llenar_contratista_rp($proceso_id);

			 $this->load->view('templates/header.php');
			 $this->load->view('templates/navigator.php');
			 $this->load->view('contratista/planillaresumen.php',$data1);
			 $this->load->view('templates/footer.php');
          //redirect('contratista/infor_contratista', 'refresh');


	}



	public function ver_comprobante()
	{
		  	if(!$this->session->userdata('session'))redirect('login');
						$rifced = $this->input->post("rif_cont");
	//	if(isset($_POST["texto"]))
			//{
		//	$dato = $_GET['variable1'];
			// $dato=$_POST["texto"];
			//	if($dato)
    ////////////sssssssss echo "El el rif es: $rifced";

				$data['consulta'] =	$this->Contratista_model->comprobante($rifced);

				$this->load->view('templates/header.php');
				$this->load->view('templates/navigator.php');
				$this->load->view('contratista/comprobante.php',$data);
				$this->load->view('templates/footer.php');
    //redirect('/index.php/Contratista/ver_comprobante',);
			//	else
				//	echo "He recibido un campo vacio";
		//	}//
      }





}
