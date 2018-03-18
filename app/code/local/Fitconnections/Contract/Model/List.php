<?php

/**
 * List model class
 *
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Model_List extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('contract/list');
    }

    /**
     * Invoke the resource remove items method
     * 
     * @return Hobbyking_Feedback_Model_List
     */
    public function removeItems() {
        $this->getResource()->removeItems($this);
        return $this;
    }

}
