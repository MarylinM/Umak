<?php

class Usuario_db extends CI_Model{
    
    function getUsuario(){
        $query = $this->db->query("SELECT * FROM usuario");
        return $query->result();
    }
    
    function identificacion($user, $pass) {
    $this->db->where('nombre', $user);
    $this->db->where('clave', $pass);
    $query = $this->db->get('usuario');    
     
    if ($query->num_rows() == 0) :
      //usuario no existe
      return false;
    else :
      //Usuario y contraseÃƒÂ±a correcta
      return true;
    endif;
    }
    function privilegio($nombre){
        $this->db->where('nombre', $nombre);
        $query = $this->db->get('usuario');
        $temp_usuario = $query->result();
        return $temp_usuario[0]->privilegio;
    }

    
}