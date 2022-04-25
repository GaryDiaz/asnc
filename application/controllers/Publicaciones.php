<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicaciones extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        //$this->load->model('Tablas_model');
    }

    //CRUD BANCO
    public function banco() {
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/banco.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'codigo_b' => $this->input->POST('codigo_b'),
            'nombre_b' => $this->input->POST('nombre_b'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_b($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_b($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_banco' => $data['id_banco'],
            'codigo_b' => $data['codigo_b'],
            'nombre_b' => $data['nombre_b'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_b($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_b($data);
        echo json_encode($data);
    }

    /////////////////////
    //CRUD TIPO DE CUENTA
    public function tipo_cuenta() {
        $data['tipocuenta'] = $this->Publicaciones_model->consultar_tc();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/tipo_cuenta.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'tipo_cuenta' => $this->input->POST('tipo_cuenta'),
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->registrar_tc($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_tc($data);
        echo json_encode($data);
    }

//EDITAR

    public function editar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_tipocuenta' => $data['id_tipocuenta'],
            'tipo_cuenta' => $data['tipo_cuenta'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_tc($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_tc($data);
        echo json_encode($data);
    }

    //////////////
    //CRUD DE DATOS BANCARIOS
    public function datosbancarios() {
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['tipocuenta'] = $this->Publicaciones_model->consultar_tc();

        $usuario = $this->session->userdata('id_user');
        $data['datosb'] = $this->Publicaciones_model->consultar_datosb($usuario);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/datosbancarios.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_banco' => $this->input->POST('id_banco'),
            'id_tipocuenta' => $this->input->POST('id_tipocuenta'),
            'n_cuenta' => $this->input->POST('n_cuenta'),
            'beneficiario' => $this->input->POST('beneficiario'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_datosb($data);
        echo json_encode($data);
    }

    //CONSULTAR DATOS
    public function consulta_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_datosba($data);
        echo json_encode($data);
    }

    public function consulta_tipocentae() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_tipocentae($data);
        echo json_encode($data);
    }

    public function consulta_bancoe() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_bancoe($data);
        echo json_encode($data);
    }

    public function editar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $id_datosb = $data['id_datosb'];

        $data = array(
            'id_banco' => $data['id_banco'],
            'id_tipocuenta' => $data['id_tipocuenta'],
            'n_cuenta' => $data['ncuenta_edit'],
            'beneficiario' => $data['beneficiario_edit'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_datosb($data, $id_datosb);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_datosb($data);
        echo json_encode($data);
    }

    //////////////
    //CRUD DE MODALIDAD
    public function modalidad() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/modalidad.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_modalidad() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'decr_modalidad' => $this->input->POST('decr_modalidad'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_modalidad($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_mod() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mod($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_m() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->editar_m($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_m() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_m($data);
        echo json_encode($data);
    }

    ///////////////
    //CRUD DE MECANISMO
    public function mecanismo() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();
        $data['mecanismos'] = $this->Publicaciones_model->consultar_mec();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/mecanismo.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_modalidad' => $this->input->POST('id_modalidad'),
            'decr_mecanismo' => $this->input->POST('decr_mecanismo'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_mec($data);
        echo json_encode($data);
    }

    //CONSULTAR DATOS
    public function consulta_modalidades() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_modalidades($data);
        echo json_encode($data);
    }

    public function consulta_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mec($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_mecanismo' => $data['id_mecanismo'],
            'id_modalidad' => $data['id_modalidad'],
            'decr_mecanismo' => $data['decr_mecanismo'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_mec($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_mec($data);
        echo json_encode($data);
    }

    /////////////////////
    //CRUD DE ACTIVIDAD
    public function actividad() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();
        $data['obj_contrat'] = $this->Publicaciones_model->consulta_obj_cont();

        $data['actividades'] = $this->Publicaciones_model->consulta_actividades();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/actividad.php', $data);
        $this->load->view('templates/footer.php');
    }

    //BUSCAR DATOS
    public function buscar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_mec($data);
        echo json_encode($data);
    }

    //GUARDAR
    public function registrar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_modalidad' => $this->input->POST('id_modalidad'),
            'id_mecanismo' => $this->input->POST('id_mecanismo'),
            'id_obj_cont' => $this->input->POST('id_obj_cont'),
            'dias' => $this->input->POST('dias'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_act($data);
        echo json_encode($data);
    }

    //CONSULTAS
    public function consulta_mecanismos() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mecanismos($data);
        echo json_encode($data);
    }

    public function consulta_objconta() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_objconta($data);
        echo json_encode($data);
    }

    public function consulta_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_act($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_actividad' => $data['id_actividad'],
            'id_modalidad' => $data['id_modalidad'],
            'id_mecanismo' => $data['id_mecanismo'],
            'id_obj_cont' => $data['id_obj_cont'],
            'dias' => $data['dias'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_act($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_act($data);
        echo json_encode($data);
    }

    ///////////////////////////////////
    //CRUD FERIADOS NACIONALES
    public function feriados() {
        $data['dias'] = $this->Publicaciones_model->consultar_d();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/feriados.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_fer() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'dia' => $this->input->POST('dia'),
            'descripcion' => $this->input->POST('descripcion'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_fer($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_d($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_feriado_n' => $data['id_feriado'],
            'dia' => $data['dia'],
            'descripcion' => $data['descripcion'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_d($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_d($data);
        echo json_encode($data);
    }

    //REGISTRO DE LLAMADO A CONCURSO
    public function registro_p() {
        $data['obj_contrat'] = $this->Publicaciones_model->consulta_obj_cont();
        $data['modalidades'] = $this->Publicaciones_model->consultar_m();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/registro_p.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function buscar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_act($data);
        echo json_encode($data);
    }

    public function buscar_act_e() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_act_e($data);
        echo json_encode($data);
    }

}

?>
