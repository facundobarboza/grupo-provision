<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Status extends MY_Controller {

    // --------------------------------------------------------------------

    /**
    * constructor
    */
    public function __construct() {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
    * cargar la vista principal
    *
    * @access public
    * @return void
    */
    public function index() {
        $this->output->enable_profiler(FALSE);
        $this->load->view('principal_view');
    }

    // --------------------------------------------------------------------
    
    /**
    * Guardar una status
    *
    * @access public
    * @return void
    */
    public function saveStatus() {

        // cargamos el modelo
        $this->load->model('status_model');

        // datos pasados al modelo
        $data = array(
                      'id_status' => $this->input->post('id_status'),
                      'descripcion'   => $this->input->post('nombre_status')
                    );
        // $this->util->dump_exit($data);        
        $this->status_model->agregar($data);

        //si guardamos una nueva status
        if($this->input->post('id_status')==0)
        { 
            $this->session->set_flashdata('exito', 'Se ingreso una delegación con &eacute;xito.');
            redirect('status/newStatus/','refresh');
        }
        else
        {
            $this->session->set_flashdata('exito', 'Se modifico una delegación ID - '.$id_status.' con &eacute;xito.');
            redirect('status/newStatus/'.$this->input->post('id_status'),'refresh');
        }
    }

    // --------------------------------------------------------------------

    /**
    * Add new status
    *
    * @access public
    * @return void
    */
    public function newStatus($id_status=0) {
    
        $this->load->model('status_model');
        $this->load->helper('form');

        //obtenemos el detalle del status 
        //$status   = $this->status_model->getStatus();
        // $this->util->dump_exit($status->row());
        $data = array(  //'status'         => $status,
                        'contenido_view' => 'estados/status_view',
                        'css'            => array(base_url('assets/css/dataTables.bootstrap.css'),
                                                    '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                        'js'             => array(base_url('assets/js/statuses/status_view.js'),
                                                    "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                                    base_url('assets/js/datatable/dataTables.bootstrap.js')), 
                    ); 

        $this->load->view('iframe_view', $data);
    }


    // --------------------------------------------------------------------

    /**
    * cargar la vista con el listado de sindicatos
    *
    * @access public
    * @return void
    */
    public function statusList($elimino=0) {
        // cargamos el modelo
        $this->load->model(array('status_model'));

        // obtenemos lso sindicatos
        $sindicatos  = $this->status_model->getStatusList();
        // $this->util->dump_exit($sindicatos->result());
      
        foreach( $sindicatos->result() as $row )
        {     

          $sindicatos_validos[] = array('id_sindicato' => (int)$row->id_sindicato,
                                      'descripcion'     => utf8_encode($row->descripcion)
                                      );  
        }
        // $this->util->dump_exit($sindicatos_validas);
        // 
        $data = array(
          'sindicatos'       => $sindicatos_validos,
          'contenido_view' => 'sindicatos/listado_view',
          'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
          'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                    base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                    base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                    base_url('assets/js/sindicatos/listado_view.js'))
        );

        $this->load->view('iframe_view', $data);
    }

    // --------------------------------------------------------------------

    /**  
    *
    * @access public
    * @return void
    */
    public function deleteRow($id_status=0) {
        // cargamos el modelo
        $this->load->model('status_model');
        $this->load->helper('form');

        // obtenemos las empresas
        $this->status_model->eliminar($id_status);
         // $this->util->dump_exit($empresas_validas);
    }

    // --------------------------------------------------------------------

    public function updateDelegation() {
        // cargamos el modelo
        $this->load->model('status_model');
        $this->status_model->updateDelegation($id_status);
    }

    public function update() {
        // cargamos el modelo
        $this->load->model('status_model');
        //$this->status_model->updateHomins();
        $this->status_model->updateUtedyc();
    }
}

/* Fin del archivo status.php */
/* Ubicacion: ./application/controllers/status.php */