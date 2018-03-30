<?php
class BFIAdminPanelPostsModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 2;
        $this->menuName = 'Posts';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Global post and post category settings",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "The settings here affect your site's blog post entries.",
            ));

        // $this->addOption(array(
        //             "name" => "Default Page Media",
        //             "desc" => "Select the page media to display in blog posts. The selected media will be displayed in the middle of the page between the left navigation area and the page contents on the right. If no page media is displayed in the choices, create one in the <strong>Page Media &gt; Add New</strong> selection in the left menu.",
        //             "type" => "SelectPagemedia",
        //             "id" => "post_pagemedia",
        //             "std" => "",
        //             ));
			
		$this->addOption(array(
        	"name" => "Sidebar location",
            "desc" => "Select the location of the sidebar for all post pages. Choose \"(No sidebar)\" to display all posts at full width. Select the sidebar to display below afterwards.",
            "type" => "select",
            "id" => "sidebar_post_location",
            "options" => array("Full width (no sidebar)", "Right sidebar", "Left sidebar"),
            "values" => array("none", "right", "left"),
            "std" => "none",
            "hasmore" => true,
		));
        
        $this->addOption(array(
            "depends" => array("sidebar_post_location" => array("right", "left")),
            "name" => "Sidebar",
            "desc" => "The sidebar to use for this page. Go to <strong>".BFI_THEMENAME." &gt; Sidebars</strong> to manage your sidebars.<br><br><em>The sidebar selected here will be placed between the 2 left sidebars found in <strong>Appearance > Widgets</strong>.</em>",
            "type" => "SelectSidebar",
            "id" => "sidebar_post",
            "std" => "",
            ));
                    // 
                    // $this->addOption(array(
                    //     "name" => "Display social sharing links",
                    //     "type" => "boolean",
                    //     "id" => "blog_social_global_enabled",
                    //     "desc" => "Uncheck to hide the social sharing links for blog pages.",
                    //     "std" => true,
                    //     ));
            
        $this->addOption(array(
            "name" => "Display author box",
            "type" => "boolean",
            "id" => "author_global_enabled",
            "desc" => "Uncheck to hide the author box",
            "std" => true,
            ));
    
        $this->addOption(array(
            "name" => "Display related posts",
            "type" => "boolean",
            "id" => "show_related_posts",
            "desc" => "Uncheck to hide the related posts area.",
            "std" => true,
            ));
    }
}

?>