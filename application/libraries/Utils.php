<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {
    
    function senhaHASH($senha) {
        $salt = '%+_CMS1@IFP8_&pHp_+%';
        return sha1($salt . $senha);
    }
    
    function data_br_usa($data) {
        $d = explode('/', $data);
        return $d[2] . '-' . $d[1] . '-' . $d[0];
    }
    
}