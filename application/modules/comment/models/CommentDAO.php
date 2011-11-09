<?php
class Model_CommentDAO extends Zend_Db_Table_Abstract 
{
	
	protected $_name = 'comment';
	
	public function getById($comment_id){
		$sql = "SELECT * FROM `comment` where `comment_id`=".$comment_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getAll() {
		$sql  = "SELECT * FROM comment";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function changeStatus($comment_id){
		$row = $this->find( $comment_id )->current();		
		if ($row)
		{
			$row->activate_date = date('Y-m-d H:i:s');
			$temp = 1 - $row->is_active;
			$row->is_active = $temp;
			$row->save();			
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	
	
	public function addComment($comment)
	{
		$row = $this->createRow($comment->getData());
		$result = $row->save();
		return $result;
	}
	
	public function updateComment($comment)
	{
		$row = $this->find( $comment->get('comment_id') )->current();
		if ($row)
		{
			$row->setFromArray( $comment->getData()); 
			$row->save();
			return true;
		} else {
			throw new Zend_Exception("Update function failed; could not find row!");
		}
	}
	
	public function deleteComment($comment_id)
	{
		// find the row that matches the comment_id
		$row = $this->find($comment_id)->current();
		if ($row) {
			$row->delete();
			return true;
		} else {
			throw new Zend_Exception("Delete function failed; could not find row!");
		}
	}
}