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
class Venustheme_Sideproduct_Block_List extends Mage_Catalog_Block_Product_Abstract 
{
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_config = '';
	
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_listDesc = array();
	
	/**
	 * @var string $_config
	 * 
	 * @access protected
	 */
	protected $_show = 0;
	protected $_theme = "";
	
	/**
	 * Contructor
	 */
	public function __construct($attributes = array())
	{
	
		$helper =  Mage::helper('venustheme_sideproduct/data');
		$this->_config = $helper->get($attributes);
		$this->_show = $this->getConfig("show");
		if(!$this->_show) return;
		/*End init meida files*/
		$mediaHelper =  Mage::helper('venustheme_sideproduct/media');
		$this->_theme = $this->getConfig("theme",'default');
		$mediaHelper->addMediaFile("skin_css", "venustheme_sideproduct/style.css" );
		parent::__construct();		
	}
	
	function _toHtml() { 		 
		if( !$this->_show || !$this->getConfig('show') ) return;
		$theme = ($this->getConfig('theme')!="") ? $this->getConfig('theme') : "default";
		
		$items = $this->getListProducts();
		
		$this->assign( "items", $items );
		$this->_config['template'] = 'venustheme/sideproduct/default.phtml';
		$this->setTemplate($this->_config['template']);	
        return parent::_toHtml();
	}
	
	/**
	 * get value of the extension's configuration
	 *
	 * @return string
	 */
	function getConfig( $key, $default= "" ){
		return (!isset($this->_config[$key])||(isset($this->_config[$key]) && empty($this->_config[$key])))?$default:$this->_config[$key] ;
	}
	
	/**
	 * overrde the value of the extension's configuration
	 *
	 * @return string
	 */
	function setConfig( $key, $value ){
		$this->_config[$key] = $value;
		return $this;
	}	
 	
  	 
	 
	function set($params){
		$params = preg_split ("/\n/", $params);
		foreach ($params as $param){	
			$param = trim($param);
			if (!$param) continue;
			$param = split ("=", $param, 2);
			if (count($param) == 2 && strlen(trim($param[1])) > 0)
				$this->_config[trim($param[0])] =  trim($param[1]);
		}
		$theme =  $this->getConfig("theme");
		if($theme != $this->_theme){
			$mediaHelper =  Mage::helper('venustheme_sideproduct/media');
			$mediaHelper->addMediaFile("skin_css", "venustheme_sideproduct/".$theme."/style.css" );
		}
	}
	
	public function getListProducts()
    {
    	$products = null;
    	$mode = $this->getConfig('sourceProductsMode','latest');

		switch ($mode) {
			case 'special' : 
				$products = $this->getListSpecialProducts();
				break;
			case 'latest' :
				$products = $this->getListLatestProducts();
				break;
			case 'best_buy' : 
				$products = $this->getListBestSellerProducts();
				break;
			case 'most_viewed' :
				$products = $this->getListMostViewedProducts();
				break;
			case 'featured' :
				$products = $this->getListFeaturedProducts();
				break;
			case 'new' :
				$products = $this->getListNewProducts();
				break;
		}
		
		return $products;
    }
	
	public function getListSpecialProducts(){
		$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
		$special= Mage::getResourceModel('reports/product_collection')
			->addAttributeToSelect('*')
			->addAttributeToFilter('visibility', array('neq'=>1))
			->addAttributeToFilter('special_price', array('neq'=>''))
			->setPageSize( $this->getConfig('limit_item',6) ) // Only return 4 products
			->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayDate))
			->addAttributeToFilter('special_to_date', array('or'=> array(
				   0 => array('date' => true, 'from' => $todayDate),
				   1 => array('is' => new Zend_Db_Expr('null')))
				   ), 'left')
			->addAttributeToSort('special_from_date', 'desc');
			$special->load();
		$this->setProductCollection($special);
		$list  =  array();
		$this->_addProductAttributesAndPrices($special);
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
	
		return $list;
	}
    
    public function getListLatestProducts($fieldorder = 'updated_at', $order = 'desc')
    {
    	$storeId    = Mage::app()->getStore()->getId();
    	$cateids = $this->getConfig('catsid');
    	if($cateids) {
    	    $productIds = $this->getProductByCategory();
			$products = Mage::getResourceModel('catalog/product_collection')
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->addStoreFilter()
		    ->addIdFilter($productIds)
		    ->setOrder ($fieldorder,$order);
    	} else {
	    $products = Mage::getResourceModel('catalog/product_collection')
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addFinalPrice()
		    ->addStoreFilter()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->setOrder ($fieldorder,$order);
    	}		
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize($this->getConfig('limit_item',6))->setCurPage(1);
        $this->setProductCollection($products);
		
		$this->_addProductAttributesAndPrices($products);
        $list = array();                  
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
		return $list;
    }
    
    public function getListBestSellerProducts($fieldorder = 'ordered_qty', $order = 'desc')
    {
    	$storeId    = Mage::app()->getStore()->getId();
    	$cateids = $this->getConfig('catsid');
    	if($cateids) {
    	    $productIds = $this->getProductByCategory();
    	    $products = Mage::getResourceModel('reports/product_collection')
			->addOrderedQty()
			->addAttributeToSelect('*')
			->addMinimalPrice()
			->addUrlRewrite()
			->addTaxPercents()
			->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
			->addIdFilter($productIds)// id product
			->setStoreId($storeId)
			->addStoreFilter($storeId)
			->setOrder ($fieldorder,$order);
    	} else {
	    $products = Mage::getResourceModel('reports/product_collection')
		    ->addOrderedQty()
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
		    ->setStoreId($storeId)
		    ->addStoreFilter($storeId)
		    ->setOrder ($fieldorder,$order);
    	}
    			
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize($this->getConfig('limit_item',6))->setCurPage(1);
        $this->setProductCollection($products);
		
		$this->_addProductAttributesAndPrices($products);
        $list = array();                  
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
		return $list;
    }
    
    public function getListMostViewedProducts()
    {
    	$storeId    = Mage::app()->getStore()->getId();
    	$cateids = $this->getConfig('catsid');
    	if($cateids) {
	    $productIds = $this->getProductByCategory();
	    $products = Mage::getResourceModel('reports/product_collection')
			->addAttributeToSelect('*')
			->addMinimalPrice()
			->addUrlRewrite()
			->addTaxPercents()
			->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes            
			->setStoreId($storeId)
			->addStoreFilter($storeId)
			->addViewsCount()
			->addIdFilter($productIds);
    	} else {  
    	    $products = Mage::getResourceModel('reports/product_collection')
			->addAttributeToSelect('*')
			->addMinimalPrice()
			->addUrlRewrite()
			->addTaxPercents()
			->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
			->setStoreId($storeId)
			->addStoreFilter($storeId)
			->addViewsCount();
    	}
    	
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize(8)->setCurPage(1);
        $this->setProductCollection($products);
		$this->_addProductAttributesAndPrices($products);
        $list = array();                  
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
		
		return $list;
    }
    
    public function getListFeaturedProducts()
    {
    	$storeId    = Mage::app()->getStore()->getId();
    	$cateids = $this->getConfig('catsid');
    	if($cateids) {
	    $productIds = $this->getProductByCategory();
	    $products = Mage::getResourceModel('catalog/product_collection')
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->addStoreFilter()
		    ->addIdFilter($productIds)
		    ->addAttributeToFilter("featured", 1);
	    Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
	    Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($products);		
    	} else {
	    $products = Mage::getResourceModel('catalog/product_collection')
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->addStoreFilter()
		    ->addAttributeToFilter("featured", 1);
	    Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
	    Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($products);		
    	}
    	
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize($this->getConfig('limit_item',6))->setCurPage(1);
        $this->setProductCollection($products);
		$this->_addProductAttributesAndPrices($products);
        $list = array();                  
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
		return $list;
    }
    
    public function getListNewProducts()
    {
    	$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
    	$storeId    = Mage::app()->getStore()->getId();
    	$cateids = $this->getConfig('catsid');
    	if($cateids) {
	    $productIds = $this->getProductByCategory();
		    $products = Mage::getResourceModel('catalog/product_collection')
			    ->addAttributeToSelect('*')
			    ->addMinimalPrice()
			    ->addUrlRewrite()
			    ->addTaxPercents()
			    ->addStoreFilter()
			    ->addIdFilter($productIds)
			    ->addAttributeToFilter('news_from_date', array('date'=>true, 'to'=> $todayDate))
			    ->addAttributeToFilter(array(array('attribute'=>'news_to_date', 'date'=>true, 'from'=>$todayDate), array('attribute'=>'news_to_date', 'is' => new Zend_Db_Expr('null'))),'','left')
			    ->addAttributeToSort('news_from_date','desc');
    	} else {
	    $products = Mage::getResourceModel('catalog/product_collection')
		    ->addAttributeToSelect('*')
		    ->addMinimalPrice()
		    ->addUrlRewrite()
		    ->addTaxPercents()
		    ->addStoreFilter()
		    ->addAttributeToFilter('news_from_date', array('date'=>true, 'to'=> $todayDate))
		    ->addAttributeToFilter(array(array('attribute'=>'news_to_date', 'date'=>true, 'from'=>$todayDate), array('attribute'=>'news_to_date', 'is' => new Zend_Db_Expr('null'))),'','left')
		    ->addAttributeToSort('news_from_date','desc');
    	}
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize($this->getConfig('limit_item',6))->setCurPage(1);
        $this->setProductCollection($products);
		$this->_addProductAttributesAndPrices($products);
        $list = array();                  
		if (($_products = $this->getProductCollection ()) && $_products->getSize ()) {            
			$list = $products;
		}
		
		return $list;
    }
    
    public function getPro()
    {
        $storeId    = Mage::app()->getStore()->getId();
        $products = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
            ->setStoreId($storeId)
            ->addStoreFilter($storeId);

		
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

        $products->setPageSize(6)->setCurPage(1);

        $this->setProductCollection($products);
    }
    
    function inArray($source, $target) {
		for($i = 0; $i < sizeof ( $source ); $i ++) {
			if (in_array ( $source [$i], $target )) {
			return true;
			}
		}
    }
	
    function getProductByCategory(){
        $return = array(); 
        $pids = array();
        $catsid=$this->getConfig('catsid');
        $products = Mage::getResourceModel ( 'catalog/product_collection' );
         
        foreach ($products->getItems() as $key => $_product){
            $arr_categoryids[$key] = $_product->getCategoryIds();
            
            if($catsid){    
                if(stristr($catsid, ',') === FALSE) {
                    $arr_catsid[$key] =  array(0 => $catsid);
                }else{
                    $arr_catsid[$key] = explode(",", $catsid);
                }
                
                $return[$key] = $this->inArray($arr_catsid[$key], $arr_categoryids[$key]);
            }
        }
        
        foreach ($return as $k => $v){ 
            if($v==1) $pids[] = $k;
        }    
        
        return $pids;   
    }
}
