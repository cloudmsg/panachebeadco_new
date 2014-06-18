<?php
/*------------------------------------------------------------------------
 # VenusTheme Sideproduct Module 
 # ------------------------------------------------------------------------
 # author:    VenusTheme.Com
 # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
 # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Websites: http://www.venustheme.com
 # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/
class Venustheme_Sideproduct_Model_Observer
{
   public function beforeRender( Varien_Event_Observer $observer ){
		$helper =  Mage::helper('venustheme_sideproduct/data');
	 
 
		$config = $helper->get();
		$this->_loadMedia( $config );
		  
   }
   function _loadMedia( $config = array()){
		if( $config['show'] ){
		$mediaHelper =  Mage::helper('venustheme_sideproduct/media');		
		$mediaHelper->addMediaFile("js","venustheme_sideproduct/script.js");
		}
	}
}
