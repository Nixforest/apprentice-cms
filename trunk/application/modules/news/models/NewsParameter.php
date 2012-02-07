<?php

/**
 * @author Nixforest
 * */

class Model_NewsParameter extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'news_parameter';
	
	public function getParameter($key){
		$sql = "SELECT * FROM `news_parameter` WHERE `key` =".$key;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getParameterValue($id){
		$row = $this->find($id)->current();
		if ($row)
		{
			return $row->value;
		} else {
			throw new Zend_Exception("Could not find row!");
		}
	}
	
	public function setParameterValue($id, $value){
		$row = $this->find($id)->current();
		if ($row) {
			$row->value = $value;
			$row->save();
		}else{
			throw new Zend_Exception("Could not find row!");
		}
	}
}