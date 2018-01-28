<?php

class Brainvire_Testimonial_Model_System_Config_Source_Selectmode
{

    public function toOptionArray()
    {
        return array(
			array('value'=>'', 'label'=>''),
            array('value'=>'fade', 'label'=>'fade'),
			array('value'=>'fadeZoom', 'label'=>'fadeZoom'),
			array('value'=>'cover', 'label'=>'cover'),
			array('value'=>'uncover', 'label'=>'uncover'),
            array('value'=>'shuffle', 'label'=>'shuffle'),
			array('value'=>'zoom', 'label'=>'zoom'),
			array('value'=>'wipe', 'label'=>'wipe'),
			array('value'=>'toss', 'label'=>'toss'),
			array('value'=>'turnDown', 'label'=>'turnDown'),
			array('value'=>'turnUp', 'label'=>'turnUp'),
			array('value'=>'scrollUp', 'label'=>'scrollUp'),
			array('value'=>'scrollDown', 'label'=>'scrollDown'),
			
        );
    }

}
