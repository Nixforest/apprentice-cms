<?php
class Admin_Model_ModuleEntity{
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
	
	// Set a value for a property
	public function setProperty($name, $value)
	{
		$this->data[$name] = $value;
	}
	
	// Set an entity
	public function setEntity( $prop)
	{
		$this->data=$prop;
	}
	
	// Get an entity
	public function getDataInsert() 
	{
		return $this->data;
	}
}