<?php

class Lectura_db extends CI_Model{
    
    function getLecturas(){
        $query = $this->db->query("SELECT * FROM lectura");
        return $query->result();
    }

}