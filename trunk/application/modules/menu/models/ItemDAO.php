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
	
	/* Use it to edit Items of Menu. BC edit=update= deleteItems + add; */
	public function deleteItems($menuId) {
	    $row = $this->delete("'menu_id' = $menuId");
	}
	
/*	
    public function _getLastPosition($menuId)
    {
        $select = $this->select();
                $select->where('menu_id = ?', $menuId);
                $select->order('position DESC');
                $row = $this->fetchRow($select);
                
                if ($row) {
                    return $row->position;
                } else {
                    return 0;
                }
    }

    public function moveUp($itemId)
    {
        $row = $this->find($itemId)->current();
                if ($row) {
                    $position = $row->position;
                    
                    if ($position < 1) {
                        // this is already the first item
                        return FALSE;
                    } else {
                        // find the previous item
                        $select = $this->select();
                        $select->order('position DESC');
                        $select->where('position < ?', $position);
                        $select->where('menu_id = ?', $row->menu_id);
                        $previousItem = $this->fetchRow($select);
                        
                        if ($previousItem) {
                            // switch position with the previous item
                            $previousPosition = $previousItem->position;
                            $previousItem->position = $row->position;
                            $previousItem->save();
        
                            $row->position = $previousPosition;
                            $row->save();
                        }
                    }
                } else {
                    throw new Zend_Exception('Error loading menu item');
                }
    }

    public function moveDown($itemId)
    {
        $row = $this->find($itemId)->current();
                if ($row) {
                    $position = $row->position;
                    
                    if ($position == $this->_getLastPosition($row->menu_id)) {
                        // this is already the last item
                        return FALSE;
                    } else {
                        // find the next item
                        $select = $this->select();
                        $select->order('position ASC');
                        $select->where('position > ?', $position);
                        $select->where('menu_id = ?', $row->menu_id);
                        $nextItem = $this->fetchRow($select);
                        
                        if ($nextItem) {
                            // switch position with the next item
                            $nextPosition = $nextItem->position;
                            $nextItem->position = $row->position;
                            $nextItem->save();
        
                            $row->position = $nextPosition;
                            $row->save();
                        }
                    }
                } else {
                    throw new Zend_Exception('Error loading menu item');
                }
    }
    
    public function updateItem ($itemId, $label, $pageId = 0, $link = null) {
    	$row = $this->find($itemId)->current();
    	if ($row) {
    		$row->label = $label;
    		$row->page_id = $pageId;
    		if ($pageId < 1) {
    			$row->link = $link;
    		} else {
    			$row->link = null;
    		}
    		return $row->save();
    	} else {
            throw new Zend_Exception('Error loading menu item'); 
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
	}*/
}
	