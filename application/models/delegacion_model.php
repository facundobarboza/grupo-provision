<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class Delegacion_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'delegacion';
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
    // $this->util->dump_exit($data);
    //si no existe lo guardamos
    if($data['id_delegacion']==0)
    {
      $this->db->set('descripcion',$data['descripcion'])
              ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET descripcion = '".utf8_encode($data['descripcion'])."'
            WHERE id_delegacion = ".$data['id_delegacion'].";";
            // echo $sql;exit;
      $this->db->query($sql);
    }
  }

   // --------------------------------------------------------------------

  /**
   * listamos todas las alertas para una empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerDelegacions() {   
    
    $this->db->select($this->_table.".*", FALSE)
           ->from($this->_table)
           ->where('activo', 1);     
    
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
  public function obtenerDetalle($id_delegacion=0) {
    
    $this->db->select("*", FALSE)
           ->from($this->_table)
           ->where('id_delegacion', $id_delegacion);     
    
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
  public function eliminar($id_delegacion=0) {
    //si existe modificamos
    $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_delegacion = ".$id_delegacion.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

} 

/* Fin del archivo alertas_model.php */
/* Ubicacion: ./application/models/alertas_model.php */