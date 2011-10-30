<?php
class Model_RoleEntity{
	public $data = array(
					'role_id'		=>'null',
					'name'   		=>'null',
					'description'	=>'null',
					'locked'		=>'null');
	
	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}
	public function setdata( $prop)
	{
		$this->data=$prop;
	}
	public function getDataInsert() 
	{
		return $this->data;
	}
}