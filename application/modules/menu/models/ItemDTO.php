<?php
class Model_ItemDTO
{
	protected $_data = array(
		'menu_item_id' => null,		/** Auto-increment Id */
		'item_id' 	   => null,		/** Id of item */
		'label' 	   => null,		/** Label of item */
		'link' 		   => null,		/** URL of target */
		'menu_id'	   => null,		/** Id of menu */
	
		/**
		 * The left and right indeces.
		 * They are generated automatically.
		 */
		'left_id'	   => null,
		'right_id'     => null,
		'parent_id'    => null  	/** Id of parent item */
		
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