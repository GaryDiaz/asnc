<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fuentefinanc extends CI_Controller
{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('Tablas_model');
	
	}
	public function index()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/fuentefinanc.php');
		$this->load->view('templates/footer.php');
	}

	public function save()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('desc_fuente_financiamiento', 'desc_fuente_financiamiento', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->saves($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Record added Successfully');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_entries()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->Tablas_model->delete_entry($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}
	public function edit()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_entry($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_desc_fuente_financiamiento', 'desc_fuente_financiamiento', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_fuente_financiamiento'] = $this->input->post('edit_record_id');
				$data['desc_fuente_financiamiento'] = $this->input->post('edit_desc_fuente_financiamiento');

				if ($this->Tablas_model->update_entry($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	//_________________________________________________________________________________________________________________________________
	public function alicuotaiva()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/alicuota.php');
		$this->load->view('templates/footer.php');
	}
	public function savealicuota()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('desc_alicuota_iva', 'desc_alicuota_iva', 'required');
			$this->form_validation->set_rules('desc_porcentaj', 'desc_porcentaj', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->Tablas_model->savesalicuota($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Datos Guardado');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchalicuota()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->Tablas_model->get_alicuota();
			$data = array('responce' => 'success', 'posts' => $posts);
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function deletealicuota()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->Tablas_model->delete_alicuota($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}
	public function editalicuota()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_alicuota($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updatealicuota()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_desc_alicuota_iva', 'desc_alicuota_iva', 'required');
			$this->form_validation->set_rules('edit_desc_porcentaj', 'desc_porcentaj', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_alicuota_iva'] = $this->input->post('edit_record_id');
				$data['desc_alicuota_iva'] = $this->input->post('edit_desc_alicuota_iva');
				$data['desc_porcentaj'] = $this->input->post('edit_desc_porcentaj');

				if ($this->Tablas_model->update_alicuota($data)) {
					$data = array('responce' => 'success', 'message' => 'Record update Successfully');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to update record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	//_________________________________________________________________________________________________________________________________
	public function partidap()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/partidap.php');
		$this->load->view('templates/footer.php');
	}
	public function savepartidap()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('codigopartida_presupuestaria', 'codigopartida_presupuestaria', 'required');
			$this->form_validation->set_rules('desc_partida_presupuestaria', 'desc_partida_presupuestaria', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->Tablas_model->savepartidap($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Datos Guardado');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchpartidap()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->Tablas_model->get_partidap();
			$data = array('responce' => 'success', 'posts' => $posts);
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function deletepartidap()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->Tablas_model->delete_alicuota($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}
	public function editpartidap()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_partidap($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updatepartidap()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_codigopartida_presupuestaria', 'codigopartida_presupuestaria', 'required');
			$this->form_validation->set_rules('edit_desc_partida_presupuestaria', 'desc_partida_presupuestaria', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_partida_presupuestaria'] = $this->input->post('edit_record_id');
				$data['codigopartida_presupuestaria'] = $this->input->post('edit_codigopartida_presupuestaria');
				$data['desc_partida_presupuestaria'] = $this->input->post('edit_desc_partida_presupuestaria');

				if ($this->Tablas_model->update_partidap($data)) {
					$data = array('responce' => 'success', 'message' => 'Dato Actualizado con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'ocurrio algun error, por favor vuelva a intentarlo');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	//_________________________________________________________________________________________________________________________________
	public function centra()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/centralizada.php');
		$this->load->view('templates/footer.php');
	}

	public function savecentra()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('desc_accion_centralizada', 'desc_accion_centralizada', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->Tablas_model->savecentra($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Datos Guardado');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function fetchcentra()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->Tablas_model->get_centra();
			$data = array('responce' => 'success', 'posts' => $posts);
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function deletecentra()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->Tablas_model->delete_alicuota($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}
	public function editcentra()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_centra($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updatecentra()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_desc_accion_centralizada', 'edit_desc_accion_centralizada', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_accion_centralizada'] = $this->input->post('edit_record_id');
				$data['desc_accion_centralizada'] = $this->input->post('edit_desc_accion_centralizada');

				if ($this->Tablas_model->update_centra($data)) {
					$data = array('responce' => 'success', 'message' => 'Dato Actualizado con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'ocurrio algun error, por favor vuelva a intentarlo');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}


	//_________________________________________________________________________________________________________________________________
	public function und()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/und.php');
		$this->load->view('templates/footer.php');
	}
	public function saveund()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('desc_unidad_medida', 'desc_unidad_medida', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->Tablas_model->save_und($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Datos Guardado');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function fetchund()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->Tablas_model->get_und();
			$data = array('responce' => 'success', 'posts' => $posts);
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function deleteund()
	{
		if ($this->input->is_ajax_request()) {

			$del_id = $this->input->post('del_id');

			if ($this->Tablas_model->save_und($del_id)) {
				$data = array('response' => "success",);
			} else {
				$data = array('response' => "error");
			}

			echo json_encode($data);
		}
	}
	public function editund()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_und($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updateund()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_desc_unidad_medida', 'edit_desc_unidad_medida', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_unidad_medida'] = $this->input->post('edit_record_id');
				$data['desc_unidad_medida'] = $this->input->post('edit_desc_unidad_medida');

				if ($this->Tablas_model->update_und($data)) {
					$data = array('responce' => 'success', 'message' => 'Dato Actualizado con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'ocurrio algun error, por favor vuelva a intentarlo');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}


	//_________________________________________________________________________________________________________________________________
	public function ccnu()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/ccnu.php');
		$this->load->view('templates/footer.php');
	}
	public function saveccnu()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('codigo_ccnu', 'codigo_ccnu', 'required');
			$this->form_validation->set_rules('desc_ccnu', 'desc_ccnu', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->save_ccnu($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Datos Guardo con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function fetchccnu()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_ccnu()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}
	public function editccnu()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_ccnu($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updateccnu()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_codigo_ccnu', 'codigo_ccnu', 'required');
			$this->form_validation->set_rules('edit_desc_ccnu', 'desc_ccnu', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_ccnu'] = $this->input->post('edit_record_id');
				$data['codigo_ccnu'] = $this->input->post('edit_codigo_ccnu');
				$data['desc_ccnu'] = $this->input->post('edit_desc_ccnu');

				if ($this->Tablas_model->update_ccnu($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
//______________________estado_____________________________
	public function estado()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/estado.php');
		$this->load->view('templates/footer.php');
	}
	public function saveestado()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('descedo', 'descedo', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->save_estado($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Estado Guardado con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchestado()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_estado()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}
	public function editestado()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_estado($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updateestado()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_descedo', 'desc_descedo', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id'] = $this->input->post('edit_record_id');
				$data['descedo'] = $this->input->post('edit_descedo');

				if ($this->Tablas_model->update_estado($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	//______________________Muncipio_____________________________
	public function municipio()
	{ if(!$this->session->userdata('session'))redirect('login');
		$data['estados'] = $this->Configuracion_model->consulta_estados();
		//print($data);
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/municipio.php',$data);
		$this->load->view('templates/footer.php');
		
	}
	public function savemunicipio()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('descmun', 'descmun', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->save_municipio($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Municipio Guardado con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchmunicipio()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_municipio()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}
	public function editmunicipio()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_municipio($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updatemunicipio()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_descmun', 'desc_descmun', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id'] = $this->input->post('edit_record_id');
				$data['descmun'] = $this->input->post('edit_descmun');

				if ($this->Tablas_model->update_municipio($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
		//______________________Parroquia_____________________________
		public function parroquia()
		{
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('tablas/parroquia.php');
			$this->load->view('templates/footer.php');
		}
		public function saveparroquia()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('descedo', 'descedo', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$ajax_data = $this->input->post();
	
					if ($this->Tablas_model->save_parroquia($ajax_data)) {
						$data = array('responce' => 'success', 'message' => 'Estado Guardado con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function fetchparroquia()
		{
			if ($this->input->is_ajax_request()) {
				if ($posts = $this->Tablas_model->get_parroquia()) {
					$data = array('responce' => 'success', 'posts' => $posts);
				} else {
					$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
				}
				echo json_encode($data);
			} else {
				echo "'No direct script access allowed'";
			}
		}
		public function editparroquia()
		{
			if ($this->input->is_ajax_request()) {
				$edit_id = $this->input->post('edit_id');
	
				if ($post = $this->Tablas_model->single_parroquia($edit_id)) {
					$data = array('responce' => 'success', 'post' => $post);
				} else {
					$data = array('responce' => 'error', 'message' => 'error al guardar');
				}
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function updateparroquia()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('edit_descmun', 'desc_descmun', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$data['id'] = $this->input->post('edit_record_id');
					$data['descmun'] = $this->input->post('edit_descmun');
	
					if ($this->Tablas_model->update_parroquia($data)) {
						$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		//______________________ciudades_____________________________
		public function ciudades()
		{
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('tablas/ciudades.php');
			$this->load->view('templates/footer.php');
		}
		public function saveciudades()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('descedo', 'descedo', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$ajax_data = $this->input->post();
	
					if ($this->Tablas_model->save_ciudades($ajax_data)) {
						$data = array('responce' => 'success', 'message' => 'Estado Guardado con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function fetchciudades()
		{
			if ($this->input->is_ajax_request()) {
				if ($posts = $this->Tablas_model->get_ciudades()) {
					$data = array('responce' => 'success', 'posts' => $posts);
				} else {
					$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
				}
				echo json_encode($data);
			} else {
				echo "'No direct script access allowed'";
			}
		}
		public function editciudades()
		{
			if ($this->input->is_ajax_request()) {
				$edit_id = $this->input->post('edit_id');
	
				if ($post = $this->Tablas_model->single_ciudades($edit_id)) {
					$data = array('responce' => 'success', 'post' => $post);
				} else {
					$data = array('responce' => 'error', 'message' => 'error al guardar');
				}
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function updateciudades()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('edit_descciu', 'desc_descciu', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$data['id'] = $this->input->post('edit_record_id');
					$data['descciu'] = $this->input->post('edit_descciu');
	
					if ($this->Tablas_model->update_ciudades($data)) {
						$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
				//______________________operador_____________________________
		public function operador()
		{
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('tablas/operador.php');
			$this->load->view('templates/footer.php');
		}
		public function saveoperadora()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('desc_operadora', 'desc_operadora', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$ajax_data = $this->input->post();
	
					if ($this->Tablas_model->save_operadora($ajax_data)) {
						$data = array('responce' => 'success', 'message' => 'Estado Guardado con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function fetchoperadora()
		{
			if ($this->input->is_ajax_request()) {
				if ($posts = $this->Tablas_model->get_operadora()) {
					$data = array('responce' => 'success', 'posts' => $posts);
				} else {
					$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
				}
				echo json_encode($data);
			} else {
				echo "'No direct script access allowed'";
			}
		}
		public function editoperadora()
		{
			if ($this->input->is_ajax_request()) {
				$edit_id = $this->input->post('edit_id');
	
				if ($post = $this->Tablas_model->single_operadora($edit_id)) {
					$data = array('responce' => 'success', 'post' => $post);
				} else {
					$data = array('responce' => 'error', 'message' => 'error al guardar');
				}
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		public function updateoperadora()
		{
			if ($this->input->is_ajax_request()) {
				$this->form_validation->set_rules('edit_desc_operadora', 'edit_desc_operadora', 'required');
				if ($this->form_validation->run() == FALSE) {
					$data = array('responce' => 'error', 'message' => validation_errors());
				} else {
					$data['id_operadora'] = $this->input->post('edit_record_id');
					$data['desc_operadora'] = $this->input->post('edit_desc_operadora');
	
					if ($this->Tablas_model->update_operadora($data)) {
						$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
					} else {
						$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
					}
				}
	
				echo json_encode($data);
			} else {
				echo "No direct script access allowed";
			}
		}
		//______________________proce_____________________________
	public function proce()
	{ if(!$this->session->userdata('session'))redirect('login');
		$data['estados'] = $this->Configuracion_model->consulta_estados();
		//print($data);
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/proce.php',$data);
		$this->load->view('templates/footer.php');
		
	}
	public function saveproce()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('descripcion','descripcion', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->save_proce($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Se ha creado con Exito el Procedimiento Selección de Contratista');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchproce()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_proce()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}
	public function editproce()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_proce($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updateproce()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_descripcion', 'edit_record_id', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id'] = $this->input->post('edit_record_id');
				$data['descripcion'] = $this->input->post('edit_descripcion');

				if ($this->Tablas_model->update_proce($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	//______________________supuestos_____________________________
	public function supuestos()
	{ if(!$this->session->userdata('session'))redirect('login');
		$data['modalidad'] = $this->Configuracion_model->consulta_modalidad();
		//print($data);
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('tablas/supuestos.php',$data);
		$this->load->view('templates/footer.php');
		
	}
	public function savesupuestos()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('descripcion','descripcion', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();

				if ($this->Tablas_model->save_supuestos($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Se ha creado con Exito el Procedimiento Selección de Contratista');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function fetchsupuestos()
	{
		if ($this->input->is_ajax_request()) {
			if ($posts = $this->Tablas_model->get_supuestos()) {
				$data = array('responce' => 'success', 'posts' => $posts);
			} else {
				$data = array('responce' => 'error', 'menssage' => 'falied to fetch data');
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}
	public function editsupuestos()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Tablas_model->single_supuestos($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'error al guardar');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
	public function updatesupuestos()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_descripcion', 'edit_record_id', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id'] = $this->input->post('edit_record_id');
				$data['descripcion'] = $this->input->post('edit_descripcion');

				if ($this->Tablas_model->update_supuestos($data)) {
					$data = array('responce' => 'success', 'message' => 'Registro Modificado Con Exito');
				} else {
					$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
				}
			}

			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}
//______________________edo civil_____________________________
public function edocivil()
{ if(!$this->session->userdata('session'))redirect('login');
	
	$this->load->view('templates/header.php');
	$this->load->view('templates/navigator.php');
	$this->load->view('tablas/edocivil.php');
	$this->load->view('templates/footer.php');
	
}
public function saveedocivil()
{
	if ($this->input->is_ajax_request()) {
		$this->form_validation->set_rules('desc_rif','desc_rif', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data = array('responce' => 'error', 'message' => validation_errors());
		} else {
			$ajax_data = $this->input->post();

			if ($this->Tablas_model->save_edocivil($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Se ha creado con Exito el Estado Civil');
			} else {
				$data = array('responce' => 'error', 'message' => 'Error , vuelva a intentar');
			}
		}

		echo json_encode($data);
	} else {
		echo "No direct script access allowed";
	}
}
public function fetcheedocivil()
{
	if ($this->input->is_ajax_request()) {
		if ($posts = $this->Tablas_model->get_edocivil()) {
			$data = array('responce' => 'success', 'posts' => $posts);
		} else {
			$data = array('responce' => 'error', 'menssage' => 'error, Actualize la Pagina');
		}
		echo json_encode($data);
	} else {
		echo "'No direct script access allowed'";
	}
}
public function editedocivil()
{
	if ($this->input->is_ajax_request()) {
		$edit_id = $this->input->post('edit_id');

		if ($post = $this->Tablas_model->single_edocivil($edit_id)) {
			$data = array('responce' => 'success', 'post' => $post);
		} else {
			$data = array('responce' => 'error', 'message' => 'error al guardar');
		}
		echo json_encode($data);
	} else {
		echo "No direct script access allowed";
	}
}
public function updateedocivil()
{
	if ($this->input->is_ajax_request()) {
		$this->form_validation->set_rules('edit_desc_rif', 'edit_record_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data = array('responce' => 'error', 'message' => validation_errors());
		} else {
			$data['id_edo_civil'] = $this->input->post('edit_record_id');
			$data['desc_rif'] = $this->input->post('edit_desc_rif');

			if ($this->Tablas_model->update_edocivil($data)) {
				$data = array('responce' => 'success', 'message' => 'Estado Civil Modificado Con Exito');
			} else {
				$data = array('responce' => 'error', 'message' => 'Error al Modificar Registor');
			}
		}

		echo json_encode($data);
	} else {
		echo "No direct script access allowed";
	}
}

}
