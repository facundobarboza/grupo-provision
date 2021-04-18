<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class archivo extends MY_Controller {

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
    $this->load->model(array('archivo_model'));
    
    $fecha = date("d_m_Y");
    
    to_excel($this->archivo_model->get_excel($fecha_desde,$fecha_hasta,$estado, $id_sindicato), "listado_fichas_".$fecha);
  }
  // --------------------------------------------------------------------

  /**
   * cargar la vista con el listado de archivos
   * @access public
   * @return void
   */
  public function listado($elimino=0) {
    
    $this->load->model('clientes_model');
    $version = date('Ymdhmis');

    if($this->input->post('fecha_desde'))
    {
      $fecha_desde     = Util::fecha_db($this->input->post('fecha_desde'));
      $fecha_hasta     = Util::fecha_db($this->input->post('fecha_hasta'));
      $id_estado       = $this->input->post('estado');
      $id_sindicato    = $this->input->post('select_sindicato');
    }
    else
    {
      $fecha_desde     = date('Y-m-d',strtotime(date('Y-m-d')."- 3 days"));
      $fecha_hasta     = date('Y-m-d');
      $id_estado       = 0;
      $id_sindicato    = 0;

    }

    // cargamos el modelo
    $this->load->model(array('archivo_model'));

    // obtenemos las fichas y el stock minimo
    $fichas   = $this->archivo_model->obtenerFichas($fecha_desde,$fecha_hasta,$id_estado, $id_sindicato);
    $s_minimo = $this->archivo_model->stockMinimo();    
  
    foreach( $fichas->result() as $row )
    {     
      $fichas_validos[] = array(  
                                  'id_ficha'             => $row->id_ficha,
                                  'beneficiario'         => utf8_encode($row->beneficiario),
                                  'nro_cliente'          => $row->nro_cliente,
                                  'optica'               => utf8_encode($row->optica),
                                  'codigo_armazon'       => $row->codigo_armazon,
                                  'color_armazon'        => $row->color_armazon,
                                  'codigo_armazon_cerca' => $row->codigo_armazon_cerca,
                                  'color_armazon_cerca'  => $row->color_armazon_cerca,
                                  'estado'               => $row->estado,
                                  'estado_cerca'         => $row->id_estado_cerca,
                                  'fecha'                => $row->fecha,
                                  'es_casa_central'      => $row->es_casa_central,
                                  'nro_pedido'           => $row->nro_pedido,
                                  'delegacion'           => utf8_encode($row->delegacion),
                                  'sindicato'            => $row->sindicato,
                                  'es_lejos'             => $row->es_lejos,
                                  'nro_pedido_cerca'     => $row->nro_pedido_cerca,
                                  't_desc'               => utf8_encode($row->t_desc),
                                  't_desc_cerca'         => utf8_encode($row->t_desc_cerca),
                                  'fecha_envio'          => $row->fecha_envio,
                                  'fecha_envio_cerca'    => $row->fecha_envio_cerca,
                                  'comentario'          => utf8_encode($row->comentario)
                                  );  
    }

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $s_minimo->result() as $row )
    {    
      $stock_minimo[] = array(  'id_stock'           => $row->id_stock,
                                'codigo_patilla'     => $row->codigo_patilla,
                                'codigo_color'       => $row->codigo_color,
                                'nro_codigo_interno' => $row->nro_codigo_interno
                                  );  
    }

    // $this->util->dump_exit($fichas_validos);
    $sindicatos = $this->clientes_model->obtenerSindicatos();

    foreach( $sindicatos->result() as $row )
    {     
      $sindicatos_validos[] = array('id_sindicato' => (int)$row->id_sindicato,
                                    'descripcion'   => utf8_encode($row->descripcion)
                                    );  
    }

    $contenido = "archivo/listado_view";
    // datos pasados a la vista
    $data = array('stock_minimo'    => $stock_minimo,
                  'fichas'          => $fichas_validos,
                  'alertas'         => $alertas_validas,
                  'fecha_desde'     => Util::fecha($fecha_desde),
                  'fecha_hasta'     => Util::fecha($fecha_hasta),
                  'estado'          => $id_estado,
                  'sindicatos'      => $sindicatos_validos,
                  'id_sindicato'    => $id_sindicato,
                  'contenido_view'  => $contenido,
                  'css'             => array(base_url('assets/css/dataTables.bootstrap.css'),
                                                      '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                  'js'              => array(
                                            base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                            base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                            base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                            "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                            base_url('assets/js/archivo/listado_view.js?'.$version))
                );

    if($elimino>0)
    { 
      $mensaje = $elimino==1? "elimino la ficha": "cambio el estado de las fichas a enviado";
      $this->session->set_flashdata('exito', 'Se '.$mensaje.' con &eacute;xito.');
      redirect('archivo/listado','refresh');    
    }
    else
    {
      $this->load->view('iframe_view', $data);
    }

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
    $beneficiario          = $this->input->post("filtro_cliente");
    $id_delegacion         = $this->input->post("id_delegacion");
    $id_optica             = $this->input->post("id_optica");
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
    $es_lejos              = $this->input->post("select_tipo");
    $adicional             = $this->input->post("adicional");
    $descripcion_adicional = $this->input->post("descripcion_adicional");
    $telefono              = $this->input->post("telefono");
    $costo_adicional       = $this->input->post("costo_adicional");
    $sena_adicional        = $this->input->post("sena_adicional");
    $saldo_adicional       = $this->input->post("saldo_adicional");
    $id_sindicato          = $this->input->post("id_sindicato");
    $id_cliente            = $this->input->post("id_cliente");
    $id_stock              = $this->input->post("id_stock");
    $nro_cliente           = $this->input->post("nro_cliente");
    $es_casa_central       = $this->input->post("es_casa_central");
    $titular               = $this->input->post("titular");
    $codigo_armazon_cerca  = $this->input->post("codigo_armazon_cerca");
    $color_armazon_cerca   = $this->input->post("color_armazon_cerca");
    $id_stock_cerca        = $this->input->post("id_stock_cerca");
    $grad_od_esf_cerca     = $this->input->post("grad_od_esf_cerca");
    $grad_od_cil_cerca     = $this->input->post("grad_od_cil_cerca");
    $eje_od_cerca          = $this->input->post("eje_od_cerca");
    $grad_oi_esf_cerca     = $this->input->post("grad_oi_esf_cerca");
    $grad_oi_cil_cerca     = $this->input->post("grad_oi_cil_cerca");
    $eje_oi_cerca          = $this->input->post("eje_oi_cerca");
    $id_estado_cerca       = $this->input->post("id_estado_cerca");
    $voucher_cerca         = $this->input->post("voucher_cerca");
    $nro_pedido_cerca      = $this->input->post("nro_pedido_cerca");
    $fecha_envio           = $this->input->post("fecha_envio");
    $tipo_lente            = ($es_lejos==2)? '0' : $this->input->post("tipo_lente");
    $fecha_envio_cerca     = $this->input->post("fecha_envio_cerca");
    $tipo_lente_cerca      = ($es_lejos==2)? $this->input->post("tipo_lente_cerca") : '0';
    $costo_adicional_cerca = $this->input->post("costo_adicional_cerca");
    $adicional_cerca       = $this->input->post("adicional_cerca");
    $laboratorio           = $this->input->post("laboratorio");
    $laboratorio_cerca     = $this->input->post("laboratorio_cerca");

    // cargamos el modelo
    $this->load->model('archivo_model');
    
    // datos pasados al modelo
    $data = array('id_ficha'                => $id_ficha,
                    'beneficiario'          => $beneficiario,
                    'id_delegacion'         => $id_delegacion,
                    'id_optica'             => $id_optica,
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
                    'sena_adicional'       => $sena_adicional,
                    'saldo_adicional'      => $saldo_adicional,
                    'id_sindicato'         => $id_sindicato,
                    'id_cliente'           => $id_cliente,
                    'id_stock'             => $id_stock,
                    'nro_cliente'          => $nro_cliente,
                    'es_casa_central'      => $es_casa_central,
                    'titular'              => $titular,
                    'codigo_armazon_cerca' => $codigo_armazon_cerca,
                    'color_armazon_cerca'  => $color_armazon_cerca,
                    'id_stock_cerca'       => $id_stock_cerca,
                    'grad_od_esf_cerca'    => $grad_od_esf_cerca,
                    'grad_od_cil_cerca'    => $grad_od_cil_cerca,
                    'eje_od_cerca'         => $eje_od_cerca,
                    'grad_oi_esf_cerca'    => $grad_oi_esf_cerca,
                    'grad_oi_cil_cerca'    => $grad_oi_cil_cerca,
                    'eje_oi_cerca'         => $eje_oi_cerca,
                    'id_estado_cerca'      => $id_estado_cerca,
                    'voucher_cerca'        => $voucher_cerca,
                    'nro_pedido_cerca'     => $nro_pedido_cerca,
                    'fecha_envio'          => $fecha_envio,
                    'tipo_lente'           => $tipo_lente,
                    'fecha_envio_cerca'    => $fecha_envio_cerca,
                    'tipo_lente_cerca'     => $tipo_lente_cerca,
                    'laboratorio'          => $laboratorio,
                    'laboratorio_cerca'    => $laboratorio_cerca,
                    'adicional_cerca'      => $adicional_cerca,
                    'costo_adicional_cerca'=> $costo_adicional_cerca

                    );
    // $this->util->dump_exit($data);
    $this->archivo_model->agregar($data);    

    if($this->input->post('id_ficha')==0)
    {
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 4,"log_fichas","id_ficha",0);
      $this->session->set_flashdata('exito', 'Se ingreso el ficha con &eacute;xito.');  
      redirect(site_url('archivo/nuevo/0/0/1'),'refresh');
    }
    else
    {
     // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 6,"log_fichas","id_ficha",$this->input->post('id_ficha'));
      $this->session->set_flashdata('exito', 'Se modifico la ficha ID '.$id_ficha.' con &eacute;xito.');
      redirect(site_url('archivo/nuevo/'.$id_ficha.'/0/1'),'refresh');
    }
    
  }

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function nuevo($id_ficha=0,$elimino=0,$es_casa_central=0) {
    
    $this->load->model('archivo_model');
    $this->load->model('clientes_model');
    $this->load->helper('form');
    $version = date('Ymdhmis');

    $sindicatos = $this->clientes_model->obtenerSindicatos();

    foreach( $sindicatos->result() as $row )
    {     
      $sindicatos_validos[] = array('id_sindicato' => (int)$row->id_sindicato,
                                    'descripcion'   => utf8_encode($row->descripcion)
                                    );  
    }

    $delegaciones = $this->clientes_model->obtenerDelegaciones();

    foreach( $delegaciones->result() as $row )
    {     
      $delegaciones_validos[] = array('id_delegacion' => (int)$row->id_delegacion,
                                    'descripcion'   => utf8_encode($row->descripcion)
                                    );  
    }

    $tipo_lentes = $this->archivo_model->obtenerTipoLentes();

    foreach( $tipo_lentes->result() as $row )
    {     
      $tipo_lentes_validos[] = array('id_tipo_lente' => (int)$row->id,
                                    'descripcion'   => utf8_encode($row->descripcion)
                                    );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_ficha==0)
    {
        $opticas = $this->clientes_model->obtenerOpticasDelegacion();

        foreach( $opticas->result() as $row )
        {     
          $opticas_validos[] = array('id_optica' => (int)$row->id_optica,
                                        'descripcion'   => utf8_encode($row->descripcion)
                                        );  
        }
      // $this->util->dump_exit($empresas->row());
      $data = array('es_casa_central' => $es_casa_central,
                    'sindicatos'      => $sindicatos_validos,
                    'delegaciones'    => $delegaciones_validos,
                    'opticas'         => $opticas_validos,
                    'result_tipo_lentes'     => $tipo_lentes_validos,
                    'contenido_view'  => 'archivo/archivo_view',
                    'css'             => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'              => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                              base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                              base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/archivo/archivo_view.js?'.$version))
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
        $opticas = $this->clientes_model->obtenerOpticas();

        foreach( $opticas->result() as $row )
        {     
          $opticas_validos[] = array('id_optica' => (int)$row->id_optica,
                                        'descripcion'   => utf8_encode($row->descripcion)
                                        );  
        }
      $fichas = $this->archivo_model->obtenerFicha($id_ficha);
      $logs   = $this->log_model->get_log("log_fichas","id_ficha",$id_ficha);  
      // $this->util->dump_exit($fichas->row());
      $data = array('es_casa_central' => $es_casa_central,
                    'sindicatos'      => $sindicatos_validos,
                    'delegaciones'    => $delegaciones_validos,
                    'opticas'         => $opticas_validos, 
                    'fichas'          => $fichas,
                    'result_tipo_lentes'     => $tipo_lentes_validos,
                    'logs'            => $logs,
                    'contenido_view'  => 'archivo/archivo_view',
                    'css'             => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'              => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                              base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                              base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/archivo/archivo_view.js?'.$version))
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

   /**
     * autocomplete del beneficiario a la hora de agregar la ficha
     *
     * @access public
     * @return json
     */

  public function autocompleteBeneficiario()
  {    
      $this->load->model('archivo_model');
      $salida = array();
      $term = trim(utf8_decode($this->input->get('term')));
      
      $rResult = $this->archivo_model->autocompleteBeneficiario($term);
      // $this->util->dump_exit($term);
      
        foreach( $rResult->result() as $row )
        {  
          $salida[] = array(  'id'    => $row->id_cliente,
                              'label' => utf8_encode($row->beneficiario_cliente." - Nro ".$row->nro_cliente),
                              'value' => utf8_encode($row->beneficiario_cliente),
                              'nro_cliente' => $row->nro_cliente,
                                'titular_cliente' => $row->titular_cliente);
        }        
      
      header('Content-Type: application/json');
      echo json_encode($salida);  
      exit;
  }

   // --------------------------------------------------------------------

   /**
     * autocomplete del titular a la hora de agregar la ficha
     *
     * @access public
     * @return json
     */

  public function autocompleteArmazon()
  {    
      $this->load->model('archivo_model');
      $salida = array();
      $term = trim(utf8_decode($this->input->get('term')));
      
      $rResult = $this->archivo_model->autocompleteArmazon($term);
      // $this->util->dump_exit($term);
      
        foreach( $rResult->result() as $row )
        {  
          $alerta = 0;
          if($row->cantidad < $row->cantidad_minima && $row->cantidad_minima>0)
          {
            $alerta = $row->cantidad;
          }

          $salida[] = array(  'id'    => $row->id_stock,
                              'label' => utf8_encode($row->nro_codigo_interno."-".$row->letra_color_interno."-".$row->codigo_patilla."-".$row->codigo_color),
                              'value' => utf8_encode($row->nro_codigo_interno."-".$row->letra_color_interno."-".$row->codigo_patilla."-".$row->codigo_color),
                              'descripcion_color' => $row->descripcion_color,
                              'alerta' => $alerta);
        }        
      
      header('Content-Type: application/json');
      echo json_encode($salida);  
      exit;
  }
  
  // --------------------------------------------------------------------

   /**
     * las ultimas dos ventas a este titular
     *
     * @access public
     * @return json
     */

    public function historialVentas()
    {    
        $this->load->model('archivo_model');
        $salida = array();
        $id_cliente = $this->input->post('id_cliente');

        $rResult = $this->archivo_model->historialVentas($id_cliente);
        // $this->util->dump_exit($term);
        $contenido = "";
      
        foreach( $rResult->result() as $row )
        {  
            switch ($row->es_lejos) {
                case '1':
                  $es_lejos = "Lejos";
                  break;
                  case '2':
                  $es_lejos = "Cerca";
                  break;
                  case '3':
                  $es_lejos = "Lejos y cerca";
                  break;
                  case '4':
                  $es_lejos = "Fuera de Prestacion";
                  break;                
                default:
                  $es_lejos = "";
                  break;
            }
            $contenido .= utf8_encode("<tr><td>".$row->sindicato."</td><td>".
                                      $row->estado."</td><td>".
                                      $row->codigo_armazon."</td><td>".
                                      $row->color_armazon."</td><td>".
                                      $this->util->fecha($row->fecha)."</td>
                                      <td>".$es_lejos."</td><tr>");
        }        
      
        echo $contenido;  
        exit;
    } 

    // --------------------------------------------------------------------

   /**
   *
   * @access public
   * @return void
   */
  public function cambiarEstado($id_ficha=0,$fecha_envio) {
    // cargamos el modelo
    $this->load->model('archivo_model');
    
    $this->load->helper('form');
    // $this->util->dump_exit($id_ficha);
        
    $this->archivo_model->cambiarEstado($id_ficha,$fecha_envio);
    // guardamos el log
    //$this->log_model->guardar_log($this->session->userdata('id_usuario'), 5,"log_fichas","id_ficha",$id_ficha);
    
    // $this->load->view('iframe_view', $data);
  }

}

/* Fin del archivo archivo.php */
/* Ubicacion: ./application/controllers/archivo.php */