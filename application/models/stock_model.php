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
    $this->_table  = 'stock';
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
    if($data['id_ficha']==0)
    {
      $this->db->set('codigo_patilla',$data['codigo_patilla'])
              ->set('codigo_color',utf8_encode($data['codigo_color']))
              ->set('descripcion_color',utf8_encode($data['descripcion_color']))
              ->set('nro_codigo_interno',utf8_encode($data['nro_codigo_interno']))
              ->set('letra_color_interno',utf8_encode($data['letra_color_interno']))
              ->set('id_tipo_armazon',utf8_encode($data['id_tipo_armazon']))
              ->set('id_material',utf8_encode($data['id_material']))
              ->set('id_ubicacion',utf8_encode($data['id_ubicacion']))
              ->set('costo',utf8_encode($data['costo']))
              ->set('cantidad',utf8_encode($data['cantidad']))
              ->set('precio_venta',utf8_encode($data['precio_venta']))
              ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
            SET codigo_patilla = '".utf8_encode($data['codigo_patilla'])."',
                codigo_color = '".utf8_encode($data['codigo_color'])."',
                descripcion_color = '".utf8_encode($data['descripcion_color'])."',
                nro_codigo_interno = '".utf8_encode($data['nro_codigo_interno'])."',
                letra_color_interno = '".utf8_encode($data['letra_color_interno'])."',                
                id_tipo_armazon = ".$data['id_tipo_armazon']."
                id_material = ".$data['id_material']."
                id_ubicacion = ".$data['id_ubicacion']."
                costo = '".$data['costo']."''
                cantidad = '".$data['cantidad']."''
                precio_venta = '".$data['precio_venta']."''
            WHERE id_stock = ".$data['id_stock'].";";
            // echo $sql;exit;
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de los tipos de armazones
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerTipoArmazon() {
    
      $this->db->select("*", FALSE)
             ->from("tipo_armazon");
    
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de las ubicaciones disponibles
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerUbicacion() {
    
    $this->db->select("*", FALSE)
             ->from("ubicacion");
    
    $result = $this->db->get();
    

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de los materials
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerMateriales() {
    
    $this->db->select("*", FALSE)
             ->from("material");
    
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
  public function obtenerStocks() {   
    
    $this->db->select("*", FALSE)
           ->from($this->_table);
           // ->join('usuario',$this->_table.'.id_usuario=usuario.id_usuario')
           // ->where('cantidad', 0);     
    
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
  public function obtenerDetalle($id_stock=0) {
    
    $this->db->select("*", FALSE)
           ->from($this->_table)
           ->where('id_stock', $id_stock);     
    
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
  public function eliminar($id_stock=0) {
    //si existe modificamos
    $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_stock = ".$id_stock.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo alertas_model.php */
/* Ubicacion: ./application/models/alertas_model.php */