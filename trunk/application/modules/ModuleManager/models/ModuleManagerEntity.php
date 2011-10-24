<?php
class Model_ModuleManagerEntity//khai báo 1 thực thể thừa của table modulemanager
{
	public $data = array(
		'module_id'   => null,		/** Id of module */
		'name' 		  => null,		/** Name of module */
		'description' => null,		/** Description of module */
		'thumbnail'   => null,		/** URL of thumbnail image that represents module */
		'author' 	  => null,		/** Author of module */
		'email' 	  => null,		/** Email address of author */
		'version' 	  => null,		/** Version of module */
		'license' 	  => null,		/** Module license information */
	);
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