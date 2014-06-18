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
class Venustheme_Sideproduct_Model_Config extends Mage_Catalog_Model_Product_Media_Config {

    public function getBaseMediaPath() {
        return Mage::getBaseDir('media') .DS. 'sideproduct';
    }

    public function getBaseMediaUrl() {
        return Mage::getBaseUrl('media') . 'sideproduct';
    }

    public function getBaseTmpMediaPath() {
        return Mage::getBaseDir('media') .DS. 'tmp' .DS. 'sideproduct';
    }

    public function getBaseTmpMediaUrl() {
        return Mage::getBaseUrl('media') . 'tmp/sideproduct';
    }

}