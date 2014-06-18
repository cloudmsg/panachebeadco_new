<?php

class Venustheme_Sideproduct_Model_System_Config_Source_ListType
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'', 'label'=>Mage::helper('venustheme_sideproduct')->__('-- Please select --')),
            array('value'=>'latest', 'label'=>Mage::helper('venustheme_sideproduct')->__('Latest')),
			array('value'=>'new', 'label'=>Mage::helper('venustheme_sideproduct')->__('Today New')),
		//	array('value'=>'special', 'label'=>Mage::helper('venustheme_sideproduct')->__('Special')),
            array('value'=>'best_buy', 'label'=>Mage::helper('venustheme_sideproduct')->__('Best Buy')),
            array('value'=>'most_viewed', 'label'=>Mage::helper('venustheme_sideproduct')->__('Most Viewed')),
            array('value'=>'featured', 'label'=>Mage::helper('venustheme_sideproduct')->__('Featured Product'))
        );
    }    
}
