<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_mdl', 'login');
    }

    function index() {
        $this->session->sess_destroy();
        $this->load->view('login');
    }

    function acesso() {
        //LIBRARY UTIL
        $this->load->library('utils');

        $email = $this->input->post('email');
        $senha = $this->utils->senhaHASH($this->input->post('senha'));

        //VALIDA O ACESSO DO USUARIO NO SISTEMA
        $res = $this->login->acesso($email, $senha);

        if (!empty($res)) {
            //CRIA A SESSAO PARA O USUAIO
            $session = array(
                'usr_id' => $res[0]->id,
                'usr_nome' => $res[0]->nome,
                'usr_email' => $res[0]->email,
                'usr_tipo' => $res[0]->tipo,
                'usr_ativo' => $res[0]->ativo,
                'usr_ultimo_acesso' => $res[0]->ultimo_acesso,
                'acs_configuracao' => $res[0]->configuracao
            );

            $permissao = array(
                'perm_usuarios' => $res[0]->usuarios,
                'perm_estoque' => $res[0]->estoque,
                'perm_documentos' => $res[0]->documentos
            );

            $this->session->set_userdata($session);
            $this->session->set_userdata($permissao);

            $this->atualiza_ultimo_acesso($res[0]->id);

            header('Location: ' . base_url('home'));
            exit();
        } else {
            //VOLTA PARA A TELA DE LOGIN
            $this->session->set_flashdata('erro', 'Email ou Senhas Inválidas.');
            header('Location: ' . base_url('login'));
            exit();
        }
    }

    function atualiza_ultimo_acesso($id) {
        $data = array(
            'ultimo_acesso' => date('Y-m-d H:i:s')
        );

        $this->login->atualiza_ultimo_acesso($id, $data);
    }

}
