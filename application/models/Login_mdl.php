<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_mdl extends CI_Model {

    function acesso($email, $senha) {
        $this->db->select('u.id, u.nome, u.email, t.nome AS tipo, u.ativo, u.ultimo_acesso, s.usuarios, s.estoque, s.documentos');
        $this->db->from('tb_usuarios u');
        $this->db->join('tb_usuarios_tipo t', 'u.tipo = t.id');
        $this->db->join('tb_usuarios_seg s', 's.id_usuario = u.id');
        $this->db->where('u.email', $email);
        $this->db->where('u.senha', $senha);
        $this->db->where('u.ativo', '1');
        return $this->db->get()->result();
    }

    function atualiza_ultimo_acesso($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tb_usuarios', $data);
    }

}
