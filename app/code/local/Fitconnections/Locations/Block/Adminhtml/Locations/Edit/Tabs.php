<?php

class Fitconnections_Locations_Block_Adminhtml_Locations_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('banners_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('locations')->__('Locations Information'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('form_section', array(
			'label'     => Mage::helper('locations')->__('Location Information'),
			'title'     => Mage::helper('locations')->__('Locations Information'),
			'content'   => $this->getLayout()->createBlock('locations/adminhtml_locations_edit_tab_form')->toHtml(),
			'content'   => $this->getLayout()->createBlock('locations/adminhtml_locations_edit_tab_form')->toHtml(),
		));
		return parent::_beforeToHtml();
	}
}