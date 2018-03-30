<?php

class BFIAdminMetaPagemediaVideoModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = BFIPagemediaModel::POST_TYPE;
        $this->slug = BFIPagemediaVideoModel::SLUG;
        $this->title = 'Video Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() { 
        $this->addOption(array(	
			"name" => "YouTube or Vimeo Embed Code",
            "id" => "embedcode",
            "type" => "text",
            "std" => "",
            "desc" => "Copy then paste the embed code for your video from YouTube or Vimeo in this field.",
            "placeholder" => "Paste Embed Code Here",
            ));

        $this->addOption(array(
            "name" => "Automatically play video",
            "id" => "autoplay",
            "type" => "boolean",
            "desc" => "If checked, the video will play once it loads.",
            "std" => true,
            ));
    }
}
