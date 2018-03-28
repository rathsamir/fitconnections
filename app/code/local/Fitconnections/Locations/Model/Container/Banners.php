<?php

class Hobbyking_Banners_Model_Container_Banners extends Enterprise_PageCache_Model_Container_Abstract
{	

    protected function _getCacheId()
    {
        //return 'GEOTARGETING_BANNERS_' . md5($this->_placeholder->getAttribute('cache_id')).'_'.$this->_getIdentifier();
		return 'GEOTARGETING_BANNERS_'.$this->_getIdentifier();
    }

    protected function _renderBlock()
    {	
        $blockClass = $this->_placeholder->getAttribute('block');
        $template = $this->_placeholder->getAttribute('template');
        $block = new $blockClass;
        $block->setTemplate($template);
		//die('TEST: '.var_dump($this->_processor));
		$block->setPageIdentifier($this->_processor->getMetadata('routing_requested_route').'_'.$this->_processor->getMetadata('routing_requested_controller').'_'.$this->_processor->getMetadata('routing_requested_action'));
        return $block->toHtml();
    }
    
    protected function _getIdentifier()
    {
		$pageIdentifier = Mage::app()->getRequest()->getRouteName().'_'.Mage::app()->getRequest()->getControllerName().'_'.Mage::app()->getRequest()->getActionName();
        //return $this->_getCookieValue(Enterprise_PageCache_Model_Cookie::COOKIE_CUSTOMER, '').microtime();
        return md5(
                $this->_placeholder->getName()
                . '_' . $this->_placeholder->getAttribute('cache_id')
                //. '_' . $this->_getCountryCode()
                . '_' . $this->_getCookieValue(Mage_Core_Model_Store::COOKIE_CURRENCY)
				. '_' . $pageIdentifier
				. '_' . microtime()
        );
    }
    
    protected function _saveCache($data, $id, $tags = array(), $lifetime = 1)
    {
        parent::_saveCache($data, $id, $tags, $lifetime);
    }
	
    /*protected function _getCountryCode() {
        $countryCode = Ewave_WarehouseFilter_Helper_Cache::getCountryCodeFromCookies();
        if (!$countryCode) {
            $countryCode = Ewave_WarehouseFilter_Helper_Cache::getCountryCode();
        }
        return $countryCode;
    }*/
}