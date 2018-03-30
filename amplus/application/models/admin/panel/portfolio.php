<?php
class BFIAdminPanelPortfolioModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 2;
        $this->menuName = 'Portfolio';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Portfolio / portfolio category URL settings",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "Portfolio item URL query var",
            "desc" => "The query var displayed in the URL for portfolio items. <em>e.g. yoururl?portfolio_item=id</em>",
            "id" => "portfolio_query_var",
            "type" => "text",
            "std" => "portfolio",
            ));
            
        $this->addOption(array(
            "name" => "Portfolio category URL query var",
            "desc" => "The query var displayed in the URL for portfolio categories. <em>e.g. yoururl?portfolio_category=id</em>",
            "id" => "portfolio_cat_query_var",
            "type" => "text",
            "std" => BFIPortfolioModel::TAXONOMY_ID,
            ));
           
           
        $this->addOption(array(
            "name" => "Portfolio page settings",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "The settings here affect all portfolio entries.",
            ));

        $this->addOption(array(
            "name" => "Sidebar location",
            "desc" => "Select the location of the sidebar for all portfolio pages. Choose \"(No sidebar)\" to display all portfolio items at full width. Select the sidebar to display below afterwards.",
            "type" => "select",
            "id" => "portfolio_sidebar_global_location",
            "options" => array("Full width (no sidebar)", "Right sidebar", "Left sidebar"),
            "values" => array("none", "right", "left"),
            "std" => "",
            "hasmore" => true,
            ));
            
        $this->addOption(array(
            "depends" => array("portfolio_sidebar_global_location" => array("right", "left")),
            "name" => "Sidebar",
            "desc" => "The sidebar to use for portfolio pages. Go to <strong>".BFI_THEMENAME." &gt; Sidebars</strong> to manage your sidebars.<br><br><em>Sidebars will only show if the option above is set to \"left\" or \"right\".</em>",
            "type" => "SelectSidebar",
            "id" => "portfolio_sidebar",
            "std" => "",
            ));
    
        $this->addOption(array(
            "name" => "Display related portfolio",
            "type" => "boolean",
            "id" => "show_related_portfolio",
            "desc" => "Uncheck to hide the related portfolio area.",
            "std" => true,
            ));
            
        // $this->addOption(array(
        //             "name" => "Display social sharing links",
        //             "type" => "boolean",
        //             "id" => "portfolio_social_global_enabled",
        //             "desc" => "Uncheck to hide the social sharing links for portfolio entry pages.",
        //             "std" => true,
        //             ));
            
        // $this->addOption(array(
        //             "name" => "Display category details",
        //             "type" => "boolean",
        //             "id" => "portfolio_display_categories",
        //             "desc" => "Uncheck to hide the category label for portfolio entry pages.",
        //             "std" => true,
        //             ));
    }
}

?>