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
  public function get_excel($fecha_desde,$fecha_hasta,$id_estado, $id_sindicato)
  {

    $fecha_desde = Util::fecha_db($fecha_desde);
    $fecha_hasta = Util::fecha_db($fecha_hasta);
    // $fields = $this->db->field_data('archivos');
    $fields =   array("Id Ficha","Fecha","Beneficiario","Nro Beneficiario","Sindicato","Delegación","Optica","Tipo de Lente","Codigo Armazon","Color Armazon","Nro Pedido","Tipo Lente","Voucher","Adicional","Costo Adicional","Fecha Envio","Codigo Armazon Cerca","Color Armazon Cerca","Nro Pedido Cerca","Tipo Lente Cerca","Voucher Cerca","Adicional Cerca","Costo Adicional Cerca","Fecha Envio Cerca", "Cantidad", "Comentarios");
    
    
    // $query  = $this->db->select('*')->get('archivos');

    if($id_estado>0)
    {
      $where = "(estado=".$id_estado." OR id_estado_cerca=".$id_estado.")"; 

      if($id_sindicato>0 )
      {
        $this->db->select("id_ficha,DATE_FORMAT(fichas.fecha,'%d/%m/%Y') as fecha,beneficiario,nro_cliente, sindicatos.descripcion,delegacion.descripcion as delegacion, opticas.descripcion as optica,
          CASE WHEN es_lejos = 1 THEN 'Lejos' 
            ELSE (CASE WHEN es_lejos=5 THEN 'Bifocal' 
                  ELSE (CASE WHEN es_lejos= 3 THEN 'Lejos y Cerca' 
                      ELSE (CASE WHEN es_lejos=4 THEN 'Fuera de Prestacion' ELSE 'Cerca' END) END ) END) END  as tipo,codigo_armazon,color_armazon,nro_pedido,tipo_lentes.descripcion as t_lentes,voucher,adicional,costo_adicional,fecha_envio,codigo_armazon_cerca,color_armazon_cerca,nro_pedido_cerca,tl_cerca.descripcion as t_lentes_cerca,voucher_cerca,adicional_cerca,costo_adicional_cerca,fecha_envio_cerca,
          CASE WHEN id_stock>0 AND id_stock_cerca>0 THEN 2 ELSE 1 END,comentario ", FALSE)
             ->from($this->_table)
             ->join('opticas',$this->_table.'.id_optica=opticas.id_optica' ,'left')
             ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
             ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
             ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
             ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
             ->where($this->_table.".activo ",1)
             ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
             ->where($where)
             ->where($this->_table.'.id_sindicato',$id_sindicato)
             ->order_by('fecha', 'DESC');
      }
      else
      {
        $this->db->select("id_ficha,DATE_FORMAT(fichas.fecha,'%d/%m/%Y') as fecha,beneficiario,nro_cliente, sindicatos.descripcion,delegacion.descripcion as delegacion, opticas.descripcion as optica,,
          CASE WHEN es_lejos = 1 THEN 'Lejos' 
            ELSE (CASE WHEN es_lejos=5 THEN 'Bifocal' 
                  ELSE (CASE WHEN es_lejos= 3 THEN 'Lejos y Cerca' 
                      ELSE (CASE WHEN es_lejos=4 THEN 'Fuera de Prestacion' ELSE 'Cerca' END) END ) END) END  as tipocodigo_armazon,color_armazon,nro_pedido,tipo_lentes.descripcion as t_lentes,voucher,adicional,costo_adicional,fecha_envio,codigo_armazon_cerca,color_armazon_cerca,nro_pedido_cerca,tl_cerca.descripcion as t_lentes_cerca,voucher_cerca,adicional_cerca,costo_adicional_cerca,fecha_envio_cerca,
          CASE WHEN id_stock>0 AND id_stock_cerca>0 THEN 2 ELSE 1 END,comentario ", FALSE)
             ->from($this->_table)
             ->join('opticas',$this->_table.'.id_optica=opticas.id_optica' ,'left')
             ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
             ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
             ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
             ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
             ->where($this->_table.".activo ",1)
             ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
             ->where($where)
             ->order_by('fecha', 'DESC');
           }
    }
    else
    {
      if($id_sindicato>0 )
      {
        $this->db->select("id_ficha,DATE_FORMAT(fichas.fecha,'%d/%m/%Y') as fecha,beneficiario,nro_cliente, sindicatos.descripcion,delegacion.descripcion as delegacion,opticas.descripcion as optica,
          CASE WHEN es_lejos = 1 THEN 'Lejos' 
            ELSE (CASE WHEN es_lejos=5 THEN 'Bifocal' 
                  ELSE (CASE WHEN es_lejos= 3 THEN 'Lejos y Cerca' 
                      ELSE (CASE WHEN es_lejos=4 THEN 'Fuera de Prestacion' ELSE 'Cerca' END) END ) END) END  as tipo,codigo_armazon,color_armazon,nro_pedido,tipo_lentes.descripcion as t_lentes,voucher,adicional,costo_adicional,fecha_envio,codigo_armazon_cerca,color_armazon_cerca,nro_pedido_cerca,tl_cerca.descripcion as t_lentes_cerca,voucher_cerca,adicional_cerca,costo_adicional_cerca,fecha_envio_cerca,
          CASE WHEN id_stock>0 AND id_stock_cerca>0 THEN 2 ELSE 1 END,comentario ", FALSE)
               ->from($this->_table)
               ->join('opticas',$this->_table.'.id_optica=opticas.id_optica', 'left')
               ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
               ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
              ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
              ->where($this->_table.".activo ",1)
              ->where($this->_table.'.id_sindicato',$id_sindicato)
              ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
              ->order_by('fecha', 'DESC');    
        }
      else
      {
        $this->db->select("id_ficha,DATE_FORMAT(fichas.fecha,'%d/%m/%Y') as fecha,beneficiario,nro_cliente, sindicatos.descripcion,delegacion.descripcion as delegacion,opticas.descripcion as optica,
          CASE WHEN es_lejos = 1 THEN 'Lejos' 
            ELSE (CASE WHEN es_lejos=5 THEN 'Bifocal' 
                  ELSE (CASE WHEN es_lejos= 3 THEN 'Lejos y Cerca' 
                      ELSE (CASE WHEN es_lejos=4 THEN 'Fuera de Prestacion' ELSE 'Cerca' END) END ) END) END  as tipo,codigo_armazon,color_armazon,nro_pedido,tipo_lentes.descripcion as t_lentes,voucher,adicional,costo_adicional,fecha_envio,codigo_armazon_cerca,color_armazon_cerca,nro_pedido_cerca,tl_cerca.descripcion as t_lentes_cerca,voucher_cerca,adicional_cerca,costo_adicional_cerca,fecha_envio_cerca,
          CASE WHEN id_stock>0 AND id_stock_cerca>0 THEN 2 ELSE 1 END,comentario ", FALSE)
               ->from($this->_table)
               ->join('opticas',$this->_table.'.id_optica=opticas.id_optica', 'left')
               ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
               ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
              ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
              ->where($this->_table.".activo ",1)
              ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
              ->order_by('fecha', 'DESC');    
        
      }
    }

    $result = $this->db->get();
// Util::dump_exit($result->row());
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
    $fecha             = Util::fecha_db($data['fecha']);
    $fecha_envio       = Util::fecha_db($data['fecha_envio']);
    $fecha_envio_cerca = Util::fecha_db($data['fecha_envio_cerca']);

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
                  ->set('id_delegacion', $data['id_delegacion'])
                  ->set('id_optica', $data['id_optica'])
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
                  ->set('codigo_armazon_cerca', $data['codigo_armazon_cerca'])
                  ->set('color_armazon_cerca', $data['color_armazon_cerca'])
                  ->set('id_stock_cerca', $data['id_stock_cerca'])
                  ->set('grad_od_esf_cerca', $data['grad_od_esf_cerca'])
                  ->set('grad_od_cil_cerca', $data['grad_od_cil_cerca'])
                  ->set('eje_od_cerca', $data['eje_od_cerca'])
                  ->set('grad_oi_esf_cerca', $data['grad_oi_esf_cerca'])
                  ->set('grad_oi_cil_cerca', $data['grad_oi_cil_cerca'])
                  ->set('eje_oi_cerca', $data['eje_oi_cerca'])
                  ->set('id_estado_cerca', $data['id_estado_cerca'])
                  ->set('voucher_cerca', $data['voucher_cerca'])
                  ->set('nro_pedido_cerca', $data['nro_pedido_cerca'])
                  ->set('es_lejos' , $data['es_lejos'])
                  ->set('fecha_envio' , $fecha_envio)
                  ->set('tipo_lente' , $data['tipo_lente'])
                  ->set('fecha_envio_cerca' , $fecha_envio_cerca)
                  ->set('tipo_lente_cerca' , $data['tipo_lente_cerca'])
                  ->set('laboratorio' , $data['laboratorio'])
                  ->set('laboratorio_cerca' , $data['laboratorio_cerca'])
                  ->set('costo_adicional_cerca' ,$data['costo_adicional_cerca'])
                  ->set('adicional_cerca' , $data['adicional_cerca'])
                  ->set('codigo_barra' , $data['codigo_barra'])
                  ->set('codigo_barra_cerca' , $data['codigo_barra_cerca'])

               ->insert($this->_table);
      }
      else
      {
        // Util::dump_exit($data);
        $this->db->set('beneficiario', $data['beneficiario'])
                  ->set('id_delegacion', $data['id_delegacion'])
                  ->set('id_optica', $data['id_optica'])
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
                  ->set('codigo_armazon_cerca', $data['codigo_armazon_cerca'])
                  ->set('color_armazon_cerca', $data['color_armazon_cerca'])
                  ->set('id_stock_cerca', $data['id_stock_cerca'])
                  ->set('es_lejos' , $data['es_lejos'])
                  ->set('comentario', $data['comentario'])
                  ->set('id_estado_cerca', $data['id_estado_cerca'])
                  ->set('voucher_cerca', $data['voucher_cerca'])
                  ->set('nro_pedido_cerca', $data['nro_pedido_cerca'])
                  ->set('fecha_envio_cerca' , $fecha_envio_cerca)
                  ->set('tipo_lente' , $data['tipo_lente'])
                  ->set('tipo_lente_cerca' , $data['tipo_lente_cerca'])
                  ->set('laboratorio' , $data['laboratorio'])
                  ->set('laboratorio_cerca' , $data['laboratorio_cerca'])
                  ->set('costo_adicional_cerca' ,$data['costo_adicional_cerca'])
                  ->set('adicional_cerca' , $data['adicional_cerca'])
                  ->set('adicional', $data['adicional'])
                  ->set('costo_adicional', $data['costo_adicional'])
                  ->set('codigo_barra' , $data['codigo_barra'])
                  ->set('codigo_barra_cerca' , $data['codigo_barra_cerca'])

               ->insert($this->_table);
      }

     
      if($data['id_stock']>0)
      {
        $id_stock = $data['id_stock'];
      }
      else
      {
        $id_stock = $data['id_stock_cerca'];
      }
      //descontamos el armazon utlizado del stock
      $sql = "UPDATE stock
              SET  cantidad  = cantidad-1 
              WHERE id_stock = ".$id_stock.";";
      // echo $sql; die();       
      $this->db->query($sql);
    }
    else
    {

        $this->db->select("id_stock,id_stock_cerca", FALSE)
               ->from("fichas")
               ->where('id_ficha', $data['id_ficha']);
        $result_stock = $this->db->get();

        $id_stock_old = $result_stock->row()->id_stock==0 ? $result_stock->row()->id_stock_cerca: $result_stock->row()->id_stock;

      //si no es casa central
      if($data['es_casa_central']==0)
      {
        //si existe modificamos
        $sql = "UPDATE ".$this->_table."
                SET 
                beneficiario          = '".$data['beneficiario']."',
                id_delegacion         = '".$data['id_delegacion']."',
                id_optica             = '".$data['id_optica']."',
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
                nro_cliente           = '".$data['nro_cliente']."',
                codigo_armazon_cerca  = '".$data['codigo_armazon_cerca']."',
                color_armazon_cerca   = '".$data['color_armazon_cerca']."',
                id_stock_cerca        = '".$data['id_stock_cerca']."',
                grad_od_esf_cerca     = '".$data['grad_od_esf_cerca']."',
                grad_od_cil_cerca     = '".$data['grad_od_cil_cerca']."',
                eje_od_cerca          = '".$data['eje_od_cerca']."',
                grad_oi_esf_cerca     = '".$data['grad_oi_esf_cerca']."',
                grad_oi_cil_cerca     = '".$data['grad_oi_cil_cerca']."',
                eje_oi_cerca          = '".$data['eje_oi_cerca']."',
                id_estado_cerca       = '".$data['id_estado_cerca']."',
                voucher_cerca         = '".$data['voucher_cerca']."',
                nro_pedido_cerca      = '".$data['nro_pedido_cerca']."',
                fecha_envio           = '".$fecha_envio."',
                tipo_lente            = '".$data['tipo_lente']."',
                fecha_envio_cerca     = '".$fecha_envio_cerca."',
                tipo_lente_cerca      = '".$data['tipo_lente_cerca']."',
                laboratorio           = '".$data['laboratorio']."',
                laboratorio_cerca     = '".$data['laboratorio_cerca']."',
                costo_adicional_cerca = '".$data['costo_adicional_cerca']."',
                adicional_cerca       = '".$data['adicional_cerca']."',
                codigo_barra          = '".$data['codigo_barra']."',
                codigo_barra_cerca    = '".$data['codigo_barra_cerca']."'

                WHERE id_ficha = ".$data['id_ficha'].";";
      }
      else
      {
        //si existe modificamos
        $sql = "UPDATE ".$this->_table."
                SET 
                beneficiario          = '".$data['beneficiario']."',
                id_delegacion         = '".$data['id_delegacion']."',
                id_optica             = '".$data['id_optica']."',
                fecha                 = '".$fecha."',
                codigo_armazon        = '".$data['codigo_armazon']."',
                color_armazon         = '".$data['color_armazon']."',
                estado                = '".$data['estado']."',
                voucher               = '".$data['voucher']."',
                nro_pedido            = '".$data['nro_pedido']."',
                es_lejos              = '".$data['es_lejos']."',
                id_sindicato          = '".$data['id_sindicato']."',
                id_cliente            = '".$data['id_cliente']."',
                id_stock              = '".$data['id_stock']."',
                codigo_armazon_cerca  = '".$data['codigo_armazon_cerca']."',
                color_armazon_cerca   = '".$data['color_armazon_cerca']."',
                id_stock_cerca        = '".$data['id_stock_cerca']."',
                nro_cliente           = '".$data['nro_cliente']."',
                id_estado_cerca       = '".$data['id_estado_cerca']."',
                voucher_cerca         = '".$data['voucher_cerca']."',
                nro_pedido_cerca      = '".$data['nro_pedido_cerca']."',
                fecha_envio           = '".$fecha_envio."',
                tipo_lente            = '".$data['tipo_lente']."',
                fecha_envio_cerca     = '".$fecha_envio_cerca."',
                tipo_lente_cerca      = '".$data['tipo_lente_cerca']."',
                comentario            = '".$data['comentario']."',
                laboratorio           = '".$data['laboratorio']."',
                laboratorio_cerca     = '".$data['laboratorio_cerca']."',
                costo_adicional_cerca = '".$data['costo_adicional_cerca']."',
                adicional_cerca       = '".$data['adicional_cerca']."',
                costo_adicional       = '".$data['costo_adicional']."',
                adicional             = '".$data['adicional']."',
                codigo_barra          = '".$data['codigo_barra']."',
                codigo_barra_cerca    = '".$data['codigo_barra_cerca']."'

                WHERE id_ficha = ".$data['id_ficha'].";";
      }
              // echo $sql; echo "<br>s".$id_stock_old;die();
      $this->db->query($sql);

      if($data['id_stock']>0)
      {
        $id_stock = $data['id_stock'];
      }
      else
      {
        $id_stock = $data['id_stock_cerca'];
      }

      if($id_stock!=$id_stock_old)
      {
        //descontamos el armazon utlizado del stock
        $sql = "UPDATE stock
                SET  cantidad  = cantidad+1 
                WHERE id_stock = ".$id_stock_old.";";
          
        $this->db->query($sql);

        //descontamos el armazon utlizado del stock
        $sql = "UPDATE stock
                SET  cantidad  = cantidad-1 
                WHERE id_stock = ".$id_stock.";";
        
        $this->db->query($sql);
        // echo $sql; die();
      }      
    }
  }

  // --------------------------------------------------------------------

  /**
   *
   * @access public
   * @return array
   */
  public function obtenerArchivosDelDia() {
    date_default_timezone_set('America/Argentina/Buenos_Aires');
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

   // --------------------------------------------------------------------
   /**
   *
   * @access public
   * @return array
   */
  public function obtenerFichas($fecha_desde,$fecha_hasta,$id_estado, $id_sindicato) {
   

    if($id_estado>0)
    {
      $where = "(estado=".$id_estado." OR id_estado_cerca=".$id_estado.")"; 

      if($id_sindicato>0 )
      {
        $this->db->select($this->_table.".*, opticas.descripcion as optica,delegacion.descripcion as delegacion, sindicatos.descripcion as sindicato,tipo_lentes.descripcion as t_desc, tl_cerca.descripcion as t_desc_cerca", FALSE)
             ->from($this->_table)
             ->join('opticas',$this->_table.'.id_optica=opticas.id_optica' ,'left')
             ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
             ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
             ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
             ->where($this->_table.".activo ",1)
             ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
             ->where($where)
             ->where($this->_table.'.id_sindicato',$id_sindicato)
             ->order_by('fecha', 'DESC');
      }
      else
      {
        $this->db->select($this->_table.".*, opticas.descripcion as optica,delegacion.descripcion as delegacion, sindicatos.descripcion as sindicato,tipo_lentes.descripcion as t_desc, tl_cerca.descripcion as t_desc_cerca", FALSE)
             ->from($this->_table)
             ->join('opticas',$this->_table.'.id_optica=opticas.id_optica' ,'left')
             ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
             ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
             ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
             ->where($this->_table.".activo ",1)
             ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
             ->where($where)
             ->order_by('fecha', 'DESC');
           }
    }
    else
    {
      if($id_sindicato>0 )
      {
        $this->db->select($this->_table.".*, opticas.descripcion as optica,delegacion.descripcion as delegacion, sindicatos.descripcion as sindicato,tipo_lentes.descripcion as t_desc, tl_cerca.descripcion as t_desc_cerca", FALSE)
               ->from($this->_table)
               ->join('opticas',$this->_table.'.id_optica=opticas.id_optica', 'left')
               ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
               ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
               ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
              ->where($this->_table.".activo ",1)
              ->where($this->_table.'.id_sindicato',$id_sindicato)
              ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
              ->order_by('fecha', 'DESC');    
        }
      else
      {
        $this->db->select($this->_table.".*, opticas.descripcion as optica,delegacion.descripcion as delegacion, sindicatos.descripcion as sindicato,tipo_lentes.descripcion as t_desc, tl_cerca.descripcion as t_desc_cerca", FALSE)
               ->from($this->_table)
               ->join('opticas',$this->_table.'.id_optica=opticas.id_optica', 'left')
               ->join('delegacion',$this->_table.'.id_delegacion=delegacion.id_delegacion', 'left')
               ->join('sindicatos',$this->_table.'.id_sindicato=sindicatos.id_sindicato', 'left')
               ->join('tipo_lentes',$this->_table.'.tipo_lente=tipo_lentes.id', 'left')
              ->join('tipo_lentes as tl_cerca',$this->_table.'.tipo_lente_cerca=tl_cerca.id', 'left')
              ->where($this->_table.".activo ",1)
              ->where("CONVERT(fichas.fecha, DATE) between '".$fecha_desde."' AND '".$fecha_hasta."'")
              ->order_by('fecha', 'DESC');    
        
      }
    }     
    
    
    $result = $this->db->get();
    // Util::dump_exit($result->row());

    return $result;
  }

   // --------------------------------------------------------------------
  /**
   *
   * @access public
   * @return array
   */
  public function stockMinimo() {   
    
    $this->db->select("id_stock, codigo_patilla, codigo_color, nro_codigo_interno", FALSE)
             ->from("stock")
            ->where('cantidad <= cantidad_minima')
            ->where('activo',1);   
    
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
  public function obtenerTipoLentes() {   
    
    $this->db->select("id, descripcion", FALSE)
           ->from("tipo_lentes");
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
   *
   * @access public
   * @param  integer $id_archivo
   * @return array
   */
  public function cambiarEstado($fichas="",$fecha_envio) {
   
    $fecha_envio = Util::fecha_db($fecha_envio);
    $array_ficha = explode("-", $fichas);

    foreach ($array_ficha as $id_ficha)
    {
      $this->db->select("es_lejos", FALSE)
                 ->from("fichas")
                 ->where('id_ficha', $id_ficha);
      $result = $this->db->get();

      $es_lejos = $result->row()->es_lejos;
      switch ($es_lejos) {
        case '1': //lejos
        $sql = " UPDATE ".$this->_table."
                    SET fecha_envio   = '".$fecha_envio."',
                        estado        = 2
                    WHERE id_ficha = ".$id_ficha;
          break;
        case '5': //bifocal
           $sql = " UPDATE ".$this->_table."
                    SET fecha_envio   = '".$fecha_envio."',
                        estado        = 2
                    WHERE id_ficha = ".$id_ficha;
          break;
        case '2'://cerca
           $sql = " UPDATE ".$this->_table."
                    SET fecha_envio_cerca  = '".$fecha_envio."',
                        id_estado_cerca    = 2
                    WHERE id_ficha = ".$id_ficha;
          break;
        case '3'://lejos y cerca
            $sql = " UPDATE ".$this->_table."
                        SET fecha_envio_cerca  = '".$fecha_envio."',
                            id_estado_cerca    = 2,
                            fecha_envio        = '".$fecha_envio."',
                            estado             = 2
                        WHERE id_ficha = ".$id_ficha;
          break;
        default:
           $sql = " UPDATE ".$this->_table."
                    SET fecha_envio_cerca  = '".$fecha_envio."',
                        id_estado_cerca    = 2,
                        fecha_envio        = '".$fecha_envio."',
                        estado             = 2
                    WHERE id_ficha = ".$id_ficha;
          break;
      }
      
      
      $this->db->query($sql);

      $sql_log = "INSERT INTO log_enviados (id_ficha,fecha_envio,es_lejos) 
                  VALUES (".$id_ficha.",'".$fecha_envio."','".$es_lejos."');";
      $this->db->query($sql_log);
      
    }
    
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
    $this->db->select($this->_table.".*,titular_cliente", FALSE)
             ->from($this->_table)
             ->join('clientes','clientes.id_cliente='.$this->_table.'.id_cliente')
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

    $array = array('beneficiario_cliente' => $term, 
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

    $this->db->select("id_stock,codigo_color,codigo_patilla,nro_codigo_interno,descripcion_color, letra_color_interno, cantidad,cantidad_minima", FALSE)
             ->from("stock")
             ->or_like($array)
             ->where('cantidad > 0 AND activo=',1);
             
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

    $this->db->select("id_ficha,descripcion as sindicato,estado,codigo_armazon,color_armazon,fecha,es_lejos", FALSE)
             ->from("fichas")
             ->join('sindicatos','fichas.id_sindicato=sindicatos.id_sindicato','left')
             ->where('id_cliente',$id_cliente)
             ->where('fichas.activo',1)
             ->order_by('fecha','DESC')
             ->limit(3);
             
    $result = $this->db->get();

    // Util::dump_exit($result->row());

    return $result;
  }
}

/* Fin del archivo archivo_model.php */
/* Ubicacion: ./application/models/archivo_model.php */