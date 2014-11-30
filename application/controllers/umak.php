<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umak extends CI_Controller {
    function __construct(){
        parent::__construct();
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
        
       
        $this->load->model("nivelmaxmin_db");
        $this->nivelmaxmin_db->updateNivelmaxmin($data_update);        
        $this->niveles();
        //print_r($data);
    }
    public function estanques()
    {        
        $this->load->model("estanque_db");
        $data['estanques'] = $this->estanque_db->getEstanques();        
        $this->load->view('view_estanques',$data);
        //print_r($data);
    }
    
    public function login()
    {
       
        $this->load->view('login');
    }
}