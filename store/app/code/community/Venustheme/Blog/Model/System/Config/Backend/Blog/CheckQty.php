<?php
class Venustheme_Blog_Model_System_Config_Backend_Blog_checkQty extends Mage_Core_Model_Config_Data
{

    protected function _beforeSave(){
        $value     = $this->getValue();
        	if ((!is_numeric($value) && !empty($value)) || $value < 0) {
        	    throw new Exception(Mage::helper('venustheme_blog')->__('Qty of products must be numeric.'));
        	}
        return $this;
    }

}
