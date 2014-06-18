<?php


class Lof_Coinslider_Model_System_Config_Source_ListThumbnailMode
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'none', 'label'=>Mage::helper('lof_coinslider')->__('Using the source image')),
            array('value'=>'resize', 'label'=>Mage::helper('lof_coinslider')->__('Using Image Resizing')),
            array('value'=>'crop', 'label'=>Mage::helper('lof_coinslider')->__('Using Image Croping'))
        );
    }    
}
