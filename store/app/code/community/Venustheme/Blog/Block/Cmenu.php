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
class Venustheme_Blog_Block_Cmenu extends Venustheme_Blog_Block_List 
{

	
	/**
	 * Contructor
	 */
	public function __construct($attributes = array()){
		 Mage::helper('venustheme_blog/media')->addMediaFile( "js", "venustheme_blog/menu.js" );
		parent::__construct( $attributes );
	}
	
	public function _toHtml(){
		
		$this->setTemplate( "venustheme/blog/block/cmenu.phtml" );
		$menu = Mage::getModel( "venustheme_blog/category" )
					->getCollection()
					 ->addFieldToFilter('is_active', 1)
                    ->addFieldToFilter('parent_id', (int)$this->getConfig("cmenu_parent") )->setOrder("position","DESC");
		
		

		$this->assign( 'menus', $menu );	 
		return parent::_toHtml();	
	}
	public function renderTree( $parent , $level=1){
		
		$collection = Mage::getModel( "venustheme_blog/category" )
					->getCollection()
					 ->addFieldToFilter('is_active', 1)
                    ->addFieldToFilter('parent_id', $parent->getId() )
					->setOrder("position","DESC");
		
		$html = '<li class="level'.($level+1).''.(count($collection)?" parent":"").'">';
			$html .= '<a href="'.$parent->getCategoryLink().'" title="'.$parent->getTitle().'"><span>'.$parent->getTitle().'</span></a>';
		if( count($collection) ){
			$html .= '<span class="head"><a style="float:right;" href="#"></a></span>';
			$html .= '<ul class="level'.($level+1).'">';
				foreach( $collection as $child ){
					$html .= $this->renderTree( $child );
				}
			$html .= '</ul>';	
		}

		$html .= '</li>';
		
		return $html;
	}
}
?>