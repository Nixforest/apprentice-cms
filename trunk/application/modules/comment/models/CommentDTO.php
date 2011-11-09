<?php

class Model_CommentDTO
{
public  $_data = array(
		'comment_id' 		 => null,	/** Id of comment */
		'title' 			 => null,	/** Main title of comment */
		'content' 			 => null,	/** Content of article */
		'full_name' 		 => null,	/** name of sender	 */
		'email' 			 => null,	/** email of sender */
		'user_id' 		 	 => null,	/** id of user when user logged in */
		'user_name' 		 => null,	/** name of user when user logged in */		
		'news_id'			 => null,	/** id of the news that the comment refered to */
		'created_date' 		 => null,	/** comment's creation date */
		'is_active' 		 => null,	/** status of the comment (1: actived or 0: inactived) */
		'activate_date' 	 => null,	/** the day of the comment when it is actived 	*/
		'ordering' 	 		 => null,	/** the order of the comment of the news */
		'depth' 	 		 => null,	/** the depth of the comment of the news */
		'reply_to' 	 		 => null,	/** the id of the comment that is replyed */
		
	);
	
	
	public function set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	
	public function get($name) 
	{
		return $this->_data[$name];;
	}
	public function getByName($name) 
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