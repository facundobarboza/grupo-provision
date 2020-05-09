<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class archivo extends MY_Controller {

  // --------------------------------------------------------------------

  /**
   * constructor
   */
  public function __construct() {
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

  public function listado_excel()
  {
    $fecha = date("d_m_Y");
    $this->load->model(array('archivo_model'));
    to_excel($this->archivo_model->get_excel(), "listado_archivos_".$fecha);
  }
  // --------------------------------------------------------------------

  /**
   * cargar la vista con el listado de archivos
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    // cargamos el modelo
    $this->load->model(array('archivo_model'));

    // obtenemos los archivos
    $fichas = $this->archivo_model->obtenerFichas();    
  
    // recorremos las liquidaciones del usuario obtenidas
    foreach( $fichas->result() as $row )
    {     
      $fichas_validos[] = array(
                                  'id_ficha'       => $row->id_ficha,
                                  'beneficiario'   => $row->beneficiario,
                                  'optica'         => $row->optica,
                                  'codigo_armazon' => $row->codigo_armazon,
                                  'color_armazon'  => $row->color_armazon,
                                  'estado'         => $row->estado,
                                  'fecha'          => $row->fecha
                                  );  
    }

    // $this->util->dump_exit($fichas_validos);
    
    $contenido = "archivo/listado_view";
    // datos pasados a la vista
    $data = array(
      'fichas'       => $fichas_validos,
      'alertas'        => $alertas_validas,
      'contenido_view' => $contenido,
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/archivo/listado_view.js'))
    );

    if($elimino==1)
    { 
      $this->session->set_flashdata('exito', 'Se elimino el archivo con &eacute;xito.');
      redirect('archivo/listado','refresh');    
    }
    else
      $this->load->view('iframe_view', $data);

  }

  // --------------------------------------------------------------------

  /**
   
   * @access public
   * @return void
   */
  public function existeArchivo($id_empresa, $id_departamento,$id_sub_departamento,$archivo)
  {
    $this->util->dump_exit($archivo);
    $nombre_fichero = "uploads/".$id_empresa."/".$id_departamento."/".$id_sub_departamento."/";
    if (file_exists($nombre_fichero))
    {

    }
  }

  // --------------------------------------------------------------------

  /**
   
   * @access public
   * @return void
   */
  public function guardarArchivo() {
    
    // $this->util->dump_exit($this->input->post());

    $id_ficha              = $this->input->post("id_ficha");
    $beneficiario          = $this->input->post("beneficiario");
    $delegacion            = $this->input->post("delegacion");
    $optica                = $this->input->post("optica");
    $fecha                 = $this->input->post("fecha");
    $codigo_armazon        = $this->input->post("codigo_armazon");
    $color_armazon         = $this->input->post("color_armazon");
    $estado                = $this->input->post("estado");
    $voucher               = $this->input->post("voucher");
    $nro_pedido            = $this->input->post("nro_pedido");
    $grad_od_esf           = $this->input->post("grad_od_esf");
    $grad_od_cil           = $this->input->post("grad_od_cil");
    $eje_od                = $this->input->post("eje_od");
    $grad_oi_esf           = $this->input->post("grad_oi_esf");
    $grad_oi_cil           = $this->input->post("grad_oi_cil");
    $eje_oi                = $this->input->post("eje_oi");
    $comentario            = $this->input->post("comentario");
    $es_lejos              = $this->input->post("es_lejos");
    $adicional             = $this->input->post("adicional");
    $descripcion_adicional = $this->input->post("descripcion_adicional");
    $telefono              = $this->input->post("telefono");
    $costo_adicional       = $this->input->post("costo_adicional");
    $sena_adicional        = $this->input->post("sena_adicional");
    $saldo_adicional       = $this->input->post("saldo_adicional");

    // cargamos el modelo
    $this->load->model('archivo_model');
    
    // datos pasados al modelo
    $data = array('id_ficha'          => $id_ficha,
                    'beneficiario'          => $beneficiario,
                    'delegacion'            => $delegacion,
                    'optica'                => $optica,
                    'fecha'                 => $fecha,
                    'codigo_armazon'        => $codigo_armazon,
                    'color_armazon'         => $color_armazon,
                    'estado'                => $estado,
                    'voucher'               => $voucher,
                    'nro_pedido'            => $nro_pedido,
                    'grad_od_esf'           => $grad_od_esf,
                    'grad_od_cil'           => $grad_od_cil,
                    'eje_od'                => $eje_od,
                    'grad_oi_esf'           => $grad_oi_esf,
                    'grad_oi_cil'           => $grad_oi_cil,
                    'eje_oi'                => $eje_oi,
                    'comentario'            => $comentario,
                    'es_lejos'              => $es_lejos,
                    'adicional'             => $adicional,
                    'descripcion_adicional' => $descripcion_adicional,
                    'telefono'              => $telefono,
                    'costo_adicional'       => $costo_adicional,
                    'sena_adicional'        => $sena_adicional,
                    'saldo_adicional'       => $saldo_adicional);
    // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->archivo_model->agregar($data);
      

    //si guardamos un nuevo departamento
    if($this->input->post('id_ficha')==0)
    {
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 4,"log_fichas","id_ficha",0);
      $this->session->set_flashdata('exito', 'Se ingreso el ficha con &eacute;xito.');  
      redirect('archivo/nuevo','refresh');
    }
    else
    {
     // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 6,"log_fichas","id_ficha",$this->input->post('id_ficha'));
      $this->session->set_flashdata('exito', 'Se modifico la ficha ID '.$id_ficha.' con &eacute;xito.');
       redirect('archivo/listado','refresh');
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
  public function nuevo($id_ficha=0,$elimino=0) {
    // cargamos el modelo
    
    $this->load->model('archivo_model');

    $this->load->helper('form');

    // si es nueva le pasamos estos datos a la vista
    if($id_ficha==0)
    {
      // $this->util->dump_exit($empresas->row());
      $data = array('contenido_view' => 'archivo/archivo_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                              base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                              base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/archivo/archivo_view.js'))
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      $fichas = $this->archivo_model->obtenerFicha($id_ficha);
      $logs   = $this->log_model->get_log("log_fichas","id_ficha",$id_ficha);  
      // $this->util->dump_exit($sindicatos->row());
      $data = array('fichas'       => $fichas,
                    'logs'         => $logs,
                    'contenido_view' => 'archivo/archivo_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                              base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                              base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/archivo/archivo_view.js'))
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
  public function eliminar($id_ficha=0) {
    // cargamos el modelo
    $this->load->model('archivo_model');

    $this->load->helper('form');

    $this->archivo_model->eliminar($id_ficha);
    // guardamos el log
    $this->log_model->guardar_log($this->session->userdata('id_usuario'), 5,"log_fichas","id_ficha",$id_ficha);
    
    // $this->load->view('iframe_view', $data);
  }
  // --------------------------------------------------------------------

}

/* Fin del archivo archivo.php */
/* Ubicacion: ./application/controllers/archivo.php */