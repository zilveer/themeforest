<?php

class BFIAdminMetaPortfolioModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = BFIPortfolioModel::POST_TYPE;
        $this->title = 'Portfolio Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() {
        // $this->addOption(array(
        //     "name" => "Preview image",
        //     "id" => "preview_image",
        //     "type" => "uploadImage",
        //     "desc" => "The URL for the preview image of this portfolio item. The dimensions of this image will be resized to the needed dimensions.<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
        //     "placeholder" => "Upload preview image here",
        //  ));
	
		$this->addOption(array(
            "name" => "Subtitle",
            "id" => "subtitle",
            "type" => "translatabletext",
            "std" => "",
            "desc" => "The subtitle to display below the page title.",
            "placeholder" => "enter page subtitle here",
			));
			
		$this->addOption(array(
            "name" => "Feature image click action",
            "id" => "preview_action",
            "hasmore" => true,
            "type" => "select",
            "options" => array("Go into portfolio page", "Open image in lightbox", "Play YouTube or Vimeo video in lightbox", "Open another URL"),
            "values" => array("page", "image", "video", "link"),
            "std" => "page",
            "desc" => "The action to perform when the preview image is clicked.",
            ));
            
        $this->addOption(array(
            "name" => "URL to open",
            "id" => "url_action",
            "type" => "text",
            "std" => "",
            "desc" => "The URL to open when the preview image is clicked.",
            "placeholder" => "http://",
            "depends" => array("preview_action" => "link"),
            ));
            
        $this->addOption(array(
            "name" => "Open URL in new window",
            "id" => "url_new_window",
            "type" => "boolean",
            "std" => false,
            "desc" => "If checked, the URL will open in a new tab / window.",
            "depends" => array("preview_action" => "link"),
            ));
            
        $this->addOption(array(
            "name" => "Image show in lightbox",
            "id" => "media_image",
            "type" => "upload",
            "desc" => "The image to show in the lightbox.<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
            "placeholder" => "Upload image here",
			"depends" => array("preview_action" => "image")
            ));

        $this->addOption(array(
            "name" => "Video to show in lightbox",
            "id" => "media_video",
            "type" => "text",
            "desc" => "The YouTube or Vimeo video to show in the lightbox. Put the video URL here.",
            "placeholder" => "YouTube or Vimeo URL here",
			"depends" => array("preview_action" => "video")
            ));

        $this->addOption(array(
            "name" => "Video to play in portfolio page",
            "id" => "media_video_embed",
            "type" => "textarea",
            "desc" => "The YouTube or Vimeo embed code that will be shown in the portfolio item details",
            "placeholder" => "YouTube or Vimeo embed code here",
			"depends" => array("preview_action" => "video")
            ));
    }
}
