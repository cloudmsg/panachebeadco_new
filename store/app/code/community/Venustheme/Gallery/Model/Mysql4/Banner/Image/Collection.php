<?php
class Venustheme_Gallery_Model_Mysql4_Banner_Image_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('venustheme_gallery/banner_image');
    }
}