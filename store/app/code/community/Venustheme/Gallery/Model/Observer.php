<?php
class Venustheme_Gallery_Model_Observer
{
   public function beforeRender( Varien_Event_Observer $observer ){
		$this->_loadMedia();	
   }
   function _loadMedia( $config = array()){
	if( Mage::getStoreConfig("venustheme_gallery/venustheme_gallery/show") ) { 
		$mediaHelper =  Mage::helper('venustheme_gallery/media');
			if(  Mage::getStoreConfig("venustheme_gallery/venustheme_gallery/enable_jquery")  ){		
				$mediaHelper->addMediaFile("js","venustheme_gallery/jquery.js");
			}
			$mediaHelper->addMediaFile("js","venustheme_gallery/jquery.colorbox.js");
		}
		 
	}
}
