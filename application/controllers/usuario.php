<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');

class Usuario extends MY_Controller {

  // --------------------------------------------------------------------

  /**
   * constructor
   */
  public function __construct() {
    parent::__construct();
  }

  // --------------------------------------------------------------------

  /**
   * mostrar la vista para iniciar sesion, como si desea ingresar al sitio,
   * verificar los datos enviados
   *
   * @access public
   * @return void
   */
  public function login() {
    $this->output->enable_profiler(FALSE);

    // datos que son usados en la vista
    $data_view = array();

    // cargamos el helper para la creacion de la imagen "captcha"
    $this->load->helper('captcha');

    $configuracion_captcha = array(
      'font_path'  => BASEPATH.'fonts'.DIRECTORY_SEPARATOR.'arial.ttf',
      'img_path'   => './assets/images/captcha/',
      'img_url'    => base_url().'assets/images/captcha/',
      'img_width'  => '250',
      'img_height' => '50',
      'expiration' => 600 // 10 minutos
    );

    // si se pudo generar la imagen "captcha"
    if( ($captcha = create_captcha($configuracion_captcha)) !== FALSE )
    {
      $data_view['captcha'] = $captcha['image'];

      $data_captcha = array(
        'captcha_time' => $captcha['time'],
        'ip_address'   => $this->input->ip_address(),
        'word'         => $captcha['word']
      );
      $query = $this->db->insert_string('captcha', $data_captcha);
      $this->db->query($query);
    }

    // echo '<pre>';print_r($captcha);exit;

    // si se envió el formulario para iniciar sesion
    if( $this->input->post('user_name') )
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('user_name','Usuario','required|trim|xss_clean')
                            ->set_rules('contrasenia','Contrase&ntilde;a','required|trim|xss_clean');

      // si no pasa la validacion del formulario
      if( !$this->form_validation->run() )
      {
        $mensaje_form_validation = ENVIRONMENT == 'development' ?
          form_error('user_name').' '.form_error('contrasenia')
          :
          'Completa los datos con tu Usuario y tu contrase&ntilde;a.';

        $this->session->set_flashdata('error', $mensaje_form_validation);

        redirect('usuario/login');
      }
      else
      {
        $this->load->model(array('usuario_model', 'bruteforce_ip_model'));

        // cargamos el archivo de configuracion
        // del ataque por fuerza bruta
        $this->config->load('bruteforce_ip');

        // si esta habilitada la proteccion contra fuerza bruta
        if( $this->config->item('habilitar') )
        {
          $cliente = $this->bruteforce_ip_model->get_by(array('ip_address' => $this->input->ip_address()));

          //Util::dump_exit($cliente);

          // si posee un registro la ip del cliente
          if( $cliente->num_rows() )
          {
            // tiempo trancurrido del ultimo acceso
            $segundos_trancurridos = round(microtime(TRUE) - $cliente->row()->last_activity);

            // si el usuario esta bloqueado
            // y ya paso el tiempo para poder desbloquearlo,
            // entonces lo desbloqueamos
            if( (int)$cliente->row()->blocked === 1 && ( $segundos_trancurridos >= (int)$this->config->item('segundos_desbloquear') ) )
            {
              // desbloquemoa el usuario
              $this->bruteforce_ip_model->unlock_client($this->input->ip_address());

              // accedemos a los nuevos datos del cliente
              $cliente = $this->bruteforce_ip_model->get_by(array('ip_address' => $this->input->ip_address()));
            }

            // si la cantidad de fallos es mayor o igual a la permitida
            // o si la IP esta bloqueada
            if( (int)$cliente->row()->fails >= (int)$this->config->item('cantidad_fallos') || $cliente->row()->blocked == 't' )
            {
              // si el usuario aun no ha sido bloqueado
              if( (int)$cliente->row()->blocked === 0 )
                $this->bruteforce_ip_model->block_client($this->input->ip_address());

              $mensaje_bloqueo = ENVIRONMENT == 'development' ?
                'Direcci&oacute;n IP bloqueada.'
                :
                'Tu usuario ha sido bloqueado de forma temporal debido a que has alcanzado el m&aacute;ximo de intentos para iniciar sesi&oacute;n.';

              $this->session->set_flashdata('error', $mensaje_bloqueo);

              // lo redireccionamos al login
              redirect('usuario/login','refresh');
            }
          }
          // la ip no posee un registro en la base de datos
          else
          {
            // guardamos el registro del usuario
            $datos = array(
              'ip_address'    => $this->input->ip_address(),
              'last_activity' => (int)microtime(TRUE)
            );

            $this->bruteforce_ip_model->save($datos);
          }
        }

        // obtenemos los datos del usuario para validarlo
        $usuario = $this->usuario_model->obtenerUsuario($this->input->post('user_name'));

        // Util::dump_exit($usuario->row());

        // si existe el usuario, entonces comprobamos la contraseña
        if( $usuario->num_rows() )
        {
          $this->load->library( 'PasswordHash' );

          // Util::dump_exit($this->passwordhash->CheckPasswordMD5( $this->input->post('contrasenia'), $usuario->row()->contrasenia ));
          // exit;
          // comprobamos que la contraseña enviada sea la misma que la almacenada en bae de datos
          if( $this->passwordhash->CheckPasswordMD5( $this->input->post('contrasenia'), $usuario->row()->contrasenia ) )
          {
            // si el usuario esta vigente
            if( (int)$usuario->row()->activo == 1 )
            {
              // destruimos la sesion
              $this->session->sess_destroy();

              // creamos la sesion
              $this->session->sess_create();

              // datos que se guardarán en sesion
              $datos_sesion = array(
                'logged_in'  => TRUE,
                'id_usuario'  => (int)$usuario->row()->id_usuario,
                'nombre'     => $usuario->row()->nombre,
                'apellido'   => $usuario->row()->apellido,
                'email'      => $usuario->row()->mail,
                'id_rol'     => $usuario->row()->id_rol,
                'id_empresa' => $usuario->row()->id_empresa,
                'id_sub_departamento' => $usuario->row()->id_sub_departamento,
                'id_departamento'     => $usuario->row()->id_departamento,
                'user_name'  => $this->input->post('user_name')
              );
              // guardamos datos en sesion
              $this->session->set_userdata($datos_sesion);
              
              // si esta habilitado la proteccion contra fuerza bruta
              if( $this->config->item('habilitar') )
                // borramos el registro de la tabla bruteforce_ip
                $this->bruteforce_ip_model->delete($this->input->ip_address());

              // guardamos el log
              $this->log_model->guardar($usuario->row()->id_usuario, 1);

              switch ($usuario->row()->id_rol) 
              {
                case 1: //si es administrador total
                  // lo redireccionamos al inicio de la aplicacion 
                  redirect('archivo', 'refresh');
                  break;
                case 2://si es un usuario encargado de una empresa
                  // lo redireccionamos al inicio de la aplicacion
                  redirect('empresas', 'refresh');
                  break;
                  case 3://si es un usuario comun
                  // lo redireccionamos al inicio de la aplicacion
                  redirect('archivo', 'refresh');
                  break;
                default:
                  # code...
                  break;
              }
              //VERIFICAMOS QUE ROL TIENE ASIGNADO EL USUARIO              
            }
            // el usuario esta inhabilitado
            else
              $data_view['error'] = 'No tiene permiso para acceder.';
          }
          // no coincide la contraseña
          else
          {
            // si esta habilitado la proteccion contra fuerza bruta
            if( $this->config->item('habilitar') )
              // actualizar la cantidad de fallos sumando al de la base de datos
              $this->bruteforce_ip_model->increment_fail($this->input->ip_address());

            $data_view['error'] = 'Usuario o contrase&ntilde;a incorrectos.';
          }
        }
        // no existe el usuario con el numero de documento ingresado
        else
        {
          // si esta habilitado la proteccion contra fuerza bruta
          if( $this->config->item('habilitar') )
            // actualizar la cantidad de fallos sumando al de la base de datos
            $this->bruteforce_ip_model->increment_fail($this->input->ip_address());

          $data_view['error'] = 'Usuario o contrase&ntilde;a incorrectos.';
        }

        // cargamos la vista para iniciar sesion con los datos correspondientes
        $this->load->view('usuario/login_view', $data_view);
      }
    }
    else
    {
      // cargamos la vista para iniciar sesion
      $this->load->view('usuario/login_view', $data_view);
    }
  }

  // --------------------------------------------------------------------

  /**
   * cerrar sesion
   *
   * @access public
   * @return void
   */
  public function logout() {
    // guardamos el log
    $this->log_model->guardar($this->session->userdata('id_usuario'), 2);

    // destruimos la sesion
    $this->session->sess_destroy();

    redirect('usuario/login','refresh');
  }

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function perfil() {
    // cargamos el modelo
    $this->load->model('usuario_model');

    $this->load->helper('form');

    // datos pasados a la vista
    $data = array(
      // 'usuario'        => $usuario->row(),
      'contenido_view' => 'usuario/perfil_view',
      'js'             => array(base_url('assets/js/usuario/pefil_view.js'))
    );

    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

  /**
   * Actualizar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function actualizarPerfil() {
    // cargamos el modelo
    $this->load->model('usuario_model');

    $this->form_validation->set_rules('contrasenia_actual', 'Contrase&ntilde;a actual', 'required|trim|xss_clean|min_length[8]|max_length[32]')
                          ->set_rules('contrasenia_nueva_1', 'Nueva contrase&ntilde;a', 'required|trim|xss_clean|min_length[8]|max_length[32]')
                          ->set_rules('contrasenia_nueva_2', 'Repetir nueva contrase&ntilde;a', 'required|trim|matches[contrasenia_nueva_1]');
    
    if( $this->form_validation->run() )
    {
      // obtenemos los datos del usuario
      $usuario = $this->usuario_model->obtenerUsuario($this->session->userdata('user_name'));

      // cargamos la biblioteca
      $this->load->library('PasswordHash');

      // comprobamos que la contraseña enviada sea la misma que la almacenada en bae de datos
      if( $this->passwordhash->CheckPasswordMD5( $this->input->post('contrasenia_actual'), $usuario->row()->contrasenia ) )
      {
        if( $this->usuario_model->actualizarContrasenia($this->input->post('contrasenia_nueva_1')) )
        {
          // guardamos el log
          $this->log_model->guardar($this->session->userdata('id_usuario'), 3);

          $this->session->set_flashdata('exito', 'Se ha actualizado el Perfil con &eacute;xito.');
        }
        else
          $this->session->set_flashdata('error', 'No se pudo actualizar el Perfil.');

        redirect('usuario/perfil','refresh');
      }
      // la contraseña actual no coincide
      else
      {
        $this->session->set_flashdata('error', 'La contrase&ntilde;a actual ingresada no coincide con la almacenada en base de datos.');

        redirect('usuario/perfil','refresh');
      }
    }
    // no paso el form validation
    else
      $this->perfil();
  }

  // --------------------------------------------------------------------

  /**
   * Regenerar la contraseña del usuario
   *
   * @access public
   * @return void
   */
  public function regenerarContrasenia() {
    $r = array('error' => 0, 'mensaje' => '');

    // deshabilitamos el profiler
    $this->output->enable_profiler(FALSE);

    // cargamos el modelo
    $this->load->model('usuario_model');

    // si es una peticion ajax
    if( $this->util->isAjax() )
    {
      // 10 minutos limite
      $expiration = time() - 600;
      // eliminamos los captchas viejos de la base de datos
      $this->db->query('DELETE FROM captcha WHERE captcha_time < ' . $expiration);

      $sql = 'SELECT COUNT(*) AS count
              FROM captcha
              WHERE word = ?
              AND ip_address = ?
              AND captcha_time > ?';
      $binds = array(strtoupper($this->input->post('captcha')), $this->input->ip_address(), $expiration);
      $query = $this->db->query($sql, $binds);
      $row   = $query->row();

      // la cadena enviada coincide con la del captcha
      if( (int)$row->count != 0 )
      {
        // obtenemos los datos del usuario para validarlo
        $usuario = $this->usuario_model->obtenerDeGestion($this->input->post('documento'));

        // si existe el usuario
        if( $usuario !== FALSE && count($usuario->row()) && ($usuario->row()->contrasenia !== NULL || trim($usuario->row()->contrasenia) !== '') )
        {
          $contrasenia = date('dmYHis');

          $this->db->trans_start();

          $this->usuario_model->actualizarContrasenia($contrasenia, $usuario->row()->id_legajo);

          $asunto    = 'Regeneración de contraseña - Coradir S.A.';
          $contenido = 'Se ha generado su nueva contraseña: ' . $contrasenia . PHP_EOL . $this->util->firmaEmail(TRUE);

          $sql = "INSERT INTO general.enviar_mail
                  (para, asunto, contenido)
                  VALUES
                  ('".$usuario->row()->mail_sitio."','".pg_escape_string($asunto)."','".pg_escape_string($contenido)."');";
          $this->db->query($sql);

          $this->db->trans_complete();

          if( $this->db->trans_status() !== FALSE )
            $r['mensaje'] = 'Se ha generado su nueva contrase&ntilde;a y ha sido enviada a su email.';
          else
          {
            $r['error']   = 1;
            $r['mensaje'] = 'No se ha podido regenerar su contrase&ntilde;a. Int&eacute;ntelo m&aacute;s tarde.';
          }
        }
        else
        {
          $r['error']   = 1;
          $r['mensaje'] = 'El usuario con el documento solicitado no existe.';
        }
      }
      // la cadena enviada no coincide con la cadena del captcha
      else
      {
        $r['error']   = 1;
        $r['mensaje'] = 'Las letras y n&uacute;meros que ingres&oacute; no coincidieron con los de la imagen.';
      }
    }
    // no es una peticion ajax
    else
    {
      // lo redireccionamos al login
      redirect('usuario/login','refresh');
    }

    header('Content-Type: application/json');
    echo json_encode( $r );
    exit;
  }

  // --------------------------------------------------------------------

  /**
   * Confirmar la contraseña
   * enviada por el usuario
   *
   * @access public
   * @return void
   */
  public function confirmarContrasenia() {
    $r = array('error' => 0, 'mensaje' => '');

    // deshabilitamos el profiler
    $this->output->enable_profiler(FALSE);

    // cargamos los modelos
    $this->load->model(array('usuario_model'));

    // si es una peticion ajax
    if( $this->util->isAjax() )
    {
      $sql = 'SELECT COUNT(*) AS count
              FROM usuario
              WHERE id_legajo = ?
              AND contrasenia = ?;';
      $binds = array($this->session->userdata('id_legajo'), md5($this->input->post('contrasenia')));
      $query = $this->db->query($sql, $binds);
      $row   = $query->row();

      // la contraseña enviada es correcta
      if( (int)$row->count )
      {
        $r['mensaje'] = 'Se confirm&oacute; contrase&ntilde;a ingresada con éxito.';
      }
      else
      {
        $r['error']   = 1;
        $r['mensaje'] = 'La contrase&ntilde;a ingresada no es correcta.';
      }
    }

    header('Content-Type: application/json');
    echo json_encode( $r );
    exit;
  }

  // --------------------------------------------------------------------


  /**
   * Cargar la vista para editar el usuario
   *
   * @access public
   * @return void
   */
  public function nuevo($id_usuario=0) {
    // cargamos el modelo
    $this->load->model('usuario_model');
    $this->load->model('sindicatos_model');

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

    // si es nueva le pasamos estos datos a la vista
    if($id_usuario==0)
    {
      $data = array(
                    'empresas'       => $empresas_validas,
                    'contenido_view' => 'usuario/usuario_view',
                    'js'             => array(base_url('assets/js/usuario/usuario_view.js'))
                    );  
    }
    else
    {
      // obtenemos los datos del usuario
      $usuarios = $this->usuario_model->obtenerUsuarioID($id_usuario);

      // $this->util->dump_exit($usuarios->row());
      $data = array(
                    'empresas'       => $empresas_validas,
                    'usuarios'        => $usuarios,
                    'contenido_view' => 'usuario/usuario_view',
                    'js'             => array(base_url('assets/js/usuario/usuario_view.js'))
                    ); 
    }
    

    $this->load->view('iframe_view', $data);
  }

   // --------------------------------------------------------------------

  /**
   * cargar la vista con el listado de empresas
   *
   * @access public
   * @return void
   */
  public function listado($eliminado=0) {
    // cargamos el modelo
    $this->load->model(array('usuario_model'));

    // obtenemos el recibo de sueldo
    $usuarios         = $this->usuario_model->obtenerListado();
    // $this->util->dump_exit($empresas->result());
    $usuarios_validos = array();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $usuarios->result() as $row )
    {

      $usuarios_validos[] = array(
        'id_usuario'    => (int)$row->id_usuario,
        'nombre'        => $row->nombre,
        'apellido'      => $row->apellido,
        'mail'          => $row->mail,
        'nombre_empresa'=> $row->nombre_empresa,
        'user_name'     => $row->user_name
      );  
    }

    // $this->util->dump_exit($empresas_validas);

    // datos pasados a la vista
    $data = array(
      'usuarios'       => $usuarios_validos,
      'contenido_view' => 'usuario/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/usuario/listado_view.js'))
    );

    if($eliminado==1)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se elimino el Usuario con &eacute;xito.');
      redirect('usuario/listado','refresh');
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
  public function guardarUsuario() {

    // cargamos el modelo
    $this->load->model('usuario_model');
    
    // datos pasados al modelo
    $data = array('id_usuario' => $this->input->post('id_usuario'),
                  'nombre'     => $this->input->post('nombre_usuario'),
                  'apellido'   => $this->input->post('apellido_usuario'),
                  'id_rol'     => $this->input->post('select_rol_usuario'),
                  'id_empresa' => $this->input->post('select_empresa_usuario'),
                  'user_name'  => $this->input->post('user_name'),
                  'contrasenia'=> $this->input->post('contrasenia_usuario'),
                  'mail'       => $this->input->post('mail_usuario'),
                  'id_departamento'     => $this->input->post('select_departamento'),
                  'id_sub_departamento' => $this->input->post('select_sub_departamento')
                );
    // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->usuario_model->agregar($data);
    
    //si guardamos un nuevo usuario
    if($this->input->post('id_usuario')==0)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso el Usuario con &eacute;xito.');  
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se modifico el Usuario con &eacute;xito.');
    }

    redirect('usuario/listado','refresh');
  }

  // --------------------------------------------------------------------

   /**
   *
   * @access public
   * @return void
   */
  public function eliminar($id_usuario=0) {
    // cargamos el modelo
    $this->load->model('usuario_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->usuario_model->eliminar($id_usuario);

     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo usuario.php */
/* Ubicacion: ./application/controllers/usuario.php */