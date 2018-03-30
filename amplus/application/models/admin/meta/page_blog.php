<?php

class BFIAdminMetaPageBlogModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = 'page';
        $this->title = 'Blog Options';
        $this->priority = 10;
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Categories to display",
            "id" => "blog_categories", // bfi_get_post_meta to this will return a serialized string 
            "type"=> "MulticheckPostCategory",
            "std" => "",
            "desc" => "Posts from the checked categories will be displayed in this page. If no category is selected, all blog posts will be displayed.",
            ));
    }
}
