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
class Venustheme_Blog_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
		
	 
        $this->_controller = 'adminhtml_category';
        $this->_blockGroup = 'venustheme_blog';
        $this->_headerText = Mage::helper('venustheme_blog')->__('Category Manager');
		
        parent::__construct();

        $this->setTemplate('venustheme_blog/category.phtml');
		
		
    }

    protected function _prepareLayout() {
	
        $this->setChild('add_new_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label'     => Mage::helper('venustheme_blog')->__('Add Record'),
                'onclick'   => "setLocation('".$this->getUrl('*/*/add')."')",
                'class'   => 'add'
                ))
        );
		
		$this->setChild('mass_rewrite_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label'     => Mage::helper('venustheme_blog')->__('Mass Generate Rewrite URLs'),
                'onclick'   => "setLocation('".$this->getUrl('*/*/massRewrite')."')",
                'class'   => 'mass'
                ))
        );
        /**
         * Display store switcher if system has more one store
         */
        //if (!Mage::app()->isSingleStoreMode()) {
        //    $this->setChild('store_switcher',
        //             $this->getLayout()->createBlock('adminhtml/store_switcher')
        //             ->setUseConfirm(false)
        //             ->setSwitchUrl($this->getUrl('*/*/*', array('store'=>null)))
        //     );
        // }
        $this->setChild('grid', $this->getLayout()->createBlock('venustheme_blog/adminhtml_category_grid', 'category.grid'));
        return parent::_prepareLayout();
    }

    public function getAddNewButtonHtml() {
        return $this->getChildHtml('add_new_button');
    }
	
	public function getMassRewriteCatButtonHtml(){
		  return $this->getChildHtml('mass_rewrite_button');
	}
    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    //public function getStoreSwitcherHtml() {
     //   return $this->getChildHtml('store_switcher');
    //}
}