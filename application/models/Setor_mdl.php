<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_mdl extends CI_Model {

    function lista() {        
        $this->db->select('id, sigla, setor, ramal, responsavel');
        return $this->db->get('tb_setor')->result();
    }
    
    function dados($id) {
        $this->db->select('id, sigla, setor, ramal, responsavel');
        $this->db->where('id', $id);
        return $this->db->get('tb_setor')->result();
    }
    
    function save($data) {
        $this->db->insert('tb_setor', $data);
    }
    
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tb_setor', $data);
    }
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_setor');
    }

}
