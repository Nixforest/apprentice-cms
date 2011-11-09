<?php
class Comment_AdminController extends Zend_Controller_Action{
	
	
	public function indexAction(){		
          $this->_redirect('comment/admin/list');
	}	

	public function listAction(){
		include '../application/modules/comment/forms/CommentForm.php';
		
		$form = new Form_Comment();         
        if ($form->isValid($_POST)) {
            return $this->_forward('add');             
        }
		$module = new Model_CommentBLO();
		$result=$module->getAll();
		$this->view->result=$result;
		$this->view->form = $form;		
	}
	
	public function deleteAction(){
		$comment_id = $this->_request->getParam('id');
		$module = new Model_CommentBLO();
		$module->deleteComment($comment_id);
		$this->_redirect('comment/admin/list');
	}
	public function activeAction(){
		$comment_id = $this->_request->getParam('id');
		$module = new Model_CommentBLO();
		$module->changeStatus($comment_id);
		$this->_redirect('comment/admin/list');
	}	
	
	public function addAction(){
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$comment_dto = new Model_CommentDTO();
			$comment_dto->setData(array(
				
				'title' 			 => $request->getPost('title_comment'),	
				'content' 			 => strip_tags($request->getPost('content_comment')),
				'full_name' 		 => $request->getPost('name_comment'),	
				'email' 			 => $request->getPost('email_comment'),
				//'user_id' 		 => null,	/** id of user when user logged in */
				//'user_name' 		 => null,	/** name of user when user logged in */		
				'news_id'			 => $request->getPost('article_id'),	/** id of the news that the comment refered to */
				'created_date' 		 => date('Y-m-d H:i:s'),
				'is_active' 		 => 1,	
				'activate_date' 	 => date('Y-m-d H:i:s'),
				//'ordering' 	     => null,	/** the order of the comment of the news */
				//'depth' 	 		 => null,	/** the depth of the comment of the news */
				//'reply_to' 	 	 => null,	/** the id of the comment that is replyed */
		
			));
			
			$comment_blo = new Model_CommentBLO();
			$id = $comment_blo->addComment($comment_dto);
			$this->_redirect('news/article/view/' . $request->getPost('article_id'));			
		}
	}
	
	public function editAction(){
		$comment_id = $this->_request->getParam('id');
		$comment_blo = new Model_CommentBLO();
		$comment_dto = new Model_CommentDTO();
		$comment_dto->setData($comment_blo->getById($comment_id)->fetch());
		
		include '../application/modules/comment/forms/EditForm.php';
		
		$form = new Form_Edit(); 
		$form->getElement('content_comment_edited')->setValue($comment_dto->get('content'));        
        $this->view->form = $form;
		$request = $this->getRequest(); 
		if ($request->isPost()) {        	     
			if ($form->isValid($_POST)) {
				$comment_dto->set('content',$form->getValue('content_comment_edited'));
				$comment_blo->updateComment($comment_dto);
				//return $this->_forward('list');
				$this->_redirect('comment/admin/list');
			}
		}      
	}
}