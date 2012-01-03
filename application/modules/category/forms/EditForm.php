<?php
class Form_Edit extends Zend_Form{
	public function init(){
		
		$this->setMethod('post');		
		
		//Content
		$name = new Zend_Form_Element_Text('name_category_edited');
		$name->setLabel('Name:')
				->setRequired(TRUE);
		$this->addElement($name);
		
		/*
		//Parent ID
		$parent_id = new Zend_Form_Element_Text('parent_id_category_edited');
		$parent_id->setLabel('Parent ID:')		
				->setRequired(TRUE)
				//->addValidator('EmailAddress')
				->setAttrib('size', 30);
		$this->addElement($parent_id);
		*/
		//-------Parent ID------//
		$parent_id = new Zend_Form_Element_Select('parent_id_category_edited');
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
        $this->addElement('submit', 'submit_edit', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));	
	}
}