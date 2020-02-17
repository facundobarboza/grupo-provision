<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class sub_departamentos_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'sub_departamento';
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
    //si no existe lo guardamos
    if($data['id_sub_departamento']==0)
    {
      $this->db->set('id_departamento',$data['id_departamento'])
              ->set('descripcion',utf8_encode($data['nombre_sub_departamento']))
             ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET id_departamento  = ".$data['id_departamento'].",
                descripcion = '".utf8_encode($data['nombre_sub_departamento'])."'
            WHERE id_sub_departamento = ".$data['id_sub_departamento'].";";
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
    $this->db->select("id_empresa,nombre_empresa", FALSE)
             ->from("empresa")
             ->where('activo', 1);
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
  public function obtenerSubDepartamentos($id_sub_departamento=0) {   

    //si es nueva la empresa
    if($id_sub_departamento==0)
    {
      //si no es super admin filtramos por empresa
      if($this->session->userdata('id_rol')!=1)
      {
        $id_empresa = $this->session->userdata('id_empresa');
        $this->db->select("id_sub_departamento, sub_departamento.descripcion ,departamento.descripcion as departamento, nombre_empresa,departamento.id_empresa", FALSE)
               ->from($this->_table)
               ->join('departamento','departamento.id_departamento='.$this->_table.'.id_departamento AND departamento.activo=1')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa AND empresa.activo=1')
               ->where($this->_table.'.activo', 1)
               ->where('empresa.id_empresa', $id_empresa);
      }
      else
      {
        $this->db->select("id_sub_departamento, sub_departamento.descripcion ,departamento.descripcion as departamento, nombre_empresa,departamento.id_empresa", FALSE)
               ->from($this->_table)
               ->join('departamento','departamento.id_departamento='.$this->_table.'.id_departamento AND departamento.activo=1')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa AND empresa.activo=1')
               ->where($this->_table.'.activo', 1);
      }
    }
    else
    {
      $this->db->select("id_sub_departamento,departamento.id_empresa,departamento.id_departamento, sub_departamento.descripcion", FALSE)
             ->from($this->_table)
             ->join('departamento','departamento.id_departamento='.$this->_table.'.id_departamento')
             ->where('id_sub_departamento', $id_sub_departamento); 
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
  public function obtenerDepartamentosEmpresa($id_empresa=0) {  

    
    $this->db->select("id_departamento, descripcion", FALSE)
             ->from("departamento")
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('departamento.id_empresa', $id_empresa); 
    
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
  public function obtenerSubDepartamentosEmpresa($id_departamento=0) {  

    
    $this->db->select("id_sub_departamento, ".$this->_table.".descripcion", FALSE)
             ->from($this->_table)
             ->join('departamento','departamento.id_departamento='.$this->_table.'.id_departamento')
             ->where('departamento.id_departamento', $id_departamento); 
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @param  integer $id_sub_departamento
   * @return array
   */
  public function eliminar($id_sub_departamento=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_sub_departamento = ".$id_sub_departamento.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }
   // --------------------------------------------------------------------
  

}

/* Fin del archivo sub_departamentos_model.php */
/* Ubicacion: ./application/models/sub_departamentos_model.php */