<?php

class Venustheme_Gallery_Model_Mysql4_Banner_Image extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('venustheme_gallery/banner_image', 'banner_image_id');
    }
}