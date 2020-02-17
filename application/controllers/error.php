<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');

class Error extends CI_Controller {

  /**
   * [__construct description]
   */
  public function __construct() {
    parent::__construct();
  }

  // --------------------------------------------------------------------

  /**
   * [error_404 description]
   *
   * @access public
   * @return void
   */
  function error_404() {
    $data = array(
      'contenido_view' => 'error/error_404_view'
    );

    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo error.php */
/* Ubicacion: ./application/controllers/error.php */