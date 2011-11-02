<?php
class Model_Privilege extends Zend_Db_Table_Abstract{
	//Lay nhung quyen chua bi xoa:
	public function getPrivilege($name){
		$db = Zend_Db_Table::getDefaultAdapter();
		$privilege = "select * from privilege where isDeleted = 0 and module_name like '$name'";
		return $privilege;
	}
	
	//Xoa 1 quyen:
	public function deletePrivilege($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$delete="update privilege set isDeleted=1 where privilege_id=$id";
		return $delete;
	}
	
	//Them 1 quyen:
	public function addPrivilege($id) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$add="update privilege set isDeleted=0 where privilege_id=$id";
		return $add;
	}
	
	//Lay ten module:
	public function getModuleName() {
		$db = Zend_Db_Table::getDefaultAdapter();
		$name="select distinct module_name from privilege";
		return $name;
	}

	//Lay thong tin quyen:
	public function getDescription($ModuleName){
		$db = Zend_Db_Table::getDefaultAdapter();
		$name="select privilege_id,description,module_name,isDeleted from privilege where module_name like '$ModuleName'";
		return $name;	
	}
	
}