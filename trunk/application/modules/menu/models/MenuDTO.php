<?php
class Model_MenuDTO
{
	protected $_data = array(
		'menu_id' 	   => null,		/** Id of menu */
		'name' 		   => null,		/** Name of menu */
		'description'  => null,		/** Description of menu */
		'user_id' 	   => null,		/** Id of user who create the menu */
		'user_name'    => null,		/** Username of user who create the menu */
		'created_date' => null,		/** Menu's creation date */
		'language'     => null,		/** Language of menu (@since 2.0.8) */
		'items' => array ()
	);
	
	public function set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	
	public function get($name) 
	{
		return $this->_data[$name];
	}
	
	public function setData( $data)
	{
		$this->_data= $data;
	}
	
	public function getData() 
	{
		return $this->_data;
	}
	
	public function addItem($itemDTO)
	{
		array_push($this->_data['items'], $itemDTO );
	}
	
}