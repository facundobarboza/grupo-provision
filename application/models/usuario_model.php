<?php if (! defined('BASEPATH')) exit('No direct script access');

class Usuario_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    $this->_schema = '';
    $this->_table  = 'usuario';
  }


  // --------------------------------------------------------------------

  /**
   * Obtener los datos del usuario
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerListado() {
    
    $this->db->select("id_usuario,apellido,nombre, usuario.mail, id_rol, user_name", FALSE)
             ->from($this->_table)
             ->where('usuario.activo', 1);
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos del usuario
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerUsuario($user_name) {
    $this->db->select("id_usuario,apellido,nombre, mail, contrasenia,id_rol, activo", FALSE)
             ->from($this->_table)
             ->where('user_name', $user_name);
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos del usuario
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerUsuarioID($id_usuario) {
    $this->db->select("id_usuario,apellido,nombre, mail, contrasenia,id_rol, activo,user_name", FALSE)
             ->from($this->_table)
             ->where('id_usuario', $id_usuario);
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }
  // --------------------------------------------------------------------

  /**
   * [actualizarContrasenia description]
   *
   * @access public
   * @param  srting $contrasenia
   * @return integer
   */
  public function actualizarContrasenia($contrasenia, $id_usuario = NULL) {
    $id_usuario = !is_null($id_usuario) && is_numeric($id_usuario) ?
      (int)$id_usuario
      :
      $this->session->userdata('id_usuario');

    $sql = "UPDATE ".$this->_table."
            SET contrasenia = md5('".pg_escape_string($contrasenia)."')
            WHERE id_usuario = ".$id_usuario.";";
    $this->db->query($sql);

    return $this->db->affected_rows();
  }

  // --------------------------------------------------------------------
  /**
   * [guardar empresa]
   * 
   * @param  array $datos
   * @return void
   */
  public function agregar($data) 
  {
    // Util::dump_exit($data);
    //si no existe lo guardamos
    if($data['id_usuario']==0)
    {
      $this->db->set('nombre',utf8_encode($data['nombre']))
              ->set('apellido',utf8_encode($data['apellido']))
              ->set('id_rol',$data['id_rol'])
              ->set('user_name',$data['user_name'])
              ->set('contrasenia',md5($data['contrasenia']))
              ->set('mail',$data['mail'])              
              ->set('activo',1)
              ->insert($this->_table);
    }
    else
    {
      if($data['contrasenia']!="")
        $sql_usuario = ",contrasenia  =  '".md5($data['contrasenia'])."'";
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET nombre  = '".utf8_encode($data['nombre'])."',
                apellido  = '".utf8_encode($data['apellido'])."',
                id_rol  = ".$data['id_rol'].",
                user_name  = '".$data['user_name']."',
                mail = '".$data['mail']."'                
                ".$sql_usuario."
            WHERE id_usuario = ".$data['id_usuario'].";";
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @param  integer $id_departamento
   * @return array
   */
  public function eliminar($id_usuario=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_usuario = ".$id_usuario.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------
}

/* Fin del archivo usuario_model.php */
/* Ubicacion: ./application/models/usuario_model.php */