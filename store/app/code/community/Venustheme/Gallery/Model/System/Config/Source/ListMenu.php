<?php

class Venustheme_Gallery_Model_System_Config_Source_ListMenu
{
 public function toOptionArray()
    {
    	$helper =  Mage::helper('venustheme_gallery/data');
    	$params = $helper->getListMenu();
    	$option = array();
    	if(!empty($params)){
    		foreach($params as $key=>$label){
    			$tmp = array();
    			$tmp["value"] = $key;
    			$tmp["label"] = $label;
    			$option[] = $tmp;
    		}
    	}
        return $option;
    }
}
