<?php
class Form_Comment extends Zend_Form{
	
	public function init(){
		
		$this->setMethod('post');
		
		//full name
		$name = new Zend_Form_Element_Text('name_comment');
		$name->setLabel('Full Name:')
			//->addValidator('alnum') 
         	//->addValidator('regex', false, array('/^[a-z]+/')) 
       		//->addValidator('stringLength', false, array(6, 20))		
			->setRequired(TRUE)
			->setAttrib('size', 30);
		$this->addElement($name);
		
		//email
		$email = new Zend_Form_Element_Text('email_comment');
		$email->setLabel('Email:')		
				->setRequired(TRUE)
				//->addValidator('EmailAddress')
				->setAttrib('size', 30);
		$this->addElement($email);		
		
		//Title
		$title = new Zend_Form_Element_Text('title_comment');
		$title->setLabel('Title:')				
			->setRequired(TRUE)
			->setAttrib('size', 30);
		$this->addElement($title);
		
		//Check
		$this->addElement('captcha', 'code_comment', array(
            'label'      => 'Please enter the 5 letters displayed below:',
            'required'   => true,
            'captcha'    => array(
            'captcha' => 'Figlet',
            'wordLen' => 5,
            'timeout' => 300
            )
        ));
		
		//Content
		$content = new Zend_Form_Element_Textarea('content_comment');
		$content->setLabel('Content:')		
				->setRequired(TRUE)
				->setAttrib('cols', 50)
				->setAttrib('rows',12);
		$this->addElement($content);
		
		// Add the submit button
        $this->addElement('submit', 'submit_comment', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));
		
		
	}
}