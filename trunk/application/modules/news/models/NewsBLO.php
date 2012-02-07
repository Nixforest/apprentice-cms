<?php
/**
 * @author Nguyen Ngoc Dai.
 * @uses NewsBLO(Business Logic Object): Lớp này thực hiện các nghiệp vụ chính của module News, 
 * 	sử dụng các dịch vụ do lớp NewsDAO(Data Access) cung cấp, 
 * 	và cung cấp các dịch vụ cho lớp Presentation(View)
 */

Class Model_NewsBLO {
	
	private   $_newsDAO;
	
	public function __construct()
	{
		$this->_newsDAO = new Model_NewsDAO();
	}

	public function getHotestNews($number){
		return $this->_newsDAO->getHotestNews($number);
	}
	
	public function getNewsByCategoryId($category_id){
		return $this->_newsDAO->getNewsByCategoryId($category_id);
	}
	
	public function getSomeNewsByCategoryId($category_id, $number){
		return $this->_newsDAO->getSomeNewsByCategoryId($category_id, $number);
	}
	
	public function getSomeMostViewNews($number){
		return $this->_newsDAO->getSomeMostViewNews($number);
	}
	
	public function getSomeNewsFromUpdateTime($category_id, $updated_date, $number){
		return $this->_newsDAO->getSomeNewsFromUpdateTime($category_id, $updated_date, $number);
	}
	public function getById($id)
	{
		return $this->_newsDAO->getById($id);
	}
	
	public function getComments($id) {
		return $this->_newsDAO->getComments($id);
	}
	
	public function getAll()
	{
		return $this->_newsDAO->getAll();
	}
	
	public function changeStatus($id,$status)
	{
		return $this->_newsDAO->changeStatus($id, $status);
	}

	public function addNews($article)
	{
		$id = $this->_newsDAO->addNews($article);
		return $id;
	}
	
	public function deleteNews($id)
	{
		$this->_newsDAO->deleteNews($id);
	}
		
	public function updateNews($article)
	{
		$this->_newsDAO->updateNews($article);
	}
	
	public function updateNewsNumberView($article_id){
		$this->_newsDAO->updateNewsNumberView($article_id);
	}
	
}