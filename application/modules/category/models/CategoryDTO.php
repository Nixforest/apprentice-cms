<?php

class Model_CategoryDTO
{
public  $_data = array(
		'category_id' 		=> null,	/** Id of category */
		'name' 			 	=> null,	/** Name of category */
		'slug' 			 	=> null,	/** Ex: s-l-u-g */
		'parent_id' 		=> null,	/** parent's Id of category (default=0)	 */
		'is_active' 		=> null,	/** status of category */
		'created_date' 		=> null,	/** the date when category is created */
		'modified_date' 	=> null,	/** the date when category is modified */		
		'user_id'			=> null,	/** id of the user */
		'num_views' 		=> null,	/** the number of views */
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