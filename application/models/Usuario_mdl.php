<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_mdl extends CI_Model {
    
    function lista() {    
        $this->db->select('u.id, u.nome, u.email, t.nome as tipo, if (u.ativo = "1", "SIM", "NÃO") as ativo, u.ativo AS n_ativo, date_format(u.ultimo_acesso, "%d/%m/%Y %H:%i:%s") AS ultimo_acesso');
        $this->db->from('tb_usuarios u');
        $this->db->join('tb_usuarios_tipo t', 'u.tipo = t.id');
        return $this->db->get()->result();
    }
    
    function tipos() {
        return $this->db->get('tb_usuarios_tipo')->result();
    }
    
    function dados($id) {
        $this->db->where('u.id', $id);
        $this->db->select('u.id, u.nome, u.email, u.tipo, t.nome as nome_tipo, if (u.ativo = "1", "SIM", "NÃO") as ativo, date_format(u.ultimo_acesso, "%d/%m/%Y %H:%i:%s") AS ultimo_acesso');
        $this->db->from('tb_usuarios u');
        $this->db->join('tb_usuarios_tipo t', 'u.tipo = t.id');
        return $this->db->get()->result();
    }
    
    function ativo($id) {
        $this->db->where('id', $id);
        $this->db->select('ativo');
        return $this->db->get('tb_usuarios')->result();
    }
    
    function save($data) {
        $this->db->insert('tb_usuarios', $data);
    }
    
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tb_usuarios', $data);
    }
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_usuarios');
    }
    
    function permissao($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tb_usuarios_seg', $data);
    }
    
    function dados_permissao($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->get('tb_usuarios_seg')->result();
    }
    
    function permissao_novo($data) {
        $this->db->insert('tb_usuarios_seg', $data);
    }
    
}