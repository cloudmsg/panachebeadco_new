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
class Venustheme_Blog_Block_Blog_Post_Comment extends Venustheme_Blog_Block_Blog_Template
{
	protected function _prepareLayout() {			 
		
			
	}
	
	public function getCollection(){
		$page = $this->getRequest()->getParam('page') ? $this->getRequest()->getParam('page') : 1;
		$comment = Mage::getModel('venustheme_blog/comment')->getCollection()
			->addEnableFilter( 1  )
			->setPageSize( $this->getGeneralConfig("comment_limit") )
			->setCurPage($page)
			->addPostFilter( $this->getRequest()->getParam('id')  );
 
		return $comment;
	}
	
	public function getCountingComment(){
		$comment = Mage::getModel('venustheme_blog/comment')->getCollection()
			->addEnableFilter( 1  )
			->addPostFilter( $this->getRequest()->getParam('id')  );
		Mage::register( 'paginateTotal', count($comment) );
		Mage::register( "paginateLimitPerPage", $this->getGeneralConfig("comment_limit") );
		return count($comment);
	}
	
	public function getReCaptcha(){ 
		return Mage::helper('venustheme_blog/recaptcha')
			->setKeys( $this->getGeneralConfig("privatekey"), $this->getGeneralConfig("publickey") )
			->getReCapcha();
	}
}
?>