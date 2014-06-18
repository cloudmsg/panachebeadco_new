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
class Venustheme_Sideproduct_Model_Mysql4_Banner_Image extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('venustheme_sideproduct/banner_image', 'banner_image_id');
    }
}