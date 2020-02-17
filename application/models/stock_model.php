<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class Stock_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'alertas';
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
    $fecha_mensaje = Util::fecha_db($data['fecha_mensaje']);

    // $this->util->dump_exit($data);
    //si no existe lo guardamos
    if($data['id_alerta']==0)
    {
      $this->db->set('id_usuario',$data['id_usuario'])
              ->set('fecha_mensaje',utf8_encode($fecha_mensaje))
              ->set('mensaje',utf8_encode($data['mensaje']))
              ->set('id_usuario_msj',$this->session->userdata('id_usuario'))
              ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET id_usuario    = ".$data['id_usuario'].",
                fecha_mensaje = '".utf8_encode($fecha_mensaje)."',
                mensaje       = '".utf8_encode($data['mensaje'])."',
                id_usuario_msj = ".$this->session->userdata('id_usuario')."
            WHERE id_alerta = ".$data['id_alerta'].";";
            // echo $sql;exit;
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos del usuario
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerUsuarios() {
    
      $id_empresa = $this->session->userdata('id_empresa');
      $this->db->select("id_usuario,apellido, nombre", FALSE)
             ->from("usuario")
             ->where('activo', 1)
             ->where('id_empresa', $id_empresa);
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * listamos todas las alertas para una empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerAlertas() {   
    
    $id_empresa = $this->session->userdata('id_empresa');
    $this->db->select("id_alerta, mensaje, apellido,nombre,fecha_mensaje", FALSE)
           ->from($this->_table)
           ->join('usuario',$this->_table.'.id_usuario=usuario.id_usuario')
           ->where('usuario.id_empresa', $id_empresa);     
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   /**
   * Obtener las alertas para un usuario
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerAlertasUsuario() {   
    
    $fecha = date("Y-m-d");
    $id_usuario = $this->session->userdata('id_usuario');

    $this->db->select("id_alerta, mensaje,fecha_mensaje", FALSE)
           ->from($this->_table)
            ->like('fecha_mensaje', $fecha)
           ->where('id_usuario', $id_usuario);     
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener el detalle de las alertas
   *
   * @access public
   * @param  integer $id_departamento
   * @return array
   */
  public function obtenerDetalleAlerta($id_alerta=0) {
    
    $this->db->select("id_alerta, mensaje, id_usuario, fecha_mensaje", FALSE)
           ->from($this->_table)
           ->where('id_alerta', $id_alerta);     
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @param  integer $id_departamento
   * @return array
   */
  public function eliminar($id_alerta=0) {
    //si existe modificamos
    $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_alerta = ".$id_alerta.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo alertas_model.php */
/* Ubicacion: ./application/models/alertas_model.php */