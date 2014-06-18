<?php

class Venustheme_Sideproduct_Block_Adminhtml_Banner_Add_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('venustheme_sideproduct')->__('General Information')));
       
		$fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
		
		$fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Enable'),
            'class'     => 'required-entry',
            'required'  => false,
            'name'      => 'is_active',
			'values' 	=> array('0'=>'No', '1'=>'Yes'),
			'note'  	=> 'If you would not like to use Sideproduct Image, you can upload to replace'
        ));
		
		$fieldset->addField('file', 'image', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Image'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'file',
			'note'  	=> 'In Detail Sideproduct Video, click to Shared button to see as this link'
        ));
		
		$fieldset->addField('label', 'text', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Group'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'label',
        ));

		$fieldset->addField('position', 'text', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Position'),
            'class'     => 'required-entry',
            'required'  => false,
            'name'      => 'position',
        ));
		
			$fieldset->addField('link', 'text', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Sideproduct Link'),
            'class'     => 'required-entry',
            'required'  => true,
			'comment' => 'hahaa aha ',
            'name'      => 'link',
			//'value'     => $_model->getPosition()
        ));
		 
		
		
		$fieldset->addField('description', 'editor', array(
            'label'     => Mage::helper('venustheme_sideproduct')->__('Description'),
            'class'     => 'required-entry',
            'required'  => false,
            'name'      => 'description',
			'style'     => 'width:600px;height:300px;',
            'wysiwyg'   => false,
			//'value'     => $_model->getDescription()
			//'config'    => Mage::getVersion() > '1.4' ? @Mage::getSingleton('cms/wysiwyg_config')->getConfig() : false,
        ));
        
        return parent::_prepareForm();
    }
}
