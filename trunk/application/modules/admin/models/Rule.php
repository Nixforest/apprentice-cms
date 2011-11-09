<?php 
class Model_Rule extends Zend_Db_Table_Abstract{
	private $tableName = 'rule'; 
	private $priTableName = 'privilege';
	private $db;
	
	//Contructor:
	public function __construct(){
		$this->db = $this->getDefaultAdapter();
	}
	
	//Them 1 quyen cho object:
	public function addRule($object_id,$object_type,$privilege_id,$allow){
	    $sql="insert into rule(object_id,object_type,privilege_id,allow) values ($object_id,'$object_type',$privilege_id,$allow)";
		return $this->db->query($sql);
	}
	
	//Delete 1 quyen cu the cua object:
	public function deleleRuleAtPriId($objId,$privilege_id,$type){
		$this->db->delete($this->tableName, array(
   			 	'privilege_id = ?' => $privilege_id,
    			'object_id = ?' => $objId,
				'object_type like ?' => $type
		));
	}
	
	//Delete tat ca cac quyen cua object:
	public function deleleAllRuleOfObj($objId,$type){
		$this->db->delete($this->tableName, array(
    			'object_id = ?' => $objId,
				'object_type like ?' => $type
		));
	}
	
	//Delete tat ca cac quyen co id xac dinh trong bang:
	public function deleleAllRuleAtPriId($privilege_id){
		$this->db->delete($this->tableName, array(
   			 	'privilege_id = ?' => $privilege_id,
		));
	}

	//Lay nhung quyen ma object dang co:
	public function getPrivilegeIdAllow($objId,$type){
		return $this->db->select()
				  ->from($this->tableName,'privilege_id')
				  ->where('object_id='.$objId)
				  ->where('object_type like ?',$type)
				  ->query();
	}
	
	//Lay nhung quyen trong module cu the ma object duoc phep:
	public function getPriAllowAtModule($objId,$type,$modulename){
		return $this->db->select()
				  ->from($this->priTableName,'*')
				  ->join($this->tableName,'privilege.privilege_id = rule.privilege_id')
				  ->where('object_id='.$objId)
				  ->where('object_type like ?',$type)
				  ->where('module_name like ?',$modulename)
				  ->order('controller_name')
				  ->query();
	}
	
	//Kiem tra 1 object da co quyen do chua:
	public function checkPrivilege($id,$type,$priId){
		return $this->db->select()
				  ->from($this->tableName,'*')
				  ->where('object_id=?',$id)
				  ->where('object_type like ?',$type)
				  ->where('privilege_id=?',$priId)
				  ->query()
				  ->rowCount();
	}
}