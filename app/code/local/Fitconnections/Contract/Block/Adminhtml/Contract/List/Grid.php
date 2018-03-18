<?php

/**
 * Adminhtml grid container block
 * 
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Block_Adminhtml_Contract_List_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('fitconnections_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection object
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getModel('contract/list')->getCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    /**
     * Prepare the grid columns
     * 
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('contract')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'id',
            ));
        
        $this->addColumn('created_at', array(
            'header' => Mage::helper('contract')->__('Created At'),
            'align' => 'left',
            'index' => 'created_at',
            'type' => 'datetime',
            ));
        $this->addColumn('firstname', array(
            'header' => Mage::helper('contract')->__('Customer First Name'),
            'align' => 'left',
            'index' => 'firstname',
            ));
        $this->addColumn('lastname', array(
            'header' => Mage::helper('contract')->__('Customer Last Name'),
            'align' => 'left',
            'index' => 'lastname',
            ));
        $this->addColumn('email', array(
            'header' => Mage::helper('contract')->__('Customer Email'),
            'align' => 'left',
            'index' => 'email',

            ));
        $this->addColumn('price', array(
            'header' => Mage::helper('contract')->__('Price'),
            'align' => 'left',
            'index' => 'price',
            ));
	    $this->addColumn('phone', array(
            'header' => Mage::helper('contract')->__('Phone'),
            'align' => 'left',
            'index' => 'phone',
            ));
        $this->addColumn('address', array(
            'header' => Mage::helper('contract')->__('Address'),
            'align' => 'left',
            'index' => 'address',
            ));
        $this->addColumn('town', array(
            'header' => Mage::helper('contract')->__('Town'),
            'align' => 'left',
            'index' => 'town',
            )); 
        $this->addColumn('zipcode', array(
            'header' => Mage::helper('contract')->__('Zipcode'),
            'align' => 'left',
            'index' => 'zipcode',
            ));
        $this->addColumn('state', array(
            'header' => Mage::helper('contract')->__('State'),
            'align' => 'left',
            'index' => 'state',
            )); 	 			


        return parent::_prepareColumns();
    }

    /**
     * @return Hobbyking_contract_Block_Adminhtml_contract_List_Grid
     */
    protected function _prepareMassaction() {
        $entityId = Mage::getModel('contract/list')->getResource()->getIdFieldName();
        $this->setMassactionIdField($entityId);
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->addItem(
            'delete', array(
                'label' => $this->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                )
            );
        return $this;
    }
    
}
