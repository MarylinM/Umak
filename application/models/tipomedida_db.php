<?php

class Tipomedida_db extends CI_Model{
    
    function getTipomedidas(){
        $query = $this->db->query("SELECT * FROM tipomedida");
        return $query->result();
    }
    function getIdtipomedida($nombre_tipomedida){
        $query = $this->db->query("SELECT idtipomedida FROM tipomedida WHERE nombre='".$nombre_tipomedida."'");
        $temp_tipomedida = $query->result();
        return $temp_tipomedida[0]->idtipomedida;
    }

}
