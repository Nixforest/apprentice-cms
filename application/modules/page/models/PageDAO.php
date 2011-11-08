<?php
class Model_PageDAO extends Zend_Db_Table_Abstract{
	protected $_name = 'page';
	
	public function getAll() {
		$sql  = "SELECT * FROM page";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}

	public function getById($page_id){
		$sql = "SELECT * FROM `page` where `page_id`=".$page_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}

	public function addPage($page)
	{
		$row = $this->createRow($page->getData());
		$result = $row->save();
		return $result;
	}
	
	public function updatePage($page)
	{
		$row = $this->find( $page->get('page_id') )->current();
		if ($row)
		{
			$row->setFromArray( $page->getData() );
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deletePage($id)
	{
		// find the row that matches the id
		$row = $this->find($id)->current();
		
		if ($row) {
			$row->delete();
			return true;
		} else {
			throw new Zend_Exception("Delete function failed; could not find row!");
		}
	}
}