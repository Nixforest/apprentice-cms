<?php

require_once '/../models/BsRole.php';

class Admin_LoginController extends Zend_Controller_Action
{
	public function indexAction() {
		//disable layout
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
			if($user && $pass)
			{
				try{
					$row=$login->checkLogin($user, $pass);
					if($row==1)
					{
						echo "Login is successfull.";
					}
					else
					{
						echo "Login fail";
					} 
				}
				catch (Exception $e)
				{
					echo $e->getMessage();
				}
			}
			else{
				$this->view->error = $error;
			}
		}
	}
} 