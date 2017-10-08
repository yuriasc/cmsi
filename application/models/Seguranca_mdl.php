<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seguranca_mdl extends CI_Model {
    
    function acesso($id, $modulo) {
        
        $this->db->select('u.id, u.nome, u.email, t.nome AS tipo, u.ativo, u.ultimo_acesso, s.usuarios');
        $this->db->from('tb_usuarios u');
        $this->db->join('tb_usuarios_tipo t', 'u.tipo = t.id');
        $this->db->join('tb_usuarios_seg s', 's.id_usuario = u.id');
        $this->db->where('u.id', $id);
        $this->db->where("s.$modulo", '1');
        $this->db->where('u.ativo', '1');
        $query = $this->db->get();
        $linhas = $query->num_rows();
                
        if ($linhas < 1) {
            header('Location: ' . base_url('login'));
        } 
        
    }
    
}