<?php
class Fitconnections_Events_Block_Profile extends Mage_Core_Block_Template
{
    public function getCurrentProfile()     
    {
    $id=$this->getRequest()->getParam('id');	
    $model= Mage::getModel('events/events')->load($id);
    	
    return $model;
 
    }
     public function getEventsCategory($category)     
    {
    	
    $collection = Mage::getModel('events/events')->getCollection()
                           ->addFieldToFilter('events_category',$category);
    	
    return $collection;
 
    }
    
    public function getMediaUrl($media){
    	if($media){
    		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$media;
    	}
    }
    
    public function getWidthMedia(){
    	return 200;
    }
    
    public function getHeightMedia(){
    	return 200;
    }
}
