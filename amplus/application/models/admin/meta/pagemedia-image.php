<?php

class BFIAdminMetaPagemediaImageModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = BFIPagemediaModel::POST_TYPE;
        $this->slug = BFIPagemediaImageModel::SLUG;
        $this->title = 'Single Image Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() {            
        $this->addOption(array(
            "name" => "Height",
            "id" => "height",
            "type" => "number",
            "class" => "height",
            "std" => "450",
            "desc" => "The height of the image to display",
            ));
                
        $this->addOption(array(
            "name" => "Upload image",
            "id" => "image",
            "type" => "uploadImage",
            "desc" => "Upload the image for your page media here.<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
            "placeholder" => "Upload your image here",
            "std" => "",
            ));

			    
        $this->addOption(array(
            "name" => "Link to open when clicked",
            "id" => "link",
            "type" => "text",
            "std" => "",
            "desc" => "Go to this URL when the image is clicked. Leave this blank to disable.",
            "placeholder" => "http://"
            ));
                
        $this->addOption(array(
            "name" => "Open link in new tab/window",
            "id" => "newwindow",
            "type" => "boolean",
            "std" => false,
            "desc" => "If checked, the link above will be opened in a new tab / window.",
			));
    }
}
