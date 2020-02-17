<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  public function __construct () {
    parent::__construct();

    $this->_clear_cache();
  }

  // --------------------------------------------------------------------

  /**
   * [_clear_cache description]
   * 
   * @return [type] [description]
   */
  public function _clear_cache() {
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0")
                 ->set_header("Pragma: no-cache");
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo MY_Controller.php */
/* Ubicacion: ./application/libraries/MY_Controller.php */