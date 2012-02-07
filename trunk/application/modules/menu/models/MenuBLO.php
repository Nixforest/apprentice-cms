<?php
Class Model_MenuBLO {
	
	private   $_menuDAO;
	private   $_itemDAO;
	
	public function __construct()
	{
		$this->_menuDAO = new Model_MenuDAO();
		$this->_itemDAO = new Model_ItemDAO();
	}
	//make tab for menu
	public function getMenus()
	{
		$data = $this->_menuDAO->getMenus();
		$menus = array();
		foreach ($data as $menu){
			$htmlMenu = "<li class='ui-state-default ui-corner-top '>";
			$htmlMenu .="<a class='editable' href='#tab-{$menu['menu_id']}'>{$menu['name']}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>";
			$menu['htmlMenu'] = $htmlMenu;
			$menu['htmlItems'] = $this->getItems($menu['menu_id']);
			$menus[$menu['menu_id']]= $menu;
		}
		return $menus;
		
	}
	
	/*	Only when edit Menu, U need load a list items of that Menu.
		Note: this function returns values, one of them is Depth, View layer use
		 it in order to arrange position of items.
	*/
	public function getItems($menuId)
	{
		$data =  $this->_itemDAO->getItems($menuId);
		
		$menu = array();
		foreach ( $data as $item ) {
    		$menu[$item['parent_id']][] = $item;
    	}
		$html = $this->makeMenu($menu, 0, $menuId);
		return $html;
	}
	
	// make items for menu
	private function makeMenu($menu, $parentID, $menuID=1) {
	    if ($parentID == 0){ $html = "<ul id='tab-{$menuID}' class='ui-tabs-panel ui-widget-content ui-corner-bottom ui-sortable'>";} else{
			$html = "<ul>";
		}
	    foreach ( $menu[$parentID] as $item ) {
	        $html .= "<li id='tab-{$menuID}-item-{$item['item_id']}' > <div style='height: 25px; ' class='item'>";
	        $html .="<span><span class='editable' style='cursor: move; padding-right: 20px; background-color: transparent; '>{$item['label']}</span><a href='javascript: void(0);' class='deleteAction' style='display: none; '>Xoa</a></span>";
			$html .="<span style='float: right; width: 400px; '><span class='editable' style='padding-left: 0px; '>{$item['link']}</span></span><hr></div>";
			if ( isset($menu[$item['item_id']]) ) {
	            $html .= $this->makeMenu($menu, $item['item_id'], $menuID);
	        }
	        $html .= "</li>";
	    }
	    $html .= "</ul>";
	    return $html;
	}
	
	public function addMenu($menuDTO)
	{
		 $id = $this->_menuDAO->addMenu($menuDTO);
		 $menuDTO->set('menu_id',$id);
		 $this->_itemDAO->addItems( $menuDTO );
	}
	
	public function deleteMenu()
	{
		$this->_menuDAO->deleteMenu();
	}
	
	
	public function updateMenu($menuDTO)
	{
		$this->_itemDAO->deleteItems( $menuDTO->get('menu_id') );
		$this->_itemDAO->addItems($menuDTO);
	}
	public function CreateMenuMultiLevel($arr,$id='0')
	{// dua cac item trong menu vao mang da chieu	
		foreach($arr as $item){
		if($item['parent_id']==$id){
			echo '<li><a href="'.$item['link'].'" >',$item['label'],'</a>';
				echo '<ul class="dropdownMenu" >';
					$this->CreateMenuMultiLevel($arr,$item['item_id']);
				echo '</ul>';
			echo '</li>';
		}
		
	}
}
	
}