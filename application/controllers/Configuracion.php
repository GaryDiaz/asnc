<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

    public function listar_municipio() {
        // if(!$this->session->userdata('session'))
        // redirect('login');

        $data = $this->input->post();
        $data = $this->Configuracion_model->listar_municipio($data);
        echo json_encode($data);
    }

    public function listar_parroquia() {
        // if(!$this->session->userdata('session'))
        // redirect('login');
        $data = $this->input->post();

        $data = $this->Configuracion_model->listar_parroquia($data);

        echo json_encode($data);
    }

    // ÓRGANO
    public function organismo() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organismo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        
        $titulo='Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/organismo.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_organismo() {
        if (!$this->session->userdata('session'))
            redirect('login');

        $data = array(
            'id_organoads' => $this->input->post("id_organoads"),
            'desc_organo' => $this->input->post("organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif' => $this->input->post("tipo_rif"),
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado"),
            'id_municipio' => $this->input->post("id_municipio"),
            'id_parroquia' => $this->input->post("id_parroquia"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Configuracion_model->save_organismo($data);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/organismo');
    }

    // ENTES
    public function entes() {
        if (!$this->session->userdata('session'))
            redirect('login');

        $data['organismos'] = $this->Configuracion_model->consulta_organismo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_ente() {
        if (!$this->session->userdata('session'))
            redirect('login');

        $data = array(
            'ente' => $this->input->post("ente"),
            'id_organo' => $this->input->post("id_organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif' => $this->input->post("tipo_rif"),
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado"),
            'id_municipio' => $this->input->post("id_municipio"),
            'id_parroquia' => $this->input->post("id_parroquia"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Configuracion_model->save_ente($data);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/entes');
    }

    // EMTES ADSCRITOS
    public function entes_adscritos() {
        if (!$this->session->userdata('session'))
            redirect('login');

        $data['entes'] = $this->Configuracion_model->consulta_entes();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes_adscritos.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_ente_adscrito() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'ente' => $this->input->post("ente"),
            'id_entes' => $this->input->post("id_ente"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif' => $this->input->post("tipo_rif"),
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado"),
            'id_municipio' => $this->input->post("id_municipio"),
            'id_parroquia' => $this->input->post("id_parroquia"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Configuracion_model->save_ente_adscrito($data);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/entes');
    }

}
