<?php
class Form_AddRoleForm extends Zend_Form
{
	public function init()
	{
		//add role name
		$name=$this->createElement('text', 'name');
		$name->setLabel('Enter role name:');
		$name->setRequired(TRUE);
		$name->setAttrib('size', 30);
		$this->addElement($name);
		
		//add role description
		$description=$this->createElement('text', 'description');
		$description->setLabel('Enter role description:');
		$description->setRequired(TRUE);
		$description->setAttrib('size', 30);
		$this->addElement($description);
		
		//add checkbox
		$lock=$this->createElement('checkbox', 'locked');
		$lock->setLabel('Lock this group');
		$this->addElement($lock);
		
		//add submit button
		$this->addElement('submit', 'submit' ,array('label'=>'Create'));
	}
}