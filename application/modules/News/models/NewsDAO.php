<?php

/**
 * @author Nguyen Ngoc Dai
 * @uses NewsDAO:Lớp này thực hiện các nghiệp vụ liên quan đến lưu trữ và truy xuất dữ liệu của ứng dụng. 
 * 		xử lý các vấn đề về CSDL như kết nối,thêm, xóa, sửa, 
 * 		hoặc lấy dữ liệu lên từ CSDL để trả về cho lớp bên trên nó là lớp NewsBlo
 */

class Model_NewsDAO extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'news_article';
	
	public function getById($id) 
	{
		$row = $this->find($id);
		return $row;
	}
	
	public function addNews($article)
	{
		$row = $this->createRow($article->getData());
		$result = $row->save();
		//$result = $this->_db->lastInsertId();
		return $result;
	}
	
	
	public function updateNews($article)
	{
		$row = $this->find( $article->get('article_id') )->current();
		if ($row)
		{
			$row->setFromArray($article);
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
}