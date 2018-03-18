<?php

/**
 * List adminhtml controller
 *
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Adminhtml_Contract_ListController extends Mage_Adminhtml_Controller_Action {
    
    /**
     * Load the layout and set menu and breadcrumb 
     */
    protected function _initAction() {
        $this->loadLayout()
        ->_setActiveMenu('customer')
        ->_addBreadcrumb(Mage::helper('contract')->__('Contract'), Mage::helper('contract')->__('Manage Contract Lists'));
        

        return $this;
    }
    
    /**
     * Render the list grid
     */
    public function indexAction() {
        $this->_title(Mage::helper('contract')->__('Manage Contract Lists'));
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('contract/adminhtml_contract_list'));
        $this->renderLayout();
    }
     /**
     * Check current user permission on resource and privilege
     * 
     * @return boolean
     */
     protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('customer/contract');
    }

    /**
     * @return $this
     */
    public function massDeleteAction() {
        $this->_removeItems($this->getRequest()->getParam('ids', array()));
        $this->_redirect('*/*');
        return $this;
    }

    /**
     * @return $this
     */
    public function deleteAction() {
        try {
            $this->_removeItems(
                ($this->getRequest()->getParam('id', 0)) ? array($this->getRequest()->getParam('id', 0)) : array()
                );
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('contract')->__('Contract Successfully Removed'));
        } catch (Exception $e) {
            
        }
        $this->_redirect('*/*');
        return $this;
    }

    /**
     * @param array $ids
     * @return $this
     */
    protected function _removeItems(array $ids) {
        try {
            $model = Mage::getModel('contract/list');
            $model->setIds($ids);
            $model->removeItems();
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        return $this;
    }
    
}
