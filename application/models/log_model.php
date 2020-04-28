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
      $valor = $this->ultimo_id($tabla,$campo);
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
   Listamos el log, en el cual pasamos campo de la base de dato
   * @return array
   */
  public function get_log($tabla,$campo,$value) {

    
     $this->db->select("log.id, fecha, tl.nombre as accion, u.nombre,u.apellido", FALSE)
             ->from($tabla." as log")
             ->join("tipo_log as tl","log.id_tipo_log=tl.id")
             ->join("usuario as u ","log.id_usuario= u.id_usuario")
             ->where($campo, $value);

    // $sql = " SELECT log.id, fecha, tl.nombre as accion, u.nombre,u.apellido
    //           FROM ".$tabla." as log JOIN tipo_log as tl on(log.id_tipo_log=tl.id)
    //           JOIN usuario as u on (log.id_usuario= u.id_usuario)
    //           WHERE ".$campo."=".$value."";
              // die($sql);
              // Util::dump_exit($sql);
    $result =  $this->db->get();
    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * [guardar description]
   * 
   Traemos el id que guardamos de la tabla a la cual hacemos referancia referencia
   * @return id
   */
  public function ultimo_id($tabla,$campo) {
    $r_table = explode("_",$tabla);
     
   $sql = " SELECT ".$campo." as id
            FROM ".$r_table[1]."
            ORDER BY ".$campo." DESC
            LIMIT 1;";
              // die($sql);
              // Util::dump_exit($sql);
    $result =  $this->db->query($sql);
    // Util::dump_exit($result->row()->id);
    return $result->row()->id;
  }
  // --------------------------------------------------------------------

}

/* Fin del archivo log_model.php */
/* Ubicacion: ./application/models/log_model.php */