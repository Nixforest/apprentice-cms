<?php
Class Model_MenuBLO {
	
	private   $_menuDAO;
	private   $_itemDAO;
	
	public function __construct()
	{
		$this->_menuDAO = new Model_MenuDAO();
		$this->_itemDAO = new Model_ItemDAO();
	}

	public function getMenus()
	{
		return $this->_menuDAO->getMenus();
	}
	
	/*	Only when edit Menu, U need load a list items of that Menu.
		Note: this function returns values, one of them is Depth, View layer use
		 it in order to arrange position of items.
	*/
	public function getItems($menuId)
	{
		return $this->_itemDAO->getItems($menuId);
	}
	
	public function addMenu($menuDTO)
	{
		 $id = $this->_menuDAO->addMenu($menuDTO);
		 $menuDTO->set('menu_id',$id);
		 $this->_itemDAO->addItems( $menuDTO );
	}
	
	public function deleteMenu($menuId)
	{
		$this->_menuDAO->deleteMenu($menuId);
	}
	
	public function updateMenu($menuDTO)
	{
		$this->_itemDAO->deleteItems( $menuDTO->get('menu_id') );
		$this->_itemDAO->addItems($menuDTO);
	}
	
	
}