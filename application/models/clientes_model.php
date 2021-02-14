<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class Clientes_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'clientes';
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
    // $fecha_vigencia = Util::fecha_db($data['fecha_vigencia']);

    if($data['id_cliente']==0)
    {
      $this->db->set('titular_cliente',utf8_encode($data['titular_cliente']))
              ->set('beneficiario_cliente',utf8_encode($data['beneficiario_cliente']))
              ->set('dni',utf8_encode($data['dni_cliente']))
              ->set('nro_cliente',utf8_encode($data['numero_cliente']))
              ->set('id_sindicato_cliente',utf8_encode($data['id_sindicato_cliente']))
             ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
              SET titular_cliente       = '".utf8_encode($data['titular_cliente'])."',
                  beneficiario_cliente     = '".utf8_encode($data['beneficiario_cliente'])."',
                  dni                  = '".utf8_encode($data['dni_cliente'])."',
                  nro_cliente       = '".utf8_encode($data['numero_cliente'])."',
                  id_sindicato_cliente = '".utf8_encode($data['id_sindicato_cliente'])."'
              WHERE id_cliente = ".$data['id_cliente'].";";
              
              // Util::dump_exit($sql);
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
  public function obtenerCliente($id_cliente) {
    $this->db->select("*", FALSE)
             ->from($this->_table)
             ->where('id_cliente', $id_cliente);
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }


  // --------------------------------------------------------------------

  /**
   * Obtener los datos de la empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function ListarClientes($filtro_afiliado) {

    if($filtro_afiliado!="")
    {
      $array = array('titular_cliente'      => $filtro_afiliado, 
                     'beneficiario_cliente' => $filtro_afiliado,
                     'dni'                  => $filtro_afiliado,
                     'nro_cliente'          => $filtro_afiliado);

      $this->db->select("*", FALSE)
               ->from($this->_table)
               ->join("sindicatos", "id_sindicato_cliente=id_sindicato")
               ->where('clientes.activo', 1)
               ->or_like($array);  
    }
    else
    {
      $this->db->select("*", FALSE)
             ->from($this->_table)
             ->join("sindicatos", "id_sindicato_cliente=id_sindicato")
             ->where('clientes.activo', 1)
             ->limit(0); 
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
  public function obtenerSindicatos() {   
   
    $this->db->select("*")
           ->from("sindicatos")
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
  public function obtenerDelegaciones() {   
   
    $this->db->select("*")
           ->from("delegacion")
           ->where('activo', 1)
           ->order_by("descripcion"); 
 
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
  public function obtenerOpticas() {   
   
    $this->db->select("*")
           ->from("opticas")
           ->where('activo', 1)
           ->order_by('descripcion', 'ASC'); 
 
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  public function obtenerOpticasDelegacion() {   
   
    $this->db->select("opticas.*")
           ->from("opticas")
           ->join("delegacion", "opticas.id_delegacion=delegacion.id_delegacion")
           ->where('opticas.activo', 1)
           ->order_by('descripcion', 'ASC'); 
 
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
   * @param  integer $id_empresa
   * @return array
   */
  public function eliminar($id_cliente=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_cliente = ".$id_cliente.";";
    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------
  
}

/* Fin del archivo empresas_model.php */
/* Ubicacion: ./application/models/empresas_model.php */