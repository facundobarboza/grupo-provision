<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Delegacion extends MY_Controller {

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
   * cargar la vista con el listado de delegacion
   *
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    // cargamos el modelo
    $this->load->model(array('delegacion_model'));

  // echo "entro";exit;
    $delegacion = $this->delegacion_model->obtenerDelegacions();
    // $this->util->dump_exit($delegacion->result());    
  
    foreach( $delegacion->result() as $row )
    {
      $delegacion_validas[] = array( 'id_delegacion'            => (int)$row->id_delegacion,
                                'descripcion'      => $row->descripcion
                                  );  
    }
    // $this->util->dump_exit($delegacion_validas);

    // datos pasados a la vista
    $data = array(
      'delegaciones'       => $delegacion_validas,
      'contenido_view' => 'delegaciones/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/delegaciones/listado_view.js'))
    );

    if($elimino==1)
    { 
      $this->session->set_flashdata('exito', 'Se elimino la delegacion con &eacute;xito.');
      redirect('delegacion/listado','refresh');    
    }
    else
      $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Guardar una delegacion
   *
   * @access public
   * @return void
   */
  public function guardarDelegacion() {

    // cargamos el modelo
    $this->load->model('delegacion_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_delegacion' => $this->input->post('id_delegacion'),
                  'descripcion'   => $this->input->post('nombre_delegacion')
                );
    // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->delegacion_model->agregar($data);

    //si guardamos una nueva delegacion
    if($this->input->post('id_delegacion')==0)
    {
      
      $this->session->set_flashdata('exito', 'Se ingreso una delegación con &eacute;xito.');  
      redirect('delegacion/nuevoDelegacion/','refresh');
    }
    else
    {
      
      $this->session->set_flashdata('exito', 'Se modifico una delegación ID - '.$id_delegacion.' con &eacute;xito.');
      redirect('delegacion/listado/','refresh');
    }
    
    
  }

  // --------------------------------------------------------------------

  // --------------------------------------------------------------------

  /**
   * Cargar nueva delegacion
   *
   * @access public
   * @return void
   */
  public function nuevoDelegacion($id_delegacion=0) {
    // cargamos el modelo
    $this->load->model('delegacion_model');

    $this->load->helper('form');

    // si es nueva le pasamos estos datos a la vista
    if($id_delegacion==0)
    {
      // $this->util->dump_exit($usuarios_validas);
      $data = array(
                    'contenido_view' => 'delegaciones/delegacion_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/delegaciones/delegacion_view.js'),
                                        "https://code.jquery.com/ui/1.12.1/jquery-ui.js")
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      //obtenemos el detalle del delegacion 
      $delegacion   = $this->delegacion_model->obtenerDetalle($id_delegacion);
      
      // $this->util->dump_exit($delegacion->row());
      $data = array('logs'           => $logs,
                    'nombre_delegacion'          => $delegacion->row()->descripcion,
                    'id_delegacion'       => $delegacion->row()->id_delegacion,
                    'contenido_view' => 'delegaciones/delegacion_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/delegaciones/delegacion_view.js'),
                                                            "https://code.jquery.com/ui/1.12.1/jquery-ui.js"), 
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
  public function eliminar($id_delegacion=0) {
    // cargamos el modelo
    $this->load->model('delegacion_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->delegacion_model->eliminar($id_delegacion);
     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo delegacion.php */
/* Ubicacion: ./application/controllers/delegacion.php */