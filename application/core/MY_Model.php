<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

  protected $_schema         = '';
  protected $_table          = '';
  protected $_primary_key    = 'id';
  protected $_primary_filter = 'intval';
  protected $_order_by       = '';
  protected $_timestamps     = FALSE;
  public    $rules           = array();

  // --------------------------------------------------------------------

  function __construct() {
    parent::__construct();
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function array_from_post($fields) {
    $data = array();
    
    foreach( $fields as $field )
      $data[$field] = $this->input->post($field);

    return $data;
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function get($id = NULL, $single = FALSE) {
    if( !is_null($id) )
    {
      if( $this->_primary_filter != '' )
      {
        $filter = $this->_primary_filter;
        $id     = $filter($id);
      }

      $this->db->where($this->_primary_key, $id);
      $method = 'row';
    }
    else
    {
      if( $single )
        $method = 'row';
      else
        $method = 'result';
    }

    if( $this->_order_by !== '' )
      $this->db->order_by($this->_order_by);

    return $this->db->get($this->_schema.$this->_table)->$method();
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function get_by($where, $limit = 1) {
    $this->db->where($where);

    if( !is_null($limit) )
      $this->db->limit((int)$limit);

    return $this->db->get($this->_schema.$this->_table);
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function save($data, $id = NULL) {
    // Set Timestamps
    if( $this->_timestamps )
    {
      $now = date('Y-m-d H:i:s');
      $id || $data['created'] = $now;
      $data['modified'] = $now;
    }

    // Insert
    if( is_null($id) )
    {
      $this->db->set($data)
               ->insert($this->_schema.$this->_table);

      $id = $this->db->insert_id();
    }
    // Update
    else
    {
      if( $this->_primary_filter != '' )
      {
        $filter = $this->_primary_filter;
        $id     = $filter($id);
      }

      $this->db->set($data)
               ->where($this->_primary_key, $id)
               ->update($this->_schema.$this->_table);
    }

    return $id;
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function delete($id) {
    if( $this->_primary_filter != '' )
    {
      $filter = $this->_primary_filter;
      $id = $filter($id);
    }

    if( !$id )
      return FALSE;

    $this->db->where($this->_primary_key, $id)
             ->limit(1);

    if( $this->db->delete($this->_schema.$this->_table) )
      return TRUE;
    else
      return FALSE;
  }

  // --------------------------------------------------------------------

  /**
   * 
   */
  public function logical_delete($id) {
    if( $this->_primary_filter != '' )
    {
      $filter = $this->_primary_filter;
      $id = $filter($id);
    }

    if( !$id )
      return FALSE;

    $this->db->where($this->_primary_key, $id)
             ->limit(1);

    if( $this->db->delete($this->_schema.$this->_table) )
      return TRUE;
    else
      return FALSE;
  }

  // --------------------------------------------------------------------

}