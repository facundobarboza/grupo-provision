<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Sub_Departamentos extends MY_Controller {

  // --------------------------------------------------------------------

  /**
   * constructor
   */
  public function __construct() {
    parent::__construct();
  }

  // --------------------------------------------------------------------

  /**
   * cargar la vista principal
   *
   * @access public
   * @return void
   */
  public function index() {
    $this->output->enable_profiler(FALSE);

    $this->load->view('principal_view');
  }

  // --------------------------------------------------------------------

  /**
   * cargar la vista con el listado de empresas
   *
   * @access public
   * @return void
   */
  public function listado($elimino=0) {

    // cargamos el modelo
    $this->load->model(array('sub_departamentos_model'));

    
    $departamentos         = $this->sub_departamentos_model->obtenerSubDepartamentos();
    // $this->util->dump_exit($departamentos->result());
    
  $departamentos_validas = array();
    // recorremos las liquidaciones del usuario obtenidas
    foreach( $departamentos->result() as $row )
    {     

      $departamentos_validas[] = array('id_sub_departamento' => (int)$row->id_sub_departamento,
                                        'descripcion' => $row->descripcion,
                                        'departamento'  => $row->departamento,
                                        'nombre_empresa'     => $row->nombre_empresa
                                        );  
    }

    // datos pasados a la vista
    $data = array(
      'sub_departamentos'       => $departamentos_validas,
      'contenido_view' => 'sub_departamentos/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/sub_departamentos/listado_view.js'))
    );

    if($elimino==1)
    {      
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se elimino el sub-departamento con &eacute;xito.');
      redirect('sub_departamentos/listado','refresh'); 
    }
    else
      $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------


  /**
   * Actualizar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function guardarSubDepartamento() {

    // cargamos el modelo
    $this->load->model('sub_departamentos_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_departamento'         => $this->input->post('select_departamento'),
                  'id_sub_departamento'     => $this->input->post('id_sub_departamento'),
                  'nombre_sub_departamento' => $this->input->post('nombre_sub_departamento')
                );
     // $this->util->dump_exit($data);
     //guardamos los datos de la empresa 
    $this->sub_departamentos_model->agregar($data);
    
    //si guardamos un nuevo departamento
    if($this->input->post('id_sub_departamento')==0)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso el sub-departamento con &eacute;xito.'); 
      redirect('sub_departamentos/nuevoSubDepartamento','refresh'); 
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se modifico el sub-departamento con &eacute;xito.');
      redirect('sub_departamentos/nuevoSubDepartamento/'.$this->input->post('id_sub_departamento'),'refresh');
    }
  }

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function nuevoSubDepartamento($id_sub_departamento=0) {
    // cargamos el modelo
    $this->load->model('departamentos_model');
     // cargamos el modelo
    $this->load->model('sub_departamentos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $empresas = $this->departamentos_model->obtenerEmpresa();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $empresas->result() as $row )
    {     

      $empresas_validas[] = array('id_empresa' => (int)$row->id_empresa,
                                  'nombre_empresa'  => $row->nombre_empresa
                                  );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_sub_departamento==0)
    {
      // $this->util->dump_exit($empresas->row());
      $data = array(
                    'empresas'       => $empresas_validas,
                    'contenido_view' => 'sub_departamentos/sub_departamento_view',
                    'js'             => array(base_url('assets/js/sub_departamentos/sub_departamento_view.js'))
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      $sub_departamentos = $this->sub_departamentos_model->obtenerSubDepartamentos($id_sub_departamento);
      $departamentos     = $this->sub_departamentos_model->obtenerDepartamentosEmpresa($sub_departamentos->row()->id_empresa); 

      // recorremos las liquidaciones del usuario obtenidas
      foreach( $departamentos->result() as $row )
      { 
        $departamentos_validas[] = array('id_departamento' => (int)$row->id_departamento,
                                          'descripcion'  => $row->descripcion
                                    );  
      }
      // $this->util->dump_exit($departamentos->row());
      $data = array('empresas'                => $empresas_validas,
                    'departamentos'           => $departamentos_validas,
                    'id_sub_departamento'     => $sub_departamentos->row()->id_sub_departamento,
                    'nombre_sub_departamento' => $sub_departamentos->row()->descripcion,
                    'id_empresa'              => $sub_departamentos->row()->id_empresa,
                    'id_departamento'         => $sub_departamentos->row()->id_departamento,
                    'contenido_view'          => 'sub_departamentos/sub_departamento_view',
                    'js'                      => array(base_url('assets/js/sub_departamentos/sub_departamento_view.js'))
                    ); 
    }    
    // $this->util->dump_exit($data);
    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function traerDepartamento($id_empresa=0,$id_departamento=0) {
    // cargamos el modelo
    $this->load->model('sub_departamentos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $departamentos = $this->sub_departamentos_model->obtenerDepartamentosEmpresa($id_empresa);
    //$this->util->dump_exit($departamentos->row());
    // recorremos las liquidaciones del usuario obtenidas
    
    echo "<option value='0'>Seleccionar--</option>";

    foreach( $departamentos->result() as $row )
    {
      if($row->id_departamento==$id_departamento)
        $selected = "selected";
      else     
        $selected = "";

      echo "<option value='".$row->id_departamento."' ".$selected.">".$row->descripcion."</option>";
    }
     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }
  // --------------------------------------------------------------------

  /**
   *
   *
   * @access public
   * @return void
   */
  public function traerSubDepartamento($id_departamento=0,$id_sub_departamento=0) {
    // cargamos el modelo
    $this->load->model('sub_departamentos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $departamentos = $this->sub_departamentos_model->obtenerSubDepartamentosEmpresa($id_departamento);
    //$this->util->dump_exit($departamentos->row());
    // recorremos las liquidaciones del usuario obtenidas
    
    echo "<option value='0'>Seleccionar--</option>";

    foreach( $departamentos->result() as $row )
    {     
      if($row->id_sub_departamento==$id_sub_departamento)
        $selected = "selected";
      else     
        $selected = "";

      echo "<option value='".$row->id_sub_departamento."' ".$selected.">".$row->descripcion."</option>";
    }
     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

   /**
   *
   * @access public
   * @return void
   */
  public function eliminar($id_sub_departamento=0) {
    // cargamos el modelo
    $this->load->model('sub_departamentos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->sub_departamentos_model->eliminar($id_sub_departamento);

     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }
  // --------------------------------------------------------------------
}

/* Fin del archivo sub_departamentos.php */
/* Ubicacion: ./application/controllers/sub_departamentos.php */