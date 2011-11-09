<?php
class Menu_IndexController extends Zend_Controller_Action {
	public function indexAction() 
	{
		$menuBLO = new Model_MenuBLO();
		$menus = $menuBLO->getMenus();
		$items = $menuBLO->getItems('1');
		$this->view->items = $items;
		/*foreach ($items as $item)
		{
			$s = "";
			for($i=0; $i < $item['depth']; $i++)
			{
				$s .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			echo "<br>". $s .$item['label']. '</br>';
		}*/
	}
	
	Public function addAction()
	{
		$itemdto1 = new Model_ItemDTO();
		$itemdto2 = new Model_ItemDTO();
		
		$itemdto1->set('label', 'item3');
		$itemdto2->set('label', 'item4');
				
		$menuDTO = new Model_MenuDTO();
		$menuDTO->set('name', 'menu1');
		$menuDTO->addItem($itemdto1);
		$menuDTO->addItem($itemdto2);
		
		$menuBLO = new Model_MenuBLO();
		$menuBLO->addMenu($menuDTO);
		
	}
	
	Public function deleteAction()
	{
		$menuBLO = new Model_MenuBLO();
		$menuBLO->deleteMenu('9');
	}
	
}