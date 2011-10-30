<?php
class Model_UserModel extends Zend_Db_Table{
	private $db;
	private $_table = "core_user";
	//ket noi csld luc khoi tao
	public function __construct(){
		/*$this->db = new Zend_Db_Adapter_Pdo_Mssql(array(
			"host" => "localhost",
			"username" => "apprentice",
			"password" => "apprentice",
			"dbname" => "apprentice_cms",
		));*/
		$this->db = $this->getDefaultAdapter();
	}
	//them user
	public function adduser($data){
		$sql = sprintf("INSERT INTO core_user (role_id, user_name, password, full_name, email, is_active)
						VALUES ('%d', '%s', '%s', '%s', '%s', '%d')",
						$data['role_id'],
						$data['user_name'],
						$data['password'],
						$data['full_name'],
						$data['email'],
						$data['is_active']);
		$this->db->query($sql);
	}
	//liet ke user
	public function listuser(){
		//$sql = "select * from core_user";
		//return $this->db->fetchAssoc($sql);
		return $this->db->select()->from($this->_table,'*')->query();	
	}	
	//kiem tra user ton tai hay ko
	public function checkuser($username){
		return $this->db->select()->from($this->_table,'*')->where('user_name=?',$username)->query()->rowCount();
	}
	//get one
	public function getone($id){
		return $this->db->select()->from($this->_table,'*')->where('user_id=?',$id)->query()->fetchAll();
	}
	//update
	public function updateuser($data,$id){
		$this->db->update($this->_table, $data, "user_id=".$id);
	}
	//active
	public function active($id){
		$this->db->update($this->_table, array("is_active"=>"1"),"user_id=".$id);
	}
	//deactive
	public function deactive($id){
		$this->db->update($this->_table, array("is_active"=>"0"),"user_id=".$id);
	}
	//filter
	public function filteruser($data){
		if($data!=null){
			foreach($data as $key=>$value){
				$a[]="$key='$value'";
			}
			$rule = implode(" and ", $a);
			return $this->db->select()->from($this->_table,"*")->where($rule)->query()->fetchAll();
		}else{
			return $this->db->select()->from($this->_table,"*")->query()->fetchAll();
		}
	}
	//list role ---> cái này của thằng lòi công chưa viết nè, dung` tam rui` xoa
	public function listrole(){
		return $this->db->select()->from("admin_role","*")->query()->fetchAll();
	}
}