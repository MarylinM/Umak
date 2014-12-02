<?php

class Estanque_db extends CI_Model{
    
    function getEstanques(){
        $query = $this->db->query("SELECT * FROM estanque");
        return $query->result();
    }
    function getIdestanque($nombre_estanque){
        $query = $this->db->query("SELECT idestanque FROM estanque WHERE nombre='".$nombre_estanque."'");
        $temp_estanque = $query->result();
        return $temp_estanque[0]->idestanque;
    }
    
    function insertEstanque($data){
        $this->db->query("INSERT INTO estanque (nombre,tipo) VALUES ('".$data['nombre_estanque']."','".$data['tipo_estanque']."')");        
        $query = $this->db->query("SELECT idestanque FROM estanque WHERE nombre='".$data['nombre_estanque']."'");
        $temp = $query->result();
        $id_estanque = $temp[0]->idestanque;
        $this->db->query("INSERT INTO nivelmaxmin(idestanque) VALUES (".$id_estanque.")");
        
    }
    

}