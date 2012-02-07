<?php

/**
 * @author Nguyen Ngoc Dai
 * @uses NewsDAO:Lớp này thực hiện các nghiệp vụ liên quan đến lưu trữ và truy xuất dữ liệu của ứng dụng. 
 * 		xử lý các vấn đề về CSDL như kết nối,thêm, xóa, sửa, 
 * 		hoặc lấy dữ liệu lên từ CSDL để trả về cho lớp bên trên nó là lớp NewsBlo
 * */

class Model_NewsDAO extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'news_article';
	
	/*public function getById($id=NULL) 
	{
		if (isset($row)){
			$row = $this->find($id)->current()->toArray();
		}else {
			
			$row = $this->fetchAll();
		}
		return $row;
	}*/
	
	public function getById($article_id){
		$sql = "SELECT * FROM `news_article` where `article_id`=".$article_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getComments($article_id) {
		$sql = "SELECT * FROM `comment` where `news_id`=".$article_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getHotestNews($number){
		$rows = $this->fetchAll('true', 'article_id DESC', $number,0);
		return $rows;
	}
	
	public function getNewsByCategoryId($category_id){
		$sql = "SELECT * FROM `news_article` WHERE `category_id` =".$category_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getSomeNewsByCategoryId($category_id, $number){
		$rows = $this->fetchAll("category_id =".$category_id, "article_id DESC", $number, 0);
		return $rows;
		//$sql = "SELECT * FROM `news_article` WHERE `category_id` =".$category_id."ORDER BY";
		//$db = $this->getDefaultAdapter();
		//return $db->query($sql);
	}
	
	public function getSomeMostViewNews($number){
		$rows = $this->fetchAll('true', "num_views DESC", $number, 0);
		return $rows;
	}
	
	/*public function getSomeNewsFromUpdateTime($updated_date, $number){
		$sql = "SELECT * FROM `news_article` WHERE `updated_date` >=".$updated_date;
		$db = $this->getDefaultAdapter();
		return $db->query($sql)->fetchAll();
		$rows = $this->fetchAll("updated_date >=".$date, "article_id DESC", $number, 0);
		if ($rows) {
			return rows;
		}else{
			throw new Zend_Exception("Could not find row!");
		}
	}*/
	
	public function getSomeNewsFromUpdateTime($category_id, $updated_date, $number){
		$rows = $this->fetchAll("category_id = ".$category_id." AND updated_date > '".$updated_date."'", "article_id DESC", $number, 0);
		if ($rows) {
			return $rows;
		}else{
			throw new Zend_Exception("Could not find row!");
		}
	}
	
	
	public function getAll() {
		//$sql  = "SELECT * FROM news_article ORDER BY `article_id` DESC";
		//$db = $this->getDefaultAdapter();
		//return $db->query($sql);
		$rows = $this->fetchAll()->toArray();
		return $rows;
	}
	
	public function changeStatus($id, $status){
		$row = $this->find( $id )->current();
		if ($row)
		{
			$row->status = $status;
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function addNews($article)
	{
		$row = $this->createRow($article->getData());
		$result = $row->save();
		return $result;
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
	
	public function updateNewsNumberView($article_id){
		$row = $this->find($article_id)->current();
		if ($row) {
			$row->num_views +=1;
			$row->save();
			return true;
		}else{
			throw new Zend_Exception("Could not find row!");
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
	}
}