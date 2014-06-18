<?php  

class Lof_Coinslider_Block_System_Config_Form_Field_Colorpicker extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$url  = Mage::getBaseUrl('js');
		$element->addClass("color");
		$output = "";
		if(!defined("_LOADED_JSCOLOR_")){
			$jspath = $url.'lof_coinslider/jscolor/jscolor.js';
			//Mage::helper("lof_coinslider/media")->addMediaFile("js",'lof_coinslider/jscolor/jscolor.js');
			$output .= '<script type="text/javascript" src="'.$jspath.'"></script>';
			define("_LOADED_JSCOLOR_",1);
		}
		$output .= $element->getElementHtml();
        return $output;
    }
}
?>
