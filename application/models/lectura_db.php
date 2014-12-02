<?php

class Lectura_db extends CI_Model{
    
    function getLecturas(){
        $query = $this->db->query("SELECT * FROM lectura");
        return $query->result();
    }
    function getLectura($lectura){     
        //obtener id del tipomeddida
        
                
        $query = $this->db->query("SELECT fecha,cantidad,nivel_max,nivel_min
                                    FROM lectura
                                    WHERE fecha BETWEEN '".$lectura['fecha_inicio']."' AND '".$lectura['fecha_fin']."'
                                    AND idtipomedida=".$id_tipomedida."
                                    AND idestanque=".$id_estanque." ;
                                    ORDER BY fehca");
        return $query->result();
    }

}