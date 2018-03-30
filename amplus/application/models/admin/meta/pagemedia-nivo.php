<?php

class BFIAdminMetaPagemediaNivoModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = BFIPagemediaModel::POST_TYPE;
        $this->slug = BFIPagemediaNivoModel::SLUG;
        $this->title = 'Nivo Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() {          
        $this->addOption(array(
            "name" => "Height",
            "id" => "height",
            "type" => "number",
            "std" => "500",
            "desc" => "The height of the image to display",
            ));    
            
        $this->addOption(array(
            "name" => "Animation effect",
            "id" => "effect",
            "type" => "select",
            "options" => array("Slice down", "Slice down left", "Slice up", "Slide up left", "Slide up down", "Slice up down left", "Fold", "Fade", "Random", "Slide-in right", "Slide-in left"),
               "values" => array("sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "random", "slideInRight", "slideInLeft"),
            "std" => "random",
            "desc" => "The effect to play when transitioning between slides.",
            ));    
            
        $this->addOption(array(
            "name" => "Pause time",
            "id" => "pause",
            "type" => "number",
            "std" => "6000",
            "desc" => "The pause time of each slide in milliseconds",
            "placeholder" => "Pause time in milliseconds",
            ));    
            
        $this->addOption(array(
            "name" => "Animation speed",
            "id" => "animation",
            "type" => "number",
            "std" => "1500",
            "desc" => "The animation speed of each slide transition in milliseconds",
            "placeholder" => "Animation speed in milliseconds",
            ));
            
        $this->addOption(array(
            "name" => "Caption Type",
            "id" => "captiontype",
            "type" => "select",
    		"options" => array("No Captions", "In-Image Captions"),
    		"values" => array("none", "inimage"),
            "std" => "none",
            "desc" => "Select the type of captions for the slider.<br><br><strong>Side Captions</strong> will appear on the right side of the slider, while <strong>In-Image captions</strong> will be displayed inside the images.",
			"hasmore" => true,
            ));
            
        for ($i = 1; $i <= 6; $i++) {
            $this->addOption(array(
                "name" => "Slide #$i",
                "type" => "subheading",
                ));
                
            $this->addOption(array(
                "name" => "Image",
                "type" => "uploadImage",
                "id" => "image$i",
                "desc" => "Upload an image for slide #$i<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
                "std" => "",
                "placeholder" => "Upload image here",
                ));
                
            $this->addOption(array(
								"depends" => array("nivo_captiontype" => "inimage"),
                "name" => "Caption Title",
                "type" => "translatabletext",
                "id" => "caption$i",
                "desc" => "Enter your caption title for slide #$i.",
                "std" => "",
                "placeholder" => "Enter caption here",
                ));
                
            $this->addOption(array(
								"depends" => array("nivo_captiontype" => "inimage"),
                "name" => "Caption",
                "type" => "translatabletext",
                "id" => "subcaption$i",
                "desc" => "Enter your caption for slide #$i. Some formatting HTML elements are supported, such as &lt;br>, &lt;strong> and &lt;em>.",
                "std" => "",
                "placeholder" => "Enter caption here",
                ));
                
            $this->addOption(array(
								"depends" => array("nivo_captiontype" => "inimage"),
                "name" => "Caption Text Color",
                "type" => "colorpicker",
                "id" => "textcolor$i",
                "desc" => "The text color for the caption of slide #$i",
                "std" => "#ffffff",
                ));
                
            $this->addOption(array(
								"depends" => array("nivo_captiontype" => "inimage"),
                "name" => "Caption Location",
                "type" => "select",
								"options" => array("Left", "Right"),
								"values" => array("l", "r"),
                "id" => "captionlocation$i",
                "desc" => "The location of the caption of slide #$i",
                "std" => "l",
                ));
        }
    }
}
