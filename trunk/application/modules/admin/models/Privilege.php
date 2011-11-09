<?php
class Model_Privilege extends Zend_Db_Table_Abstract{
	private $tableName = "privilege"; 
	private $db;
	
	//Contructor:
	public function __construct(){
		$this->db = $this->getDefaultAdapter();
	}
	
	//Lay tat ca cac quyen:
	public function getAllPrivilege($ModuleName){
		return $this->db->select()
						->from($this->tableName,'*')
						->where('module_name like ?',$ModuleName)
						->order('controller_name')
						->query();
	}
	
	//Lay nhung quyen chua bi xoa:
	public function getPrivilege($name){
		return $this->db->select()
				  ->from($this->tableName,'*')
				  ->where('isDeleted=0')
				  ->where('module_name like ?',$name)
				  ->order('controller_name')
				  ->query();		
	}
	
	//Xoa 1 quyen:
	public function deletePrivilege($id) {
		$this->db->update($this->tableName, Array("isDeleted" => "1"),'privilege_id='.$id);
	}
	
	//Them 1 quyen:
	public function addPrivilege($id) {
		$this->db->update($this->tableName, Array("isDeleted" => "0"),'privilege_id='.$id);
	}
	
	//Lay ten module:
	public function getModuleName() {
		return $this->db->select()
						->distinct()
						->from($this->tableName,'module_name')
						->query();
	}	
	
	//Lay ten cac controller trong module xac dinh:
	public function getControllerName($moduleName){
		return $this->db->select()
						->distinct()
						->from($this->tableName,'controller_name')
						->where('module_name like ?',$moduleName)
						->order('controller_name')
						->query();
	}
}