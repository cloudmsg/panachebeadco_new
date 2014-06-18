<?php


class Lof_Coinslider_Model_System_Config_Source_ListNavigation
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'', 'label'=>Mage::helper('lof_coinslider')->__('No')),
            array('value'=>'number', 'label'=>Mage::helper('lof_coinslider')->__('Number')),
            array('value'=>'thumbs', 'label'=>Mage::helper('lof_coinslider')->__('Thumbnails'))
        );
    }    
}
