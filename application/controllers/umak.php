<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umak extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("estanque_db");
        $this->load->model("lectura_db");
        $this->load->model("nivelmaxmin_db");
        $this->load->model("estanque_db");
        $this->load->model("tipomedida_db");
        $this->load->model("usuario_db"); 
    }
    public function index()
    {
        if($this->session->userdata('login')){
            $this->graficos();
        }else{
            $this->login();
        }
        
    }

    public function niveles()
    {   //comprueba si esta logeado
        if($this->session->userdata('login')){
            $data['niveles'] = $this->nivelmaxmin_db->getNivelmaxmin();  
            $usuario['privilegio'] = $this->session->userdata('usuario');
            //comprueba si es administrador o usuario
            if( strcasecmp( $this->session->userdata('privilegio'), 'administrador' ) == 0){
                $this->load->view('view_header',$usuario);
                $this->load->view('view_nivelesFisicoquimico',$data);
            }  elseif ( strcasecmp( $this->session->userdata('privilegio'), 'usuario' ) == 0) {
                $this->load->view('view_header',$usuario);
                $this->load->view('views_usuario/view_nivelesFisicoquimico',$data);
            }
        }else{
            $this->load->view('view_Bienvenida');
        }
        
        
        
        //print_r($data);
    }
    public function modificar_niveles()
    {   
        $data_update = array(
            'id_estanque'=>$this->input->post('id_estanque'),
            'ph_min'=>$this->input->post('ph_min'),
            'ph_max'=>$this->input->post('ph_max'),
            'amoniaco_min'=>$this->input->post('amoniaco_min'),
            'amoniaco_max'=>$this->input->post('amoniaco_max'),
            'oxigeno_min'=>$this->input->post('oxigeno_min'),
            'oxigeno_max'=>$this->input->post('oxigeno_max'),
            'temperatura_min'=>$this->input->post('temperatura_min'),
            'temperatura_max'=>$this->input->post('temperatura_max'),            
        );
        $this->nivelmaxmin_db->updateNivelmaxmin($data_update);        
        $this->niveles();
        //print_r($data);
    }
    public function estanques()
    {    //comprueba si esta logeado
        if($this->session->userdata('login')){
            $data['estanques'] = $this->estanque_db->getEstanques();
            $usuario['privilegio'] = $this->session->userdata('usuario');
            //comprueba si es administrador o usuario
            if( strcasecmp( $this->session->userdata('privilegio'), 'administrador' ) == 0){
                $this->load->view('view_header',$usuario);
                $this->load->view('view_estanques',$data);
            }  elseif ( strcasecmp( $this->session->userdata('privilegio'), 'usuario' ) == 0) {
                $this->load->view('view_header',$usuario);
                $this->load->view('views_usuario/view_estanques',$data);
            }
        }else{
            $this->load->view('view_Bienvenida');
        }
        
        //print_r($data);
    }
    public function agregar_estanque(){
        $data_insert = array(
            'nombre_estanque'=>$this->input->post('nombre_estanque'),
            'tipo_estanque'=>$this->input->post('tipo_estanque')                      
        );
        
        $this->estanque_db->insertEstanque($data_insert);        
        $this->estanques();
    }
    public function graficos(){
        //comprueba si esta logeado
        if($this->session->userdata('login')){
            $data['lecturas'] = $this->lectura_db->getLecturas();
            $usuario['privilegio'] = $this->session->userdata('usuario');
            $this->load->view('view_header',$usuario);
            $this->load->view('view_graficos',$data);
        }else{
            $this->load->view('view_Bienvenida');
        }
    }
    //funcion usada para listar los estanques en un selectBox en la vista view_graficos
    public function obtenerEstanques(){        
        $jsonData = $this->estanque_db->getEstanques();
        echo json_encode($jsonData);
    }
    
    public function obtenerTipomedidas(){        
        $jsonData = $this->tipomedida_db->getTipomedidas();
        echo json_encode($jsonData);
    }

    public function lectura(){  
        $lectura['id_tipomedida']=$this->input->get('id_tipomedida');
        $lectura['id_estanque']=$this->input->get('id_estanque');
        $lectura['fecha_inicio']=$this->input->get('fecha_inicio');
        $lectura['fecha_fin']=$this->input->get('fecha_fin');
        $jsonData = $this->lectura_db->getLectura($lectura);        
        echo json_encode($jsonData);
    }
        
    public function login(){
        $this->load->view('view_login');
    }
    public function validar_login(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|callback_validar_usuario');
        $this->form_validation->set_rules('clave', 'Clave', 'required|trim');
        //si la validacion es correcta se crea la variable de sesion
        //falta editar los mensajes de validacion en caso de error
        if($this->form_validation->run()){            
            $data = array(
                'usuario' => $this->input->post('usuario'),
                'privilegio' => $this->usuario_db->privilegio($this->input->post('usuario')),
                'login' => true
            );
            $this->session->set_userdata($data);
            $this->graficos();
        } else{
            $this->login();
        }

    }
    public function validar_usuario(){
        $usuario=$this->input->post('usuario');
        $clave=$this->input->post('clave');
        //consulta a la bd si los datos usuario y clave son correctos, si lo son devuelve una validacion valida
        if($this->usuario_db->identificacion($usuario,$clave)){
            return true;
        } else {
            $this->form_validation->set_message('validar_usuario', 'usuario/clave incorrectas.');
            return false;
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->index();
    }
    public function rechazo_entrada()
    { 
        $this->load->view('view_Bienvenida');
    }

}