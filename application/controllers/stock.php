<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Stock extends MY_Controller {

  // --------------------------------------------------------------------

  /**
   * constructor
   */
  public function __construct() {
   date_default_timezone_set('America/Argentina/Buenos_Aires');
    parent::__construct();
    $this->load->helper('mysql_to_excel_helper');
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
   * listamos los archivos en excel
   * @access public
   * @return void
   */

  public function listado_excel($fecha_desde,$fecha_hasta,$id_sindicato,$estado)
  {
    $this->load->model(array('stock_model'));
    
    $fecha = date("d_m_Y");
    
    to_excel($this->stock_model->get_excel(), "listado_stock_".$fecha);
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
    $version = date('Ymdhmis');
  // echo "entro";exit;
    $stock = $this->stock_model->obtenerStocks();
    // $this->util->dump_exit($stock->result());    
  
    foreach( $stock->result() as $row )
    {
      $stock_validas[] = array( 'id_stock'            => (int)$row->id_stock,
                                'codigo_patilla'      => $row->codigo_patilla,
                                'codigo_color'        => $row->codigo_color,
                                'descripcion_color'   => $row->descripcion_color,
                                'nro_codigo_interno'  => $row->nro_codigo_interno,
                                'letra_color_interno' => $row->letra_color_interno,
                                'tipo_armazon'        => $row->tipo_armazon,
                                'material'            => $row->material,
                                'ubicacion'           => $row->ubicacion,
                                'cantidad'            => $row->cantidad,
                                'costo'               => $row->costo,
                                'precio_venta'        => $row->precio_venta
                                  );  
    }
    // $this->util->dump_exit($empresas_validas);

    // datos pasados a la vista
    $data = array(
      'stocks'       => $stock_validas,
      'contenido_view' => 'stock/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/stock/listado_view.js?'.$version))
    );

    if($elimino==1)
    { 
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
  public function guardarStock() {

    // cargamos el modelo
    $this->load->model('stock_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_stock'            => $this->input->post('id_stock'),
                  'codigo_patilla'      => $this->input->post('codigo_patilla'),
                  'codigo_color'        => $this->input->post('codigo_color'),
                  'descripcion_color'   => $this->input->post('descripcion_color'),
                  'nro_codigo_interno'  => $this->input->post('nro_codigo_interno'),
                  'letra_color_interno' => $this->input->post('letra_color_interno'),
                  'id_tipo_armazon'     => $this->input->post('id_tipo_armazon'),
                  'id_material'         => $this->input->post('id_material'),
                  'id_ubicacion'        => $this->input->post('id_ubicacion'),
                  'costo'               => $this->input->post('costo'),
                  'cantidad'            => $this->input->post('cantidad'),
                  'cantidad_minima'     => $this->input->post('cantidad_minima'),
                  'precio_venta'        => $this->input->post('precio_venta')
                );
    // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->stock_model->agregar($data);

    //si guardamos una nueva stock
    if($this->input->post('id_stock')==0)
    {
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'),4,"log_stock","id_stock",0);
      $this->session->set_flashdata('exito', 'Se ingreso un Armazon con &eacute;xito.');  
      redirect('stock/nuevoStock/','refresh');
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'),6,"log_stock","id_stock",$this->input->post('id_stock'));
      $this->session->set_flashdata('exito', 'Se modifico el Armazon ID - '.$id_stock.' con &eacute;xito.');
      redirect('stock/listado/','refresh');
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
    $version = date('Ymdhmis');
    $this->load->helper('form');

    // obtenemos los tipo de armazones
    $tipo_armazon_r = $this->stock_model->obtenerTipoArmazon();
    
    foreach( $tipo_armazon_r->result() as $row )
    {     
      $tipo_armazon[] = array('id_tipo_armazon' => (int)$row->id_tipo_armazon,
                                  'descripcion' => $row->descripcion
                              );  
    }



    // obtenemos los tipo de armazones
    $ubicacion_r = $this->stock_model->obtenerUbicacion();

    foreach( $ubicacion_r->result() as $row )
    {     
      $ubicaciones[] = array('id_ubicacion' => (int)$row->id,
                            'descripcion'     => $row->descripcion
                          );  
    }

    // obtenemos los tipo de armazones
    $material_r = $this->stock_model->obtenerMateriales();

    foreach( $material_r->result() as $row )
    {     
      $materiales[] = array('id_material' => (int)$row->id,
                            'descripcion'     => $row->descripcion
                                  );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_stock==0)
    {
      // $this->util->dump_exit($usuarios_validas);
      $data = array(
                    'tipo_armazon'   => $tipo_armazon,
                    'ubicaciones'      => $ubicaciones,
                    'materiales'       => $materiales,
                    'contenido_view' => 'stock/stock_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/stock/stock_view.js?'.$version),
                                        "https://code.jquery.com/ui/1.12.1/jquery-ui.js")
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      //obtenemos el detalle del stock 
      $stock = $this->stock_model->obtenerDetalle($id_stock);
      $logs     = $this->log_model->get_log("log_stock","id_stock",$id_stock);  
      // $this->util->dump_exit($stock->row());
      $data = array('tipo_armazon'   => $tipo_armazon,
                    'logs'           => $logs,
                    'ubicaciones'    => $ubicaciones,
                    'materiales'     => $materiales,
                    'stock'          => $stock,
                    'id_stock'       => $id_stock,
                    'contenido_view' => 'stock/stock_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/stock/stock_view.js?'.$version),
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
    // guardamos el log
    $this->log_model->guardar_log($this->session->userdata('id_usuario'),5,"log_stock","id_stock",$id_stock);
     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo stock.php */
/* Ubicacion: ./application/controllers/stock.php */