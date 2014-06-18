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
class Venustheme_Blog_Block_Blog_List extends Venustheme_Blog_Block_Blog_Template
{
    
    protected function _prepareLayout() {			 
		$tag = $this->getRequest()->getParam( "tag" ); 
		$author = (int)$this->getRequest()->getParam( "user" ); 
		if( $tag ){
			$this->setType( "tag" )
				->setPageTitle( sprintf($this->__("Displaying posts by tag: %s"),$tag) )
				->setHeadInfo( $this->getGeneralConfig("metakeywords"), $this->getGeneralConfig("metadescription") );
		}elseif( $author ) {
			$author = Mage::getModel("admin/user")->load( $author ); 
			$f = $author->getFirstname().' '.$author->getLastname();
			$this->setType( "author" )
				->setPageTitle( sprintf($this->__("Displaying posts by author: %s"),$f) )
				->setHeadInfo( $this->getGeneralConfig("metakeywords"), $this->getGeneralConfig("metadescription") );
		}else {
			$this->setType( "latest" )
				->setPageTitle( $this->__("Latest Posts") )
				->setHeadInfo( $this->getGeneralConfig("metakeywords"), $this->getGeneralConfig("metadescription") );
				
		}
		
		$breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
		$breadcrumbs->addCrumb( 'home', array( 'label'=>Mage::helper('venustheme_blog')->__('Home'), 
											   'title'=>Mage::helper('venustheme_blog')->__('Go to Home Page'), 
											   'link' => Mage::getBaseUrl()) );
		
		$extension = "";
		$breadcrumbs->addCrumb( 'venus_blog', array( 'label' => $this->getGeneralConfig("title"), 
													 'title' => $this->getGeneralConfig("title"), 
													 'link'  =>  Mage::getBaseUrl().$this->getGeneralConfig("route").$extension ) );	
													
	}

	public function getPosts(){
	
		$id = $this->getRequest()->getParam('id');
		$page = $this->getRequest()->getParam('page') ? $this->getRequest()->getParam('page') : 1;
		$limit = (int)$this->getListConfig("list_leadinglimit") + (int)$this->getListConfig("list_secondlimit");
		$collection = Mage::getModel( 'venustheme_blog/post' )
				->getCollection();
		if( $this->getType() == "tag" ){ 
			$collection->addTagsFilter( array($this->getRequest()->getParam( "tag" )) );
		}elseif ( $this->getType() == "author" ){
			$collection->addAuthorFilter( (int)$this->getRequest()->getParam( "user" ) );
		}		
		$collection->addCategoriesFilter(0)->setOrder( 'created', 'DESC' )
				->setPageSize( $limit )
				->setCurPage( $page );
				
		return $collection;		
	}
 
}