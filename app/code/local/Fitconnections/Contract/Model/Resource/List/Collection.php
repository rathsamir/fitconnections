<?php

/**
 * List Resource Collection
 *
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Model_Resource_List_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct() {
        $this->_init('contract/list');
    }

}
