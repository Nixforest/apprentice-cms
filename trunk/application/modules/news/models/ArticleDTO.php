<?php
/**
 * @author Nguyen Ngoc Dai.
 * @uses ArticleDTO(Data Transfer Object):  là thực thể mô tả thông tin của news_article. 
 * 		Các ArticleDTO này được dùng để trao đổi thông tin giữa lớp Presentation(View) và lớp NewsDAO.
 */

class Model_ArticleDTO
{
protected $_data = array(
		'article_id' 		 => null,	/** Id of article */
		'title' 			 => null,	/** Main title of article */
		'sub_title' 		 => null,	/** Sub-title of article */
		'slug' 				 => null,	/** Slug of article */
		'description' 		 => null,	/** Description of article */	
		'content' 			 => null,	/** Content of article */
		'icons' 			 => null,	/** Article icons */
	
		/**
		 * URL of thumbnail image that represent article
		 */
		'image_square' 		 => null,	/** The thumbnail in square size */
		'image_thumbnail' 	 => null,	/** Thumbnail size */
		'image_small' 		 => null,	/** Small size */
		'image_crop' 		 => null,	/** Crop size */
		'image_medium' 		 => null,	/** Medium size */
		'image_large' 		 => null,	/** Large size */
	
		/** 
		 * Article's status. Can be one of following values:
		 * - active
		 * - inactive
		 * - draft
		 * - deleted
		 */
		'status' 			 => 'inactive',
		
		'num_views' 		 => 0,		/** Number of views */
		
		'created_date' 		 => null,	/** Article's creation date */
		'created_user_id' 	 => null,	/** Id of user who create article */
		'created_user_name'  => null,	/** Username of user who create article */

		'updated_date' 		 => null,	/** Article's modification date */
		'updated_user_id' 	 => null,	/** Id of user who update article */
		'updated_user_name'  => null,	/** Username of user who update article */
	
		'activate_date' 	 => null,	/** Article's activation date */
		'activate_user_id' 	 => null,	/** Id of user who activate article */
		'activate_user_name' => null,	/** Username of user who activate article */
		
		'author'			 => null,	/** Author of article */
		'allow_comment' 	 => 0,		/** Defines that user can comment on article or not */
		'sticky' 			 => 0,		/** Defines that article is sticky of main category or not */
		'language'			 => null,	/** Language of article (@since 2.0.8) */
	);
	
	
	public function set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	
	public function get($name) 
	{
		return $this->_data[$name];;
	}
	
	public function setData( $data)
	{
		$this->_data= $data;
	}
	
	public function getData() 
	{
		return $this->_data;
	}
	
}