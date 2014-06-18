<?php


class Lof_Coinslider_Model_System_Config_Source_ListImagegroup
{
    public function toOptionArray()
    {
		$_model  = Mage::getModel('lof_coinslider/banner');
		$collection = $_model->getCollection();
		$groups =  array();
		foreach($collection as $item){
		
			$option = array('value'=>$item->getLabel(), 'label'=>$item->getLabel());
			$groups[$item->getLabel()] = $option;
		}
	   return $groups;
    }    
}
