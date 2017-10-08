<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque_mdl extends CI_Model {

    function lista() {        
        $this->db->select('id, produto, qtd, patrimonio, caixa, DATE_FORMAT(garantia, "%d/%m/%Y") AS garantia, DATE_FORMAT(dt_cadastro, "%d/%m/%Y %H:%i:%s") AS dt_cadastro');
        return $this->db->get('tb_estoque')->result();
    }
    
    function dados($id) {
        $this->db->select('id, produto, qtd, patrimonio, caixa, DATE_FORMAT(garantia, "%d/%m/%Y") AS garantia, DATE_FORMAT(dt_cadastro, "%d/%m/%Y %H:%i:%s") AS dt_cadastro');
        $this->db->where('id', $id);
        return $this->db->get('tb_estoque')->result();
    }
    
    function save($data) {
        $this->db->insert('tb_estoque', $data);
    }
    
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tb_estoque', $data);
    }
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_estoque');
    }

}
