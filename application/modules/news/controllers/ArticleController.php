<?php
class News_ArticleController extends Zend_Controller_Action {
	public function addAction() {
		$request = $this->getRequest();
		if ($request->isPost()) {
			$article = new Model_ArticleDTO();
			$article->setData(array(
				'title'         => strip_tags($request->getPost('title')),
				'slug'          => $request->getPost('slug'),
			    'description'   => $request->getPost('description'),
			    'content'       => $request->getPost('newsContent'),
				'created_date'  => date('Y-m-d H:i:s'),
				'updated_date'  => date('Y-m-d H:i:s'),
				'author'        => strip_tags($request->getPost('author')),
				'allow_comment' => $request->getPost('allowComment'),
				'is_hot'        => $request->getPost('hotArticle')
			));
			
			$news = new Model_NewsBLO();
			$id = $news->addNews($article);
			
			
			$this->view->article_id = $id;
			$this->view->message = "Add a new article successfully.";
		}
		
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}
	
	public function viewAction() {
        $this->_helper->layout->disableLayout();
		$request = $this->getRequest();
		$id = $request->getParam('article_id');
		
		$news = new Model_NewsBLO();
		$news->updateNewsNumberView($id);
		$categories = new Model_CategoryBLO();
		$article = $news->getById($id)->fetch();
		$number_newer = 10;
		$article_newers = $news->getSomeNewsFromUpdateTime($article['category_id'], $article['updated_date'], $number_newer);
		$category = $categories->getById($article['category_id']);
		
		$this->view->id            = $id;
		$this->view->title         = $article['title'];
		$this->view->description   = $article['description'];
		$this->view->content       = $article['content'];
		$this->view->author        = $article['author'];
		$this->view->created_date  = $article['created_date'];
		$this->view->allowComment  = $article['allow_comment'];
		$this->view->comments      = $news->getComments($id);
		
        $this->view->article = $article;
        $this->view->category = $category;
        $this->view->article_newers = $article_newers;
        $this->view->number_newer = $number_newer;
		$this->view->slug = $category['slug'];
	}

//DUONG THAN DAN
	public function listAction(){
		//$module = new Model_News();
		$module = new Model_NewsBLO();
		$result=$module->getAll();
		$this->view->result = $result;
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}
	
	public function editAction(){
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
        
		$article_id = $this->_request->getParam('id');
		
		if($this->getRequest()->isPost()){
			$request = $this->getRequest();
			
			$article = new Model_ArticleDTO();
			$article->setData(array(
				'article_id'	=> $article_id,
				'title'         => strip_tags($request->getPost('title')),
				'sub_title'     => strip_tags($request->getPost('subTitle')),
				'slug'          => $request->getPost('slug'),
			    'description'   => $request->getPost('description'),
			    'content'       => $request->getPost('content'),
				'author'        => strip_tags($request->getPost('author')),
				'allow_comment' => $request->getPost('allowComment'),
				'is_hot'        => $request->getPost('hotArticle')
			));
			
			$news = new Model_NewsBLO();
			$id = $news->updateNews($article);
			
			$this->_redirect('news/article/list');
		}
		else{
			$module = new Model_NewsBLO();
			$newsEdit = $module->getById($article_id);
			
			$newsEdit->setFetchMode(Zend_Db::FETCH_NUM);
			if($row = $newsEdit->fetchAll()){
				$this->view->newsTitle = $row[0][2];
				$this->view->newsDescription = $row[0][3];
				$this->view->newsContent = $row[0][4];
				$this->view->newsAuthor = $row[0][5];
				$this->view->newsisComment = $row[0][6];
				$this->view->newsisHot = $row[0][7];
			}
		}
	}
	
	public function deleteAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->deleteNews($article_id);
		
		$this->_redirect('news/article/list');
	}
	
	public function activeAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->changeStatus($article_id, 'active');
		
		$this->_redirect('news/article/list');
	}
	
	public function deactiveAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->changeStatus($article_id, 'inactive');
		
		$this->_redirect('news/article/list');
	}
public function edit2Action(){
                $request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
        
                $article_id = $this->_request->getParam('id');
                $this->view->article_id = $article_id;
                
                if($this->getRequest()->isPost()){
                        $request = $this->getRequest();
                        
                        $article = new Model_ArticleDTO();
                        $article->setData(array(
                                'article_id'    => $article_id,
                                'title'         => strip_tags($request->getPost('title')),
                                'sub_title'     => strip_tags($request->getPost('subTitle')),
                                'slug'          => $request->getPost('slug'),
                            'description'   => $request->getPost('description'),
                            'content'       => $request->getPost('content'),
                                'author'        => strip_tags($request->getPost('author')),
                                'allow_comment' => $request->getPost('allowComment'),
                                'is_hot'        => $request->getPost('hotArticle')
                        ));
                        
                        $news = new Model_NewsBLO();
                        $id = $news->updateNews($article);
                        
                        $this->_redirect('news/article/list');
                }
                else{
                        $module = new Model_NewsBLO();
                        $newsEdit = $module->getById($article_id);
                        
                        $newsEdit->setFetchMode(Zend_Db::FETCH_NUM);
                        if($row = $newsEdit->fetchAll()){
                                $this->view->newsTitle = $row[0][2];
                                $this->view->newsDescription = $row[0][3];
                                $this->view->newsContent = $row[0][4];
                                $this->view->newsAuthor = $row[0][5];
                                $this->view->newsisComment = $row[0][6];
                                $this->view->newsisHot = $row[0][7];
                        }
                }
        }
        
        public function edittitleAction()
        {               
                $request = $this->getRequest(); 
                $article_id = $this->_request->getParam('id');
                echo $article_id;
                
                if($request->isPost())
                {
                        $article_id = $this->_request->getParam('id');                                  
                        $module = new Model_NewsBLO();
                        $module->editTitle($article_id, $request->getPost("title_news"));
                }
        }
                
        public function editdescriptionAction()
        {
                $request = $this->getRequest(); 
                                
                if($request->isPost())
                {       
                        $article_id = $this->_request->getParam('id');
                        $module = new Model_NewsBLO();
                        $module->editTitle($article_id, $request->getPost("description_news"));
                }
        }
        
        public function editauthorAction()
        {
                $request = $this->getRequest(); 
                                
                if($request->isPost())
                {                                       
                        $article_id = $this->_request->getParam('id');
                        $module = new Model_NewsBLO();
                        $module->editTitle($article_id, $request->getPost("author_news"));
                }
        }
        public function add2Action()
        {
        
        }
}