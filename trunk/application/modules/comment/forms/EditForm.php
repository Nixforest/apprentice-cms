<?php
class Form_Edit extends Zend_Form{
	public function init(){
		
		$this->setMethod('post');		
		
		//Content
		$content = new Zend_Form_Element_Textarea('content_comment_edited');
		$content->setLabel('Content:')
				->setRequired(TRUE)
				->setAttrib('cols', 50)
				->setAttrib('rows',12);
		$this->addElement($content);
		
		// Add the submit button
        //$edit = new Zend_Form_Element_Button('edit_comment');
		//$edit->setLabel('Content:')		
		//		->setRequired(TRUE);				
		//$this->addElement($edit);
		// Add the submit button
        $this->addElement('submit', 'submit_edit', array(
            'ignore'   => true,
            'label'    => 'Submit',
        ));	
	}
}