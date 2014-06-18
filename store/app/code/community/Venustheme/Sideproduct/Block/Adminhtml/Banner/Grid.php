<?php

class Venustheme_Sideproduct_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
		
        parent::__construct();
	
        $this->setId('bannerGrid');
        $this->setDefaultSort('date_from');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
		
    }

  //  protected function _getStore() {
   //     $storeId = (int) $this->getRequest()->getParam('store', 0);
   //     return Mage::app()->getStore($storeId);
   // }

    protected function _prepareCollection() {
        $collection = Mage::getModel('venustheme_sideproduct/banner')->getCollection();
        //$store = $this->_getStore();
        //if ($store->getId()) {
        //    $collection->addStoreFilter($store);
       // }
		
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {  
        $this->addColumn('banner_id', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'banner_id',
        ));
		$this->addColumn('title', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('Title'),
                'align'     =>'left',
                'index'     => 'title',
        ));
		
		
        $this->addColumn('link', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('Sideproduct Link'),
                'align'     =>'left',
                'index'     => 'link',
        ));		
		
        $this->addColumn('position', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('Position'),
                'align'     =>'left',
                'index'     => 'position',
        ));
		$this->addColumn('label', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('Group'),
                'align'     =>'left',
                'index'     => 'label',
        ));

        $this->addColumn('is_active', array(
                'header'    => Mage::helper('venustheme_sideproduct')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                        1 => Mage::helper('venustheme_sideproduct')->__('Enabled'),
                        0 => Mage::helper('venustheme_sideproduct')->__('Disabled'),
                //3 => Mage::helper('venustheme_sideproduct')->__('Hidden'),
                ),
        ));

        $this->addColumn('action',
                array(
                'header'    =>  Mage::helper('venustheme_sideproduct')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption'   => Mage::helper('venustheme_sideproduct')->__('Edit'),
                                'url'       => array('base'=> '*/*/edit'),
                                'field'     => 'id'
                        ),
                        array(
                                'caption'   => Mage::helper('venustheme_sideproduct')->__('Delete'),
                                'url'       => array('base'=> '*/*/delete'),
                                'field'     => 'id'
                        )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() { 
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem('delete', array(
                'label'    => Mage::helper('venustheme_sideproduct')->__('Delete'),
                'url'      => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('venustheme_sideproduct')->__('Are you sure?')
        ));

        $statuses = array(
                1 => Mage::helper('venustheme_sideproduct')->__('Enabled'),
                0 => Mage::helper('venustheme_sideproduct')->__('Disabled')
				);
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
                'label'=> Mage::helper('venustheme_sideproduct')->__('Change status'),
                'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                        'visibility' => array(
                                'name' => 'status',
                                'type' => 'select',
                                'class' => 'required-entry',
                                'label' => Mage::helper('venustheme_sideproduct')->__('Status'),
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