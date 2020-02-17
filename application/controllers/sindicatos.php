<?php

if( !defined('BASEPATH') ) exit('No direct script access allowed');


class Sindicatos extends MY_Controller {

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
    $this->load->model(array('sindicatos_model'));

    // obtenemos lso sindicatos
    $sindicatos  = $this->sindicatos_model->obtenerSindicatos();
    // $this->util->dump_exit($empresas->result());
    
  
    foreach( $sindicatos->result() as $row )
    {     

      $sindicatos_validos[] = array('id_departamento' => (int)$row->id_departamento,
                                  'nombre_empresa'  => $row->nombre_empresa,
                                  'descripcion'     => $row->descripcion
                                  );  
    }

    // $this->util->dump_exit($empresas_validas);

    // datos pasados a la vista
    $data = array(
      'sindicatos'       => $sindicatos_validos,
      'contenido_view' => 'sindicatos/listado_view',
      'css'            => array(base_url('assets/css/dataTables.bootstrap.css')),
      'js'             => array(base_url('assets/js/datatable/jquery.dataTables.min.js'),
                                base_url('assets/js/datatable/jquery.dataTables.es.js'),
                                base_url('assets/js/datatable/dataTables.bootstrap.js'),
                                base_url('assets/js/sindicatos/listado_view.js'))
    );

    if($elimino==1)
    {      
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se elimino el departamento con &eacute;xito.');
      redirect('sindicatos/listado','refresh');    
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
  public function guardarDepartamento() {

    // cargamos el modelo
    $this->load->model('sindicatos_model');
    
    // datos pasados al modelo
    $data = array(
                  'id_departamento'    => $this->input->post('id_departamento'),
                  'id_empresa'         => $this->input->post('select_empresa'),
                  'nombre_departamento'=> $this->input->post('nombre_departamento')
                );
    
     //guardamos los datos de la empresa 
    $this->sindicatos_model->agregar($data);
     
    // $this->util->dump_exit($data);

    //si guardamos un nuevo departamento
    if($this->input->post('id_departamento')==0)
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se ingreso el Departamento con &eacute;xito.');  
      redirect('departamentos/nuevoDepartamento/','refresh');
    }
    else
    {
      // guardamos el log
      $this->log_model->guardar($this->session->userdata('id_usuario'), 4);
      $this->session->set_flashdata('exito', 'Se modifico el Departamento con &eacute;xito.');
      redirect('departamentos/nuevoDepartamento/'.$this->input->post('id_departamento'),'refresh');
    }
    
    
  }

  // --------------------------------------------------------------------

  // --------------------------------------------------------------------

  /**
   * Cargar la vista para editar el perfil del usuario
   *
   * @access public
   * @return void
   */
  public function nuevoDepartamento($id_departamento=0) {
    // cargamos el modelo
    $this->load->model('sindicatos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $empresas = $this->sindicatos_model->obtenerEmpresa();

    // recorremos las liquidaciones del usuario obtenidas
    foreach( $empresas->result() as $row )
    {     

      $empresas_validas[] = array('id_empresa' => (int)$row->id_empresa,
                                  'nombre_empresa'  => $row->nombre_empresa
                                  );  
    }

    // si es nueva le pasamos estos datos a la vista
    if($id_departamento==0)
    {
      // $this->util->dump_exit($empresas->row());
      $data = array(
                    'empresas'       => $empresas_validas,
                    'contenido_view' => 'sindicatos/sindicato_view',
                    'js'             => array(base_url('assets/js/departamentos/sindicato_view.js'))
                    );  
       // $this->util->dump_exit($data);
    }
    else
    {
      $departamentos = $this->sindicatos_model->obtenerDepartamentos($id_departamento);
  
      // $this->util->dump_exit($departamentos->row());
      $data = array('empresas'           => $empresas_validas,
                    'id_departamento'    => $departamentos->row()->id_departamento,
                    'nombre_departamento'=> $departamentos->row()->descripcion,
                    'id_empresa'         => $departamentos->row()->id_empresa,
                    'contenido_view'     => 'sindicatos/sindicato_view',
                    'js'                 => array(base_url('assets/js/departamentos/sindicato_view.js'))
                    ); 
    }    

    $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

   /**
   *
   * @access public
   * @return void
   */
  public function eliminar($id_departamento=0) {
    // cargamos el modelo
    $this->load->model('sindicatos_model');

    $this->load->helper('form');

    // obtenemos las empresas
    $this->sindicatos_model->eliminar($id_departamento);

     // $this->util->dump_exit($empresas_validas);
    
    // $this->load->view('iframe_view', $data);
  }

  // --------------------------------------------------------------------

}

/* Fin del archivo sindicatos.php */
/* Ubicacion: ./application/controllers/sindicatos.php */