<?php
class Category_AdminController extends Zend_Controller_Action{
	
	
	public function indexAction(){		
          $this->_redirect('category/admin/list');
	}	

	public function listAction(){
		include '../application/modules/category/forms/CategoryForm.php';
		
		$form = new Form_Category();       
        if ($form->isValid($_POST)) {
            return $this->_forward('add');             
        }
		$module = new Model_CategoryBLO();
		$result=$module->getAll();
		$this->view->result=$result;
		$this->view->result1 =$result;
		$this->view->form = $form;		
	}
	
	public function deleteAction(){
		$category_id = $this->_request->getParam('id');
		$module = new Model_CategoryBLO();
		$module->deleteCategory($category_id);
		$this->_redirect('category/admin/list');
	}
	public function activeAction(){
		$category_id = $this->_request->getParam('id');
		$module = new Model_CategoryBLO();
		$module->changeStatus($category_id);
		$this->_redirect('category/admin/list');
	}	
	
	public function addAction(){
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$category_dto = new Model_CategoryDTO();
			$category_dto->setData(array(			
				
				'name' 			 	=> $request->getPost('name_category'),	/** Name of category */
				//'slug' 			 	=> null,	/** Ex: s-l-u-g */
				'parent_id' 		=> $request->getPost('parent_id'),	/** parent's Id of category (default=0)	 */
				'is_active' 		=> 1,	/** status of category */
				'created_date' 		=> date('Y-m-d H:i:s'),	/** the date when category is created */
				'modified_date' 	=> date('Y-m-d H:i:s'),	/** the date when category is modified */		
				//'user_id'			=> null,	/** id of the user */
				'num_views' 		=> 0,	/** the number of views */			
			));
			
			$category_blo = new Model_CategoryBLO();
			$id = $category_blo->addCategory($category_dto);
			$this->_redirect('category/admin/list');			
		}
	}
	
	public function editAction(){
		$category_id = $this->_request->getParam('id');
		$category_blo = new Model_CategoryBLO();
		$category_dto = new Model_CategoryDTO();
		$category_dto->setData($category_blo->getById($category_id)->fetch());
		
		include '../application/modules/category/forms/EditForm.php';
		
		$form = new Form_Edit(); 
		$form->getElement('name_category_edited')->setValue($category_dto->get('name'));
		$form->getElement('parent_id_category_edited')->setValue($category_dto->get('parent_id'));        
        $this->view->form = $form;
		$request = $this->getRequest(); 
		if ($request->isPost()) {        	     
			if ($form->isValid($_POST)) {
				$category_dto->set('name',$form->getValue('name_category_edited'));
				$category_dto->set('parent_id',$form->getValue('parent_id_category_edited'));
				$category_dto->set('modified_date', date('Y-m-d H:i:s'));
				$category_blo->updateCategory($category_dto);
				//return $this->_forward('list');
				$this->_redirect('category/admin/list');
			}
		}      
	}
	
	public function countAction(){
		$category_id = $this->_request->getParam('id');
		$category_blo = new Model_CategoryBLO();
		$category_dto = new Model_CategoryDTO();
		$category_dto->setData($category_blo->getById($category_id)->fetch());
		$num_views = $category_dto->get('num_views')+1;
		$category_dto->set('num_views',$num_views);
		$category_blo->updateCategory($category_dto);				
		$this->_redirect('category/admin/list');
	}
	
	public function test1Action()
	{
		$category_blo = new Model_CategoryBLO();
		$result = $category_blo->getAll();
		$this->view->result = $result;		
	}
	public function test2Action()
	{
		include '../application/modules/category/forms/AddCategoryToMenuForm.php';
		$form = new Form_AddCategoryToMenu(); 
		$this->view->form = $form;	
		$request = $this->getRequest(); 
		if ($request->isPost()) 
		{        	     
			if ($form->isValid($_POST)) 
			{
				$this->view->test="huylamtheo"; 
				$list_checked = serialize($form->getValue('list'));
				$this->view->list_checked=$list_checked;
				//$this->_redirect('category/admin/test2');
			}
		} 
		  	
	}
	public function list2Action()
	{
		$categoryBLO = new Model_CategoryBLO();
		$category= $categoryBLO->getTree();
		$this->view->items = $category;		
	}
	
}