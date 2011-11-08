<?php
class Model_PageDTO{
	protected $_data = array(
		'page_id'	=> null,
		'name'		=> null,
		'description'=> null,
		'content'	=> null,
		'parent_id'	=> null,
		'num_views'	=> null,
		'create_date'=> null,
		'modified_date'=> null,
		'user_id'	=> null,
		'language'	=> null,
	);
	
	public function set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	
	public function get($name) 
	{
		return $this->_data[$name];;
	}
	
	public function setData( $data)
	{
		$this->_data= $data;
	}
	
	public function getData() 
	{
		return $this->_data;
	}
}