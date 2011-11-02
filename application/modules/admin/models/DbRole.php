<?php
require_once '/../models/BsRole.php';

class Model_DbRole extends Zend_Db_Table_Abstract{
	protected $_name='role';
	
	public function getAllRole()
	{
		$sql='SELECT * FROM admin_role';
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	//only exist one name of role.
	public function checkNameRole($name)
	{
		$db = $this->getDefaultAdapter();
		return $db->select()->from('admin_role','*')->where('name=?',$name)->query()->rowCount();
	}
	
	public function addRole($table,$row)
	{
		//insert rows
		$db=$this->getDefaultAdapter();
		$db->insert($table,$row);
	}
	
	//lock
	public function lock($id)
	{
		$db=$this->getDefaultAdapter();
		$table='admin_role';
		$data=array('locked'=>'1');
		$db->update($table, $data, "role_id=".$id);
	}
	
	//unlock
	public function unlock($id)
	{
		$db=$this->getDefaultAdapter();
		$table='admin_role';
		$data=array('locked'=>'0');
		$db->update($table, $data, "role_id=".$id);
	}
	
	//delete
	public function deleteRole($id)
	{
		$db=$this->getDefaultAdapter();
		$table='admin_role';
		$db->delete($table,'role_id='.$id);
	}
	
	//count number of users in each role
	//SELECT admin_role.role_id, admin_role.name, admin_role.description, admin_role.locked, COUNT( core_user.role_id ) AS number_of_users
	//FROM admin_role
	//LEFT JOIN core_user ON admin_role.role_id = core_user.role_id
	//GROUP BY admin_role.role_id
	public function numbUsers()
	{
		$db=$this->getDefaultAdapter();
		$select=$db	->select()
					->from('admin_role',array('role_id','name','description','locked'))
					->joinLeft('core_user','admin_role.role_id=core_user.role_id',array('number_of_users'=>'COUNT(core_user.role_id)'))
					->group('admin_role.role_id');
		return $db->query($select);
	}
	
	//lấy so user của id tại thời điểm click
	public function numCurrentUsers($id)
	{
		$db=$this->getDefaultAdapter();
		$select=$db	->select()
					->from('admin_role')
					->join('core_user','admin_role.role_id=core_user.role_id',array('number_of_users'=>'COUNT(core_user.role_id)'))
					->group('admin_role.role_id')
					->having('admin_role.role_id=?',$id);
		$sql=$select->__toString();
		return $db->query($sql);
	}
	
	//lay unlock cua id tai thoi diem click
	//public function IsUnlock($id)
	//{
	//	$db=$this->getDefaultAdapter();
	//	$select=$db	->select()
	//				->from()
	//}
}