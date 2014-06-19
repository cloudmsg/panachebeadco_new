<?php

class Venustheme_Blog_Block_Adminhtml_Post_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    public function __construct() {
		
        parent::__construct();
 
        $this->setId('postGrid');
        $this->setDefaultSort('date_from');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
		
    }

  //  protected function _getStore() {
   //     $storeId = (int) $this->getRequest()->getParam('store', 0);
   //     return Mage::app()->getStore($storeId);
   // }

    protected function _prepareCollection() {
        $collection = Mage::getModel('venustheme_blog/post')->getCollection();
        //$store = $this->_getStore();
        //if ($store->getId()) {
        //    $collection->addStoreFilter($store);
       // }
		
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {  
        $this->addColumn('post_id', array(
                'header'    => Mage::helper('venustheme_blog')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'post_id',
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
                'header'    => Mage::helper('venustheme_blog')->__('Position'),
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

        $this->addColumn('action',
                array(
                'header'    =>  Mage::helper('venustheme_blog')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                        array(
                                'caption'   => Mage::helper('venustheme_blog')->__('Edit'),
                                'url'       => array('base'=> '*/*/edit'),
                                'field'     => 'id'
                        ),
                        array(
                                'caption'   => Mage::helper('venustheme_blog')->__('Delete'),
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
        $this->setMassactionIdField('post_id');
        $this->getMassactionBlock()->setFormFieldName('post');

        $this->getMassactionBlock()->addItem('delete', array(
                'label'    => Mage::helper('venustheme_blog')->__('Delete'),
                'url'      => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('venustheme_blog')->__('Are you sure?')
        ));

        $statuses = array(
                1 => Mage::helper('venustheme_blog')->__('Enabled'),
                0 => Mage::helper('venustheme_blog')->__('Disabled')
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