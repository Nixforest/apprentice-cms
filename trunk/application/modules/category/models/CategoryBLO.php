<?php
Class Model_CategoryBLO {
	
	private   $_categoryDAO;
	
	public function __construct()
	{
		$this->_categoryDAO = new Model_CategoryDAO();
	}

	public function getById($category_id)
	{
		return $this->_categoryDAO->getById($category_id);
	}
	
	public function getAll()
	{
		return $this->_categoryDAO->getAll();
	}
	public function getChildCategories($parentCategoryId)
	{
		return $this->_categoryDAO->getChildCategories($parentCategoryId);
	}

	public function changeStatus($category_id)
	{
		return $this->_categoryDAO->changeStatus($category_id);
	}

	public function addCategory($category)
	{
		$id = $this->_categoryDAO->addCategory($category);
		return $id;
	}
	
	public function deleteCategory($category)
	{
		$this->_categoryDAO->deleteCategory($category);
	}
		
	public function updateCategory($category)
	{
		$this->_categoryDAO->updateCategory($category);
	}
	public function getTree()
	{
		//$sql = sprintf("SELECT node.category_id, node.name, node.slug,node.parent_id, (COUNT(parent.name) - 1) AS depth,
							//node.left_id, node.right_id
						///FROM category AS node,
							//category AS parent
						//WHERE node.left_id BETWEEN parent.left_id AND parent.right_id
						//GROUP BY node.category_id
						//ORDER BY node.left_id") ;
		//$items = $this->_db->fetchAll($sql);
		return $this->_categoryDAO->getTree();
	}
	
}