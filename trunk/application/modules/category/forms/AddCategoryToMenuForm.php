<?php
class Form_AddCategoryToMenu extends Zend_Form{
	
	public function init(){
		include '/Apprentice_CMS/application/modules/category/forms/AddCategoryToMenuForm.php';
		//$this->headLink()->appendStylesheet($this->url.'skin/admin/default/adminNews.css');
		$this->setMethod('post');
		
		$categoriesList = new Model_CategoryBLO();
		$element = new Zend_Form_Element_MultiCheckbox('list_checkbox', array('multiOptions' => array()));
/*		$element->setDecorators(array(
          array('ViewHelper'),
              array('Description'),
              array('Label', array('separator'=>'<br />')),
              array('HtmlTag', array('tag' => 'li', 'class'=>'huylamtheo')),
       ));*/
		foreach ($categoriesList->getAll() as $cate)
		{
			$aCats[]=$cate;
		}
		$list_checkbox=new Zend_Form_Element_MultiCheckbox('list', array('multiOptions' => array()));
		$list_checkbox=$this->showMenu1(0,$aCats,$element);
		$this->addElement($list_checkbox);		
		//$this->addElement($element);	
		
		
		
		// Add the submit button
        $this->addElement('submit', 'submit_category', array(
            'ignore'   => true,
            'label'    => 'Add to menu',
        ));	
	}
	
	public function showMenu1($parentId,$aCats,$element,$sep='')
	{
		foreach($aCats as $v)
		{
			if($v['parent_id'] == $parentId)
			{
				$tem = new Zend_Form_Element_MultiCheckbox('list_', array('multiOptions' => array()));
				$tem=$element;
				$tem->addMultiOption($v['category_id'],$sep.$v['name']);
				//$tem->setValue(array($v['category_id']));
				$element = $this->showMenu1($v['category_id'],$aCats,$tem,$sep.'----');
			}
		}
		return $element;
	}
}