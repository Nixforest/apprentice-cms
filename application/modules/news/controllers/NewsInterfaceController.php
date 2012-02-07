<?php
class News_NewsInterfaceController extends Zend_Controller_Action {
	public function viewAction(){
		$categories = new Model_CategoryBLO();
		$newsParameter = new Model_NewsParameter();
		$request = $this->getRequest();
		if ($request->isPost()) {
			$newsParameter->setParameterValue(CATEGORY_UP, $request->getPost('category_up_select'));
			$newsParameter->setParameterValue(CATEGORY_MIDDLE, $request->getPost('category_middle_select'));
			$newsParameter->setParameterValue(CATEGORY_DOWN, $request->getPost('category_down_select'));
		}
		$category_up = $categories->getById($newsParameter->getParameterValue(CATEGORY_UP));
		$category_middle = $categories->getById($newsParameter->getParameterValue(CATEGORY_MIDDLE));
		$category_down = $categories->getById($newsParameter->getParameterValue(CATEGORY_DOWN));
		$this->view->category_up = $category_up;
		$this->view->category_middle = $category_middle;
		$this->view->category_down = $category_down;
		$this->view->categories = $categories->getAll();
	}
}