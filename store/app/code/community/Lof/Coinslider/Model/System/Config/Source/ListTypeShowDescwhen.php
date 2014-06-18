<?php

class Lof_Coinslider_Model_System_Config_Source_ListTypeShowDescwhen
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'always', 'label'=>Mage::helper('lof_coinslider')->__('Always')),
            array('value'=>'mouseover', 'label'=>Mage::helper('lof_coinslider')->__('Mouse Over Image'))
        );
    }    
}
