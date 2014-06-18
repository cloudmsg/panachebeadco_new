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
class Venustheme_Blog_Block_Latest extends Venustheme_Blog_Block_List 
{

	
	/**
	 * Contructor
	 */
	public function __construct($attributes = array())
	{
		
		parent::__construct( $attributes );
	}
	
	public function _toHtml(){
 
		$collection = Mage::getModel( 'venustheme_blog/post' )
						->getCollection()
						->addCategoriesFilter(0);
		
		
		if( $this->getConfig("latest_typesource") == "hit" ){
			$collection ->setOrder( 'hits', 'DESC' );
		}else {
			$collection ->setOrder( 'created', 'DESC' );
		}
		$collection->setPageSize( $this->getConfig("limit_items") )->setCurPage( 1 );
 
		$this->assign( 'posts', $collection );	
		$this->setTemplate( "venustheme/blog/block/latest.phtml" );
		  
		return parent::_toHtml();
		
	}
}	