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
    $this->_table  = 'departamento';
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
    if($data['id_departamento']==0)
    {
      $this->db->set('id_empresa',$data['id_empresa'])
              ->set('descripcion',utf8_encode($data['nombre_departamento']))
              ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET id_empresa  = ".$data['id_empresa'].",
                descripcion = '".utf8_encode($data['nombre_departamento'])."'
            WHERE id_departamento = ".$data['id_departamento'].";";
            // echo $sql;exit;
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de la empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerEmpresa($id_empresa) {
    //si no es super admin filtramos por empre
    if($this->session->userdata('id_rol')!=1)
    {
      $id_empresa = $this->session->userdata('id_empresa');
      $this->db->select("id_empresa,nombre_empresa", FALSE)
             ->from("empresa")
             ->where('activo', 1)
             ->where('id_empresa', $id_empresa);
    }
    else
    {
      $this->db->select("id_empresa,nombre_empresa", FALSE)
             ->from("empresa")
             ->where('activo', 1);  
    }
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener los departamentos asociados a la empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerSindicatos($id_departamento=0) {   

    //si es nuevo el departamento
    if($id_departamento==0)
    {
      //si no es super admin filtramos por empre
      if($this->session->userdata('id_rol')!=1)
      {
        $id_empresa = $this->session->userdata('id_empresa');
        $this->db->select("id_departamento, descripcion, nombre_empresa,departamento.id_empresa", FALSE)
               ->from($this->_table)
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               ->where('departamento.activo', 1)
               ->where('empresa.id_empresa', $id_empresa);
      }
      else
      {
        $this->db->select("id_departamento, descripcion, nombre_empresa,departamento.id_empresa", FALSE)
               ->from($this->_table)
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               ->where('departamento.activo', 1)
               ->where('empresa.activo', 1);
      }
    }
    else
    {
      $this->db->select("id_departamento, descripcion, nombre_empresa,departamento.id_empresa", FALSE)
             ->from($this->_table)
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('id_departamento', $id_departamento); 
    }
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener los datos de los sub departamentos para el departamento seleccionado
   *
   * @access public
   * @param  integer $id_departamento
   * @return array
   */
  public function obtenerSubDepartamentos($id_departamento=0) {
    //si es nueva la empresa
    if($id_departamento==0)
    {
      $this->db->select("*", FALSE)
             ->from("sub_departamento");
    }
    else
    {
      $this->db->select("*", FALSE)
             ->from("sub_departamento")
             ->where('id_departamento', $id_departamento);  
    }
    
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
  public function eliminar($id_departamento=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_departamento = ".$id_departamento.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo departamentos_model.php */
/* Ubicacion: ./application/models/departamentos_model.php */