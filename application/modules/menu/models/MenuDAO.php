<?php
class Model_MenuDAO extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'menu';
	protected $_dependentTables = array('Model_ItemDao');
	
	
	public function getMenus() 
	{
		$rows = $this->fetchAll();
		return $rows;
	}
	
	public function addMenu($menuDTO)
	{
		$row = $this->createRow( $menuDTO->getData() );
		$result = $row->save();
		return $result;
	}
	/*Use it to delete a Menu. It automatically deletes items relates to this Menu */
	public function deleteMenu ($menuId)
	{
		$row = $this->find($menuId)->current();
		if ($row) {
			$row->delete();
		} else {
			throw new Zend_Exception('Error loading menu');
		}
	}
	
	/*
	public function createMenu ($name)
	{
		$row = $this->createRow();
		$row->name = $name;
		return $row->save();
	}
	
	
	public function getMenus()
	{
		$select = $this->select();
		$select->order('name');
		$menus = $this->fetchAll($select);
		if ($menus->count() > 0) {
			return $menus;
		} else {
			return null;
		}
	}
	
	public function updateMenu($id, $name)
	{
		$currentMenu = $this->find($id)->current();
		if ($currentMenu) {
			$currentMenu->name = $name;
			return $currentMenu->save();
		} else {
			return false;
		}
	}
	
	





	
	
	public function updateNews($article)
	{
		$row = $this->find( $article->get('article_id') )->current();
		if ($row)
		{
			$row->setFromArray( $article->getData() );
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deleteNews($id)
	{
		// find the row that matches the id
		$row = $this->find($id)->current();
		
		if ($row) {
			$row->delete();
			return true;
		} else {
			throw new Zend_Exception("Delete function failed; could not find row!");
		}
	}*/
}