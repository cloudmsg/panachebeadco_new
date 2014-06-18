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

class Venustheme_Blog_Block_Adminhtml_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $_model = Mage::registry('category_data');
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('category_form', array('legend'=>Mage::helper('venustheme_blog')->__('General Information')));
        
		$fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('venustheme_blog')->__('Is Active'),
            'name'      => 'is_active',
            'values'    => Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
            //'value'     => $_model->getIsActive()
        ));
		$fieldset->addField('layout', 'select', array(
            'label'     => Mage::helper('venustheme_blog')->__('Layout Design'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'layout',
			'default'  => 'default',
			'values'   => array('default'=> Mage::helper('venustheme_blog')->__('Default'))
        ));
		
		$fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('venustheme_blog')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
		$fieldset->addField('identifier', 'text', array(
            'label'     => Mage::helper('venustheme_blog')->__('Alias'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'identifier',
            //'value'     => $_model->getLabel()
        ));
		
		$fieldset->addField('parent_id', 'select', array(
			'label'     => Mage::helper('venustheme_blog')->__('Parent'),
			'name'      => 'parent_id',
			'values'    => $this->getParentToOptionArray()
		));
		
		$fieldset->addField('file', 'image', array(
            'label'     => Mage::helper('venustheme_blog')->__('Image'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'file',
        ));
		
		
		
		
		$fieldset->addField('position', 'text', array(
            'label'     => Mage::helper('venustheme_blog')->__('Position'),
            'class'     => 'required-entry',
            'required'  => false,
            'name'      => 'position',
			//'value'     => $_model->getPosition()
        ));
		
		try{
			$config = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
                array(
                        'add_widgets' => false,
                        'add_variables' => false,
                    )
                );
			if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
				$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
			}  

			$config->setData(Mage::helper('venustheme_blog')->recursiveReplace(
					'/venustheme_blog/',
					'/'.(string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName').'/',
					$config->getData()
				)
			);
				
		}
        catch (Exception $ex){
            $config = null;
        }		
		$fieldset->addField('description', 'editor', array(
            'label'     => Mage::helper('venustheme_blog')->__('Description'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'description',
			'style'     => 'width:600px;height:300px;',
            'wysiwyg'   => true,
			//'value'     => $_model->getDescription()
			 'config'    =>  $config,
        ));
		
		
        
		
		 
        
		if ( Mage::getSingleton('adminhtml/session')->getCategoryData() )
		  {
			  $form->setValues(Mage::getSingleton('adminhtml/session')->getCategoryData());
			  Mage::getSingleton('adminhtml/session')->getCategoryData(null);
		  } elseif ( Mage::registry('category_data') ) {
			  $form->setValues(Mage::registry('category_data')->getData());
		  }
        
        return parent::_prepareForm();
    }
	
	  public function getParentToOptionArray() {
		$catCollection = Mage::getModel('venustheme_blog/category')
					->getCollection();
		$id = Mage::registry('category_data')->getId();
		if($id) {
			$catCollection->addFieldToFilter('category_id', array('neq' => $id));
		}
		$option = array();
		$option[] = array( 'value' => 0, 
						   'label' => 'Top Level');
		foreach($catCollection as $cat) {
			$option[] = array( 'value' => $cat->getId(), 
							   'label' => $cat->getTitle() );
		}
		return $option;
    }
}
