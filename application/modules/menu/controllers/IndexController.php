<?php
class Menu_IndexController extends Zend_Controller_Action {
	public function indexAction() 
	{
		$request = $this->getRequest();
		$menuBLO = new Model_MenuBLO();
		$menus = $menuBLO->getMenus();
		//$htmlItems = $menuBLO->getItems('1');
		$this->view->menus = $menus;
		
		
		$url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
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
		/*$itemdto1 = new Model_ItemDTO();
		$itemdto2 = new Model_ItemDTO();
		
		$itemdto1->set('label', 'item3');
		$itemdto2->set('label', 'item4');
				
		$menuDTO = new Model_MenuDTO();
		$menuDTO->set('name', 'menu1');
		$menuDTO->addItem($itemdto1);
		$menuDTO->addItem($itemdto2);
		
		$menuBLO = new Model_MenuBLO();
		$menuBLO->addMenu($menuDTO);
		*/
		
			$menus = $_POST['menus'];
			$menus = Zend_Json::decode($menus);	
			$menuBLO = new Model_MenuBLO();
			$menuBLO->deleteMenu();
			foreach($menus as $items){
				$menuDTO = new Model_MenuDTO();
				foreach ($items as $index=>$item ){
					if ($index==0) {
						$menuDTO->set('name', $item['name'] );
					} else{
						$itemDTO = new Model_ItemDTO();
						$itemDTO->set('item_id',$item['item_id']);
						$itemDTO->set('left_id',$item['left']);
						$itemDTO->set('right_id',$item['right']);
						$itemDTO->set('parent_id',$item['parent_id']);
						$itemDTO->set('link',$item['link']);
						$itemDTO->set('label',$item['label']);
						
						$menuDTO->addItem($itemDTO);
						echo 'yes';
					}
				}
				$menuBLO->addMenu($menuDTO);
				
			}
		
		
		$this->_helper->layout->disableLayout();
		
	}
	
	Public function deleteAction()
	{
		$menuBLO = new Model_MenuBLO();
		$menuBLO->deleteMenu('3');
	}
	
}