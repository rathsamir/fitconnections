<?php

/**
 * Adminhtml grid container block
 * 
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir Rath
 */
class Fitconnections_Contract_Block_Adminhtml_Contract_List extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_contract_list';
        $this->_blockGroup = 'contract';
        $this->_headerText = Mage::helper('contract')->__('Manage Contract Lists');
        
        parent::__construct();

        $this->_removeButton('add');
    }

}
