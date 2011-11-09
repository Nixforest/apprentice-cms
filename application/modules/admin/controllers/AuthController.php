<?php

require_once '/../models/BsRole.php';
require_once 'acl/acl.php';

class Admin_AuthController extends Zend_Controller_Action
{
	//Zend_ACl
	
	protected $_acl;
	public  function init(){
		//disable layout
		$this->_helper->layout->disableLayout();
	}
	
	//
	public function indexAction()
	{
		$this->_redirect('/admin/');
	}
	
	//check login
	public function loginAction() {
		/*//disable layout
		$this->_helper->layout->disableLayout();
		$login=new Model_BsRole();
		$this->view->base =  $this->_request->getBaseUrl();
		$post=$this->getRequest();
		$user=NULL;
		$str=NULL;
		if ($post->ispost())
		{
			if ($post->getPost('txtuser')==NULL)
			{
				$error[]="Please enter username";
			}
			else {
				$user=$post->getPost('txtuser');
			}
			if ($post->getPost('txtpass')==NULL)
			{
				$error[]="Please enter password";
			}
			else {
				$str=$post->getPost('txtpass');
				$pass=md5($str);
			}
			if($user!=NULL && $str!=NULL)
			{
				try{
					$row=$login->checkLogin($user, $pass);
					if($row==1)
					{
						$message[]="Login is successfull.";
					}
					else
					{
						$message[]="Login fail";
					}
					$this->view->message=$message; 
				}
				catch (Exception $e)
				{
					echo $e->getMessage();
				}
			}
			else{
				$this->view->error = $error;
			}
		}*/
		
		//Zend_Auth
		//retrieve form data
		$user=$this->getRequest()->getPost('txtuser');
		$str=$this->getRequest()->getPost('txtpass');
		$pass=md5($str);
		
		if (isset($user) && isset($str) && $user!='' && $str!='') //check for POST
		{
			
			//retrieve database from Registry
			$dbAdapter=Zend_Registry::get('connectDb');
			
			//setup database adapter
			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);  
            $authAdapter->setTableName('core_user') 
                        ->setIdentityColumn('user_name') 
                        ->setCredentialColumn('password'); 
                        
           	// Set the input credential values (e.g., from a login form) 
            $authAdapter->setIdentity($user); 
            $authAdapter->setCredential($pass); 

            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($authAdapter);
            
            // returns true if the result represents a successful authentication 
            if ($result->isValid())  
            { 
                // store database row to auth's storage 
                //where the password column has been omitted 
                $auth->getStorage() 
                           ->write($authAdapter->getResultRowObject(null, 'password')); 
                $this->view->auth = true; 
                $this->_redirect(); 
            } else { 
                $this->view->auth = false; // fail authentication 
                switch ($result->getCode()) 
                { 
                    case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND: 
                        $messages = array('user_name' => array('No such identity exists')); 
                        break; 
                    case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID: 
                        $messages = array('password' => array('Does not match current password')); 
                        break; 
                    default: 
                        throw new Exception('Unsupported authentication failure code'); 
                        break; 
                } 
                $this->view->messages = $messages; 
            } 
		}
	}
	
	//logout
	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect('/admin/');
	}
	
	
	
} 