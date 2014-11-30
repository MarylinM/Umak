<?php

class Usuario_db extends CI_Model{
    
    function getUsuario(){
        $query = $this->db->query("SELECT * FROM usuario");
        return $query->result();
    }

}