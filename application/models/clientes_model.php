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
    $this->_table  = 'empresa';
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
    $fecha_vigencia = Util::fecha_db($data['fecha_vigencia']);

    if($data['id_empresa']==0)
    {
      $this->db->set('nombre_empresa',utf8_encode($data['nombre_empresa']))
              ->set('direccion',utf8_encode($data['direccion_empresa']))
              ->set('cuit',utf8_encode($data['cuit_empresa']))
              ->set('tipo_actividad',utf8_encode($data['actividad_empresa']))
              ->set('nombre_contacto',utf8_encode($data['contacto_empresa']))
              ->set('telefono_1',$data['telefono_empresa_1'])
              ->set('telefono_2',$data['telefono_empresa_2'])
              ->set('mail',$data['mail_empresa'])
              ->set('observacion',utf8_encode($data['observacion_empresa']))
              ->set('facebook',$data['facebook_empresa'])
              ->set('instagram',$data['instagram_empresa'])
              ->set('fecha_vigencia',$fecha_vigencia)
             ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
              SET nombre_empresa  = '".utf8_encode($data['nombre_empresa'])."',
                  direccion       = '".utf8_encode($data['direccion_empresa'])."',
                  cuit            = '".utf8_encode($data['cuit_empresa'])."',
                  tipo_actividad  = '".utf8_encode($data['actividad_empresa'])."',
                  nombre_contacto = '".utf8_encode($data['contacto_empresa'])."',
                  telefono_1      = '".$data['telefono_empresa_1']."',
                  telefono_2      = '".$data['telefono_empresa_2']."',
                  mail            = '".$data['mail_empresa']."',
                  observacion     = '".utf8_encode($data['observacion_empresa'])."',
                  facebook        = '".utf8_encode($data['facebook_empresa'])."',
                  instagram       = '".$data['instagram_empresa']."',
                  fecha_vigencia  = '".$fecha_vigencia."'
              WHERE id_empresa = ".$data['id_empresa'].";";
              
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
  public function obtenerCiente($id_empresa) {
    $this->db->select("*", FALSE)
             ->from($this->_table)
             ->where('id_empresa', $id_empresa);
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
  public function obtenerDepartamentos($id_empresa=0) {   

    //si es nueva la empresa
    if($id_empresa==0)
    {
      $this->db->select("*", FALSE)
             ->from($this->_table);
    }
    else
    {
      $this->db->select("*", FALSE)
             ->from($this->_table)
             ->where('id_empresa', $id_empresa); 
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
   * @param  integer $id_empresa
   * @return array
   */
  public function eliminar($id_empresa=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_empresa = ".$id_empresa.";";
    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------
  
}

/* Fin del archivo empresas_model.php */
/* Ubicacion: ./application/models/empresas_model.php */