<?php

class Fitconnections_Events_Model_Mysql4_Events extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the events_id refers to the key field in your database table.
        $this->_init('events/events', 'events_id');
    }     
   /**
     * Load images
     */
    public function loadImage(Mage_Core_Model_Abstract $object) {
        return $this->__loadImage($object);
    }
   /**
     *
     * @param Mage_Core_Model_Abstract $object
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
        if (!$object->getIsMassDelete()) {
            $object = $this->__loadImage($object);
        }

        return parent::_afterLoad($object);
    }
    /**
     * Call-back function
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        if (!$object->getIsMassStatus()) {
            $this->__saveToImageTable($object);
        }

        return parent::_afterSave($object);
    }
  /**
     * Load images
     */
    private function __loadImage(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('events/events_image'))
                ->where('events_id = ?', $object->getId())
                ->order(array('position ASC', 'image_id'));

        $object->setData('image', $this->_getReadAdapter()->fetchAll($select));
        return $object;
    }
  
    /**
     * Save stores
     */
    private function __saveToImageTable(Mage_Core_Model_Abstract $object) {
        if ($_imageList = $object->getData('images')) {
            $_imageList = Zend_Json::decode($_imageList);
            if (is_array($_imageList) and sizeof($_imageList) > 0) {
                $_imageTable = $this->getTable('events/events_image');
                $_adapter = $this->_getWriteAdapter();
                $_adapter->beginTransaction();
                try {
                    $condition = $this->_getWriteAdapter()->quoteInto('events_id = ?', $object->getId());
                    $this->_getWriteAdapter()->delete($this->getTable('events/events_image'), $condition);

                    foreach ($_imageList as &$_item) {
                        if (isset($_item['removed']) and $_item['removed'] == '1') {
                            $_adapter->delete($_imageTable, $_adapter->quoteInto('image_id = ?', $_item['value_id'], 'INTEGER'));
                        } else {
                            $_data = array(
                                'file' => $_item['file'],
                                'position' => $_item['position'],
                                'disabled' => $_item['disabled'],
                                'events_id' => $object->getId());
                            $_adapter->insert($_imageTable, $_data);
                        }
                    }
                    $_adapter->commit();
                } catch (Exception $e) {
                    $_adapter->rollBack();
                    echo $e->getMessage();
                }
            }
        }
    }
}
