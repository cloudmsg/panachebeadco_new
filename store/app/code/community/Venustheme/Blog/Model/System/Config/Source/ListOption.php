<?php
class Venustheme_Blog_Model_System_Config_Source_ListOption
{
	
    public function toOptionArray()
    {
        return array(
            array('value' => "before", 'label'=>Mage::helper('adminhtml')->__('Before')),
            array('value' => "after", 'label'=>Mage::helper('adminhtml')->__('After'))
        );
    }
}
