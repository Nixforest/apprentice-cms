<?php
/**
 * @author Nguyen Ngoc Dai.
 * @uses NewsBlo: là lớp chuyên xử lý các vần đề về nghiệp vụ cho News, 
 * 		nó gần gũi với các chức năng có trên lớp View.
 * 		Blo không trực tiếp thao tác đến csdl mà lấy thông tin thông qua lớp Dao
 */

Class Model_NewsBlo {
	
	private   $_newsDao;
	
	public function __construct()
	{
		$this->_newsDao = new Model_NewsDao();
	}
	public function addNews($article)
	{
		$id = $this->_newsDao->addNews($article);
		return $id;
	}
	
	public function deleteNews($id)
	{
		$this->_newsDao->deleteNews($id);
	}
	
	public function updateNews($article)
	{
		$this->_newsDao->updateNews($article);
	}
	
	
}