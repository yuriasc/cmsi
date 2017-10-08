<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ordem_servico_mdl extends CI_Model {

  function lista($id_documento_tipo) {
    $this->db->select('d.id, u.nome, d.numero, d.setor, d.responsavel, DATE_FORMAT(d.dt_cadastro, "%d/%m/%Y %H:%i:%s") AS dt_cadastro');
    $this->db->from('tb_documentos d');
    $this->db->join('tb_usuarios u', 'd.id_usuario = u.id');
    $this->db->where('id_documento_tipo', $id_documento_tipo);
    return $this->db->get()->result();
  }

  function dados($id) {
    $this->db->where('id', $id);
    return $this->db->get('tb_documentos')->result();
  }

  function dados_itens($id_documento) {
    $this->db->where('id_documento', $id_documento);
    return $this->db->get('tb_documentos_itens')->result();
  }

  function numero_os($id_documento_tipo) {
    $this->db->select('count(id) AS total');
    $this->db->where('id_documento_tipo', $id_documento_tipo);
    return $this->db->get('tb_documentos')->result();
  }

  function item($id) {
    $this->db->select('i.*, d.numero');
    $this->db->from('tb_documentos_itens i');
    $this->db->join('tb_documentos d', 'i.id_documento = d.id');
    $this->db->where('i.id_documento', $id);
    return $this->db->get()->result();
  }

  function laudo($id) {
    $this->db->select('numero, laudo');
    $this->db->where('id', $id);
    return $this->db->get('tb_documentos')->result();
  }

  function novo_documento($data) {
    $this->db->insert('tb_documentos', $data);
    return $this->db->insert_id();
  }

  function novo_item($data) {
    $this->db->insert('tb_documentos_itens', $data);
    return $this->db->insert_id();
  }

}
