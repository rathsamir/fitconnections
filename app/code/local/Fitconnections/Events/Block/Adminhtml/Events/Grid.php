<?php

class Fitconnections_Events_Block_Adminhtml_Events_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('eventsGrid');
      $this->setDefaultSort('events_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {  
      $collection = Mage::getModel('events/events')->getCollection();    
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

	/*protected function _getStore()
	{
		$storeId = (int) $this->getRequest()->getParam('store', 0);
		return Mage::app()->getStore($storeId);
	} */ 
  
  protected function _prepareColumns()
  {
      $this->addColumn('events_id', array(
          'header'    => Mage::helper('events')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'events_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('events')->__('Event Name'),
          'align'     =>'left',
          'index'     => 'title',
	  'width'	=> '150px',
      ));
      
      /*$this->addColumn('email', array(
          'header'    => Mage::helper('events')->__('Client Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));*/      

      $this->addColumn('status', array(
          'header'    => Mage::helper('events')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              0 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('events')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('events')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('events')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('events')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('events_id');
        $this->getMassactionBlock()->setFormFieldName('events');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('events')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('events')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('events/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('events')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('events')->__('Status'),
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
