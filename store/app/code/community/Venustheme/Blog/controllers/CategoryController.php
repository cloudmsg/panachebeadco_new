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
class Venustheme_Blog_CategoryController extends Mage_Core_Controller_Front_Action
{  	
	public function indexAction(){
		 
		
		
		
	//	 Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
	}
	
	public function viewAction(){
	

		
		$this->loadLayout();
		$this->renderLayout();
		// Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
	}
}
?>