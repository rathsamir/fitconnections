<?php

class Fitconnections_Locations_Block_Adminhtml_Locations_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('locations_form', array('legend'=>Mage::helper('locations')->__('Item information')));
     
	  $object = Mage::getModel('locations/locations')->load( $this->getRequest()->getParam('id') );
	 
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('locations')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
	  $fieldset->addField('address', 'text', array(
          'label'     => Mage::helper('locations')->__('Address'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'address',
      ));
		
	 $fieldset->addField('town', 'text', array(
          'label'     => Mage::helper('locations')->__('Town'),
          'required'  => false,
          'name'      => 'town',
	  ));
	   $fieldset->addField('postcode', 'text', array(
          'label'     => Mage::helper('locations')->__('Postcode'),
          'required'  => false,
          'name'      => 'postcode',
	  ));
	   $fieldset->addField('state', 'text', array(
          'label'     => Mage::helper('locations')->__('State'),
          'required'  => false,
          'name'      => 'state',
	  ));
	   $fieldset->addField('country', 'text', array(
          'label'     => Mage::helper('locations')->__('Country'),
          'required'  => false,
          'name'      => 'country',
	  ));
	     $fieldset->addField('phone', 'text', array(
          'label'     => Mage::helper('locations')->__('Phone'),
          'required'  => false,
          'name'      => 'phone',
	  ));
	     $fieldset->addField('fax', 'text', array(
          'label'     => Mage::helper('locations')->__('Fax'),
          'required'  => false,
          'name'      => 'fax',
	  ));
	      $fieldset->addField('code', 'text', array(
          'label'     => Mage::helper('locations')->__('Code'),
          'required'  => false,
          'name'      => 'code',
	  ));
	  
	
     
      if ( Mage::getSingleton('adminhtml/session')->getLocationsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLocationsData());
          Mage::getSingleton('adminhtml/session')->setBannersData(null);
      } elseif ( Mage::registry('locations_data') ) {
          $form->setValues(Mage::registry('locations_data')->getData());
      }
      return parent::_prepareForm();
  }
}