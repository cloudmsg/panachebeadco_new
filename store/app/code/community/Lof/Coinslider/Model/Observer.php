<?php

class Lof_Coinslider_Model_Observer
{
   public function beforeRender( Varien_Event_Observer $observer ){
		$action = Mage::app()->getRequest()->getActionName();
		if($action == 'noRoute' || $this->isAdmin() ){ return ;	}
		
		$this->_loadMedia();  
   }
   public function isAdmin() {
        if(Mage::app()->getStore()->isAdmin()) {
            return true;
        }
		if(Mage::getDesign()->getArea() == 'adminhtml')  {
            return true;
        }
        return false;
    }
   function _loadMedia( $config = array()){
		if( Mage::getStoreConfig("lof_coinslider/lof_coinslider/show") ) { 
			$mediaHelper = Mage::helper("lof_coinslider/media");			
			$mediaHelper->addMediaFile("js",'lof_coinslider/script.js');
		}
   }
}
