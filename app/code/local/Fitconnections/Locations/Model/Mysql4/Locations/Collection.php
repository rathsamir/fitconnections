<?php

class Fitconnections_Locations_Model_Mysql4_Locations_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('locations/locations');
    }
}