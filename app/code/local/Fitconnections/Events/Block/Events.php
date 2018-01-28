<?php
class Fitconnections_Events_Block_Events extends Mage_Core_Block_Template
{
    public function getEvents()     
    {
    	
    $collection = Mage::getModel('events/events')->getCollection()
	                 ->addFieldToFilter('status',1);
	               
    	
    return $collection;
 
    }
     public function getAthletesCategory($category)     
    {
    	
    $collection = Mage::getModel('events/events')->getCollection()
                           ->addFieldToFilter('events_category',$category)
                           ->addFieldToFilter('status',1);
    	
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
