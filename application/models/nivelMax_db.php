<?php

class NivelMax_db extends CI_Model{
    
    function getNivelMax(){
        $query = $this->db->query("SELECT * FROM nivelMax");
        return $query->result();
    }

}

