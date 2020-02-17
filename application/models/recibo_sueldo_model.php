<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class Recibo_sueldo_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = 'liquidaciones.';
    $this->_table  = 'liquidaciones';
  }

  // --------------------------------------------------------------------

  /**
   * Comprobar si la liquidacion le pertenece
   * al usuario
   *
   * @access public
   * @param  integer $id_legajo
   * @param  integer $id_liquidacion
   * @return boolean
   */
  public function comprobarPertenencia($id_legajo, $id_liquidacion) {
    $pertenece = FALSE;

    $this->db->select('COUNT(*) AS pertenece')
             ->from($this->_schema.$this->_table)
             ->where('id_legajo', (int)$id_legajo)
             ->where('id_liquidacion', (int)$id_liquidacion);
    $result = $this->db->get();

    if( $result !== FALSE && (int)$result->row()->pertenece === 1 )
    {
      $pertenece = TRUE;
    }

    //Util::dump_exit($result->row());

    return $pertenece;
  }

  // --------------------------------------------------------------------

  /**
   * Comprobar si esta confirmado el
   * recibo de sueldo de la liquidacion solicitada
   *
   * @access public
   * @param  integer $id_legajo
   * @param  integer $id_liquidacion
   * @return boolean
   */
  public function estaConfirmado($id_legajo, $id_liquidacion) {
    $confirmado = FALSE;

    $this->db->select('COUNT(*) AS confirmado')
             ->from('sitio_recibo_sueldo_digital.recibo_confirmado')
             ->where('id_legajo', (int)$id_legajo)
             ->where('id_liquidacion', (int)$id_liquidacion);
    $result = $this->db->get();

    if( $result !== FALSE )
    {
      $confirmado = $result->row()->confirmado ? TRUE : FALSE;
    }

    return $confirmado;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener la ultima liquidacion del usuario solicitado
   *
   * @access public
   * @param  integer $id_legajo
   * @return array
   */
  public function obtenerUltima($id_legajo) {
    $r = array('error' => 0, 'mensaje' => '', 'liquidacion' => array());

    $this->db->select('*')
             ->from($this->_schema.$this->_table)
             ->where('id_legajo', (int)$id_legajo)
             ->order_by('id_liquidacion', 'DESC')
             ->limit(1);
    $result = $this->db->get();

    if( $result !== FALSE )
    {
      if( $result->num_rows() )
      {
        $r['liquidacion'] = $result->row_array();
      }
    }
    else
    {
      $r['error']   = 1;
      $r['mensaje'] = 'Nro: '.$this->db->_error_number().' - '.$this->db->_error_message();
    }

    return $r;
  }

  // --------------------------------------------------------------------

  /**
   * Comprobar si es la ultima liquidacion
   * del usuario
   *
   * @access public
   * @param  integer $id_legajo
   * @param  integer $id_liquidacion
   * @return boolean
   */
  public function esUltima($id_legajo, $id_liquidacion) {
    $es_ultima = FALSE;

    $r_ultima = $this->obtenerUltima($id_legajo);

    // Util::dump_exit($r_ultima);

    return !$r_ultima['error'] && count($r_ultima['liquidacion']) && $r_ultima['liquidacion']['id_liquidacion'] == $id_liquidacion;
  }

  // --------------------------------------------------------------------

  /**
   * Establecer como confirmado el recibo
   * de sueldo de la liquidacion
   * 
   * @param  integer $id_legajo
   * @param  integer $id_liquidacion
   * @return array
   */
  public function confirmar($id_legajo, $id_liquidacion) {
    $r = array('error' => 0, 'mensaje' => '');

    $this->db->set('id_liquidacion', (int)$id_liquidacion)
             ->set('id_legajo', (int)$id_legajo);
    
    if( $this->db->insert('sitio_recibo_sueldo_digital.recibo_confirmado') )
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_legajo'), 5);

      $r['mensaje'] = 'Se confirm&oacute; el Recibo de Sueldo con &eacute;xito.';
    }
    else
    {
      $r['error']   = 1;
      $r['mensaje'] = 'Nro: '.$this->db->_error_number().' - '.$this->db->_error_message();
    }

    return $r;
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo recibo_sueldo_model.php */
/* Ubicacion: ./application/models/recibo_sueldo_model.php */