<?php

class Lof_Coinslider_Model_System_Config_Source_ListType
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'', 'label'=>Mage::helper('lof_coinslider')->__('-- Please select --')),
            array('value'=>'latest', 'label'=>Mage::helper('lof_coinslider')->__('Latest')),
            array('value'=>'best_buy', 'label'=>Mage::helper('lof_coinslider')->__('Best Buy')),
            array('value'=>'most_viewed', 'label'=>Mage::helper('lof_coinslider')->__('Most Viewed')),
            array('value'=>'most_reviewed', 'label'=>Mage::helper('lof_coinslider')->__('Most Reviewed')),
            array('value'=>'top_rated', 'label'=>Mage::helper('lof_coinslider')->__('Top Rated')),
            array('value'=>'attribute', 'label'=>Mage::helper('lof_coinslider')->__('Featured Product'))
        );
    }    
}
