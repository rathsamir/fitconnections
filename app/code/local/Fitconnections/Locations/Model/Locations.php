<?php

class Fitconnections_Locations_Model_Locations extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('locations/locations');
    }
}