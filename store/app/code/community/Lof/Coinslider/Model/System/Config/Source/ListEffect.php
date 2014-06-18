<?php


class Lof_Coinslider_Model_System_Config_Source_ListEffect
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'linear', 'label'=>Mage::helper('lof_coinslider')->__('Linear')),
            array('value'=>'quadOut', 'label'=>Mage::helper('lof_coinslider')->__('Medium to Slow')),
            array('value'=>'cubicOut', 'label'=>Mage::helper('lof_coinslider')->__('Fast to Slow')),
            array('value'=>'quartOut', 'label'=>Mage::helper('lof_coinslider')->__('Very Fast to Slow')),
            array('value'=>'quintOut', 'label'=>Mage::helper('lof_coinslider')->__('Uber Fast to Slow')),
            array('value'=>'expoOut', 'label'=>Mage::helper('lof_coinslider')->__('Exponential Speed')),
            array('value'=>'elasticOut', 'label'=>Mage::helper('lof_coinslider')->__('Elastic')),
            array('value'=>'backIn', 'label'=>Mage::helper('lof_coinslider')->__('Back In')),
            array('value'=>'backOut', 'label'=>Mage::helper('lof_coinslider')->__('Back Out')),
            array('value'=>'backInOut', 'label'=>Mage::helper('lof_coinslider')->__('Back In and Out')),
            array('value'=>'bounceOut', 'label'=>Mage::helper('lof_coinslider')->__('Bouncing')),
        );
    }    
}
