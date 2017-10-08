<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordem_servico extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('ordem_servico_mdl', 'ordem_servico');
    $this->load->model('seguranca_mdl', 'seguranca');

    //SEGURANCA DE ACESSO, PASSAR O ID DO USUARIO E O MODULO IGUAL AO DB
    $this->seguranca->acesso($this->session->userdata('usr_id'), 'documentos');

    $this->id_documento_tipo = 1; //TIPO DE DOCUMENTO ORDEM DE SERVICO
  }

  function index() {
    $data['documentos'] = $this->ordem_servico->lista($this->id_documento_tipo);

    $this->load->view('topo');
    $this->load->view('documentos/ordem_servico/index', $data);
    $this->load->view('rodape');
  }

  function novo() {
    $this->load->view('topo');
    $this->load->view('documentos/ordem_servico/novo');
    $this->load->view('rodape');
  }

  function item() {
    $id = $this->input->post('id');
    $json = $this->ordem_servico->item($id);
    echo json_encode($json);
  }

  function laudo() {
    $id = $this->input->post('id');
    $json = $this->ordem_servico->laudo($id);
    echo json_encode($json);
  }

  function numero_os() {
    $res = $this->ordem_servico->numero_os($this->id_documento_tipo);
    $quantidade = $res[0]->total + 1;
    $ano = date('Y');
    return $quantidade . '/' . $ano;
  }

  function save() {

    $data = array(
      'id_usuario' => $this->session->userdata('usr_id'),
      'id_documento_tipo' => $this->id_documento_tipo,
      'numero' => $this->numero_os(),
      'setor' => $this->input->post('setor'),
      'responsavel' => $this->input->post('responsavel'),
      'laudo' => $this->input->post('laudo'),
      'dt_cadastro' => date('Y-m-d H:i:s'),
      'dt_update' => date('Y-m-d H:i:s')
    );

    echo $id_documento = $this->ordem_servico->novo_documento($data);

    $tam = count($this->input->post('descricao'));

    for ($i = 1; $i < $tam + 1; $i++) {
      $d = $i - 1;
      $qtd[$i] = count($this->input->post('patrimonio_' . $i));
      for ($j = 0; $j < $qtd[$i]; $j++) {

        $data = array(
          'id_documento' => $id_documento,
          'descricao' => $this->input->post('descricao')[$d],
          'patrimonio' => ($this->input->post('patrimonio_' . $i)[$j]) ? $this->input->post('patrimonio_' . $i)[$j] : NULL,
          'numero_serie' => ($this->input->post('numero_serie_' . $i)[$j]) ? $this->input->post('numero_serie_' . $i)[$j] : NULL,
          'metros' => ($this->input->post('metros_' . $i)[$j]) ? $this->input->post('metros_' . $i)[$j] : NULL,
          'quantidade' => ($this->input->post('quantidade_' . $i)[$j]) ? $this->input->post('quantidade_' . $i)[$j] : NULL,
          'dt_cadastro' => date('Y-m-d H:i:s'),
          'dt_update' => date('Y-m-d H:i:s')
        );

        $this->ordem_servico->novo_item($data);

      }
    }

  }

  function imprimir() {
    $id = $this->uri->segment(3);
    $data['documento'] = $this->ordem_servico->dados($id);
    $data['itens'] = $this->ordem_servico->dados_itens($id);

    $this->load->library('gerar_pdf');
    $html = $this->load->view('documentos/ordem_servico/pdf', $data, true);
    $this->gerar_pdf->pdf($html);
  }

}
