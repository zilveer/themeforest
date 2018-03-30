<?php
class BFIAdminPanelGeneralModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 1;
        $this->menuName = 'General';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
	    
        $this->addOption(array(
            "name" => "General Theme Settings",
            "type" => "heading",
            "std" => true,
            ));
            
        $this->addOption(array(
            "name" => "Logo Image URL",
            "desc" => "The URL of your logo image. The height of this logo will be resized to 50 pixels. If you want the height to be higher or lower than 50, please change the next setting below.",
            "id" => "logo_url",
            "type" => "UploadImage",//"upload",
            "std" => "",
            "placeholder" => "http://"
            ));
            
        $this->addOption(array(
            "name" => "Upload Favicon",
            "desc" => "The URL of your favicon.ico. If you want to convert an image to an ico file, or if you want to create one pixel by pixel, you can use <a href='http://www.favicon.cc/' target='_blank'>http://www.favicon.cc/</a>",
            "type" => "uploadFavicon",
            // "std" => "",
            // "placeholder" => site_url()."/favicon.ico",
            ));
            
        $this->addOption(array(
            "name" => "Use CDNs",
            "desc" => "If checked, CDNs will be used instead of the local copies of scripts and styles. Note that if local scripts are used, some scripts will still use CDNs e.g. Google Web Fonts",
            "type" => "booleanCdn",
            "std" => true,
            ));


        $this->addOption(array(
            "type" => "save",
            ));


            
        // $this->addOption(array(
        //             "name" => "Site-wide Searchbar",
        //             "type" => "heading",
        //             "std" => true,
        //             ));
        //             
        //         $this->addOption(array(
        //             "name" => "Display Searchbar",
        //             "desc" => "If checked, a searchbar will be displayed on the top of the site.",
        //             "id" => "display_searchbar",
        //             "type" => "boolean",
        //             "std" => true,
        //             ));
        //             
        //         $this->addOption(array(
        //             "type" => "save",
        //             ));
                  //   
                  // $this->addOption(array(
                  //     "name" => "SEO, Site Meta Information",
                  //     "type" => "heading",
                  //     "std" => true,
                  //     ));
                  //     
                  // $this->addOption(array(
                  //     "name" => "Meta Keywords",
                  //     "desc" => "A comma-separated list of keywords that describes your website. This is used by search engines for studying the relevance of your website.",
                  //     "id" => "meta_keywords",
                  //     "type" => "text",
                  //     "std" => BFI_THEMENAME.",WordPress,Theme",
                  //     ));
                  //     
                  // $this->addOption(array(
                  //     "name" => "Meta Description",
                  //     "desc" => "A description of your website. This is usually displayed by search engines in their search results.",
                  //     "id" => "meta_description",
                  //     "type" => "text",
                  //     "std" => "",
                  //     ));
                  //     
                  // $this->addOption(array(
                  //     "type" => "save",
                  //     ));



                    // 
                    // $this->addOption(array(
                    //     "name" => "Frontpage Content",
                    //     "type" => "heading",
                    //     "std" => true,
                    //     ));
                    // 
                    // // page logic
                    // $pageListTemp = get_pages();
                    // $pageList = array();
                    // foreach($pageListTemp as $apage)
                    //     $pageList[$apage->ID] = $apage->post_title;
                    // 
                    // if (count($pageListTemp)) {
                    //     $pageTitles = array_merge(array("Select a page to display in the home page"), array_values($pageList));
                    //     $pageIDs = array_merge(array(""), array_keys($pageList));
                    // } else {
                    //     $pageTitles = array_merge(array("There are no pages available, please create a page first under Pages &gt; Add New"), array_values($pageList));
                    //     $pageIDs = array_merge(array(""), array_keys($pageList));
                    // }
                    // unset($pageListTemp);
                    //     
                    // $this->addOption(array(
                    //     "name" => "Content page",
                    //     "desc" => "The contents of the page you specify here will be displayed in the front page",
                    //     "id" => BFI_FRONTPAGEOPTION,
                    //     "type" => "select",
                    //     "options" => $pageTitles,
                    //     "values" => $pageIDs,
                    //     "std" => "",
                    //     ));
                    //     
                    // $this->addOption(array(
                    //     "type" => "save",
                    //     ));
                    //     
            



        $this->addOption(array(
            "name" => "Additional Scripts (Javascript)",
            "type" => "heading",
            "std" => true,
            ));
            
        $this->addOption(array(
            "name" => "Additional scripts",
            "desc" => "You can put in additional scripts here, such as your Google Analytics code.<br><br><em><strong>NOTE: </strong>Don't enclose with the &lt;script&gt; tags.</em>",
            "type" => "textareaJavascript",
            "std" => ""
            ));
    }
}
?>
