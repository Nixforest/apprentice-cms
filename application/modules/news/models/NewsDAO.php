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
	
	public function getAll() {
		$sql  = "SELECT * FROM news_article";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
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
	
	public function updateNewsAtAttr($attrName,$id,$newContent){
		$db = $this->getDefaultAdapter();
		$db->update($this->_name, Array($attrName => $newContent),'article_id='.$id);
	}
	
	public function editTitle($id,$title)
	{
		$row = $this->find( $id )->current();
		if ($row)
		{
			$row->title = $title;
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function editDescription($id,$description)
	{
		$row = $this->find( $id )->current();
		if ($row)
		{
			$row->title = $description;
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function editAuthor($id,$author)
	{
		$row = $this->find( $id )->current();
		if ($row)
		{
			$row->title = $author;
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
}