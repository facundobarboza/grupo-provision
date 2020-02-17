<?php if (!defined('BASEPATH')) exit('No direct script access');

class Profiler {

  private $_CI;

  public function __construct() {
    $this->_CI =& get_instance();
  }

  /**
   * [profiler_hook description]
   * 
   * @return void
   */
  function mostrar() {
    if( ENVIRONMENT === 'development' )
      $this->_CI->output->enable_profiler(TRUE);
  }
  
}


/* Fin del archivo profiler.php */
/* Ubicacion: coradir/application/hooks/profiler.php */
/* Division Software - Coradir S.A. */