<?php

/**
 * List resource model class
 * 
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Model_Resource_List extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {
        $this->_init('contract/list', 'id');
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return Hobbyking_Feedback_Model_Resource_List
     * @throws Mage_Core_Exception
     */
    public function removeItems(Mage_Core_Model_Abstract $object) {
        if (!is_array($object->getData('ids')) || empty($object->getData('ids'))) {
            throw Mage::exception(
                    'Mage_Core', Mage::helper('contract')->__('Item(s) should be selected')
            );
        }
        $this->_getWriteAdapter()
                ->delete(
                        $this->getMainTable(), array(
                    'id in(?)' => $object->getData('ids')
                        )
        );
        return $this;
    }

}
