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
class Venustheme_Blog_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
		
        parent::__construct();
		
	
        $this->setId('categoryGrid');
        $this->setDefaultSort('date_from');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
		
    }

  //  protected function _getStore() {
   //     $storeId = (int) $this->getRequest()->getParam('store', 0);
   //     return Mage::app()->getStore($storeId);
   // }

    protected function _prepareCollection() {
        $collection = Mage::getModel('venustheme_blog/category')->getCollection();
        //$store = $this->_getStore();
        //if ($store->getId()) {
        //    $collection->addStoreFilter($store);
       // }
		
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
	
	
    protected function _prepareColumns() {  
	 
        $this->addColumn('category_id', array(
                'header'    => Mage::helper('venustheme_blog')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'category_id',
        ));
		
		$this->addColumn('title', array(
                'header'    => Mage::helper('venustheme_blog')->__('Title'),
                'align'     =>'left',
                'index'     => 'title',
        ));
		$this->addColumn('identifier', array(
                'header'    => Mage::helper('venustheme_blog')->__('Identifier'),
                'align'     =>'left',
                'index'     => 'identifier',
        ));
		 $this->addColumn('file', array(
                'header'    => Mage::helper('venustheme_blog')->__('Image'),
                'align'     =>'left',
                'index'     => 'file',
        ));		
		$this->addColumn('position', array(
                'header'    => Mage::helper('venustheme_blog')->__('Sort Order'),
                'align'     =>'left',
                'index'     => 'position',
				 'width'     => '80px',
        ));
		
		$this->addColumn('is_active', array(
                'header'    => Mage::helper('venustheme_blog')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                        1 => Mage::helper('venustheme_blog')->__('Enabled'),
                        0 => Mage::helper('venustheme_blog')->__('Disabled'),
                //3 => Mage::helper('venustheme_blog')->__('Hidden'),
                ),
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() { 
        $this->setMassactionIdField('category_id');
        $this->getMassactionBlock()->setFormFieldName('category');

        $this->getMassactionBlock()->addItem('delete', array(
                'label'    => Mage::helper('venustheme_blog')->__('Delete'),
                'url'      => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('venustheme_blog')->__('Are you sure?')
        ));

        $statuses = array(
                1 => Mage::helper('venustheme_blog')->__('Enabled'),
                2 => Mage::helper('venustheme_blog')->__('Disabled')
				);
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
                'label'=> Mage::helper('venustheme_blog')->__('Change status'),
                'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                        'visibility' => array(
                                'name' => 'status',
                                'type' => 'select',
                                'class' => 'required-entry',
                                'label' => Mage::helper('venustheme_blog')->__('Status'),
                                'values' => $statuses
                        )
                )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}