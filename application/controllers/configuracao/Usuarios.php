<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuario_mdl', 'usuario');
        $this->load->model('seguranca_mdl', 'seguranca');

        //SEGURANCA DE ACESSO, PASSAR O ID DO USUARIO E O MODULO IGUAL AO DB
        $this->seguranca->acesso($this->session->userdata('usr_id'), 'usuarios');
    }

    function index() {
        $data['usuarios'] = $this->usuario->lista();

        $this->load->view('topo');
        $this->load->view('configuracoes/usuarios', $data);
        $this->load->view('rodape');
    }

    function novo() {
        $data['tipos'] = $this->usuario->tipos();

        $this->load->view('topo');
        $this->load->view('configuracoes/novo', $data);
        $this->load->view('rodape');
    }

    function atualizar() {
        if (is_numeric($this->uri->segment(4))) {
            $data['id'] = $this->uri->segment(4);
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $data['tipos'] = $this->usuario->tipos();
        $data['usuario'] = $this->usuario->dados($data['id']);

        $this->load->view('topo');
        $this->load->view('configuracoes/atualizar', $data);
        $this->load->view('rodape');
    }

    function permissoes() {
        if (is_numeric($this->uri->segment(4))) {
            $data['id'] = $this->uri->segment(4);
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $data['tipos'] = $this->usuario->tipos();
        $data['usuario'] = $this->usuario->dados($data['id']);

        //VALIDA A EXISTENCIA DE PERMISSOES PARA O USUARIO
        $res = $this->usuario->dados_permissao($data['id']);
        if (!empty($res)) {
            $data['permissoes'] = $this->usuario->dados_permissao($data['id']);
        }

        $this->load->view('topo');
        $this->load->view('configuracoes/permissoes', $data);
        $this->load->view('rodape');
    }

    function ativar() {
        if (is_numeric($this->input->get('id'))) {
            $id = $this->input->get('id');
            $ativo = $this->usuario->ativo($id);
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $data = array(
            'ativo' => ($ativo[0]->ativo == '0') ? '1' : '0'
        );

        $this->usuario->update($id, $data);
    }

    function excluir() {
        if (is_numeric($this->input->get('id'))) {
            $id = $this->input->get('id');
        } else {
            header('Location: ' . base_url('login'));
            exit();
        }

        $this->usuario->delete($id);
    }

    function save() {
        $this->load->library('utils');

        $data = array(
            'nome' => ucwords($this->input->post('nome')),
            'email' => $this->input->post('email'),
            'senha' => $this->utils->senhaHASH($this->input->post('senha')),
            'tipo' => $this->input->post('tipo'),
        );

        $this->usuario->save($data);
    }

    function update() {
        $this->load->library('utils');

        $id = $this->input->post('id');

        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'tipo' => $this->input->post('tipo'),
        );

        $this->usuario->update($id, $data);
    }

    function permissao() {
        $id = $this->input->post('id');
        $id_usuario = $this->input->post('id_usuario');

        if (empty($id)) {
            $data = array(
                'id_usuario' => $id_usuario,
                'usuarios' => ($this->input->post('usuarios')) ? '1' : '0',
                'estoque' => ($this->input->post('estoque')) ? '1' : '0',
                'documentos' => ($this->input->post('documentos')) ? '1' : '0',
                'dt_criacao' => date('Y-m-d H:i:s')
            );
            $this->usuario->permissao_novo($data);
        } else {
            $data = array(
                'usuarios' => ($this->input->post('usuarios')) ? '1' : '0',
                'estoque' => ($this->input->post('estoque')) ? '1' : '0',
                'documentos' => ($this->input->post('documentos')) ? '1' : '0'
            );
            $this->usuario->permissao($id, $data);
        }

    }

}
