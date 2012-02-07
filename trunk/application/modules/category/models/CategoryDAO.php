<?php
class Model_CategoryDAO extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'category';
	
	public function getById($category_id){
		/*$sql = "SELECT * FROM `category` where `category_id`=".$category_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);*/
		$row = $this->find($category_id)->current();
		if ($row){
			return $row;
		}else{
			throw new Zend_Exception("Could not find row!");
		}
	}
	
	public function getTree()
	{
		$sql = sprintf("SELECT node.category_id, node.name, node.slug,node.parent_id, (COUNT(parent.name) - 1) AS depth,
							node.left_id, node.right_id,node.is_active,node.created_date,node.modified_date,node.user_id,node.num_views
						FROM category AS node,
							category AS parent
						WHERE node.left_id BETWEEN parent.left_id AND parent.right_id
						GROUP BY node.category_id
						ORDER BY node.left_id") ;
		$items = $this->_db->fetchAll($sql);
		return $items;
	}
	public function getAll() {
		$rows = $this->fetchAll();
		return $rows;
		/*$sql  = "SELECT * FROM category";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);*/
	}
	public function getChildCategories($parentCategoryId)
	{
		$sql = "SELECT * FROM category where category.parent_id=".$parentCategoryId."order by ";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function changeStatus($category_id){
		$row = $this->find( $category_id )->current();		
		if ($row)
		{
			//$row->activate_date = date('Y-m-d H:i:s');
			$temp = 1 - $row->is_active;
			$row->is_active = $temp;
			$row->save();			
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	
	
	public function addCategory($category)
	{
		$row = $this->createRow($category->getData());
		$result = $row->save();
		return $result;
	}
	
	public function updateCategory($category)
	{
		$row = $this->find( $category->get('category_id') )->current();
		if ($row)
		{
			$row->setFromArray( $category->getData()); 
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deleteCategory($category_id)
	{
		// find the row that matches the comment_id
		$row = $this->find($category_id)->current();
		if ($row) {
			$row->delete();
			return true;
		} else {
			throw new Zend_Exception("Delete function failed; could not find row!");
		}
	}
}