<?php
/**
 * Valentine Landpage controller
 * 
 * @category    Fitconnections
 * @package     Fitconnections_Contract
 * @author      Samir
 */
class Fitconnections_Contract_IndexController extends Mage_Core_Controller_Front_Action
{
	/**
     * Valentine Landing Page action
     *
     */
	public function indexAction() {
			$this->loadLayout();
            $this->renderLayout();
	}
	public function postAction(){
	   if($this->getRequest()->getPost()){
	     $data = $this->getRequest()->getPost();
	     $cModel = Mage::getModel('contract/list');
    	try{
    		$cModel->setFirstname($data['fname'])
    		->setLastname($data['lname'])
    		->setEmail($data['email'])
			->setUserid($data['userid'])
			->setPid($data['pid'])
			->setPrice($data['price'])
			->setDuration($data['duration'])
    		->setAddress($data['address'])
    		->setPhone($data['phone'])
    		->setTown($data['town'])
    		->setZipcode($data['zip'])
			->setState($data['state'])
    		->save();
    		Mage::getSingleton('core/session')->addSuccess(Mage::helper('contract')->__('Thank you for filling the contract form.One of our sales person will contact you soon.'));
    		$this->_redirect("/");
    		return;

    	}
    	catch(Exception $e){
    		Mage::log($e->getMessage());
    		Mage::getSingleton('core/session')->addError(Mage::helper('contract')->__('Unable to submit your request. Please, try again later'));
    		$this->_redirect('*/*/');
    		return;

    	}
	   }
	}

}