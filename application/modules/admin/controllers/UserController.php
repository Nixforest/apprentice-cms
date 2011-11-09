<?php
class Admin_UserController extends Zend_Controller_Action{
	public  function init()
		{			
			$autoLoader = Zend_Loader_Autoloader::getInstance(); 
		    $autoLoader->registerNamespace('CMS_'); 
		    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
		        'basePath'      => APPLICATION_PATH . '/modules/admin', 
		        'namespace'     => '', 
		        'resourceTypes' => array( 
		            'form' => array( 
		                'path'      => 'forms/', 
		                'namespace' => 'Form_', 
		            ), 
		            'model' => array( 
		                'path'      => 'models/', 
		                'namespace' => 'Model_' 
		            ),		             
		        ), 
		    ));
		    return $autoLoader; 
	}
	public function indexAction(){
		$db = new Model_UserModel();
		$role_user = new Model_BsRole();
		$this->view->role = $role_user->getAllRole();
		$this->view->base =  $this->_request->getBaseUrl();
		$post = $this->getRequest();
		$f=0;
		if($post->isPost()){
			if($post->getPost("tbxuser")!=""){
				$data["user_name"]=$post->getPost("tbxuser");
				$f=1;
			}
			if($post->getPost("tbxemail")!=""){
				$data["email"]=$post->getPost("tbxemail");
				$f=1;
			}
			if($post->getPost("cbxaction")!=""){
				$data["is_active"]=$post->getPost("cbxaction");
				$f=1;
			}
			if($post->getPost("cbxgroups")!=""){
				$data["role_id"]=$post->getPost("cbxgroups");
				$f=1;
			}
			if($f==1)
			{
				$this->view->data = $db->filteruser($data);
				$this->view->filter = $data;
			}
			else 
				$this->view->data = $db->listuser();
			//$this->view->data = $db->filteruser($data);
		}else		
			$this->view->data = $db->listuser();
	}
	//add user
	public function addAction(){		
		$db = new Model_UserModel();
		$role_user = new Model_BsRole();
		$ruleDb = new Model_Rule();
		//$userId = (int)$this->_request->getParam('id');
		//$role_user = new Model_UserModel();//sửa lại bên role
		$this->view->role = $role_user->getAllRole();
		$this->view->base =  $this->_request->getBaseUrl();
		$post = $this->getRequest();
		$fullname=NULL;
		$user=NULL;
		$pass=NULL;
		$pass2=NULL;
		$email=NULL;
		if($post->ispost()){						
			$active = "0";
			if($post->getPost("tbxname")==NULL){
				$error[]="Please enter your Fullname";
			}else{
				$fullname = $post->getPost("tbxname");
			}
			if($post->getPost("tbxuser")==NULL){
				$error[]="Please enter your Username";
			}else{
				$user = $post->getPost("tbxuser");
			}
			if($post->getPost("tbxpass")==NULL){
				$error[]="Please enter your Password";
			}else{
				$pass = $post->getPost("tbxpass");
			}
			if($post->getPost("tbxpass2")==NULL){
				$error[]="Please enter your Re-Password";
			}else{
				if($post->getPost("tbxpass")!=$post->getPost("tbxpass2")){
					$error[] = "Password and Re-Password not match";
				}else{
					$pass2 = $post->getPost("tbxpass2");
				}
			}
			if($post->getPost("tbxemail")==NULL){
				$error[]="Please enter your Email";
			}else{
				//$rule='^[a-zA-Z0-9]{1}[a-zA-Z0-9._][@]{1}[a-zA-Z0-9]{3,}\.[a-zA-Z.]$';
				$rule = '/^[^0-9][A-z0-9_]+[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
				if(preg_match($rule, $post->getPost("tbxemail"))){
					$email = $post->getPost("tbxemail");	
				}else{
					$error[]="Wrong email address";
				}				
			}
			if($post->getPost("cbxgroups")==""){
				$error[]="Please choose a user role";
			}else{
				$role_id = $post->getPost("cbxgroups");	
			}
			if($fullname && $user && $pass && $pass2 && $email && $role_id){
				if($db->checkuser($user)>0){
					$error[]="$user has been registed, please try again";
					$this->view->error = $error;
				}else{
					$data = array(
						"role_id" => $role_id,
						"user_name" => $user,
						"password" => md5($pass),
						"email" => $email,
						"full_name" => $fullname,
						"is_active" => $active,
					);
					
					
					$db->adduser($data);
					$userId = (int)$db->getUserId($user);
					$this->view->message = "user has been created";
					
					//phan tao them:
					$priUserResult = $ruleDb->getPrivilegeIdAllow($role_id,'role');
					while($row = $priUserResult->fetch()){
						$priId = $row['privilege_id'];
						$ruleDb->addRule($userId, 'user', $priId, 1);
					}
					//
				}
			}else{
				$this->view->error = $error;
			}
		}
	}
	//edit user
	public function editAction(){
		$db = new Model_UserModel();
		$role_user = new Model_BsRole();	
		$ruleDb = new Model_Rule();
		//$role_user = new Model_UserModel();//sửa lại bên role
		$this->view->role = $role_user->getAllRole();	
		$this->view->base =  $this->_request->getBaseUrl();
		$post = $this->getRequest();
		$id = $this->_request->getParam('id');
		$oldRoleId = $db->getRoleIdOfUser($id);
		$f=0;
		if($post->isPost()){
			if($post->getPost("tbxname")==""){
				$error[]="Please enter your fullname";
				$f=1;
			}else{
				$data["full_name"]=$post->getPost("tbxname");
			}
			if($post->getPost("tbxuser")==""){
				$error[]="Please enter your usename";
				$f=1;
			}else{
				$data["user_name"]=$post->getPost("tbxuser");
			}
			if($post->getPost("tbxemail")==""){
				$error[]="Please enter your email";
				$f=1;
			}else{
				$rule = '/^[^0-9][A-z0-9_]+[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/';
				if(preg_match($rule, $post->getPost("tbxemail"))){
					$data["email"]=$post->getPost("tbxemail");	
				}else{
					$error[]="Wrong email address";
					$f=1;
				}
			}		
			if($post->getPost("tbxpass")!=""){
				if($post->getPost("tbxpass")!=$post->getPost("tbxpass2")){
					$error[]="Password and Re-Password not match";
					$f=1;
				}else{
					$data["password"]=$post->getPost("tbxpass");
				}
			}
			if($post->getPost("cbxgroups")==""){
				$error[]="Please choose a user role";
				$f=1;
			}else{
				$data["role_id"] = $post->getPost("cbxgroups");
			}
			if($f==1){
				$this->view->error=$error;
				$this->view->data = $db->getone($id);
				$this->view->id=$id;
			}else{
				$db->updateuser($data, $id);
				
				$newRoleId =  $data["role_id"];		//Role Id sau khi cap nhat
				if($oldRoleId != $newRoleId){
					$ruleDb->deleleAllRuleOfObj($id, 'user');
					$priUserResult = $ruleDb->getPrivilegeIdAllow($newRoleId,'role');
					while($row = $priUserResult->fetch()){
						$priId = $row['privilege_id'];
						$ruleDb->addRule($id, 'user', $priId, 1);
					}
				}

				$this->_redirect('admin/user/index');
			}
		}else{			
			$this->view->data = $db->getone($id);
			$this->view->id=$id;
		}		
	}	
	//active user
	public function activeAction(){
		$id = $this->_request->getParam("id");
		$db = new Model_UserModel();
		$db->active($id);
		$this->_redirect("admin/user/index");
	}
	//deactive user
	public function deactiveAction(){
		$id = $this->_request->getParam("id");
		$db = new Model_UserModel();
		$db->deactive($id);
		$this->_redirect("admin/user/index");
	}
	
	public function permissionAction(){
		$priAllowArray[] =null;		//Mang luu id cac quyen cua da~ co cua user
		$priDb = new Model_Privilege();
		$ruleDb = new Model_Rule();	
		$userId = (int)$this->_request->getParam('id');
		$roleId = (int)$this->_request->getParam('role');
		$this->view->userId= $userId;
		$this->view->roleId= $roleId;

		//Lay cac quyen cua 1 nguoi dung va luu vao mang:
		$priAllowResult = $ruleDb->getPrivilegeIdAllow($userId,'user');
		while($row = $priAllowResult->fetch()){
			$priAllowArray[] = $row['privilege_id'];
		}
		$this->view->priAllowArray = $priAllowArray;

		//Danh sach cac module:
		$moduleResult = $priDb->getModuleName();
		$this->view->moduleResult = $moduleResult;
		
		//click vao 1 module item:
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$priResult = $ruleDb->getPriAllowAtModule($roleId, 'role', $moduleName);										
			
			//Luu cac ten controller o trong module vao mang:
			$conResult = $priDb->getControllerName($moduleName);
			while($row = $conResult->fetch()){
				$conArray[]=$row['controller_name'];
			}
			$this->view->conArray = $conArray;
		
			//Add cac quyen da co cua user vao mang de kiem tra:
			while($row = $priResult->fetch()){
				$priArray[]= $row['privilege_id'];
			}
			
			//click vao submit button save:
			if( $this->getRequest()->isPost()){
				foreach($priArray as $id){
					if(isset($_POST[$id])){
						//User chua co quyen thi add quyen do cho user:
						if($ruleDb->checkPrivilege($userId,'user', $id)==0)
							$addRuleResult = $ruleDb->addRule($userId, 'user', $id, 1);
					}
					else
						$ruleDb->deleleRuleAtPriId($userId, $id,'user');				
				}			
				$this->_redirect('admin/user/permission/id/'.$userId.'/role/'.$roleId);
			}
			
			$priResult = $ruleDb->getPriAllowAtModule($roleId,'role',$moduleName);
			$this->view->privilegeResult = $priResult;									
		}						
	}
}