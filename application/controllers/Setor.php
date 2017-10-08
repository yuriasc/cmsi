<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('setor_mdl', 'setor');
//        $this->load->model('seguranca_mdl', 'seguranca');
//        
//        //SEGURANCA DE ACESSO, PASSAR O ID DO USUARIO E O MODULO IGUAL AO DB
//        $this->seguranca->acesso($this->session->userdata('usr_id'), 'estoque');
    }

    function index() {
        $data['setor'] = $this->setor->lista();

        $this->load->view('topo');
        $this->load->view('setor/index', $data);
        $this->load->view('rodape');
    }

    function novo() {
        $this->load->view('topo');
        $this->load->view('setor/novo');
        $this->load->view('rodape');
    }

    function atualizar() {
        if (is_numeric($this->uri->segment(3))) {
            $data['id'] = $this->uri->segment(3);
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $data['setor'] = $this->setor->dados($data['id']);

        $this->load->view('topo');
        $this->load->view('setor/atualizar', $data);
        $this->load->view('rodape');
    }

    function excluir() {
        if (is_numeric($this->input->post('id'))) {
            $id = $this->input->post('id');
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->setor->delete($id);
    }

    function save() {
        $data = array(
            'sigla' => $this->input->post('sigla'),
            'setor' => $this->input->post('setor'),
            'ramal' => $this->input->post('ramal'),
            'responsavel' => $this->input->post('responsavel')
        );
        $this->setor->save($data);
    }

    function update() {
        $id = $this->input->post('id');
        $data = array(
            'sigla' => $this->input->post('sigla'),
            'setor' => $this->input->post('setor'),
            'ramal' => $this->input->post('ramal'),
            'responsavel' => $this->input->post('responsavel'),
            'dt_update' => date('Y-m-d H:i:s')
        );
        $this->setor->update($id, $data);
    }

}
