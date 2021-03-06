<?php

class Venustheme_Sideproduct_Block_Adminhtml_Banner_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('venustheme_sideproduct')->__('Banner Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general_section', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('General Information'),
            'title'     => Mage::helper('venustheme_sideproduct')->__('General Information'),
            'content'   => $this->getLayout()->createBlock('venustheme_sideproduct/adminhtml_banner_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}