<?php

class Fitconnections_Events_Block_Adminhtml_Events_Edit_Tab_Image extends Mage_Adminhtml_Block_Widget {
protected $_uploaderType = 'uploader/multiple';
    protected function _prepareForm() {
        $data = $this->getRequest()->getPost();
        $form = new Varien_Data_Form();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function __construct() {
        parent::__construct();
        $this->setTemplate('events/media/image.phtml');
        $this->setId('image_gallery');
        $this->setHtmlId('image_gallery');
    }

    protected function _prepareLayout() {
        $this->setChild('uploader',
                $this->getLayout()->createBlock($this->_uploaderType)
        );

        $this->getUploader()->getUploaderConfig()
            ->setFileParameterName('image')
            ->setTarget(Mage::getModel('adminhtml/url')->addSessionParam()->getUrl('*/*/upload'));

        $browseConfig = $this->getUploader()->getButtonConfig();
        $browseConfig
            ->setAttributes(array(
                'accept' => $browseConfig->getMimeTypesByExtensions('gif, png, jpeg, jpg')
            ));
        $this->setChild(
                'delete_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                'id'      => '{{id}}-delete',
                'class'   => 'delete',
                'type'    => 'button',
                'label'   => Mage::helper('adminhtml')->__('Remove'),
                'onclick' => $this->getJsObjectName() . '.removeFile(\'{{fileId}}\')'
                ))
        );

        return parent::_prepareLayout();
    }

    /**
     * Retrive uploader block
     *
     * @return Mage_Adminhtml_Block_Media_Uploader
     */
    public function getUploader() {
        return $this->getChild('uploader');
    }

    /**
     * Retrive uploader block html
     *
     * @return string
     */
    public function getUploaderHtml() {
        return $this->getChildHtml('uploader');
    }

    public function getJsObjectName() {
        return $this->getHtmlId() . 'JsObject';
    }

    public function getAddImagesButton() {
        return $this->getButtonHtml(
                Mage::helper('catalog')->__('Add New Images'),
                $this->getJsObjectName() . '.showUploader()',
                'add',
                $this->getHtmlId() . '_add_images_button'
        );
    }

    public function getImagesJson() {
        $_model = Mage::registry('events_data');
        $_data = $_model->getImage();
        if (is_array($_data) and sizeof($_data) > 0) {
            $_result = array();
            foreach ($_data as &$_item) {
                $_result[] = array(
                    'value_id'  => $_item['image_id'],
                    'url'       => Mage::getSingleton('events/config')->getBaseMediaUrl() . $_item['file'],                    
                    'file'      => $_item['file'],
                    'label'     => $_item['label'],
		    'link'     => $_item['link'],
                    'position'  => $_item['position'],
                    'disabled'  => $_item['disabled']);
            }
            return Zend_Json::encode($_result);
        }
        return '[]';
    }

    public function getImagesValuesJson() {
        $values = array();

        return Zend_Json::encode($values);
    }


    /**
     * Enter description here...
     *
     * @return array
     */
    public function getMediaAttributes() {

    }

    public function getImageTypes() {
        $type = array();
        $type['gallery']['label'] = "events";
        $type['gallery']['field'] = "events";

        $imageTypes = array();

        return $type;
    }

    public function getImageTypesJson() {
        return Zend_Json::encode($this->getImageTypes());
    }

    public function getCustomRemove() {
        return $this->setChild(
                'delete_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                'id'      => '{{id}}-delete',
                'class'   => 'delete',
                'type'    => 'button',
                'label'   => Mage::helper('adminhtml')->__('Remove'),
                'onclick' => $this->getJsObjectName() . '.removeFile(\'{{fileId}}\')'
                ))
        );
    }

    public function getDeleteButtonHtml() {
        return $this->getChildHtml('delete_button');
    }

    public function getCustomValueId() {
        return $this->setChild(
                'value_id',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                'id'      => '{{id}}-value',
                'class'   => 'value_id',
                'type'    => 'text',
                'label'   => Mage::helper('adminhtml')->__('ValueId'),
                ))
        );
    }

    public function getValueIdHtml() {
        return $this->getChildHtml('value_id');
    }
}
