<?php
/*------------------------------------------------------------------------
 # VenusTheme Sideproduct Module 
 # ------------------------------------------------------------------------
 # author:    VenusTheme.Com
 # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
 # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Websites: http://www.venustheme.com
 # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/
class Venustheme_Sideproduct_Block_System_Config_Form_Field_Notification extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$time = intval($element->getValue());
		$time = !empty($time)?$time:time();
		$url  = Mage::getBaseUrl('js');
		$jspath = $url.'venustheme_sideproduct/form/script.js';
		$csspath = $url.'venustheme_sideproduct/form/style.css';
		$output = '<link rel="stylesheet" type="text/css" href="'.$csspath.'" />'; 		
		$output .= '<script type="text/javascript" src="'.$jspath.'"></script>';
		$format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $timeUpdate = Mage::app()->getLocale()->date()->toString($format);
		
        return $timeUpdate.	$output;
    }
}
?>