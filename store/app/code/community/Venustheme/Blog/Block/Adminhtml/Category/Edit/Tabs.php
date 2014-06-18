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
class Venustheme_Blog_Block_Adminhtml_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('blog_form');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('venustheme_blog')->__('Category Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('venustheme_blog')->__('General Information'),
            'title'     => Mage::helper('venustheme_blog')->__('General Information'),
            'content'   => $this->getLayout()->createBlock('venustheme_blog/adminhtml_category_edit_tab_form')->toHtml(),
        ));
		$this->addTab('form_section_seo', array(
            'label'     => Mage::helper('venustheme_blog')->__('SEO'),
            'title'     => Mage::helper('venustheme_blog')->__('SEO'),
            'content'   => $this->getLayout()->createBlock('venustheme_blog/adminhtml_category_edit_tab_meta')->toHtml(),
        ));
		/*
		$this->addTab('form_section_params', array(
            'label'     => Mage::helper('venustheme_blog')->__('Parameters'),
            'title'     => Mage::helper('venustheme_blog')->__('Parameters'),
            'content'   => $this->getLayout()->createBlock('venustheme_blog/adminhtml_category_edit_tab_param')->toHtml(),
        ));
		*/
        return parent::_beforeToHtml();
    }
}