<?php

class Venustheme_Blog_Model_System_Config_Source_Imagetypes
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'l', 'label'=>Mage::helper('venustheme_blog')->__('Large')." (".Mage::getStoreConfig('venustheme_blog/general_setting/large_imagesize') .")" ),
            array('value'=>'m', 'label'=>Mage::helper('venustheme_blog')->__('Medium')." (".Mage::getStoreConfig('venustheme_blog/general_setting/medium_imagesize') .")"),
            array('value'=>'s', 'label'=>Mage::helper('venustheme_blog')->__('Small')." (".Mage::getStoreConfig('venustheme_blog/general_setting/small_imagesize') .")"),

        );
    }    
}
