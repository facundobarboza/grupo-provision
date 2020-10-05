<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Opticas extends MY_Controller {

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
   * cargar la vista con el listado de optica
   *
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    // cargamos el modelo
    $this->load->model(array('optica_model'));

  // echo "entro";exit;
    $optica = $this->optica_model->obtenerOpticas();
    // $this->util->dump_exit($optica->result());    
  
    foreach( $optica->result() as $row )
    {
      $optica_validas[] = array( 'id_optica'            => (int)$row->id_optica,
                                'descripcion'      => $row->descripcion
                                  );  
    }
    // $this->util->dump_exit($empresas_validas);

    // datos pasados a la vista
    $data = array(
      'opticas'       => $optica_validas,
      'contenido_view' => 'opticas/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/opticas/listado_view.js'))
    );

    if($elimino==1)
    { 
      $this->session->set_flashdata('exito', 'Se elimino la optica con &eacute;xito.');
      redirect('opticas/listado','refresh');    
    }
    else
      $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Guardar una optica
   *
   * @access public
   * @return void
   */
  public function guardarOptica() {

    // cargamos el modelo
    $this->load->model('optica_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_optica'            => $this->input->post('id_optica'),
                  'descripcion'      => $this->input->post('nombre_optica')
                );
    // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->optica_model->agregar($data);

    //si guardamos una nueva optica
    if($this->input->post('id_optica')==0)
    {
      
      $this->session->set_flashdata('exito', 'Se ingreso una optica con &eacute;xito.');  
      redirect('opticas/nuevoOptica/','refresh');
    }
    else
    {
      $this->session->set_flashdata('exito', 'Se modifico la optica ID - '.$id_optica.' con &eacute;xito.');
      redirect('opticas/nuevoOptica/'.$this->input->post('id_optica'),'refresh');
    }
    
    
  }

  // --------------------------------------------------------------------

  // --------------------------------------------------------------------

  /**
   * Cargar nueva optica
   *
   * @access public
   * @return void
   */
  public function nuevoOptica($id_optica=0) {
    // cargamos el modelo
    $this->load->model('optica_model');

    $this->load->helper('form');

    // si es nueva le pasamos estos datos a la vista
    if($id_optica==0)
    {
      // $this->util->dump_exit($usuarios_validas);
      $data = array(
                    'contenido_view' => 'opticas/optica_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/opticas/optica_view.js'),
                                        "https://code.jquery.com/ui/1.12.1/jquery-ui.js")
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      //obtenemos el detalle del optica 
      $optica   = $this->optica_model->obtenerDetalle($id_optica);
      
      // $this->util->dump_exit($optica->row());
      $data = array('nombre_optica'  => $optica->row()->descripcion,
                    'id_optica'      => $optica->row()->id_optica,
                    'contenido_view' => 'opticas/optica_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/opticas/optica_view.js'),
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
  public function eliminar($id_optica=0) {
    // cargamos el modelo
    $this->load->model('optica_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->optica_model->eliminar($id_optica);
     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo optica.php */
/* Ubicacion: ./application/controllers/optica.php */