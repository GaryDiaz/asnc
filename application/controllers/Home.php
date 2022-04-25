<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('home/index.php');
        $this->load->view('templates/footer.php');
    }

}
