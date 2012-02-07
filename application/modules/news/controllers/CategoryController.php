<?php
class News_CategoryController extends Zend_Controller_Action {
	public function viewAction(){
		 $this->_helper->layout->disableLayout();
		$request = $this->getRequest();
		$id = $request->getParam('id');
		$categories = new Model_CategoryBLO();
		$newses = new Model_NewsBLO();
		$category = $categories->getById($id);
		$numberX = 5;
		$newsesInCategory = $newses->getSomeNewsByCategoryId($id, $numberX);
		$this->view->newsesInCategory = $newsesInCategory;
		$this->view->category = $category;
		$this->view->numberX = $numberX;
	}
}