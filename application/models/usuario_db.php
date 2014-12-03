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
      return 0;
    else :
      //Usuario y contraseÃƒÂ±a correcta
      return 1;
    endif;
  }

    
}