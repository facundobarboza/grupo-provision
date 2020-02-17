<?php if (! defined('BASEPATH')) exit('No direct script access');

class Log_model extends MY_Model {

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    $this->_schema         = '';
    $this->_table          = 'log';
    $this->_primary_key    = 'id';
    $this->_primary_filter = '';
  }

  // --------------------------------------------------------------------

  /**
   * [guardar description]
   * 
   * @param  integer $tipo
   * @param  integer $id_legajo
   * @return void
   */
  public function guardar($id_usuario, $id_tipo_log) {
    $this->db->set('id_usuario', (int)$id_usuario)
             ->set('id_tipo_log', (int)$id_tipo_log)
             ->insert($this->_table);
  }

  // --------------------------------------------------------------------

  /**
   * [guardar description]
   * 
   guardamos el log, en el cual pasamos campo de la base de dato y el id de referencia
   * @return void
   */
  public function guardar_log($id_usuario, $id_tipo_log,$tabla,$campo,$valor) {

    if($id_tipo_log==4)
    {
      $result = ultimo_id($tabla,$campo);
    }
    $this->db->set('id_usuario', (int)$id_usuario)
             ->set('id_tipo_log', (int)$id_tipo_log)
             ->set($campo, (int)$valor)
             ->insert($tabla);
  }

  // --------------------------------------------------------------------

  /**
   * [guardar description]
   * 
   Traemos el id que guardamos de la tabla a la cual hacemos referancia referencia
   * @return void
   */
  public function ultimo_id($tabla,$campo) {
   $sql = " SELECT *
            FROM ".$tabla."
            ORDER BY ".$campo." DESC
            LIMIT 1;";
              
              // Util::dump_exit($sql);
    $result =  $this->db->query($sql);
    return $result;
  }
  // --------------------------------------------------------------------

}

/* Fin del archivo log_model.php */
/* Ubicacion: ./application/models/log_model.php */