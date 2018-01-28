<?php

class Fitconnections_Events_Block_Adminhtml_Events_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('events_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('events')->__('Event Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('events')->__('Event Information'),
          'title'     => Mage::helper('events')->__('Event Information'),
          'content'   => $this->getLayout()->createBlock('events/adminhtml_events_edit_tab_form')->toHtml(),
      ));
       $this->addTab('image_section', array(
            'label' => Mage::helper('events')->__('Event Images'),
            'title' => Mage::helper('events')->__('Event Images'),
            'content' => $this->getLayout()->createBlock('events/adminhtml_events_edit_tab_image')->toHtml(),
        ));
     
      return parent::_beforeToHtml();
  }
}
