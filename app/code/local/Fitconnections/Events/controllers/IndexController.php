<?php
class Fitconnections_Events_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {   
    	$this->loadLayout();
		 $this->getLayout()->getBlock('head')->setTitle($this->__("Event Listing"));
         $this->renderLayout();
    }
	public function viewAction()
    {
    	$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__("Event Listing View"));
        $this->renderLayout();
    }
}
