<?php

class Lof_Coinslider_Model_System_Config_Source_ListTypeShowDesc
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'0', 'label'=>Mage::helper('lof_coinslider')->__('No')),
            array('value'=>'1', 'label'=>Mage::helper('lof_coinslider')->__('Yes - Default style')),
            array('value'=>'custom_style', 'label'=>Mage::helper('lof_coinslider')->__('Yes - custom style'))
        );
    }    
}
