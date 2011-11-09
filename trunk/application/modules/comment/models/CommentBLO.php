<?php
Class Model_CommentBLO {
	
	private   $_commentDAO;
	
	public function __construct()
	{
		$this->_commentDAO = new Model_CommentDAO();
	}

	public function getById($comment_id)
	{
		return $this->_commentDAO->getById($comment_id);
	}
	
	public function getAll()
	{
		return $this->_commentDAO->getAll();
	}
	
	public function changeStatus($comment_id)
	{
		return $this->_commentDAO->changeStatus($comment_id);
	}

	public function addComment($comment)
	{
		$id = $this->_commentDAO->addComment($comment);
		return $id;
	}
	
	public function deleteComment($comment_id)
	{
		$this->_commentDAO->deleteComment($comment_id);
	}
		
	public function updateComment($comment)
	{
		$this->_commentDAO->updateComment($comment);
	}
}