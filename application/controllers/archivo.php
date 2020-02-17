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
    $archivos = $this->archivo_model->obtenerArchivos();    
  
    // recorremos las liquidaciones del usuario obtenidas
    foreach( $archivos->result() as $row )
    {     

      $archivos_validos[] = array('id_archivo'          => (int)$row->id_archivo,
                                  'id_empresa'          => (int)$row->id_empresa,
                                  'id_departamento'     => (int)$row->id_departamento,
                                  'id_sub_departamento' => (int)$row->id_sub_departamento,
                                  'nombre_archivo'  => $row->nombre_archivo,
                                  'observacion'     => $row->observacion,
                                  'fecha_vigencia'  => $row->fecha_vigencia,
                                  'nombre_empresa'  => $row->nombre_empresa,
                                  'departamento'    => $row->departamento,
                                  'sub_departamento'=> $row->sub_departamento,
                                  'ruta'            => $row->ruta
                                  );  
    }

    // $this->util->dump_exit($empresas_validas);
    //si es un usuario normal lo enviamos a otro listado
    if($this->session->userdata('id_rol')==3)
    {
      $contenido= "archivo/listado_archivos_usuario";
       // cargamos el modelo
      $this->load->model(array('alerta_model'));

      // obtenemos las alertas para este usuario
      $alertas = $this->alerta_model->obtenerAlertasUsuario();    

      foreach( $alertas->result() as $row )
      {     
        $alertas_validas[] = array('id_alerta' => (int)$row->id_alerta,
                                    'mensaje'   => $row->mensaje
                                    );  
      }
    }
    else
    {
      $contenido = "archivo/listado_view";
      $alertas_validas [] = array();
    }
    // datos pasados a la vista
    $data = array(
      'archivos'       => $archivos_validos,
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
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
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

    $this->load->helper('path');
    
    // $this->util->dump_exit($this->input->post());

    $id_empresa          = $this->input->post('select_empresa');
    $id_departamento     = $this->input->post('select_departamento');
    $id_sub_departamento = $this->input->post('select_sub_departamento');

    $cookie_empresa = array( 'name'   => 'id_empresa',
                              'value'  => $id_empresa,
                              'expire' => '3600'
                            );
    $this->input->set_cookie($cookie_empresa);

    $cookie_departamento = array( 'name'   => 'id_departamento',
                                  'value'  => $id_departamento,
                                  'expire' => '3600'
                                );

    $this->input->set_cookie($cookie_departamento);

    $cookie_sub_departamento = array( 'name'   => 'id_sub_departamento',
                                      'value'  => $id_sub_departamento,
                                      'expire' => '3600'
                                     );
    $this->input->set_cookie($cookie_sub_departamento);

    // $ruta = base_url('uploads/');
    // $ruta = "/www/celoma/uploads/".$id_empresa."/";
    $ruta = "uploads/".$id_empresa."/";
  
    $dir  = set_realpath($ruta);  

    //SI no existe la carpeta de la empresa
    if(!is_dir($dir))
    {  
      mkdir($dir);
      // chmod($dir,755);    
    } 

    //Creamos la carpeta con el departamento
    $ruta .= $id_departamento."/";
    $dir  = set_realpath($ruta);  

    if(!is_dir($dir))
    {  
      mkdir($dir);
      // chmod($dir,755);
    } 

    //Creamos la carpeta con el sub-departamento
    $ruta .=$id_sub_departamento."/";
    $dir  = set_realpath($ruta);  
// $this->util->dump_exit($dir);
    if(!is_dir($dir))
    {  
      mkdir($dir);
      // chmod($dir,755);
      
    } 
    // chmod($dir,777);
    // $this->util->dump_exit($dir);
    //Ruta donde se guardan los ficheros
    // $config['upload_path'] =  base_url('uploads/');
    $config['upload_path'] =  $dir;
    // $this->util->dump_exit($this->input->post());
    //Tipos de ficheros permitidos
    $config['allowed_types'] = 'pdf|jpg|png';
    $config['max_size']      = '30720';//30 megas
    $config['max_width']     = '1920';
    $config['max_height']    = '1080';
   //Se pueden configurar aun mas parámetros.
   //Cargamos la librería de subida y le pasamos la configuración 
    $this->load->library('upload', $config);

    if(!$this->upload->do_upload())
    {
      /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
      $error = array('error' => $this->upload->display_errors());

      $this->session->set_flashdata('error', $error); 

      $this->util->dump_exit($this->upload);
    }
    else
    {
      //Datos del fichero subido
      $datos["img"] = $this->upload->data();

      $file_name    = $datos["img"]["file_name"];
      $full_path    = $datos["img"]["full_path"];
      $file_size    = $datos["img"]["file_size"];
      $image_width  = $datos["img"]["image_width"];
      $image_height = $datos["img"]["image_height"];
      $file_ext     = $datos["img"]["file_ext"];
      $file_type    = $datos["img"]["file_type"];

      // Podemos acceder a todas las propiedades del fichero subido 
      // $datos["img"]["file_name"]);
      // $this->util->dump_exit($datos);

      // cargamos el modelo
      $this->load->model('archivo_model');
      
      // datos pasados al modelo
      $data = array(
                    'id_archivo'          => $this->input->post('id_archivo'),
                    'id_sub_departamento' => $this->input->post('select_sub_departamento'),
                    'observacion'         => $this->input->post('observacion'),
                    'fecha_vigencia'      => $this->input->post('fecha_vigencia'),
                    'nombre_archivo'      => $file_name,
                    'ruta'                => $full_path,
                    'size'                => $file_size,
                    'ancho'               => $image_width,
                    'largo'               => $image_height,
                    'file_ext'            => $file_ext,
                    'tipo'                => $file_type
                  );
      // $this->util->dump_exit($data);
       //guardamos los datos de la empresa 
      $this->archivo_model->agregar($data);
        

      //si guardamos un nuevo departamento
      if($this->input->post('id_archivo')==0)
      {
        // guardamos el log
        $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
        $this->session->set_flashdata('exito', 'Se ingreso el archivo con &eacute;xito.');  
      }
      else
      {
        // guardamos el log
        $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
        $this->session->set_flashdata('exito', 'Se modifico el archivo con &eacute;xito.');
      }
      
      redirect('archivo/nuevo','refresh');
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
  public function nuevo($id_archivo=0,$elimino=0) {
    // cargamos el modelo
    $this->load->model('sindicatos_model');
    $this->load->model('archivo_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $empresas = $this->sindicatos_model->obtenerEmpresa();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $empresas->result() as $row )
    {     

      $empresas_validas[] = array('id_empresa' => (int)$row->id_empresa,
                                  'nombre_empresa'  => $row->nombre_empresa
                                  );  
    }

    // obtenemos las empresas
    $archivos = $this->archivo_model->obtenerArchivosDelDia();

    // $this->util->dump_exit($empresas->row());

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $archivos->result() as $row )
    {     

      $archivos_validos[] = array('id_archivo'          => (int)$row->id_archivo,
                                  'id_empresa'          => (int)$row->id_empresa,
                                  'id_departamento'     => (int)$row->id_departamento,
                                  'id_sub_departamento' => (int)$row->id_sub_departamento,
                                  'nombre_archivo'  => $row->nombre_archivo,
                                  'observacion'     => $row->observacion,
                                  'fecha_vigencia'  => $row->fecha_vigencia,
                                  'nombre_empresa'  => $row->nombre_empresa,
                                  'departamento'    => $row->departamento,
                                  'sub_departamento'=> $row->sub_departamento,
                                  'ruta'            => $row->ruta
                                  );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_archivo==0)
    {
      // $this->util->dump_exit($empresas->row());
      $data = array('archivos_dia'   => $archivos_validos,
                    'empresas'       => $empresas_validas,
                    'contenido_view' => 'archivo/archivo_view',
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
      $archivos = $this->archivo_model->obtenerArchivo($id_archivo);
  
      // $this->util->dump_exit($sindicatos->row());
      $data = array('archivos'       => $archivos,
                    'empresas'       => $empresas_validas,
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
  public function eliminar($id_archivo=0) {
    // cargamos el modelo
    $this->load->model('archivo_model');

    $this->load->helper('form');

    $this->archivo_model->eliminar($id_archivo);
    
    // $this->load->view('iframe_view', $data);
  }
  // --------------------------------------------------------------------

}

/* Fin del archivo archivo.php */
/* Ubicacion: ./application/controllers/archivo.php */