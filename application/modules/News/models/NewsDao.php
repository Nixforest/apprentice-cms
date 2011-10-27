<?php

/**
 * @author Nguyen Ngoc Dai
 * @uses NewsDao: là lớp xử lý các vấn đề về CSDL như kết nối,thêm, xóa, sửa, 
 * 		hoặc lấy dữ liệu lên từ CSDL để trả về cho lớp bên trên nó là lớp ModuleNewsBlo
 */

require_once 'Zend/Db/Table/Abstract.php';

class Model_NewsDao extends Zend_Db_Table_Abstract 
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
		$row->save();
		return $this->_db->lastInsertId();
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