<?php

class Fitconnections_Events_Helper_Data extends Mage_Core_Helper_Abstract {
  
 public function resizeImg($fileName, $width, $height = '',$keepRatio)
{
    $folderURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
    $imageURL = $folderURL . $fileName;
 
    $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $fileName;
    $newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . "resized" . DS . $fileName;
    //if width empty then return original size image's URL
    if ($width != '') {
        //if image has already resized then just return URL
       /* if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {*/
            $imageObj = new Varien_Image($basePath);
            $imageObj->constrainOnly(TRUE);
            if($keepRatio)
            $imageObj->keepAspectRatio(FALSE);
            $imageObj->keepFrame(FALSE);
            $imageObj->resize($width, $height);
            $imageObj->save($newPath);
        //}
        $resizedURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "resized" . '/' . $fileName;
     } else {
        $resizedURL = $imageURL;
     }
    
     return $resizedURL;
}
 public function resizeImage($fileName, $width, $height = '')
{
    $folderURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
    $imageURL = $folderURL . 'profileimages/events' .$fileName;
 
    $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/profileimages/events' . $fileName;
    $newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/profileimages/events/' . "resized" . $fileName;
    //if width empty then return original size image's URL
    if ($width != '') {
        //if image has already resized then just return URL
        if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
            $imageObj = new Varien_Image($basePath);
            $imageObj->constrainOnly(TRUE);
            $imageObj->keepAspectRatio(FALSE);
            $imageObj->keepFrame(FALSE);
            $imageObj->resize($width, $height);
            $imageObj->save($newPath);
        }
        $resizedURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'profileimages/events'.'/'."resized" .  $fileName;
     } else {
        $resizedURL = $imageURL;
     }
    
     return $resizedURL;
}
 public function jsonEncode($valueToEncode, $cycleCheck = false, $options = array())
    {
        $json = Zend_Json::encode($valueToEncode, $cycleCheck, $options);
        /* @var $inline Mage_Core_Model_Translate_Inline */
        $inline = Mage::getSingleton('core/translate_inline');
        if ($inline->isAllowed()) {
            $inline->setIsJson(true);
            $inline->processResponseBody($json);
            $inline->setIsJson(false);
        }

        return $json;
    }

}
