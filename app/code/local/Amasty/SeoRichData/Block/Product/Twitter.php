<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_SeoRichData
 */


class Amasty_SeoRichData_Block_Product_Twitter extends Mage_Core_Block_Template
{
    public function getProduct()
    {
        return Mage::registry('current_product') ? Mage::registry('current_product') : Mage::registry('product');
    }

    public function getLabel1()
    {
        return Mage::getStoreConfig('amseorichdata/twitter/label1');
    }

    public function getLabel2()
    {
        return Mage::getStoreConfig('amseorichdata/twitter/label2');
    }

    public function getData1()
    {
        return strip_tags($this->getDataField('data1'));
    }

    public function getData2()
    {
        return strip_tags($this->getDataField('data2'));
    }

    public function getDataField($name)
    {
        if (!isset($this->_data[$name])) {
            $this->_data[$name] = NULL;
        }
        if (is_null($this->_data[$name])) {
            $value = '';

            // @todo add attributes support and templates like `color {color} for {city}`
            $type = Mage::getStoreConfig('amseorichdata/twitter/' . $name . '_select');
            switch ($type) {
                case 'stock_status':
                    $value = $this->__('Not available');
                    if ($this->getProduct()->is_in_stock == 1) {
                        $value = $this->__('In Stock'); // @todo compatibility with Custom Stock Status
                    }
                    break;

                case 'rating':
                    $value = Mage::helper('amseorichdata/rating')->getSummaryRating();
                    break;

                case 'price':
                    $value = $this->getProduct()->getFormatedPrice();
                    break;

                case 'custom':
                default:
                    $value = Mage::getStoreConfig('amseorichdata/twitter/' . $name . '_custom');
                    break;
            }

            $this->_data[$name] = $value;
        }

        return $this->_data[$name];
    }

    public function getResizedImage()
    {
        return $this->helper('catalog/image')->init($this->getProduct(), 'thumbnail')->resize(
            (int)Mage::getStoreConfig('amseorichdata/twitter/image_height'),
            (int)Mage::getStoreConfig('amseorichdata/twitter/image_height'));
    }

    public function getDescription()
    {
        $shortDescription = $this->getProduct()->getShortDescription();
        $shortDescription = preg_replace('|[\s\r\n]+|s', ' ', $shortDescription);
        $shortDescription = trim(strip_tags($shortDescription));
        $shortDescription = substr(
            $shortDescription,
            0,
            (int)Mage::getStoreConfig('amseorichdata/twitter/max_description_length')
        );

        return $shortDescription;
    }
}