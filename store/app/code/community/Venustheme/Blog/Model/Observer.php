<?php
 /*------------------------------------------------------------------------
  # VenusTheme Blog Module 
  # ------------------------------------------------------------------------
  # author:    VenusTheme.Com
  # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
  # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.venustheme.com
  # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/
			
class Venustheme_Blog_Model_Observer  extends Varien_Object
{
	 
	/**
	 *
	 */
	public function initControllerRouters( $observer ){	
	
        $request = $observer->getEvent()->getFront()->getRequest();
		/*if (!Mage::app()->isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }
	*/
		$identifier = trim($request->getPathInfo(), '/');
	
	 
        $condition = new Varien_Object(array(
            'identifier' => $identifier,
            'continue'   => true
        ));
        Mage::dispatchEvent('blog_controller_router_match_before', array(
            'router'    => $this,
            'condition' => $condition
        ));
        $identifier = $condition->getIdentifier();
		
		 
        if ($condition->getRedirectUrl()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect($condition->getRedirectUrl())
                ->sendResponse();
            $request->setDispatched(true);
            return true;
        }

        if (!$condition->getContinue())
            return false;
		

		$route = trim( Mage::getStoreConfig('venustheme_blog/general_setting/route') );
	

        if($identifier) {
            if(  preg_match("#^".$route."(\.html)?$#",$identifier, $match) ) {
                $request->setModuleName('blog')
                        ->setControllerName('index')
                        ->setActionName('index');
                $request->setAlias(
                    Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                    $identifier
                );
                return true;
			
            } elseif(str_replace('/rss', '', str_replace($route, '', $identifier)) == '') {
				$request->setModuleName('blog')
			    ->setControllerName('rss')
			    ->setActionName('index');
		    
			$request->setAlias(
				Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
				$identifier
			);
			return true;
	    } elseif( preg_match("#ves-blog/tag/(\w+)\.?#",$identifier, $match) ) {
			if( count($match)<= 1 ){
				return false;
			}  
			
			$request->setModuleName('venusblog')
			    ->setControllerName('list')
			    ->setActionName('show')
				->setParam("tag",$match[1]);
		    
			$request->setAlias(
				Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
				$identifier
			);
			return true;
			}
		}
        return false;					
	}
	
	/**
	 *
	 */
	public function beforeRender( Varien_Event_Observer $observer ){
		$controller_name = Mage::app()->getRequest()->getControllerModule();
		$menu_name = $controller_name."_".Mage::app()->getRequest()->getControllerName();
		$helper =  Mage::helper('venustheme_blog/data');
		
		
		// if($helper->checkAvaiable( $controller_name )){
			//$config = $helper->get();
			 $this->_loadMedia( $config );
		 	/**LATEST BLOG */
			//$this->latestModule( $menu_name , $helper );
			/** CATEGORY BLOG */
			//$this->cmenuModule( $menu_name , $helper );
		// }
   }
   
   public function getModuleConfig( $val ){
		return Mage::getStoreConfig( "venustheme_blog/module_setting/".$val );
   }
   
   public function latestModule( $menu_name, $helper ){
   		if( !$this->getModuleConfig("enable_latestmodule") ){
			return ;
		}
		
		if($helper->checkMenuItem( $menu_name, $this->getModuleConfig("latest_menuassignment") )){
			
			$layout = Mage::getSingleton('core/layout');
			$title = $this->getModuleConfig("latest_title");
			$position = $this->getModuleConfig("latest_position");
			if( !$position ){ $position = "right"; }
			
			$cposition = $this->getModuleConfig("latest_customposition");
			if( $cposition ){ $position = $cposition; }

			$display = $this->getModuleConfig("latest_display");
			if( $display=="after" ){ $display = true; }else { $display=false; }
	
			$block =  $layout->createBlock( 'venustheme_blog/latest' );
	
			if($myblock = $layout->getBlock( $position )){
				$myblock->insert($block, $title , $display);
			}

		}
   }
   
   
   
    public function cmenuModule( $menu_name, $helper ){
		if( !$this->getModuleConfig("enable_cmenumodule") ){
			return ;
		}
		if($helper->checkMenuItem( $menu_name, $this->getModuleConfig("cmenu_menuassignment") )){
			
			$layout = Mage::getSingleton('core/layout');
			$title = $this->getModuleConfig("cmenu_title");
			$position = $this->getModuleConfig("cmenu_position");
			if( !$position ){ $position = "right"; }
			
			$cposition = $this->getModuleConfig("cmenu_customposition");
			if( $cposition ){ $position = $cposition; }

			$display = $this->getModuleConfig("cmenu_display");
			if( $display=="after" ){ $display = true; }else { $display=false; }

			$block =  $layout->createBlock( 'venustheme_blog/cmenu' );

			if($myblock = $layout->getBlock( $position )){
				$myblock->insert($block, $title , $display);
			}

		}
	}

   function _loadMedia( $config = array()){

		$mediaHelper =  Mage::helper('venustheme_blog/media');
		$mediaHelper->addMediaFile("skin_css", "venustheme_blog/style.css" );
	}
}
