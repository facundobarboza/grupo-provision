<?php
if( !defined('BASEPATH') ) exit('No direct script access');

class Status_model extends MY_Model {

    /**
    * [__construct description]
    */
    function __construct() {
        parent::__construct();
        // establecemos el esquema y la tabla
        $this->_schema = '';
        $this->_table  = 'estados';
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
        if($data['id_estados']==0)
        {
          $this->db->set('descripcion',$data['descripcion'])
                  ->insert($this->_table);
        }
        else
        {
          //si existe modificamos
          $sql = "UPDATE ".$this->_table."
                SET descripcion = '".utf8_encode($data['descripcion'])."'
                WHERE id_estados = ".$data['id_estados'].";";
                // echo $sql;exit;
          $this->db->query($sql);
        }
    }

   // --------------------------------------------------------------------

  /**
   * listamos todas las alertas para una empresa
   *
   * @access public
   * @return array
   */
  public function  getStatus() {   
    
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
  public function obtenerDetalle($id_estados=0) {
    
    $this->db->select("*", FALSE)
           ->from($this->_table)
           ->where('id_estados', $id_estados);     
    
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
  public function eliminar($id_estados=0) {
    //si existe modificamos
    $sql = "UPDATE ".$this->_table."
            SET activo  = 0
            WHERE id_estados = ".$id_estados.";";

    $this->db->query($sql);

    // Util::dump_exit($result->row());
  }

    //ALTER TABLE `opticas` ADD `id_estados` INT NOT NULL AFTER `descripcion`;
    public function updateDelegation() {
        
        $sql = "SELECT estadoses,opticas
                FROM excel_estadoses_opticas
                ORDER BY estadoses";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0;      
        $estados    = "";

        foreach ($result_query->result() as $result)
        {
            if(trim($result->estadoses) == trim($estados))
            {
                echo " INSERT INTO opticas (descripcion,id_estados)
                       VALUES ('".$result->opticas."',$id_estados)<br>";

                $this->db->query(" INSERT INTO opticas (descripcion,id_estados)
                                     VALUES ('".$result->opticas."',".$id_estados.");");  

            }
            else
            {
                //insertamosla estados
                echo " INSERT INTO estados (descripcion)
                       VALUES ('".$result->estadoses."')<br>";

                $this->db->query(" INSERT INTO estados (descripcion)
                        VALUES ('".$result->estadoses."')");


                $id_estados = $this->db->insert_id();

                //insertamos la optica
                echo " INSERT INTO opticas (descripcion,id_estados)
                       VALUES ('".$result->opticas."',$id_estados)<br>";

                $this->db->query(" INSERT INTO opticas (descripcion,id_estados)
                                     VALUES ('".$result->opticas."',".$id_estados.");");  
               
               $estados = $result->estadoses;
            }
        }
     }  

    // Util::dump_exit($result->row());
  
    

    public function updateHomins() {
        
        $sql = "SELECT *
                FROM excel_homins";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente = 1; //1 lejos 2 cerca
        $sql = "";
        foreach ($result_query->result() as $result)
        {       
            $this->db->select("id_optica,id_estados", FALSE)
               ->from("opticas")
               ->like('descripcion', $result->optica);
            $result_optica = $this->db->get();
            
            $id_optica = $result_optica->row()->id_optica=="" ? 0: $result_optica->row()->id_optica;
            $id_estados = $result_optica->row()->id_estados=="" ? 0: $result_optica->row()->id_estados;

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', 14);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                $this->db->set('titular_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->nro_beneficiario)))
                              ->set('id_sindicato_cliente',utf8_encode(14))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = "Nro autorizacion: ".$result->nro_autorizacion." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->nro_beneficiario);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_color);
            $nro_pedido       = trim($result->nro_pedido);

            if(trim($result->tipo) == "CERCA")
            {
                $tipo_lente = 2;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon_cerca,color_armazon_cerca, id_estado_cerca, nro_pedido,tipo_lente_cerca,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,14,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',$tipo_lente,1,1,2,'$comentario',$id_estados)";
            }
            else
            {
                $tipo_lente=1;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,14,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',$tipo_lente,1,1,1,'$comentario',$id_estados)";

            }            

            //echo $sql."<br>";
            
            //$this->db->query($sql);  
           
        }
     }  

     public function updateApops() {
        
        $sql = "SELECT *
                FROM excel_apops";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        $id_sindicato  = 16;
        foreach ($result_query->result() as $result)
        {       
            $this->db->select("id_optica,id_estados", FALSE)
               ->from("opticas")
               ->like('descripcion', $result->optica);
            $result_optica = $this->db->get();
            
            $id_optica      = $result_optica->row()->id_optica=="" ? 0: $result_optica->row()->id_optica;
            $id_estados  = $result_optica->row()->id_estados=="" ? 0: $result_optica->row()->id_estados;

            if($id_optica==0)
            {
                $this->db->set('descripcion',utf8_encode(trim($result->optica)))
                        ->insert("opticas");
                $id_optica = $this->db->insert_id();
            }  

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->legajo)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = $result->observaciones." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->legajo);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_armazon);
            $nro_pedido       = trim($result->nro_pedido);

            $cadena_de_texto    = $result->observaciones;
            $cadena_buscada   = 'LEJOS';
            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

            if ($posicion_coincidencia === false) 
            {
                $tipo_lente = 2;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon_cerca,color_armazon_cerca, id_estado_cerca, nro_pedido,tipo_lente_cerca,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',2,1,1,2,'$comentario',$id_estados)";
            }
            else
            {
                $tipo_lente=1;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados)";

            }            

            //echo $sql."<br>";
            
            //$this->db->query($sql);  
        }
     } 


     public function updateSupta() {
        
        $sql = "SELECT *
                FROM excel_sutpa";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        $id_sindicato  = 15;
        foreach ($result_query->result() as $result)
        {       
            $this->db->select("id_optica,id_estados", FALSE)
               ->from("opticas")
               ->like('descripcion', $result->optica);
            $result_optica = $this->db->get();
            
            $id_optica      = $result_optica->row()->id_optica=="" ? 0: $result_optica->row()->id_optica;
            $id_estados  = $result_optica->row()->id_estados=="" ? 0: $result_optica->row()->id_estados;

            if($id_optica==0)
            {
                $this->db->set('descripcion',utf8_encode(trim($result->optica)))
                        ->insert("opticas");
                $id_optica = $this->db->insert_id();
            }  

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->nro_beneficiario)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = $result->observacion." Sucursal: ".$result->optica." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->nro_beneficiario);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_armazon);
            $nro_pedido       = trim($result->nro_pedido);

            $cadena_de_texto    = $result->observaciones;
            $cadena_buscada   = 'CERCA';
            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

            
                $tipo_lente=1;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados)";

                        

            //echo $sql."<br>";
            
            //$this->db->query($sql);  
        }
     }

     public function updateSatsaid_chaco() {
        
        $sql = "SELECT *
                FROM excel_satsaid_chaco";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        $id_sindicato  = 20;
        foreach ($result_query->result() as $result)
        {       
            $this->db->select("id_optica,id_estados", FALSE)
               ->from("opticas")
               ->like('descripcion', $result->optica);
            $result_optica = $this->db->get();
            
            $id_optica      = 210;// satsaid chaco
            $id_estados  = 24;//chaco

            if($id_optica==0)
            {
                $this->db->set('descripcion',utf8_encode(trim($result->optica)))
                        ->insert("opticas");
                $id_optica = $this->db->insert_id();
            }  

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->nro_beneficiario)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = " Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->nro_beneficiario);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_armazon);
            $nro_pedido       = trim($result->nro_pedido);

            $cadena_de_texto    = $result->observaciones;
            $cadena_buscada   = 'CERCA';
            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

            
            $tipo_lente=1;
            $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
               VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados)";

                        

     //       echo $sql."<br>";
            //exit;
       //    $this->db->query($sql);  
        }
     }   

      /*
     13 - UTEDYC
     14 - HOMINS
     15 -  SUTPA
     16 APOPS
     17 SATSAID ENTRE RIOS
     18 SATSAID CORRIENTES
     19 SATSAID LA PAMPA 
     20 SATSAID CHACO
     21 SATSAID MDQ
     22 SATSAID ROSARIO
     23 SATSAID SANTA FE 
     24 AMFA
      */
     
     public function updateSatsaid() {
        
        $sql = "SELECT *
                FROM excel_satsaid";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        
        foreach ($result_query->result() as $result)
        {       
            switch (trim($result->estados)) {
                case 'LA PAMPA':
                    $id_optica      = 0;// satsaid chaco
                    $id_estados  = 50;
                    $id_sindicato   = 19;
                    break;
                case 'ENTRE RIOS':
                    $id_optica      = 0;// satsaid chaco
                    $id_estados  = 35;
                    $id_sindicato   = 17;
                    break;
                 case 'CORRIENTES':
                    $id_optica      = 0;// satsaid chaco
                    $id_estados  = 31;
                    $id_sindicato   = 18;
                    break;
                case 'ROSARIO':
                    $id_optica      = 0;// satsaid chaco
                    $id_estados  = 90;
                    $id_sindicato   = 22;
                    break;
                case 'SANTA FE':
                    $id_optica      = 0;// satsaid chaco
                    $id_estados  = 105;
                    $id_sindicato   = 23;
                    break;
                default:
                    # code...
                    break;
            } 

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->nro_beneficiario)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = "Tipo Lente:".$result->tipo_lentes." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->nro_beneficiario);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_armazon);
            $nro_pedido       = trim($result->nro_pedido);
            
            $tipo_lente=1;
            $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
               VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados)";

            //echo $sql."<br>";
            //exit;
           //$this->db->query($sql);  
        }
     }  

      public function updateSoeme() {
        
        $sql = "SELECT *
                FROM excel_soeme";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        $id_sindicato  = 25;
        foreach ($result_query->result() as $result)
        {       
            $this->db->select("id_optica,id_estados", FALSE)
               ->from("opticas")
               ->like('descripcion', $result->optica);
            $result_optica = $this->db->get();
            
            $id_optica      = $result_optica->row()->id_optica=="" ? 0: $result_optica->row()->id_optica;
            $id_estados  = $result_optica->row()->id_estados=="" ? 0: $result_optica->row()->id_estados;

            if($id_optica==0)
            {
                $this->db->set('descripcion',utf8_encode(trim($result->optica)))
                        ->insert("opticas");
                $id_optica = $this->db->insert_id();
            }  

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->dni)))
                              ->set('dni',utf8_encode(trim($result->dni)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = $result->observaciones." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->dni);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->color);
            $nro_pedido       = trim($result->nro_pedido);

            $cadena_de_texto  = $result->tipo;
            $cadena_buscada   = 'LEJOS';
            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

            if ($posicion_coincidencia === false) 
            {
                $tipo_lente = 2;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon_cerca,color_armazon_cerca, id_estado_cerca, nro_pedido,tipo_lente_cerca,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',2,1,1,2,'$comentario',$id_estados)";
            }
            else
            {
                $tipo_lente=1;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados)";

            }            

            //echo $sql."<br>";
            //exit;
            //$this->db->query($sql);  
        }
     } 

     public function updateUtedyc() {
        
        $sql = "SELECT *
                FROM excel_utedyc
                ORDER BY beneficiario
                LIMIT 15000,18000";

        $result_query = $this->db->query($sql);
        
        //por defecto el primer usuario
        $id_estados = 0; //BUSCARLA POR NOMBRE    
        $id_optica     = 0; //BUSCARLA POR NOMBRE    
        $comentario    = "";
        $tipo_lente    = 1; //1 lejos 2 cerca
        $sql           = "";
        $id_sindicato  = 13;
        foreach ($result_query->result() as $result)
        {              
            //echo $result->nro_pedido." ".$result->nro_beneficiario ;exit;
            $this->db->select("id_estados", FALSE)
               ->from("estados")
               ->like('descripcion', $result->estados);
            $result_optica = $this->db->get();
            
            $id_optica      = 0; //$result_optica->row()->id_optica=="" ? 0: $result_optica->row()->id_optica;
            $id_estados  = $result_optica->row()->id_estados=="" ? 0: $result_optica->row()->id_estados;

            if($id_estados==0)
            {
                $this->db->set('descripcion',utf8_encode(trim($result->optica)))
                        ->insert("estados");
                $id_estados = $this->db->insert_id();
            }  

            $this->db->select("id_cliente", FALSE)
               ->from("clientes")
               ->like('beneficiario_cliente', $result->beneficiario)
               ->where('id_sindicato_cliente', $id_sindicato);
            $result_cliente = $this->db->get();

            $id_cliente = $result_cliente->row()->id_cliente=="" ? 0: $result_cliente->row()->id_cliente;
            
            
            if($id_cliente==0)
            {
                if(trim($result->titular)=='SI')
                    $titular = trim($result->beneficiario);
                else
                    $titular = trim($result->titular);

                $this->db->set('titular_cliente',utf8_encode($titular))
                              ->set('beneficiario_cliente',utf8_encode(trim($result->beneficiario)))
                              ->set('nro_cliente',utf8_encode(trim($result->nro_beneficiario)))
                              ->set('id_sindicato_cliente',utf8_encode($id_sindicato))
                        ->insert("clientes");
               $id_cliente = $this->db->insert_id();
            }           

            $comentario       = "Tipo Lente: ".$result->tipo_lente." Estado:".$result->estado;
            $fecha            = Util::fecha_db(trim($result->fecha));
            $beneficiario     = str_replace("'","",trim($result->beneficiario));
            $nro_beneficiario = trim($result->nro_beneficiario);
            $codigo_armazon   = trim($result->codigo_armazon);
            $color_armazon    = trim($result->letra_color);
            $nro_pedido       = trim($result->nro_pedido);
            $voucher          = trim($result->voucher);

            $cadena_de_texto  = $result->tipo;
            $cadena_buscada   = 'LEJOS';
            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);

            if ($posicion_coincidencia === false) 
            {
                $tipo_lente = 2;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon_cerca,color_armazon_cerca, id_estado_cerca, nro_pedido,tipo_lente_cerca,es_casa_central,activo,es_lejos,comentario,id_estados,voucher_cerca)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',2,1,1,2,'$comentario',$id_estados,'".$voucher."')";
            }
            else
            {
                $tipo_lente=1;
                $sql = " INSERT INTO fichas (beneficiario,nro_cliente,id_cliente,id_sindicato, id_optica,fecha,codigo_armazon,color_armazon, estado, nro_pedido,tipo_lente,es_casa_central,activo,es_lejos,comentario,id_estados,voucher)
                   VALUES ('".$beneficiario."','".$nro_beneficiario."',$id_cliente,$id_sindicato,$id_optica,'".$fecha."','".$codigo_armazon."','".$color_armazon."',2,'".$nro_pedido."',1,1,1,1,'$comentario',$id_estados,'".$voucher."')";

            }            

            echo $sql."<br>";
            //exit;
            $this->db->query($sql);  
            
            }
     }   
}   

/* Fin del archivo alertas_model.php */
/* Ubicacion: ./application/models/alertas_model.php */