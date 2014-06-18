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

class Venustheme_Blog_Model_Category extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {	
        $this->_init('venustheme_blog/category');
    }
	
	public function getCategoryLink(){

		return  Mage::getBaseUrl().Mage::getModel('core/url_rewrite')->loadByIdPath('venusblog/category/'.$this->getId())->getRequestPath();
	}
	
	public function getImageURL($type='l') {
		return Mage::getBaseUrl( Mage_Core_Model_Store::URL_TYPE_MEDIA)."resized/".$type."/".$this->getFile();
	}
	

}