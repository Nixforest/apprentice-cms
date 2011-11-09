<?php

class Model_ItemDAO extends Zend_Db_Table_Abstract 
{
	protected $_name = 'menu_item';
	protected $_referenceMap = array(
		'MenuDAO' => array (
			'columns'			=> array('menu_id'),
			'refTableClass'		=> 'Model_MenuDAO',
			'refColumns'		=> array('menu_id'),
			'onDelete'			=> self::CASCADE,
			'onUpdate'			=> self::RESTRICT
		)
	);
	
	public function getItems($menuId) 
	{
		$sql = sprintf("SELECT  node.item_id, 
								node.label, 
								node.link, 
								(COUNT(parent.item_id) - 1) AS depth,
								node.left_id, 
								node.right_id, 
								node.parent_id
						FROM menu_item AS node,
							 menu_item AS parent
						WHERE node.menu_id = '%s' 
							AND parent.menu_id = '%s' 
							AND node.left_id BETWEEN parent.left_id AND parent.right_id
						GROUP BY node.item_id
						ORDER BY node.left_id",
						$menuId,
						$menuId);
						
		$items = $this->_db->fetchAll($sql);
		return $items;
	
	}


	public function addItems ($menuDTO)
	{
		$items = $menuDTO->get('items');
		foreach ($items as $item)
		{
			$item->set('menu_id', $menuDTO->get('menu_id') );
			$row = $this->createRow( $item->getData() );
			$row->save();
		}
	}
	
	/* Use it to edit Items of Menu. BC edit=update= deleteItems + addItems; */
	public function deleteItems($menuId) {
	    $row = $this->delete("'menu_id' = $menuId");
	}
	

}
	