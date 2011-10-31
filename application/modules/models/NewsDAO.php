<?php

/**
 * @author Nguyen Ngoc Dai
 * @uses NewsDAO:Lá»›p nÃ y thá»±c hiá»‡n cÃ¡c nghiá»‡p vá»¥ liÃªn quan Ä‘áº¿n lÆ°u trá»¯ vÃ  truy xuáº¥t dá»¯ liá»‡u cá»§a á»©ng dá»¥ng. 
 * 		xá»­ lÃ½ cÃ¡c váº¥n Ä‘á»� vá»� CSDL nhÆ° káº¿t ná»‘i,thÃªm, xÃ³a, sá»­a, 
 * 		hoáº·c láº¥y dá»¯ liá»‡u lÃªn tá»« CSDL Ä‘á»ƒ tráº£ vá»� cho lá»›p bÃªn trÃªn nÃ³ lÃ  lá»›p NewsBlo
 */

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
		$sql = "SELECT article_id, title, description FROM `news_article` where `article_id`=".$article_id;
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
}