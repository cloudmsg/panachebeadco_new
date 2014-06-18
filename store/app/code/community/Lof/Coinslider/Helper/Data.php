<?php

class Lof_Coinslider_Helper_Data extends Mage_Core_Helper_Abstract {
	
	public function checkAvaiable( $controller_name = ""){
		 $arr_controller = array(  "Mage_Cms",
											"Mage_Catalog",
											"Mage_Tag",
											"Mage_Checkout",
											"Mage_Customer",
											"Mage_Wishlist",
											"Mage_CatalogSearch");
		 if( !empty($controller_name)){
			if( in_array( $controller_name, $arr_controller ) ){
				return true;
			}
		 }
		 return false;
   }
	public function checkMenuItem( $menu_name = "", $config = array())
	{
		if(!empty( $menu_name) && !empty( $config)){
			$menus = isset($config["menuAssignment"])?$config["menuAssignment"]:"all";
			$menus = explode(",", $menus);
			if( in_array("all", $menus) || in_array( $menu_name, $menus) ){
				return true;
			}
		}
		return false;
	}
	public function getListMenu(){
		$arrayParams = array(
							 'all'=>Mage::helper('adminhtml')->__("All"),
							 'Mage_Cms_index'=>Mage::helper('adminhtml')->__("Mage Cms Index"),
							 'Mage_Cms_page'=>Mage::helper('adminhtml')->__("Mage Cms Page"),
							 'Mage_Catalog_category'=>Mage::helper('adminhtml')->__("Mage Catalog Category"),
							 'Mage_Catalog_product'=>Mage::helper('adminhtml')->__("Mage Catalog Product"),
							 'Mage_Customer_account'=>Mage::helper('adminhtml')->__("Mage Customer Account"),
							 'Mage_Wishlist_index'=>Mage::helper('adminhtml')->__("Mage Wishlist Index"),
							 'Mage_Customer_address'=>Mage::helper('adminhtml')->__("Mage Customer Address"),
							 'Mage_Checkout_cart'=>Mage::helper('adminhtml')->__("Mage Checkout Cart"),
							 'Mage_Checkout_onepage'=>Mage::helper('adminhtml')->__("Mage Checkout"),
							 'Mage_CatalogSearch_result'=>Mage::helper('adminhtml')->__("Mage Catalog Search"),
							 'Mage_Tag_product'=>Mage::helper('adminhtml')->__("Mage Tag Product")
							 );
		return $arrayParams;
	}
	function get( $attributes )
	{
		$data = array();
		$arrayParams = array('show',
							'name',
		                     'title', 
		                     'theme', 		                     
							 'blockPosition',
							 'customBlockPosition',
							 'blockDisplay',
							 'menuAssignment',
							 'folder', 
							 'imagecategory', 							 
							 'mainWidth', 
							 'mainHeight', 
							 'showdesc', 
							 'showdescwhen',
							 'readmoretext', 
							 'duration', 
							 'effect', 
							 'boxCols',
							 'boxRows',
							 'slices',
							 'startSlide',							
							 'showdesc',
							 'maxChars',							 
							 'captionOpacity',							
							 'autoRenderthumb',
							 'navigation',
							 'directionNavHide', 
							 'showItem', 
							 'control', 
							 'autoplay', 
							 'interval', 
							 'descOpacity', 
							 //'overlapOpacity', 
							 'thumbnailMode',
							 'useRatio',
							 'useRatios',
							 'source',
							 'sourceProductsMode',
							 'catsid',
							 'quanlity'
		);
		
		
		foreach ($arrayParams as $var)
		{	
			$tags = array('lof_coinslider', 'image_source_setting','file_source_setting','catalog_source_setting', 'main_slider', 'navigation', 'animation', 'advanced_setting');
			foreach($tags as $tag){
				if(Mage::getStoreConfig("lof_coinslider/$tag/$var")!=""){
					$data[$var] =  Mage::getStoreConfig("lof_coinslider/$tag/$var");
				}
			}
			if(isset($attributes[$var]))
			{
				$data[$var] =  $attributes[$var];
			}
		}
				
    	return $data;
	}	  
	    public function getImageUrl($url = null) {
        return Mage::getSingleton('lof_coinslider/config')->getBaseMediaUrl() . $url;
    }

    /**
     * Encode the mixed $valueToEncode into the JSON format
     *
     * @param mixed $valueToEncode
     * @param  boolean $cycleCheck Optional; whether or not to check for object recursion; off by default
     * @param  array $options Additional options used during encoding
     * @return string
     */
    public function jsonEncode($valueToEncode, $cycleCheck = false, $options = array())
    {
        $json = Zend_Json::encode($valueToEncode, $cycleCheck, $options);
        /* @var $inline Mage_Core_Model_Translate_Inline */
        $inline = Mage::getSingleton('core/translate_inline');
        if ($inline->isAllowed()) {
            $inline->setIsJson(true);
            $inline->processResponseBody($json);
            $inline->setIsJson(false);
        }

        return $json;
    }
	
	public function getConfig( $config, $fieldName, $default_value = ""){
		return isset($config[ $fieldName ])?$config[ $fieldName ]: $default_value;
	}
}
?>