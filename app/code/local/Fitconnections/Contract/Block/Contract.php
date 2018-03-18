<?php
/**
 * Html block
 * 
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_Block_Contract extends Mage_Core_Block_Template
{
	    /**
     * @var string
     */
	    protected $_template = 'hobbyking/valentine/landing.phtml';

    /**
     * @return string
     */
    protected function _toHtml() {
    	return parent::_toHtml();
    }
    
    
    /**
     * Get the customer Infos
     * 
     * @return array
     */
    public function getCustomerInfo() {
    	$customer = Mage::helper('customer')->getCustomer();
    	$info = array();
    	if ($customer && $customer->getId()) {
    		$info['email'] = $customer->getEmail();
    		$info['firstname'] = $customer->getFirstname();
    		$info['lastname'] = $customer->getLastname();    

    	}
    	return $info;
    }

}