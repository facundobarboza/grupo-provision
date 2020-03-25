<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Sindicatos extends MY_Controller {

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
   * cargar la vista con el listado de sindicatos
   *
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    // cargamos el modelo
    $this->load->model(array('sindicatos_model'));

    // obtenemos lso sindicatos
    $sindicatos  = $this->sindicatos_model->obtenerSindicatos();
    // $this->util->dump_exit($sindicatos->result());
    
  
    foreach( $sindicatos->result() as $row )
    {     

      $sindicatos_validos[] = array('id_sindicato' => (int)$row->id_sindicato,
                                  'descripcion'     => $row->descripcion
                                  );  
    }

    // $this->util->dump_exit($sindicatos_validas);

    // datos pasados a la vista
    $data = array(
      'sindicatos'       => $sindicatos_validos,
      'contenido_view' => 'sindicatos/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/sindicatos/listado_view.js'))
    );

    if($elimino==1)
    {      
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se elimino el sindicato con &eacute;xito.');
      redirect('sindicatos/listado','refresh');    
    }
    else
      $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Actualizar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function guardarSindicato() {

    // cargamos el modelo
    $this->load->model('sindicatos_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_sindicato'=> $this->input->post('id_sindicato'),
                  'nombre_sindicato'=> $this->input->post('nombre_sindicato')
                );
    
     //guardamos los datos de la empresa 
    $this->sindicatos_model->agregar($data);
     
    // $this->util->dump_exit($data);

    //si guardamos un nuevo sindicato
    if($this->input->post('id_sindicato')==0)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso el Sindicato con &eacute;xito.');  
      redirect('sindicatos/nuevoSindicato/','refresh');
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se modifico el Sindicato con &eacute;xito.');
      redirect('sindicatos/nuevoSindicato/'.$this->input->post('id_sindicato'),'refresh');
    }
    
    
  }

  // --------------------------------------------------------------------

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function nuevoSindicato($id_sindicato=0) {
    // cargamos el modelo
    $this->load->model('sindicatos_model');

    $this->load->helper('form');

    // si es nueva le pasamos estos datos a la vista
    if($id_sindicato==0)
    {
      // $this->util->dump_exit($sindicatos->row());
      $data = array(
                    'contenido_view' => 'sindicatos/sindicato_view',
                    'js'             => array(base_url('assets/js/sindicatos/sindicato_view.js'))
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      $sindicatos = $this->sindicatos_model->obtenerSindicato($id_sindicato);
  
      // $this->util->dump_exit($sindicatos->row());
      $data = array('id_sindicato'    => $sindicatos->row()->id_sindicato,
                    'nombre_sindicato'=> $sindicatos->row()->descripcion,
                    'contenido_view'     => 'sindicatos/sindicato_view',
                    'js'                 => array(base_url('assets/js/sindicatos/sindicato_view.js'))
                    ); 
    }    

    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

   /**
   *
   * @access public
   * @return void
   */
  public function eliminar($id_sindicato=0) {
    // cargamos el modelo
    $this->load->model('sindicatos_model');

    $this->load->helper('form');

    // obtenemos las sindicatos
    $this->sindicatos_model->eliminar($id_sindicato);

     // $this->util->dump_exit($sindicatos_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo sindicatos.php */
/* Ubicacion: ./application/controllers/sindicatos.php */