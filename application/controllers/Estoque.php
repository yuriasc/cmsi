<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('estoque_mdl', 'estoque');
        $this->load->model('seguranca_mdl', 'seguranca');
        
        //SEGURANCA DE ACESSO, PASSAR O ID DO USUARIO E O MODULO IGUAL AO DB
        $this->seguranca->acesso($this->session->userdata('usr_id'), 'estoque');
    }
    
    function index() {        
        $data['estoque'] = $this->estoque->lista();
        
        $this->load->view('topo');
        $this->load->view('estoque/index', $data);
        $this->load->view('rodape');
    }
    
    function novo() {
        $this->load->view('topo');
        $this->load->view('estoque/novo');
        $this->load->view('rodape');
    }
    
    function atualizar() {
        if (is_numeric($this->uri->segment(3))) {
            $data['id'] = $this->uri->segment(3);
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $data['produto'] = $this->estoque->dados($data['id']);

        $this->load->view('topo');
        $this->load->view('estoque/atualizar', $data);
        $this->load->view('rodape');
    }
    
    function excluir() {
        if (is_numeric($this->input->post('id'))) {
            $id = $this->input->post('id');
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }
        $this->estoque->delete($id);
    }
    
    function save() {
        $this->load->library('utils');
        $data = array(
            'produto' => $this->input->post('produto'),
            'qtd' => $this->input->post('qtd'),
            'patrimonio' => ($this->input->post('patrimonio')) ? $this->input->post('patrimonio') : NULL,
            'caixa' => ($this->input->post('caixa')) ? $this->input->post('caixa') : NULL,
            'garantia' => ($this->input->post('garantia')) ? $this->utils->data_br_usa($this->input->post('garantia')) : NULL,
            'produto' => $this->input->post('produto'),
        );
        $this->estoque->save($data);
    }
    
    function update() {
        $this->load->library('utils');
        $id = $this->input->post('id');
        $data = array(
            'produto' => $this->input->post('produto'),
            'qtd' => $this->input->post('qtd'),
            'patrimonio' => ($this->input->post('patrimonio')) ? $this->input->post('patrimonio') : NULL,
            'caixa' => ($this->input->post('caixa')) ? $this->input->post('caixa') : NULL,
            'garantia' => ($this->input->post('garantia')) ? $this->utils->data_br_usa($this->input->post('garantia')) : NULL,
            'produto' => $this->input->post('produto'),
            'dt_update' => date('Y-m-d H:i:s')
        );
        $this->estoque->update($id, $data);
    }
    
}