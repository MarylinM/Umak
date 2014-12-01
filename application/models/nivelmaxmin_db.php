<?php

class Nivelmaxmin_db extends CI_Model{

    function getNivelmaxmin(){
        $query = $this->db->query("SELECT n.idestanque as id_estanque,e.nombre as nombre_estanque,e.tipo as tipo_estanque,n.oxigeno_min,n.oxigeno_max,n.temperatura_min,n.temperatura_max,n.ph_min,n.ph_max,n.amoniaco_min,n.amoniaco_max
                                    FROM nivelmaxmin n
                                    JOIN estanque e on e.idestanque = n.idestanque");
        return $query->result();
    }
    function updateNivelmaxmin($data){
        
            $this->db->query("UPDATE nivelmaxmin
                              SET oxigeno_min=".$data['oxigeno_min'].",
                                  oxigeno_max=".$data['oxigeno_max'].",
                                  temperatura_min=".$data['temperatura_min'].",
                                  temperatura_max=".$data['temperatura_max'].",
                                  ph_min=".$data['ph_min'].",
                                  ph_max=".$data['ph_max'].",
                                  amoniaco_min=".$data['amoniaco_min'].",
                                  amoniaco_max=".$data['amoniaco_max']."
                              WHERE idestanque=".$data['id_estanque']);
    }

}

