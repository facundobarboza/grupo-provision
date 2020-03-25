<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class Sindicatos_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'sindicatos';
  }

  // --------------------------------------------------------------------

  /**
   * [guardar sindicato]
   * 
   * @param  array $datos
   * @return void
   */
  public function agregar($data) 
  {
    // $this->util->dump_exit($data);
    //si no existe lo guardamos
    if($data['id_sindicato']==0)
    {
      $this->db->set('descripcion',utf8_encode($data['nombre_sindicato']))
              ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET descripcion = '".utf8_encode($data['nombre_sindicato'])."'
            WHERE id_sindicato = ".$data['id_sindicato'].";";
            // echo $sql;exit;
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de la sindicato
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerSindicato($id_sindicato) {
    
    $this->db->select("id_sindicato,descripcion", FALSE)
           ->from($this->_table)
           ->where('activo', 1)
           ->where('id_sindicato', $id_sindicato);   
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener los sindicatos asociados a la sindicato
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerSindicatos($id_sindicato=0) {   

   
    $id_sindicato = $this->session->userdata('id_sindicato');
    $this->db->select("id_sindicato, descripcion", FALSE)
           ->from($this->_table)
           ->where('activo', 1);
      
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener los datos de los sub sindicatos para el sindicato seleccionado
   *
   * @access public
   * @param  integer $id_sindicato
   * @return array
   */
  public function obtenerSubSindicatos($id_sindicato=0) {
    //si es nueva la sindicato
    if($id_sindicato==0)
    {
      $this->db->select("*", FALSE)
             ->from("sub_sindicato");
    }
    else
    {
      $this->db->select("*", FALSE)
             ->from("sub_sindicato")
             ->where('id_sindicato', $id_sindicato);  
    }
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @param  integer $id_sindicato
   * @return array
   */
  public function eliminar($id_sindicato=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_sindicato = ".$id_sindicato.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo sindicatos_model.php */
/* Ubicacion: ./application/models/sindicatos_model.php */