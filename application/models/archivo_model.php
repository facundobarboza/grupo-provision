<?php

if( !defined('BASEPATH') ) exit('No direct script access');


class archivo_model extends MY_Model {

  // --------------------------------------------------------------------

  /**
   * [__construct description]
   */
  function __construct() {
    parent::__construct();

    // establecemos el esquema y la tabla
    $this->_schema = '';
    $this->_table  = 'fichas';
  }
   // --------------------------------------------------------------------

  /**
   * [exportamos los datos para el excel]
   * 
   * @param  array $datos
   * @return void
   */
  public function get_excel()
  {
    // $fields = $this->db->field_data('archivos');
    $fields =   array("Empresa","Departamento","Sub Departamento","Nombre Archivo","Vigencia","Observacion");
    
    // Util::dump_exit($fields);
    // $query  = $this->db->select('*')->get('archivos');

    //si no es super admin filtramos por empresa
    if($this->session->userdata('id_rol')!=1)
    {
      $id_empresa = $this->session->userdata('id_empresa');
      $this->db->select("nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,nombre_archivo,archivos.fecha_vigencia,".$this->_table.".observacion", FALSE)
               ->from($this->_table)
               ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
               ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               //->where('borrado', 0)
               ->like('fecha_carga', $fecha)
               ->where('borrado', 0)
               ->where('empresa.id_empresa', $id_empresa);
      }
      else
      {
        $this->db->select("nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,nombre_archivo,archivos.fecha_vigencia,".$this->_table.".observacion", FALSE)
               ->from($this->_table)
               ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
               ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               //->where('borrado', 0)
               ->like('fecha_carga', $fecha)
               ->where('borrado', 0);
      }
    $result = $this->db->get();

    return array("fields" => $fields, "query" => $result);
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
    $fecha = Util::fecha_db($data['fecha']);

    if($data['id_ficha']==0)
    {
       //si el cliente no existe lo creamos
      if($data['id_cliente']==0)
      {
        $this->db->set('titular_cliente',utf8_encode($data['titular']))
                      ->set('beneficiario_cliente',utf8_encode($data['beneficiario']))
                      ->set('nro_cliente',utf8_encode($data['nro_cliente']))
                      ->set('id_sindicato_cliente',utf8_encode($data['id_sindicato']))
                ->insert("clientes");
       $data['id_cliente'] = $this->db->insert_id();
      }

      //si no es casa central
      if($data['es_casa_central']==0)
      {
        // Util::dump_exit($data);
        $this->db->set('beneficiario', $data['beneficiario'])
                  ->set('delegacion', $data['delegacion'])
                  ->set('optica', $data['optica'])
                  ->set('fecha', $fecha)
                  ->set('codigo_armazon', $data['codigo_armazon'])
                  ->set('color_armazon', $data['color_armazon'])
                  ->set('estado', $data['estado'])
                  ->set('voucher', $data['voucher'])
                  ->set('nro_pedido', $data['nro_pedido'])
                  ->set('grad_od_esf', $data['grad_od_esf'])
                  ->set('grad_od_cil', $data['grad_od_cil'])
                  ->set('eje_od', $data['eje_od'])
                  ->set('grad_oi_esf', $data['grad_oi_esf'])
                  ->set('grad_oi_cil', $data['grad_oi_cil'])
                  ->set('eje_oi', $data['eje_oi'])
                  ->set('comentario', $data['comentario'])
                  ->set('es_lejos', $data['es_lejos'])
                  ->set('adicional', $data['adicional'])
                  ->set('descripcion_adicional', $data['descripcion_adicional'])
                  ->set('telefono', $data['telefono'])
                  ->set('costo_adicional', $data['costo_adicional'])
                  ->set('sena_adicional', $data['sena_adicional'])
                  ->set('saldo_adicional', $data['saldo_adicional'])
                  ->set('id_sindicato', $data['id_sindicato'])
                  ->set('id_cliente', $data['id_cliente'])
                  ->set('id_stock', $data['id_stock'])
                  ->set('nro_cliente', $data['nro_cliente'])
                  ->set('es_casa_central', $data['es_casa_central'])
               ->insert($this->_table);
      }
      else
      {
        // Util::dump_exit($data);
        $this->db->set('beneficiario', $data['beneficiario'])
                  ->set('delegacion', $data['delegacion'])
                  ->set('optica', $data['optica'])
                  ->set('fecha', $fecha)
                  ->set('codigo_armazon', $data['codigo_armazon'])
                  ->set('color_armazon', $data['color_armazon'])
                  ->set('estado', $data['estado'])
                  ->set('voucher', $data['voucher'])
                  ->set('nro_pedido', $data['nro_pedido'])
                  
                  ->set('id_sindicato', $data['id_sindicato'])
                  ->set('id_cliente', $data['id_cliente'])
                  ->set('id_stock', $data['id_stock'])
                  ->set('nro_cliente', $data['nro_cliente'])
                  ->set('es_casa_central', $data['es_casa_central'])
               ->insert($this->_table);
      }

     

      //descontamos el armazon utlizado del stock
      $sql = "UPDATE stock
              SET  cantidad  = cantidad-1 
              WHERE id_stock = ".$data['id_stock'].";";
      // echo $sql; die();       
      $this->db->query($sql);
    }
    else
    {
      //si no es casa central
      if($data['es_casa_central']==0)
      {
        //si existe modificamos
        $sql = "UPDATE ".$this->_table."
                SET 
                beneficiario          = '".$data['beneficiario']."',
                delegacion            = '".$data['delegacion']."',
                optica                = '".$data['optica']."',
                fecha                 = '".$fecha."',
                codigo_armazon        = '".$data['codigo_armazon']."',
                color_armazon         = '".$data['color_armazon']."',
                estado                = '".$data['estado']."',
                voucher               = '".$data['voucher']."',
                nro_pedido            = '".$data['nro_pedido']."',
                grad_od_esf           = '".$data['grad_od_esf']."',
                grad_od_cil           = '".$data['grad_od_cil']."',
                eje_od                = '".$data['eje_od']."',
                grad_oi_esf           = '".$data['grad_oi_esf']."',
                grad_oi_cil           = '".$data['grad_oi_cil']."',
                eje_oi                = '".$data['eje_oi']."',
                comentario            = '".$data['comentario']."',
                es_lejos              = '".$data['es_lejos']."',
                adicional             = '".$data['adicional']."',
                descripcion_adicional = '".$data['descripcion_adicional']."',
                telefono              = '".$data['telefono']."',
                costo_adicional       = '".$data['costo_adicional']."',
                sena_adicional        = '".$data['sena_adicional']."',
                saldo_adicional       = '".$data['saldo_adicional']."',
                id_sindicato          = '".$data['id_sindicato']."',
                id_cliente            = '".$data['id_cliente']."',
                id_stock              = '".$data['id_stock']."',
                nro_cliente           = '".$data['nro_cliente']."'
                WHERE id_ficha = ".$data['id_ficha'].";";
      }
      else
      {
        //si existe modificamos
        $sql = "UPDATE ".$this->_table."
                SET 
                beneficiario          = '".$data['beneficiario']."',
                delegacion            = '".$data['delegacion']."',
                optica                = '".$data['optica']."',
                fecha                 = '".$fecha."',
                codigo_armazon        = '".$data['codigo_armazon']."',
                color_armazon         = '".$data['color_armazon']."',
                estado                = '".$data['estado']."',
                voucher               = '".$data['voucher']."',
                nro_pedido            = '".$data['nro_pedido']."',
                
                id_sindicato          = '".$data['id_sindicato']."',
                id_cliente            = '".$data['id_cliente']."',
                id_stock              = '".$data['id_stock']."',
                nro_cliente           = '".$data['nro_cliente']."'
                WHERE id_ficha = ".$data['id_ficha'].";";
      }
              // echo $sql; die();
      $this->db->query($sql);
    }
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @return array
   */
  public function obtenerArchivosDelDia() {
   
    $fecha = date("Y-m-d");
    //si no es super admin filtramos por empresa
    if($this->session->userdata('id_rol')!=1)
    {
      $id_empresa = $this->session->userdata('id_empresa');
      $this->db->select("id_archivo,nombre_archivo,".$this->_table.".observacion,archivos.fecha_vigencia,nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,ruta,sub_departamento.id_sub_departamento,departamento.id_departamento,empresa.id_empresa", FALSE)
               ->from($this->_table)
               ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
               ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               //->where('borrado', 0)
               ->like('fecha_carga', $fecha)
               ->where('borrado', 0)
               ->where('empresa.id_empresa', $id_empresa);
      }
      else
      {
        $this->db->select("id_archivo,nombre_archivo,".$this->_table.".observacion,archivos.fecha_vigencia,nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,ruta,sub_departamento.id_sub_departamento,departamento.id_departamento,empresa.id_empresa", FALSE)
               ->from($this->_table)
               ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
               ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
               ->join('empresa','departamento.id_empresa=empresa.id_empresa')
               //->where('borrado', 0)
               ->like('fecha_carga', $fecha)
               ->where('borrado', 0);
      }
    $result = $this->db->get();
    // Util::dump_exit($result->row());


    return $result;
  }

   /**
   *
   * @access public
   * @return array
   */
  public function obtenerFichas() {
   
    
    $this->db->select("*", FALSE)
             ->from($this->_table)
            ->where('activo', 1);;   
    
    $result = $this->db->get();
    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------

  /**
   * Obtener los departamentos asociados a la empresa
   *
   * @access public
   * @return array
   */
  public function obtenerDepartamentos($id_departamento=0) {   

    //si es nueva la empresa
    if($id_departamento==0)
    {
      $this->db->select("id_departamento, descripcion, nombre_empresa,departamento.id_empresa", FALSE)
             ->from($this->_table)
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('departamento.activo', 1);
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
   * @param  integer $id_archivo
   * @return array
   */
  public function eliminar($id_ficha=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_ficha = ".$id_ficha.";";
// echo $sql; exit;
    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de la ficha
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerFicha($id_ficha) {
    $this->db->select("*", FALSE)
             ->from($this->_table)
             ->where('id_ficha', $id_ficha);
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }
  // --------------------------------------------------------------------  

  /**
   * Obtenemos los titulares segun la busqueda
   *
   * @access public
   * @param  taxt $term
   * @return json
   */
  public function autocompleteBeneficiario($term) {

    $array = array('titular_cliente' => $term,
                   'beneficiario_cliente' => $term, 
                   'nro_cliente' => $term,
                   'dni' => $term);

    $this->db->select("id_cliente,titular_cliente,beneficiario_cliente,nro_cliente", FALSE)
             ->from("clientes")
             ->or_like($array);
             
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos del stock
   *
   * @access public
   * @param  text $term
   * @return json
   */
  public function autocompleteArmazon($term) {

    $array = array('codigo_patilla' => $term,
                   'codigo_color' => $term, 
                   'nro_codigo_interno' => $term);

    $this->db->select("id_stock,codigo_color,codigo_patilla,nro_codigo_interno,descripcion_color", FALSE)
             ->from("stock")
             ->or_like($array);
             
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }

  // --------------------------------------------------------------------

  /**
     * las ultimas dos ventas a este titular
     *
     * @access public
     * @return json
     */
  public function historialVentas($id_cliente) {

    $this->db->select("id_ficha,descripcion as sindicato,estado,codigo_armazon,color_armazon,fecha", FALSE)
             ->from("fichas")
             ->join('sindicatos','fichas.id_sindicato=sindicatos.id_sindicato')
             ->where('id_cliente',$id_cliente)
             ->order_by('fecha','DESC')
             ->limit(3);
             
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }
}

/* Fin del archivo archivo_model.php */
/* Ubicacion: ./application/models/archivo_model.php */