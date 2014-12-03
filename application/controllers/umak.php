<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umak extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("estanque_db");
        $this->load->model("lectura_db");
        $this->load->model("nivelmaxmin_db");
        $this->load->model("estanque_db");
        $this->load->model("tipomedida_db");
    }
    public function index()
    {
            $this->load->view('welcome_message');
    }

    public function niveles()
    {        
        $this->load->model("nivelmaxmin_db");
        $data['niveles'] = $this->nivelmaxmin_db->getNivelmaxmin();        
        $this->load->view('view_nivelesFisicoquimico',$data);
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
    {        
        
        $data['estanques'] = $this->estanque_db->getEstanques();        
        $this->load->view('view_estanques',$data);
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
        
        $data['lecturas'] = $this->lectura_db->getLecturas();
        $this->load->view('view_graficos',$data);
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
    public function prueba(){
        $jsonData = $this->lectura_db->getLecturas();
        echo json_encode($jsonData);
    }
    public function lectura(){
        
        //$nombre_estanque = $this->input->get('nombre_estanque');
        //$nombre_tipomedida = $this->input->get('nombre_tipomedida');
        $lectura['id_tipomedida']=$this->input->get('id_tipomedida');
        $lectura['id_estanque']=$this->input->get('id_estanque');
        $lectura['fecha_inicio']=$this->input->get('fecha_inicio');
        $lectura['fecha_fin']=$this->input->get('fecha_fin');
        //$lectura['id_estanque']=$this->estanque_db->getIdestanque($nombre_estanque);
        //$lectura['id_tipomedida']=$this->tipomedida_db->getIdtipomedida($nombre_tipomedida);
        //buscar id medida
        //buscar id estanque
        
        $jsonData = $this->lectura_db->getLectura($lectura);
        
        echo json_encode($jsonData);
    }
    
    
    public function login()
    {       
        $this->load->view('login');
    }
}