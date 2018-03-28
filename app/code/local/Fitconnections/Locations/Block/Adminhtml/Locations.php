<?php
class Fitconnections_Locations_Block_Adminhtml_Locations extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_locations';
		$this->_blockGroup = 'locations';
		$this->_headerText = Mage::helper('locations')->__('Locations Manager');
		$this->_addButtonLabel = Mage::helper('locations')->__('Add Store Locations');

		parent::__construct();
	}
}