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
class Venustheme_Blog_Block_Blog_Template extends Mage_Core_Block_Template
{
	
	/**
	 * @var string $_theme store currently theme.
	 *
	 * @access protected;
	 */
	protected $_theme = 'default';
	
	/**
	 * @var string $_type type of layout
	 *
	 * @access protected;
	 */
	protected $_type='';
	
	/**
	 * @var string $_pageTitle it is page title.
	 *
	 * @access protected;
	 */
	protected $_pageTitle = '';
	

	public function __construct($attributes = array())
	{
		if( !defined("_VENUSTHEME_BLOG_MEDIA_") ) {
			$mediaHelper =  Mage::helper('venustheme_blog/media');
			$this->_theme = $this->getGeneralConfig("theme");
			

			$mediaHelper->addMediaFile("skin_css", "venustheme_blog/style.css" );
			$mediaHelper->addMediaFile("js","venustheme_blog/script.js");
			define( "_VENUSTHEME_BLOG_MEDIA_", 1 );
		}	
		parent::__construct( $attributes );		
	}
	
	public function getPostConfig( $key ){  
		return Mage::getStoreConfig('venustheme_blog/post_setting/'.$key);
	}
	
	public function getGeneralConfig( $key ){
		return Mage::getStoreConfig('venustheme_blog/general_setting/'.$key);
	}
	
	public function getCategoryConfig( $key ){
		return  Mage::getStoreConfig('venustheme_blog/category_setting/'.$key);
	}
	
	public function getListConfig( $key ){
		return  Mage::getStoreConfig('venustheme_blog/list_setting/'.$key);
	}
	
		
	public function setType( $type ){
		$this->_type = $type;
		return $this;
	}
	
	public function getType(){
		return $this->_type;
	}
	
	public function setPageTitle( $ptitle ){
		$this->_pageTitle = $ptitle;
		return $this;
	}
	
	public function getPageTitle(){
		return $this->_pageTitle;
	}
	
	public function setHeadInfo( $keyword='',$metadesc='',$rss='' ){		
		if ( $head = $this->getLayout()->getBlock('head') ) {

			$head->setTitle( $this->_pageTitle );
			if( $keyword ) {
				$head->setKeywords( $keyword );
			}
			if( $metadesc ) {
				$head->setDescription( $metadesc );
			}
			//	Mage::helper('mtcms')->addRssToHead($head, Mage::helper('')->getBlogUrl() . "rss");
	
		}
		return $this;
	}

}
?>