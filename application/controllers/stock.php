<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Stock extends MY_Controller {

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
   * cargar la vista con el listado de stock
   *
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    // cargamos el modelo
    $this->load->model(array('stock_model'));

    // obtenemos el recibo de sueldo
    $stock = $this->stock_model->obtenerAlertas();
    // $this->util->dump_exit($stock->result());    
  
    foreach( $stock->result() as $row )
    {
      $stock_validas[] = array( 'id_stock'     => (int)$row->id_stock,
                                  'nombre'        => $row->apellido.", ".$row->nombre,
                                  'mensaje'       => $row->mensaje,
                                  'fecha_mensaje' => $row->fecha_mensaje
                                  );  
    }
    // $this->util->dump_exit($empresas_validas);

    // datos pasados a la vista
    $data = array(
      'stock'       => $stock_validas,
      'contenido_view' => 'stock/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/stock/listado_view.js'))
    );

    if($elimino==1)
    {      
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se elimino la stock con &eacute;xito.');
      redirect('stock/listado','refresh');    
    }
    else
      $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Guardar una stock
   *
   * @access public
   * @return void
   */
  public function guardarAlerta() {

    // cargamos el modelo
    $this->load->model('stock_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_stock'       => $this->input->post('id_stock'),
                  'id_usuario'      => $this->input->post('select_usuario'),
                  'fecha_mensaje'   => $this->input->post('fecha_mensaje'),
                  'mensaje'         => $this->input->post('mensaje')
                );
    
     //guardamos los datos de la empresa 
    $this->stock_model->agregar($data);
     
    // $this->util->dump_exit($data);

    //si guardamos una nueva stock
    if($this->input->post('id_stock')==0)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso la Alerta con &eacute;xito.');  
      redirect('stock/nuevaAlerta/','refresh');
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se modifico la Alerta con &eacute;xito.');
      redirect('stock/nuevaAlerta/'.$this->input->post('id_stock'),'refresh');
    }
    
    
  }

  // --------------------------------------------------------------------

  // --------------------------------------------------------------------

  /**
   * Cargar nueva stock
   *
   * @access public
   * @return void
   */
  public function nuevoStock($id_stock=0) {
    // cargamos el modelo
    $this->load->model('stock_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $usuarios = $this->stock_model->obtenerUsuarios();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $usuarios->result() as $row )
    {     

      $usuarios_validas[] = array('id_usuario' => (int)$row->id_usuario,
                                  'nombre'     => $row->nombre,
                                  'apellido'   => $row->apellido
                                  );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_stock==0)
    {
      // $this->util->dump_exit($usuarios_validas);
      $data = array(
                    'usuarios'       => $usuarios_validas,
                    'contenido_view' => 'stock/stock_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/stock/stock_view.js'),
                                        "https://code.jquery.com/ui/1.12.1/jquery-ui.js")
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      $stock = $this->stock_model->obtenerDetalleAlerta($id_stock);
  
      // $this->util->dump_exit($stock);
      $data = array('usuarios'           => $usuarios_validas,
                    'fecha_mensaje'      => $stock->row()->fecha_mensaje,
                    'mensaje'            => $stock->row()->mensaje,
                    'id_usuario'         => $stock->row()->id_usuario,
                    'id_stock'          => $id_stock,
                    'contenido_view'     => 'stock/stock_view',
                    'css'                => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'                 => array(base_url('assets/js/stock/stock_view.js'),
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
  public function eliminar($id_stock=0) {
    // cargamos el modelo
    $this->load->model('stock_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->stock_model->eliminar($id_stock);

     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo stock.php */
/* Ubicacion: ./application/controllers/stock.php */