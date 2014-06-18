<?php

class Lof_Coinslider_Model_System_Config_Source_ListAnimationType
{
    public function toOptionArray()
    {
        return array(
        	array('value'=>'sliceDown', 'label'=>Mage::helper('lof_coinslider')->__('Slice Down')),
            array('value'=>'sliceDownLeft', 'label'=>Mage::helper('lof_coinslider')->__('Slice Down Left')),
            array('value'=>'sliceUpDownLeft', 'label'=>Mage::helper('lof_coinslider')->__('Slice Up Down Left')),
			array('value'=>'sliceUp', 'label'=>Mage::helper('lof_coinslider')->__('Slice Up')),
            array('value'=>'sliceUpLeft', 'label'=>Mage::helper('lof_coinslider')->__('Slice Up Left')),
            array('value'=>'sliceUpDown', 'label'=>Mage::helper('lof_coinslider')->__('Slice Up Down')),
            array('value'=>'fold', 'label'=>Mage::helper('lof_coinslider')->__('Fold')),
            array('value'=>'fade', 'label'=>Mage::helper('lof_coinslider')->__('Fade')),
            array('value'=>'random', 'label'=>Mage::helper('lof_coinslider')->__('Random')),
            array('value'=>'slideInRight', 'label'=>Mage::helper('lof_coinslider')->__('SlideInRight')),
            array('value'=>'slideInLeft', 'label'=>Mage::helper('lof_coinslider')->__('SlideInLeft')),
            array('value'=>'boxRandom', 'label'=>Mage::helper('lof_coinslider')->__('BoxRandom')),
            array('value'=>'boxRain', 'label'=>Mage::helper('lof_coinslider')->__('BoxRain')),
            array('value'=>'boxRainReverse', 'label'=>Mage::helper('lof_coinslider')->__('BoxRainReverse')),
            array('value'=>'boxRainGrow', 'label'=>Mage::helper('lof_coinslider')->__('BoxRainGrow')),
            array('value'=>'boxRainGrowReverse', 'label'=>Mage::helper('lof_coinslider')->__('BoxRainGrowReverse'))
        );
    }    
}
