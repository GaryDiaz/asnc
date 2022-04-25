<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programacion extends CI_Controller {

    //----Carga todos los años ya registrados y para registrar----
    public function index(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        $unidad = $this->session->userdata('id_unidad');

        $data['ver_programaciones'] = $this->Programacion_model->consultar_programaciones($unidad);
        $data['fecha'] = date('yy');

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/ver_programaciones.php', $data);
        $this->load->view('templates/footer.php');
    }

    //----Agregar año de programacion----
    public function agg_programacion_anio(){
        if(!$this->session->userdata('session'))redirect('login');

        $data = array(
            'unidad'        => $this->session->userdata('id_unidad'),
            'anio'          => $this->input->POST('anio'),
            'id_usuario' 	=> $this->session->userdata('id_user'),
            'estatus' 	    => 0,
        );

        $data = $this->Programacion_model->agg_programacion_anio($data);
        echo json_encode($data);
    }

    //Consulta los proyectos y acc por año
    public function nueva_prog(){
        if(!$this->session->userdata('session'))redirect('login');
        //Información traido por el session de usuario para mostrar inf
        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        $unidad = $this->session->userdata('id_unidad');
        $data['id_programacion'] = $this->input->get('id');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
        $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos($data['id_programacion']);
        $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada($data['id_programacion']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/nueva_prog.php', $data);
        $this->load->view('templates/footer.php');
    }

    // Anterior
    public function add(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/add.php', $data);
        $this->load->view('templates/footer.php');
    }

    //funcion para cargar la información completa de la programación (En desarrollo)
    public function pdf_compl(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['proyectos'] = $this->Programacion_model->consultar_proyectos_compl($data['id_programacion'], $data['unidad']);

        $data['pp_ff'] = $this->Programacion_model->llenar_ff($data['proyectos']);
        //print_r($data['pp_ff']);die;
        // $count_prog = count($data['proyectos']);

        // for ($i=0; $i < $count_prog; $i++) {
            // foreach ($data['proyectos'] as $key => $value) {
            //     for ($i=0; $i < $count_prog; $i++) {
            //         $id_p_proyecto = $value['id_p_proyecto'];
            //         $data['pp_ff'] = $this->Programacion_model->llenar_ff($id_p_proyecto);
            //     }
            //
            // }

        // }


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/pdf_compl.php', $data);
        $this->load->view('templates/footer.php');
    }


    //Registrar Servicio
    public function agregar_servicio(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/servicio/agregar_servicio.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_servicio(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 2,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 2,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
            'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'id_tip_obra' 		     => 0,
            'id_alcance_obra' 		 => 0,
            'id_obj_obra' 		     => 0,
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
            'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'descripcion_ff' 	                => $this->input->post('descripcion_ff'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->save_servicio($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
        echo json_encode($data);
    }

    // Registrar Bienes
    public function agregar_bien(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/bien/agregar_bien.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_bien(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 1,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 1,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
            'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'id_tip_obra' 		     => 0,
            'id_alcance_obra' 		 => 0,
            'id_obj_obra' 		     => 0,
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
            'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'cantidad'               => $this->input->post('cantidad'),
            'i' 		             => $this->input->post('I'),
            'ii' 		             => $this->input->post('II'),
            'iii' 		             => $this->input->post('III'),
            'iv' 		             => $this->input->post('IV'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
            'costo_unitario' 	     => $this->input->post('costo_unitario'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'descripcion_ff' 	                => $this->input->post('descripcion_ff'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->save_bienes($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
        echo json_encode($data);
    }

    //Registrar Obras
    public function agregar_obra(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
        $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
        $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/obra/agregar_obra.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_obra(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

       $p_items = array(
           'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
           'id_ccnu' 		        => $this->input->post('id_ccnu'),
           'id_tip_obra' 		    => $this->input->post('id_tip_obra'),
           'id_alcance_obra' 		=> $this->input->post('id_alcance_obra'),
           'id_obj_obra' 		    => $this->input->post('id_obj_obra'),
           'fecha_desde'   	        => $this->input->POST('fecha_desde'),
           'fecha_hasta'   	        => $this->input->POST('fecha_hasta'),
           'especificacion' 		=> $this->input->post('especificacion'),
           'id_unidad_medida' 		=> $this->input->post('id_unidad_medida'),
           'i' 		                => $this->input->post('i'),
           'ii' 		            => $this->input->post('ii'),
           'iii' 		            => $this->input->post('iii'),
           'iv' 		            => $this->input->post('iv'),
           'precio_total' 		    => $this->input->post('precio_total'),
           'id_alicuota_iva' 		=> $this->input->post('id_alicuota_iva'),
           'iva_estimado' 		    => $this->input->post('iva_estimado'),
           'monto_estimado' 	    => $this->input->post('monto_estimado'),
       );

       $p_ffinanciamiento = array(
           'id_estado'   		        => $this->input->post('id_estado'),
           'id_par_presupuestaria' 	    => $this->input->post('par_presupuestaria_ff'),
           'id_fuente_financiamiento'   => $this->input->post('fuente_financiamiento'),
           'descripcion_ff' 	        => $this->input->post('descripcion_ff'),
           'porcentaje' 	            => $this->input->post('porcentaje'),
       );

       $data = $this->Programacion_model->save_obra($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
       echo json_encode($data);

    }

///////////////////////////////////////////////////////////////////////////////////////
    public function ver_programacion_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $parametros = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_proyecto']  = $separar['0'];
        $data['id_programacion'] = $separar['1'];
        $data['id_obj_comercial'] = $separar['2'];

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
        $data['inf_2'] = $this->Programacion_model->inf_2($data['id_p_proyecto']);
        $data['inf_3'] = $this->Programacion_model->inf_3($data['id_p_proyecto']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        if ($data['id_obj_comercial'] == 3) {
          $this->load->view('programacion/obra/pdf_obra.php', $data);
        }else {
          $this->load->view('programacion/pdf_proyecto.php', $data);
        }
        $this->load->view('templates/footer.php');
    }

    //Para editar desde la ptabla de Proyectos Registrados--------------------------------------------------
    public function editar_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $data['unidad']          = $this->session->userdata('id_unidad');
        $data['des_unidad']      = $this->session->userdata('unidad');
        $data['rif']             = $this->session->userdata('rif');
        $data['codigo_onapre']   = $this->session->userdata('codigo_onapre');

        $parametros              = $this->input->get('id');
        $separar                 = explode("/", $parametros);
        $data['id_p_proyecto']   = $separar['0'];
        $id_obj_comercial        = $separar['1'];
        $data['id_programacion'] = $separar['2'];

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/editar_proy.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1'){
            //BIEN
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/bien/editar_proy_b.php', $data);
            $this->load->view('templates/footer.php');
        }elseif ($id_obj_comercial == '3'){
            //OBRA
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
          
			$data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
			$data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
			$data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/obra/editar_proy.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    public function ver_proy_editar(){
        if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_edit($data);
	    echo json_encode($data);
    }

    public function ver_proy_editar_items(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_edit($data);
		echo json_encode($data);
    }

    public function ver_proy_editar_items_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_b($data);
		echo json_encode($data);
    }

	public function ver_proy_editar_items_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_o($data);
		echo json_encode($data);
    }

    public function editar_programacion_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
			'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	    );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
			'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
			'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
		);

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->editar_programacion_proy($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
		   $this->session->set_flashdata('sa-error', 'error');
		   redirect('Programacion/nueva_prog?id='.$id_programacion);
	    }
    }

    public function editar_programacion_proy_b(){
        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria_acc'),
			'id_ccnu' 		         => $this->input->post('id_ccnu_acc'),
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
			'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida_acc'),
            'cantidad'               => $this->input->post('cantidad_acc'),
            'i' 		             => $this->input->post('I_acc'),
            'ii' 		             => $this->input->post('II_acc'),
            'iii' 		             => $this->input->post('III_acc'),
            'iv' 		             => $this->input->post('IV_acc'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir_acc'),
            'costo_unitario' 	     => $this->input->post('costo_unitario_acc'),
            'precio_total' 		     => $this->input->post('precio_total_acc'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva_acc'),
            'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
            'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
		        );

            $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_acc_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento_acc'),
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
          );

        $data = $this->Programacion_model->editar_programacion_proy_b($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
  		    $this->session->set_flashdata('sa-error', 'error');
  		   redirect('Programacion/nueva_prog?id='.$id_programacion);
  	    }
    }

	public function editar_programacion_proy_o(){
		if(!$this->session->userdata('session'))redirect('login');

        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

       $p_items = array(
           'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
           'id_ccnu' 		        => $this->input->post('id_ccnu'),
           'id_tip_obra' 		    => $this->input->post('id_tip_obra_e'),
           'id_alcance_obra' 		=> $this->input->post('id_alcance_obra_e'),
           'id_obj_obra' 		    => $this->input->post('id_obj_obra_e'),
           'fecha_desde'   	        => $this->input->POST('fecha_desde'),
           'fecha_hasta'   	        => $this->input->POST('fecha_hasta'),
           'especificacion' 		=> $this->input->post('especificacion'),
           'id_unidad_medida' 		=> $this->input->post('id_unidad_medida'),
           'i' 		                => $this->input->post('i'),
           'ii' 		            => $this->input->post('ii'),
           'iii' 		            => $this->input->post('iii'),
           'iv' 		            => $this->input->post('iv'),
           'precio_total' 		    => $this->input->post('precio_total_e'),
           'id_alicuota_iva' 		=> $this->input->post('id_alicuota_iva'),
           'iva_estimado' 		    => $this->input->post('iva_estimado'),
           'monto_estimado' 	    => $this->input->post('monto_estimado'),
       );

       $p_ffinanciamiento = array(
           'id_estado'   		        => $this->input->post('id_estado'),
           'id_par_presupuestaria' 	    => $this->input->post('par_presupuestaria_ff'),
           'id_fuente_financiamiento'   => $this->input->post('fuente_financiamiento'),
           'descripcion_ff' 	        => $this->input->post('descripcion_ff'),
           'porcentaje' 	            => $this->input->post('porcentaje'),
       );
      /* $data = $this->Programacion_model->save_obra($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
       echo json_encode($data);*/

	   $data = $this->Programacion_model->editar_programacion_proy_o($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('Programacion/nueva_prog?id='.$id_programacion);
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('Programacion/nueva_prog?id='.$id_programacion);
		 }
	}

    //LLENADO PARA EL MODAL DE PROYECTO / OBRAS
    public function cons_items_proy_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->cons_items_proy_o($data);
		
		echo json_encode($data);
    }

    public function editar_fila_ip(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->editar_fila_ip($data);
  		echo json_encode($data);
  	}

	public function editar_fila_ip_o(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->editar_fila_ip_b_o($data);
		echo json_encode($data);
	}

	/////LLENA LOS SELECT DENTRO DE LOS MODALES
    public function llenar_par_pre_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_par_pre_mod($data);
  		echo json_encode($data);
  	}

    public function llenar_uni_med_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_uni_med_mod($data);
  		echo json_encode($data);
  	}

    public function llenar_alic_iva_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_alic_iva_mod($data);
  		echo json_encode($data);
  	}

    public function llenar_selc_ccnu_m(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_selc_ccnu_m($data);
  		echo json_encode($data);
  	}

	public function llenar_alic_tip_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_tip_obra($data);
		echo json_encode($data);
	}

	public function llenar_alic_alc_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_alc_obra($data);
		echo json_encode($data);
	}

	public function llenar_alic_obj_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_obj_obra($data);
		echo json_encode($data);
	}
	

	///////
    public function eliminar_proy(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_proy($data);
        echo json_encode($data);
    }

    public function ver_programacion_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $parametros = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_acc_centralizada']  = $separar['0'];
        $data['id_programacion'] = $separar['1'];
        $data['id_obj_comercial'] = $separar['2'];

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
        $data['inf_2_acc'] = $this->Programacion_model->inf_2_acc_pdf($data['id_p_acc_centralizada']);
        $data['inf_3_acc'] = $this->Programacion_model->inf_3_acc_pdf($data['id_p_acc_centralizada']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');

        if ($data['id_obj_comercial'] == 3) {
          $this->load->view('programacion/obra/pdf_obra_acc.php', $data);
        }else {
          $this->load->view('programacion/pdf_acc.php', $data);
        }
        $this->load->view('templates/footer.php');

    }

    //Para editar desde la ptabla de Acción Centralizada Registradas ---------------------------------------
    public function editar_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $parametros         = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_acc_centralizada']  = $separar['0'];
        $id_obj_comercial = $separar['1'];
        $data['id_programacion'] = $separar['2'];

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Se pregunta y depende de la actividad comercial muestra la vista correspondiente----------------------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/editar_acc.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1') {
            //BIEN
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/bien/editar_acc_b.php', $data);
            $this->load->view('templates/footer.php');
        }elseif ($id_obj_comercial == '3') {
            //OBRA
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

			$data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
			$data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
			$data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/obra/editar_acc.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    public function ver_acc_editar(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_acc($data);
		 echo json_encode($data);
    }

    public function ver_acc_editar_items(){
        if(!$this->session->userdata('session'))
        redirect('login');
		      $data = $this->input->post();
		        $data = $this->Programacion_model->inf_3_acc($data);
		          echo json_encode($data);
    }

	public function ver_acc_editar_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_acc($data);
		 echo json_encode($data);
    }

	public function ver_acc_editar_items_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_4_acc_o($data);
		echo json_encode($data);
    }

    public function ver_acc_editar_items_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_acc_b($data);
		echo json_encode($data);
    }

    public function editar_programacion_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $id_accion_centralizada = $this->input->POST('id_accion_centralizada');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_acc_centralizada    = $separar['1'];

        $p_acc_centralizada = array(
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	         );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
			         'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
			         'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
		        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->editar_programacion_acc($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
    		redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
            $this->session->set_flashdata('sa-error', 'error');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }

    }

    public function editar_programacion_acc_b(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $id_accion_centralizada = $this->input->POST('id_programacion_acc_b');
        $separar                 = explode("/", $id_accion_centralizada);
        $id_programacion         = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $p_acc_centralizada = array(
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada_acc'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial_acc'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	         );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria_acc'),
			         'id_ccnu' 		         => $this->input->post('id_ccnu_acc'),
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
			         'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida_acc'),
            'cantidad'               => $this->input->post('cantidad_acc'),
            'i' 		             => $this->input->post('I_acc'),
            'ii' 		             => $this->input->post('II_acc'),
            'iii' 		             => $this->input->post('III_acc'),
            'iv' 		             => $this->input->post('IV_acc'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir_acc'),
            'costo_unitario' 	     => $this->input->post('costo_unitario_acc'),
            'precio_total' 		     => $this->input->post('precio_total_acc'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva_acc'),
            'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
            'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
		        );


        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_acc_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento_acc'),
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        );

        $data = $this->Programacion_model->editar_programacion_acc_b($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
            $this->session->set_flashdata('sa-error', 'error');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }
    }

    //LLENADO PARA EL MODAL DE PROYECTO / BIENES
    public function cons_items_proy_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_proy($data);
        echo json_encode($data);
    }

    public function editar_fila_ip_b(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->editar_fila_ip_b($data);
  		echo json_encode($data);
  	}

    public function cons_items_acc_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_acc_b($data);
        echo json_encode($data);
    }

	public function cons_items_acc_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_acc_o($data);
        echo json_encode($data);
    }

    public function eliminar_acc(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_acc($data);
        echo json_encode($data);
    }
}
