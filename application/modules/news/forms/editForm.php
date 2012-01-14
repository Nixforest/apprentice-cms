<?php
class Form_Edit extends Zend_Form{
	public function init(){
		$title=$this->createElement('text', 'title');
		$title->setLabel('Enter title:');
		//$title->setValue('asdas');
		$title->setRequired(TRUE);
		$title->setAttrib('size', 30);
		$this->addElement($title);
		
		$description=$this->createElement('text', 'description');
		$description->setLabel('Enter description:');
		$description->setRequired(TRUE);
		$description->setAttrib('size', 100);
		$this->addElement($description);
		
		//Submit button
		$this->addElement('submit','submit',array('label'=>'Submit'));
		//hidden 
		$article_id = $this->createElement('hidden', 'article_id'); 
		$this->addElement($article_id);
	}
}