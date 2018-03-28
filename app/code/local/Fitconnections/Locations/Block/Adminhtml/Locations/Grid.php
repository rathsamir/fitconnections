<?php

class Fitconnections_Locations_Block_Adminhtml_Locations_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('LocationsGrid');
		$this->setDefaultSort('locations_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('locations/locations')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('id', array(
			'header'    => Mage::helper('locations')->__('ID'),
			'align'     =>'right',
			'width'     => '50px',
			'index'     => 'id',
		));
	
		$this->addColumn('title', array(
		  'header'    => Mage::helper('locations')->__('Title'),
		  'align'     =>'left',
		  'index'     => 'title',
		));
		$this->addColumn('town', array(
			'header'    => Mage::helper('locations')->__('Town'),
			'align'     =>'left',
			'index'     => 'town',
		));
		$this->addColumn('state', array(
			'header'    => Mage::helper('locations')->__('State'),
			'align'     =>'left',
			'index'     => 'state',
		));	  
		$this->addColumn('address', array(
			'header'    => Mage::helper('locations')->__('Address'),
			'align'     =>'left',
			'index'     => 'address',
			'width'	  => "300",	
		));
		$this->addColumn('phone', array(
			'header'    => Mage::helper('locations')->__('Phone'),
			'align'     =>'left',
			'index'     => 'phone',
			'width'	  => "300",	
		));
		$this->addColumn('created_time', array(
			'header'    => Mage::helper('locations')->__('Created At'),
			'align'     =>'left',
			'type' => 'date',
			'index'     => 'created_time',
		));
		$this->addColumn('update_time', array(
			'header'    => Mage::helper('locations')->__('Updated At'),
			'align'     =>'left',
			'type' => 'date',
			'index'     => 'update_time',
		));
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('locations')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('locations')->__('Edit'),
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'id'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));

		$this->addExportType('*/*/exportCsv', Mage::helper('locations')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('locations')->__('XML'));

		return parent::_prepareColumns();
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('locations_id');
		$this->getMassactionBlock()->setFormFieldName('locations');

		$this->getMassactionBlock()->addItem('delete', array(
			 'label'    => Mage::helper('locations')->__('Delete'),
			 'url'      => $this->getUrl('*/*/massDelete'),
			 'confirm'  => Mage::helper('locations')->__('Are you sure?')
		));

		$statuses = Mage::getSingleton('locations/status')->getOptionArray();

		array_unshift($statuses, array('label'=>'', 'value'=>''));
		$this->getMassactionBlock()->addItem('status', array(
			 'label'=> Mage::helper('locations')->__('Change status'),
			 'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
			 'additional' => array(
					'visibility' => array(
						'name' => 'status',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => Mage::helper('locations')->__('Status'),
						'values' => $statuses
					)
			)
		));
		return $this;
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}