<?php

class Lof_Coinslider_Model_System_Config_Backend_Slider_checkInputCategory extends Mage_Core_Model_Config_Data
{
    protected function _beforeSave(){
        $value     = trim($this->getValue());

        if ($value && !eregi('^([1-9]+)+([,]?([0-9]+))*$', $value)) { 

            throw new Exception(Mage::helper('lof_coinslider')->__('Categories ID: Format is incorrect.'));
        }

        return $value;
         
    }


}
