<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('login_mdl', 'login');
    }

    function index() {
        $this->load->view('topo');
        $this->load->view('home');
        $this->load->view('rodape');
    }

}
