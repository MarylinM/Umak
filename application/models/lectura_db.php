<?php

class Lectura_db extends CI_Model{
    
    function getLecturas(){
        $query = $this->db->query("SELECT * FROM lectura");
        return $query->result();
    }
    function getLectura($lectura){
//        $query = $this->db->query("SELECT fecha,cantidad,nivel_max,nivel_min
//                                    FROM lectura
//                                    WHERE fecha BETWEEN '2014-11-29' AND '2014-12-01'
//                                    AND idtipomedida=11
//                                    AND idestanque=1");
        
        $query = $this->db->query("SELECT fecha,cantidad,nivel_max,nivel_min
                                    FROM lectura
                                    WHERE fecha BETWEEN '".$lectura['fecha_inicio']."' AND '".$lectura['fecha_fin']."'
                                    AND idtipomedida=".$lectura['id_tipomedida']."
                                    AND idestanque=".$lectura['id_estanque']);
    //print_r($query->result());
        return $query->result();
    }

}