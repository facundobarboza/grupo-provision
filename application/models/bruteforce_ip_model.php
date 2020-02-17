<?php if (! defined('BASEPATH')) exit('No direct script access');

class Bruteforce_ip_model extends MY_Model {

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    $this->_schema         = '';
    $this->_table          = 'bruteforce_ip';
    $this->_primary_key    = 'ip_address';
    $this->_primary_filter = '';
  }

  // --------------------------------------------------------------------

  /**
   * incrementar en uno la cantidad de fallos del cliente
   * actualizar el tiempo
   *
   * @access public
   * @param  string $ip_address
   * @return void
   */
  public function increment_fail($ip_address) {
    $this->db->set('fails', 'fails+1', FALSE)
             ->set('last_activity', microtime(TRUE))
             ->from($this->_table)
             ->where('ip_address', $ip_address)
             ->update();
  }

  // --------------------------------------------------------------------

  /**
   * actualizar el tiempo de su ultimo intento
   *
   * @access public
   * @param  string $ip_address
   * @return void
   */
  public function update_last_activity($ip_address) {
    $this->db->set('last_activity', microtime(TRUE))
             ->from($this->_table)
             ->where('ip_address', $ip_address)
             ->update();
  }

  // --------------------------------------------------------------------

  /**
   * bloquear la ip del cliente
   * y actualizar el tiempo
   *
   * @access public
   * @param  string $ip_address
   * @return void
   */
  public function block_client($ip_address) {
    $this->db->set('blocked', 't')
             ->set('last_activity', microtime(TRUE))
             ->from($this->_table)
             ->where('ip_address', $ip_address)
             ->update();
  }

  // --------------------------------------------------------------------

  /**
   * desbloquear la ip del cliente
   *
   * @access public
   * @param  string $ip_address
   * @return void
   */
  public function unlock_client($ip_address) {
    $this->db->set('blocked', 'f')
             ->set('fails', 0)
             ->from($this->_table)
             ->where('ip_address', $ip_address)
             ->update();
  }

  // --------------------------------------------------------------------

  /**
   * reiniciar la ip del cliente
   *
   * @access public
   * @param  string $ip_address
   * @return void
   */
  public function delete($ip_address) {
    $this->db->set('blocked', 'f')
             ->set('fails', 0)
             ->from($this->_table)
             ->where('ip_address', $ip_address)
             ->update();
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo bruteforce_ip_model.php */
/* Ubicacion: ./application/models/bruteforce_ip_model.php */