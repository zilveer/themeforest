<?php

class BFIAdminMetaPostModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = 'post';
        $this->title = 'Post Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() {
		$this->addOption(array(
			"name" => "Preview & Header Media",
            "type" => "select",
            // "options" => array("None", "Image", "Video (YouTube or Vimeo)"),
            // "values" => array("none", "image", "video"),
            "options" => array("Use Featured Image", "Video (YouTube or Vimeo)"),
            "values" => array("image", "video"),
            "desc" => "Select what type of preview & header media to display.",
            "id" => "preview_type",
            "std" => "image",
            "hasmore" => true,
            ));
			
        // $this->addOption(array(
        //     "depends" => array("preview_type" => "image"),
        //  "name" => "Preview & Header Image",
        //             "type" => "uploadImage",
        //             "desc" => "An image to show in the blog page, this is also shown at the top of this post.<br><br><strong><em>Be sure to upload an image that's at MOST 1024x768 AND less than 2MB</em></strong>",
        //             "id" => "preview_image",
        //             "std" => "",
        //             "placeholder" => "upload a preview image",
        //             ));
			
		$this->addOption(array(
		    "depends" => array("preview_type" => "video"),
			"name" => "Preview & Header YouTube / Vimeo Embed Code",
            "type" => "textarea",
            "desc" => "Enter the embed code for your YouTube or Vimeo video",
            "id" => "preview_video",
            "std" => "",
            "placeholder" => "Enter embed code",
            ));
    }
}
