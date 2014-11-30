<?php

class medida_db extends CI_Model{
    
    function getMedida(){
        $query = $this->db->query("SELECT * FROM medida");
        return $query->result();
    }

}
