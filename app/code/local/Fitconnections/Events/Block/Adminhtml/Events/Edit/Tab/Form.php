<?php

class Fitconnections_Events_Block_Adminhtml_Events_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

		
	  protected function _prepareForm()
	  {
	      $form = new Varien_Data_Form();
	      $this->setForm($form);
	      $fieldset = $form->addFieldset('events_form', array('legend'=>Mage::helper('events')->__('Events Information')));
	        
	      $fieldset->addField('title', 'text', array(
	          'label'     => Mage::helper('events')->__('Event Title'),
	          'class'     => 'required-entry',
	          'required'  => true,
	          'name'      => 'title',
	      ));

	      
	      $fieldset->addField('description', 'text', array(
	          'label'     => Mage::helper('events')->__('Event Description'),
	          'required'  => false,
	          'name'      => 'description',
	      ));
	       
                 
	      $fieldset->addField('event_image', 'image', array(
	          'label'     => Mage::helper('events')->__('Event Profile Image'),
	          'required'  => false,
	          'name'      => 'event_image',
                 // 'after_element_html' => '<br> [ Only jpg, jpeg, gif, png are allowed ]<br><br>'.$media
		  ));

			
	      $fieldset->addField('status', 'select', array(
	          'label'     => Mage::helper('events')->__('Status'),
	          'name'      => 'status',
	          'values'    => array(
	              array(
	                  'value'     => 1,
	                  'label'     => Mage::helper('events')->__('Enabled'),
	              ),
	
	              array(
	                  'value'     => 0,
	                  'label'     => Mage::helper('events')->__('Disabled'),
	              ),
	          ),
	      ));
	     
	       
	     
	      if ( Mage::getSingleton('adminhtml/session')->getEventsData() )
	      {
	          $form->setValues(Mage::getSingleton('adminhtml/session')->getEventsData());
	          Mage::getSingleton('adminhtml/session')->setEventsData(null);
	      } elseif ( Mage::registry('events_data') ) {
	      	  $events = Mage::registry('events_data')->getData();
	          $form->setValues($events);
	      }
	      return parent::_prepareForm();
  		}
}
