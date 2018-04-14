<?php

class WP_CustomMenu_Helper_Data extends Mage_Core_Helper_Abstract
{
    private $_menuData = null;

    public function saveCurrentCategoryIdToSession()
    {
        $currentCategory = Mage::registry('current_category');
        $currentCategoryId = 0;
        if (is_object($currentCategory)) {
            $currentCategoryId = $currentCategory->getId();
        }
        Mage::getSingleton('catalog/session')
            ->setCustomMenuCurrentCategoryId($currentCategoryId);
    }

    public function initCurrentCategory()
    {
        $currentCategoryId = Mage::getSingleton('catalog/session')->getCustomMenuCurrentCategoryId();
        $currentCategory = null;
        if ($currentCategoryId) {
            $currentCategory = Mage::getModel('catalog/category')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($currentCategoryId);
        }
        Mage::unregister('current_category');
        Mage::register('current_category', $currentCategory);
    }

    public function getMenuData()
    {
        if (!is_null($this->_menuData)) return $this->_menuData;
        $blockClassName = Mage::getConfig()->getBlockClassName('custommenu/navigation');
        $block = new $blockClassName();
        $categories = $block->getStoreCategories();
        if (is_object($categories)) $categories = $block->getStoreCategories()->getNodes();
        if (Mage::getStoreConfig('custom_menu/general/ajax_load_content')) {
            $_moblieMenuAjaxUrl = str_replace('http:', '', Mage::getUrl('custommenu/ajaxmobilemenucontent'));
            $_menuAjaxUrl = str_replace('http:', '', Mage::getUrl('custommenu/ajaxmenucontent'));
        } else {
            $_moblieMenuAjaxUrl = '';
            $_menuAjaxUrl = '';
        }
        $this->_menuData = array(
            '_block'                        => $block,
            '_categories'                   => $categories,
            '_moblieMenuAjaxUrl'            => $_moblieMenuAjaxUrl,
            '_menuAjaxUrl'                  => $_menuAjaxUrl,
            '_showHomeLink'                 => Mage::getStoreConfig('custom_menu/general/show_home_link'),
            '_popupWidth'                   => Mage::getStoreConfig('custom_menu/popup/width') + 0,
            '_popupTopOffset'               => Mage::getStoreConfig('custom_menu/popup/top_offset') + 0,
            '_popupDelayBeforeDisplaying'   => Mage::getStoreConfig('custom_menu/popup/delay_displaying') + 0,
            '_popupDelayBeforeHiding'       => Mage::getStoreConfig('custom_menu/popup/delay_hiding') + 0,
            '_rtl'                          => Mage::getStoreConfig('custom_menu/general/rtl') + 0,
            '_mobileMenuEnabled'            => Mage::getStoreConfig('custom_menu/general/mobile_menu') + 0,
            '_mobileMenuWidthInit'          => Mage::getStoreConfig('custom_menu/general/mobile_menu_width_init') + 0,
        );
        return $this->_menuData;
    }

    public function getMobileMenuContent()
    {
        // checking for the cache
        $cache = Mage::app()->getCacheInstance();
		$cacheTags = array(Mage_Core_Model_Store::CACHE_TAG, Mage_Cms_Model_Block::CACHE_TAG, Mage_Catalog_Model_Category::CACHE_TAG);
		$cacheKey = "Mobile_".$this->getCacheKeyInfo();
		
		$data = $cache->load($cacheKey);
		if($data) return ($data);

        $menuData = Mage::helper('custommenu')->getMenuData();
        extract($menuData);
        if (!$_mobileMenuEnabled) return '';
        // --- Home Link ---
        $homeLinkUrl        = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $homeLinkText       = $this->__('Home');
        $homeLink           = '';
        if ($_showHomeLink) {
            $homeLink = <<<HTML
<div id="menu-mobile-0" class="menu-mobile level0">
    <div class="parentMenu">
        <a href="$homeLinkUrl">
            <span>$homeLinkText</span>
        </a>
    </div>
</div>
HTML;
        }
        // --- Menu Content ---
        $mobileMenuContent = '';
        $mobileMenuContentArray = array();
        foreach ($_categories as $_category) {
            $mobileMenuContentArray[] = $_block->drawCustomMenuMobileItem($_category);
        }
        if (count($mobileMenuContentArray)) {
		$locationsUrl = Mage::getUrl('locations');
	    $htmlTop[] = "<div id='menu-mobile-0' class='menu-mobile level0'><div class='parentMenu'><a href='$locationsUrl'><span>locations</span></a></div></div>";
		$supportUrl =  Mage::getUrl('support');
	    $htmlTop[] = "<div id='menu-mobile-0' class='menu-mobile level0'><div class='parentMenu'><a href='$supportUrl'><span>support</span></a></div></div>";
		$contactUrl =  Mage::getUrl('contact-us');
	    $htmlTop[] = "<div id='menu-mobile-0' class='menu-mobile level0'><div class='parentMenu'><a href='$contactUrl'><span>contact us</span></a></div></div>";
	    $eventUrl = Mage::getUrl('events');
	    $htmlTop[] = "<div id='menu-mobile-0' class='menu-mobile level0'><div class='parentMenu'><a href='$eventUrl'><span>events</span></a></div></div>";
		$mobileMenu = implode("\n", $htmlTop);
        $mobileMenuContent = implode("\n", $mobileMenuContentArray);
        }
        // --- Result ---
        $menu = <<<HTML
$homeLink
$mobileMenuContent
$mobileMenu
<div class="clearBoth"></div>
HTML;
        $cache->save($menu, $cacheKey, $cacheTags, false);
        return $menu;
    }

    public function getMenuContent()
    {
        $cache = Mage::app()->getCacheInstance();
		$cacheTags = array(Mage_Core_Model_Store::CACHE_TAG, Mage_Cms_Model_Block::CACHE_TAG, Mage_Catalog_Model_Category::CACHE_TAG);
		$cacheKey = $this->getCacheKeyInfo();
		
		$data = $cache->load($cacheKey);
		if($data) return unserialize($data);


        $menuData = Mage::helper('custommenu')->getMenuData();
        extract($menuData);
        // --- Home Link ---
        $homeLinkUrl        = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $homeLinkText       = $this->__('Home');
        $homeLink           = '';
        if ($_showHomeLink) {
            $homeLink = <<<HTML
<div class="menu">
    <div class="parentMenu menu0">
        <a href="$homeLinkUrl">
            <span>$homeLinkText</span>
        </a>
    </div>
</div>
HTML;
    }
        // --- Menu Content ---
        $menuContent        = '';
        $menuContentArray   = array();
        foreach ($_categories as $_category) {
            $_block->drawCustomMenuItem($_category);
        }
        $topMenuArray       = $_block->getTopMenuArray();
        $topMenuContent     = '';
        if (count($topMenuArray)) {
            $topMenuContent = implode("\n", $topMenuArray);
        }
        $popupMenuArray     = $_block->getPopupMenuArray();
        $popupMenuContent   = '';
        if (count($popupMenuArray)) {
            $popupMenuContent = implode("\n", $popupMenuArray);
        }
        // --- Result ---
        $topMenu = <<<HTML
$homeLink
$topMenuContent
<div class="clearBoth"></div>
HTML;
        
        $data = array('topMenu' => $topMenu, 'popupMenu' => $popupMenuContent);
        $cache->save(serialize($data), $cacheKey, $cacheTags, false);
        return $data;

    }

    public function getCacheKeyInfo()
    {
        return 
            'CUSTOM_MENU'. md5(
            Mage::app()->getStore()->getId()."-".
            Mage::getStoreConfig('custom_menu/general/position').
            (int)Mage::app()->getStore()->isCurrentlySecure()."-".
            Mage::getDesign()->getPackageName()."-".
            Mage::getDesign()->getTheme('template')."-".
            Mage::getSingleton('customer/session')->isLoggedIn()
        );
    }

}
