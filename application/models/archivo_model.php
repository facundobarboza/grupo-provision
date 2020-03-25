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
    $fecha_vigencia = Util::fecha_db($data['fecha_vigencia']);

    if($data['id_archivo']==0)
    {

      $this->db->set('id_sub_departamento',$data['id_sub_departamento'])
                ->set('observacion',$data['observacion'])
                ->set('fecha_vigencia',$fecha_vigencia)
                ->set('nombre_archivo',$data['nombre_archivo'])
                ->set('ruta',$data['ruta'])
                ->set('size',$data['size'])
                ->set('ancho',$data['ancho'])
                ->set('largo',$data['largo'])
                ->set('file_ext',$data['file_ext'])
                ->set('tipo',$data['tipo'])
             ->insert($this->_table);
    }
    else
    {
      //si existe modificamos
      $sql = "UPDATE ".$this->_table."
              SET id_sub_departamento = ".$data['id_sub_departamento'].",
                  observacion         = '".$data['observacion']."',
                  fecha_vigencia      = '".$fecha_vigencia."',
                  nombre_archivo      = '".$data['nombre_archivo']."',
                  ruta                = '".$data['ruta']."',
                  size                = ".$data['size'].",
                  ancho               = ".$data['nombre_archivo'].",
                  largo                = ".$data['largo'].",
                  file_ext            = '".$data['file_ext']."',
                  tipo                = '".$data['tipo']."'
              WHERE id_archivo = ".$data['id_archivo'].";";
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
  public function obtenerArchivos() {
   
    $fecha = date("Y-m-d");
    //si no es super admin filtramos por empresa
    if($this->session->userdata('id_rol')!=1)
    {
      $id_empresa          = $this->session->userdata('id_empresa');
      $id_departamento     = $this->session->userdata('id_departamento');
      $id_sub_departamento = $this->session->userdata('id_sub_departamento');

      $this->db->select("id_archivo,nombre_archivo,".$this->_table.".observacion,archivos.fecha_vigencia,nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,ruta,sub_departamento.id_sub_departamento,departamento.id_departamento,empresa.id_empresa", FALSE)
             ->from($this->_table)
             ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
             ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('borrado', 0)
             ->where('empresa.id_empresa', $id_empresa);

            if($id_departamento>0)
            {
              $this->db->where('departamento.id_departamento', $id_departamento);
            }

            if($id_sub_departamento>0)
            {
              $this->db->where('sub_departamento.id_sub_departamento', $id_sub_departamento);
            }
    }
    else
    {
      $this->db->select("id_archivo,nombre_archivo,".$this->_table.".observacion,archivos.fecha_vigencia,nombre_empresa,departamento.descripcion as departamento,sub_departamento.descripcion as sub_departamento,ruta,sub_departamento.id_sub_departamento,departamento.id_departamento,empresa.id_empresa", FALSE)
             ->from($this->_table)
             ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
             ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('borrado', 0);
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
  public function eliminar($id_archivo=0) {
   //si existe modificamos
  $sql = "UPDATE ".$this->_table."
            SET borrado  = 1
            WHERE id_archivo = ".$id_archivo.";";
// echo $sql; exit;
    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

  // --------------------------------------------------------------------

  /**
   * Obtener los datos de la empresa
   *
   * @access public
   * @param  integer $login
   * @return array
   */
  public function obtenerArchivo($id_archivo) {
    $this->db->select("id_archivo,sub_departamento.id_sub_departamento,empresa.id_empresa,departamento.id_departamento,".$this->_table.".observacion,".$this->_table.".fecha_vigencia", FALSE)
             ->from($this->_table)
             ->join('sub_departamento','sub_departamento.id_sub_departamento='.$this->_table.'.id_sub_departamento')
             ->join('departamento','departamento.id_departamento=sub_departamento.id_departamento')
             ->join('empresa','departamento.id_empresa=empresa.id_empresa')
             ->where('id_archivo', $id_archivo);
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }
  // --------------------------------------------------------------------  

}

/* Fin del archivo archivo_model.php */
/* Ubicacion: ./application/models/archivo_model.php */