<?php

class Ves_Tempcp_Model_Observer {

    public function beforeRender(Varien_Event_Observer $observer) {
		$this->_loadMedia();
    }

    function _loadMedia($config = array()) {
		
        $mediaHelper = Mage::helper('ves_tempcp/media');
		if ( !defined("_LOAD_JQUERY_") &&  Mage::getStoreConfig("ves_tempcp_info/ves_tempcp/enablejquery")  ) {
			$mediaHelper->addMediaFile("js", "ves_tempcp/jquery.js");
			define( "_LOAD_JQUERY_",1 );
		}
		
        $mediaHelper->addMediaFile("js", "ves_tempcp/script.js");
		
    }

}
