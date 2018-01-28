<?php
class Fitconnections_Events_Block_Adminhtml_Events extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_events';
    $this->_blockGroup = 'events';  
    $this->_headerText = Mage::helper('events')->__('Events Manager');
    $this->_addButtonLabel = Mage::helper('events')->__('Add Event');
    parent::__construct();
	 
  }
  
}
