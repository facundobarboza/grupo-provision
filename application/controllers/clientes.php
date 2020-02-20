<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Clientes extends MY_Controller {

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
   * cargar la vista con el listado de clientes
   *
   * @access public
   * @return void
   */
  public function listado($id_elimino=0) {

    // $this->util->dump_exit($elimino);
    // cargamos el modelo
    $this->load->model(array('clientes_model'));

    // obtenemos el recibo de sueldo
    $clientes         = $this->clientes_model->get_by(array('activo' => 1), NULL);
    // $this->util->dump_exit($clientes->result());
    $recibos_validos = array();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $clientes->result() as $row )
    {
      // $this->util->dump_exit($row);

      $clientes_validas[] = array(
        'id_cliente'        => (int)$row->id_cliente,
        'nombre_cliente'    => $row->nombre_cliente,
        'apellido_cliente'  => $row->apellido_cliente,
        'dni_cliente'       => $row->dni_cliente,
        'numero_cliente'    => $row->numero_cliente,
        'id_sindicato_cliente' => $row->id_sindicato_cliente
      );  
    }

    // $this->util->dump_exit($clientes_validas);

    // datos pasados a la vista
    $data = array(
      'clientes'       => $clientes_validas,
      'contenido_view' => 'clientes/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/clientes/listado_view.js'))
    );
    if($id_elimino>0)
    {      
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 5,"log_cliente","id_cliente",$id_elimino);
      $this->session->set_flashdata('exito', 'Se elimino la Empresa con &eacute;xito.');
      redirect('clientes/listado','refresh');    
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
  public function guardarCliente() {

    // cargamos el modelo
    $this->load->model('clientes_model');
    
    // datos pasados al modelo
    $data = array('id_cliente'        => $this->input->post('id_cliente'),
                  'nombre_cliente'    => $this->input->post('nombre_cliente'),
                  'apellido_cliente'  => $this->input->post('apellido_cliente'),
                  'dni_cliente'       => $this->input->post('dni_cliente'),
                  'numero_cliente'    => $this->input->post('numero_cliente'),
                  'id_sindicato_cliente' => $this->input->post('id_sindicato_cliente')
                );
     // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->clientes_model->agregar($data);
    
    if($this->input->post('id_cliente')==0)
    {
      // guardamos el log
      // $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso el Cliente con &eacute;xito.');

    }
    else
    {
      // guardamos el log
      $this->log_model->guardar_log($this->session->userdata('id_usuario'), 6,"log_empresa","id_cliente",$this->input->post('id_cliente'));
      $this->session->set_flashdata('exito', 'Se modifico el Cliente con &eacute;xito.');
      
    }
    redirect('clientes/listado','refresh');
  }


  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function nuevo($id_cliente=0) {
    // cargamos el modelo
    $this->load->model('clientes_model');

    $this->load->helper('form');

    // si es nueva le pasamos estos datos a la vista
    if($id_cliente==0)
    {
      $data = array(
                    // 'usuario'        => $usuario->row(),
                    'contenido_view' => 'clientes/cliente_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array("https://code.jquery.com/jquery-1.12.4.js",
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/clientes/cliente_view.js'))
                    );  
    }
    else
    {
      // obtenemos los datos del usuario
      $clientes = $this->clientes_model->obtenerCliente($id_cliente);

      // $this->util->dump_exit($clientes->row());
      $data = array(
                    'clientes'        => $clientes,
                    'contenido_view' => 'clientes/cliente_view',
                    'css'            => array('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'),
                    'js'             => array("https://code.jquery.com/jquery-1.12.4.js",
                                              "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                                              base_url('assets/js/clientes/cliente_view.js'))
                    ); 
    }    

    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Descargar el recibo de sueldo solicitado
   *
   * @access public
   * @param  integer $id_liquidacion
   * @return void
   */
  public function descargar($id_liquidacion = NULL) {
    // si la liquidacion es un valor numerico
    if( !is_null($id_liquidacion) && is_numeric($id_liquidacion) )
    {
      // cargamos el modelo
      $this->load->model(array('recibo_sueldo_model'));

      // obtenemos el recibo de sueldo
      $recibo = $this->recibo_sueldo_model->get_by(array('id_liquidacion' => $id_liquidacion,'id_legajo' => $this->session->userdata('id_legajo')));

      // Util::dump_exit($recibo->row());

      // si no hubo errores al comprobar el recibo de sueldo
      if( $recibo !== FALSE )
      {
        // si existe la liquidacion solicitada
        if( $recibo->num_rows() )
        {
          // si es el ultimo recibo de sueldo y no esta confirmado
          if( $this->recibo_sueldo_model->esUltima($this->session->userdata('id_legajo'), $id_liquidacion) && !$this->recibo_sueldo_model->estaConfirmado($this->session->userdata('id_legajo'), $id_liquidacion) )
          {
            $this->session->set_flashdata('error', 'El Recibo de Sueldo solicitado no existe.');

            redirect('recibo_sueldo/listado');
          }
          // puede descargar el recibo de sueldo
          else
          {
            $path = '';

            // si existe el pdf firmado
            if( file_exists(RECIBOS_DIR.$recibo->row()->agno.DIRECTORY_SEPARATOR.$recibo->row()->periodo.DIRECTORY_SEPARATOR.$id_liquidacion.'_firmado.pdf') )
            {
              $path = RECIBOS_DIR.$recibo->row()->agno.DIRECTORY_SEPARATOR.$recibo->row()->periodo.DIRECTORY_SEPARATOR.$id_liquidacion.'_firmado.pdf';
            }
            else
              // si existe el pdf aun no firmado
              if( file_exists(RECIBOS_DIR.$recibo->row()->agno.DIRECTORY_SEPARATOR.$recibo->row()->periodo.DIRECTORY_SEPARATOR.$id_liquidacion.'.pdf') )
              {
                $path = RECIBOS_DIR.$recibo->row()->agno.DIRECTORY_SEPARATOR.$recibo->row()->periodo.DIRECTORY_SEPARATOR.$id_liquidacion.'.pdf';
              }
              else
              {
                $this->session->set_flashdata('error', 'El Recibo de Sueldo solicitado no existe.');

                redirect('recibo_sueldo/listado');
              }

            // guardamos el log
            $this->log_model->guardar($this->session->userdata('id_legajo'), 4);

            // cargamos el helper
            $this->load->helper('download');

            $r_jpg = $this->generarJPG($path);

            // si no hubo un error al generar la imagen del recibo
            if( !$r_jpg['error'] )
            {
              $datos  = $r_jpg['data'];
              $nombre = 'recibo_sueldo_'.$recibo->row()->periodo.'-'.$recibo->row()->agno.'.jpg';
            }
            else
            {
              $datos  = file_get_contents($path);
              $nombre = 'recibo_sueldo_'.$recibo->row()->periodo.'-'.$recibo->row()->agno.'.pdf';
            }

            force_download($nombre, $datos);
          }
        }
        else
        {
          $this->session->set_flashdata('error', 'El Recibo de Sueldo solicitado no existe.');

          redirect('recibo_sueldo/listado');
        }
      }
      else
      {
        $this->session->set_flashdata('error', 'Hubo un error al obtener su Recibo de Sueldo. Int&eacute;ntelo m&aacute;s tarde.');

        redirect('recibo_sueldo/listado');
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'El Recibo de Sueldo solicitado no existe.');

      redirect('recibo_sueldo/listado');
    }
  }

  // --------------------------------------------------------------------

  /**
   * Generar la imagen JPG del PDF solicitado
   *
   * @access private
   * @param  string $path
   * @return array
   */
  private function generarJPG($path = '') {
    $r = array('error' => 0, 'mensaje' => '', 'data' => '');

    // si la extension para generar la imagen esta cargada
    if( extension_loaded('imagick') )
    {
      $page = 0;

      // instanciamos la clase
      $imagick = new Imagick();

      // establecemos la resolucion, debe ser llamada antes de cargar/crear la imagen
      if( (@$imagick->setResolution(400, 400)) === FALSE )
      {
        $r['error']   = 1;
        $r['mensaje'] = 'Error: setResolution()';
      }
      // se pudo establecer la resolucion
      else
      {
        // leemos la pagina solicitada del pdf
        if( (@$imagick->readImage($path.'['.$page.']')) === FALSE )
        {
          $r['error']   = 1;
          $r['mensaje'] = 'Error: readImage()';
        }
        // se pudo leer la imagen
        else
        {
          // establecemos el formato
          if( (@$imagick->setImageFormat('jpg')) === FALSE )
          {
            $r['error']   = 1;
            $r['mensaje'] = 'Error: setImageFormat()';
          }
          // se pudo establecer el formato
          else
          {
            $r['data'] = $imagick;
          }
        }
      }
    }
    else
    {
      $r['error']   = 1;
      $r['mensaje'] = 'La extensi&oacute;n imagick no est&aacute; cargada.';
    }

    return $r;
  }

// --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function eliminar($id_cliente=0) {
    // cargamos el modelo
    $this->load->model('clientes_model');

    $this->load->helper('form');

    // obtenemos las clientes
    $this->clientes_model->eliminar($id_cliente);

     // $this->util->dump_exit($clientes_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


}

/* Fin del archivo clientes.php */
/* Ubicacion: ./application/controllers/clientes.php */