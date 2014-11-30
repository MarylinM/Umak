<?php

class Estanque_db extends CI_Model{
    
    function getEstanques(){
        $query = $this->db->query("SELECT * FROM estanque");
        return $query->result();
    }

}