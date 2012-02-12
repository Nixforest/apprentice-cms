<?php
//require_once '../application/models/Models.php';
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        /* Initialize action controller here */
    	//$base = $this->_request->getBaseUrl();
       	//$this->view->headScript()->appendFile("../application/models/jquery-1.6.js");
        //$this->view->headScript()->appendFile("../application/models/Menu.js");
        //$this->view->headLink()->appendStylesheet('../application/models/Menu.css');
    	//$base = $this->_request->getBaseUrl();
       	//$this->view->headScript()->appendFile($base."/js/jquery-1.6.js");
        //$this->view->headScript()->appendFile($base."/js/Menu.js");
        //$this->view->headLink()->appendStylesheet($base.'/css/Menu.css');
    }

    public function indexAction()
    {
    	// Get 7 Newsest in database
		$newses = new Model_NewsBLO();
		$categories = new Model_CategoryBLO();
		
		$result = $newses->getHotestNews(7);
		$this->view->result = $result;
		$this->view->newes = $newses;
		
		$newsParameter = new Model_NewsParameter();
		$parameter_up = $newsParameter->getParameterValue(CATEGORY_UP);
		$this->view->parameter_up = $parameter_up;
		$parameter_middle = $newsParameter->getParameterValue(CATEGORY_MIDDLE);
		$this->view->parameter_middle = $parameter_middle;
		$parameter_down = $newsParameter->getParameterValue(CATEGORY_DOWN);
		$this->view->parameter_down = $parameter_down;
		
		$list_categories = $categories->getAll();
		$number_category = count($list_categories);
		$this->view->list_categories = $list_categories;
		$this->view->number_category = $number_category;
		$number_newes_in_category = 5;	// Number of relational newses
		$this->view->number_newes_in_category = $number_newes_in_category;
		/*// UP Location
		
		$news_up = $newses->getSomeNewsByCategoryId($parameter_up, $number_newes_in_category);
		$this->view->news_up = $news_up;
		$category_up = $categories->getById($parameter_up);
		$this->view->category_up = $category_up;
		
		// MIDDLE Location
		$news_middle = $newses->getSomeNewsByCategoryId($parameter_middle, $number_newes_in_category);
		$this->view->news_middle = $news_middle;
		$category_middle = $categories->getById($parameter_middle);
		$this->view->category_middle = $category_middle;
		
		// DOWN Location
		$news_down = $newses->getSomeNewsByCategoryId($parameter_down, $number_newes_in_category);
		$this->view->news_down = $news_down;
		$category_down = $categories->getById($parameter_down);
		$this->view->category_down = $category_down;*/
		
		// Most Viewed News
		$number_mostViewed = 10;
		$mostViewNewses = $newses->getSomeMostViewNews($number_mostViewed);
		$this->view->number_mostViewed = $number_mostViewed;
		$this->view->mostViewNewses = $mostViewNewses;

		/*$date = '2008-04-21';
		$d = getdate(strtotime($date));
		echo $d['mday'].'/'.$d['mon'].'/'.$d['year'];*/
		// tham khảo thêm hàm getdate() để biết chi tiết

    }


}

