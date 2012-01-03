<?php
class Form_Category extends Zend_Form{
	
	public function init(){
		
		$this->setMethod('post');
		
		//Name
		$name = new Zend_Form_Element_Text('name_category');
		$name->setLabel('Name:')
			//->addValidator('alnum') 
         	//->addValidator('regex', false, array('/^[a-z]+/')) 
       		//->addValidator('stringLength', false, array(6, 20))		
			->setRequired(TRUE)
			->setAttrib('size', 30);
		$this->addElement($name);
		
		/*
		//Parent ID
		$parent_id = new Zend_Form_Element_Text('parent_id_category');
		$parent_id->setLabel('Parent ID:')		
				->setRequired(TRUE)
				//->addValidator('EmailAddress')
				->setAttrib('size', 30);
		$this->addElement($parent_id);*/
		
		//-------------//
		$parent_id = new Zend_Form_Element_Select('parent_id');
		$parent_id->setLabel('Categories:');
		
		$categoriesList = new Model_CategoryBLO();
		$parent_id->addMultiOption('0','---');
		foreach ($categoriesList->getAll() as $cate)
		{
				$parent_id->addMultiOption($cate['category_id'],$cate['name']);
		}
		$this->addElement($parent_id);
					
		//-------------//
		
		// Add the submit button
        $this->addElement('submit', 'submit_category', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));
		
		
	}
}