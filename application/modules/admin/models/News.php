<?php
class Model_News extends Zend_Db_Table_Abstract{
	
	public function getAll() {
		$sql  = "SELECT * FROM news_article";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function getOne($article_id){
		$sql = "SELECT article_id, title, description FROM `news_article` where `article_id`=".$article_id;
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function updateNews($article_id, $title, $description) {
		$sql  = "UPDATE `news_article` SET  `title` =  '".$title."',`description` =  '".$description."' WHERE `article_id` =".$article_id;
		$db = $this->getDefaultAdapter();
		$db->query($sql);
	}
	
	public function activeNews($article_id){
		$sql  = "UPDATE `news_article` SET  `status` =  'active' WHERE `article_id` =".$article_id;
		$db = $this->getDefaultAdapter();
		$db->query($sql);
	}
	
	public function deactiveNews($article_id){
		$sql  = "UPDATE `news_article` SET  `status` =  'inactive' WHERE `article_id` =".$article_id;
		$db = $this->getDefaultAdapter();
		$db->query($sql);
	}
}