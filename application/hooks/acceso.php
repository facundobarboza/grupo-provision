<?php if (!defined('BASEPATH')) exit('No direct script access');

class Acceso {

  private $_CI;

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  public function __construct() {
    $this->_CI =& get_instance();
  }

  // --------------------------------------------------------------------

  /**
   * segun este logueado o no el usuario,
   * chequear sus permisos
   * 
   * @return void
   */
  public function comprobar() {

    //echo '<pre>';print_r($this->_CI);
    // echo '<p>M&oacute;dulo: '.$this->_CI->router->fetch_module().'</p>';
    // echo '<p>Clase: '.$this->_CI->router->class.'</p>';
    // echo '<p>M&eacute;todo: '.$this->_CI->router->method.'</p>';
    // exit;

    // urls utilizadas en el inicio de sesion
    $urls_login = array('usuario/login');

    // si el usuario esta logueado
    if( $this->_CI->session->userdata('logged_in') )
    {
      // si solicita una pagina de inicio de sesion
      if( array_search($this->_CI->router->class.'/'.$this->_CI->router->method, $urls_login) !== FALSE )
        // lo redireccionamos al inicio
        redirect('archivo', 'refresh');
    }
    // el usuario no esta logueado
    else
    {
      // arreglo con las url a las que puede tener acceso un usuario qque no ha iniciado sesion
      $url_permitida = array();

      // agregamos las url del inicio de sesion
      $url_permitida = array_merge($url_permitida, $urls_login);

      $url_permitida[] = 'usuario/regenerarContrasenia';

      // si no solicita una pagina permitida
      if( array_search($this->_CI->router->class.'/'.$this->_CI->router->method, $url_permitida) === FALSE )
      {
        // si es una peticion ajax
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
        {
          // enviar el error con valor -1 para que se redireccione en el cliente
          echo json_encode(array('e' => -1));
          exit;
        }
        else
          // redirigirlo al inicio de sesion
          redirect('usuario/login', 'refresh');
      }
    }
  }

  // --------------------------------------------------------------------

}


/* Fin del archivo acceso.php */
/* Ubicacion: ./application/hooks/acceso.php */