<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Recibo_sueldo extends MY_Controller {

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
   * cargar la vista con el listado de recibos
   *
   * @access public
   * @return void
   */
  public function listado() {
    // cargamos el modelo
    $this->load->model(array('recibo_sueldo_model'));

    // obtenemos el recibo de sueldo
    $recibos         = $this->recibo_sueldo_model->get_by(array('id_legajo' => $this->session->userdata('id_legajo')), NULL);
    // $this->util->dump_exit($recibos);
    $recibos_validos = array();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $recibos->result() as $row )
    {
      // si no existe el recibo de sueldo en formato pdf
      // firmado o no
      if(
        !file_exists(RECIBOS_DIR.$row->agno.DIRECTORY_SEPARATOR.$row->periodo.DIRECTORY_SEPARATOR.$row->id_liquidacion.'_firmado.pdf')
        &&
        !file_exists(RECIBOS_DIR.$row->agno.DIRECTORY_SEPARATOR.$row->periodo.DIRECTORY_SEPARATOR.$row->id_liquidacion.'.pdf')
        )
        continue;

      $confirmado = FALSE;
      $es_ultimo  = FALSE;

      // si es el ultimo recibo de sueldo
      if( $this->recibo_sueldo_model->esUltima($this->session->userdata('id_legajo'), $row->id_liquidacion) )
      {
        $es_ultimo = TRUE;

        $confirmado = $this->recibo_sueldo_model->estaConfirmado($this->session->userdata('id_legajo'), $row->id_liquidacion);
      }

      // $this->util->dump_exit($row);

      $recibos_validos[] = array(
        'id_liquidacion' => (int)$row->id_liquidacion,
        'periodo'        => (int)$row->periodo,
        'agno'           => (int)$row->agno,
        'es_ultimo'      => $es_ultimo,
        'confirmado'     => $confirmado
      );
    }

    // $this->util->dump_exit($recibos_validos);

    // datos pasados a la vista
    $data = array(
      'recibos'        => $recibos_validos,
      'contenido_view' => 'recibo_sueldo/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/recibo_sueldo/listado_view.js'))
    );

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

}

/* Fin del archivo recibo_sueldo.php */
/* Ubicacion: ./application/controllers/recibo_sueldo.php */