<?php
class Admin_UserController extends Zend_Controller_Action{
	public  function init()
		{			
			//$this->view->headScript()->appendFile('http://localhost:81/apprentice_cms/public/js/jquery.js','text/javascript');
			//$base = $this->_request->getBaseUrl();
        	//$this->view->base=$base;
        	//$this->view->headScript()->appendFile($base."/public/js/jquery.js",'text/javascript');
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
		    // Return it so that it can be stored by the bootstrap 
		    return $autoLoader; 
	}
	public function indexAction(){
		$db = new Model_UserModel();
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
		$role_user = new Model_UserModel();//sửa lại bên role
		$this->view->role = $role_user->listrole(); 
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
					$this->view->message = "user has been created";
				}
			}else{
				$this->view->error = $error;
			}
		}
	}
	//edit user
	public function editAction(){
		$db = new Model_UserModel();	
		$role_user = new Model_UserModel();//sửa lại bên role
		$this->view->role = $role_user->listrole();	
		$post = $this->getRequest();
		$id = $this->_request->getParam('id');
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
	
}