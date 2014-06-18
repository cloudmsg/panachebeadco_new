<?php

class Lof_Coinslider_Model_Observer
{
   public function beforeRender( Varien_Event_Observer $observer ){
	
		$controller_name = Mage::app()->getRequest()->getControllerModule();
		$menu_name = $controller_name."_".Mage::app()->getRequest()->getControllerName();
		$helper =  Mage::helper('lof_coinslider/data');
		if($helper->checkAvaiable( $controller_name )){
		 	$config = $helper->get();
			$this->loadMediaFiles( $config );
		 	if($helper->checkMenuItem( $menu_name, $config )){
				/*Define slider block*/
				$layout = Mage::getSingleton('core/layout'); // we are taking the item with 'object' key from array passed to dispatcher
				$title = $config["title"];
				$position = isset($config["blockPosition"])?$config["blockPosition"]:"content";
				$custom_pos = isset($config["customBlockPosition"])?$config["customBlockPosition"]:"";
				if(!empty($custom_pos)){
					$position = $custom_pos;
				}
				$display = isset($config["blockDisplay"])?$config["blockDisplay"]:"after";
				$display = $display == "after"?true:false;
				$source = $config["source"];
			
			
				$block =  $layout->createBlock('lof_coinslider/source_'.$source);
				// echo $source;die;
				$layout->getBlock( $position )->insert($block, $title , $display);
				/*End defined*/
		 	}
		}
   }
   function loadMediaFiles( $config = array()){
		if(!empty($config)){
			$mediaHelper = Mage::helper("lof_coinslider/media");
			$enable_jquery = isset( $config["enable_jquery"] )?$config["enable_jquery"]: 1;
			if( $enable_jquery == 1 ){
				$mediaHelper->addMediaFile("js","lof_coinslider/jquery.js");
			}
			$mediaHelper->addMediaFile("js",'lof_coinslider/script.js');
		}
   }
}
