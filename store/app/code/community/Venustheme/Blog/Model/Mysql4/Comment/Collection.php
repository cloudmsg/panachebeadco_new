<?php
 /*------------------------------------------------------------------------
  # VenusTheme Blog Module 
  # ------------------------------------------------------------------------
  # author:    VenusTheme.Com
  # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
  # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.venustheme.com
  # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/
class Venustheme_Blog_Model_Mysql4_Comment_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    /**
     * Constructor method
     */
    protected function _construct() {
        $this->_init('venustheme_blog/comment');
    }

     

    /**
     * Add Filter by status
     *
     * @param int $status
     * @return Ves_Slider_Model_Mysql4_Comment_Collection
     */
    public function addEnableFilter($status = 1) {
        $this->getSelect()->where('main_table.is_active = ?', $status);
        return $this;
    }
	
	public function addPostFilter( $postId ) {
        $this->getSelect()
                ->where('post_id = ?', $postId);
        return $this;
    }
	
	public function  addPostsFilter( $categoryId=0 ){
		 $this->getSelect()->join(
                    array('post' => $this->getTable('venustheme_blog/post')),
                    'main_table.post_id = post.post_id',
                    array("post.title as post_title")
                    )
                    ->where('main_table.post_id not in (?)', array(0, $categoryId));
		return $this;			
	}
}