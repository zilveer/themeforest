<?php

class BFIAdminMetaPagePortfolioModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = 'page';
        $this->title = 'Portfolio Options';
        $this->priority = 11;
        parent::__construct();
    }
    
    public function createOptions() {   
        $this->addOption(array(
            "name" => "Portfolio gallery layout",
            "id" => "portfolio_gallery_type",
            "type"=> "select",
            "options" => array("Two Column", "Three Column", "Four Column"),
            "values" => array("2", "3", "4"),
            "std" => "4",
            "desc" => "The type of portfolio gallery to use",
            ));
            
        $this->addOption(array(
            "name" => "Portfolio items per page",
            "id" => "portfolio_display_number",
            "type"=> "number",
            "std" => "8",
            "desc" => "The number of portfolio items to display per page. Leave blank to display all items.",
            "placeholder" => "enter number of items per page",
            ));
            
            
        $this->addOption(array(
            "name" => "Enable filter buttons",
            "id" => "portfolio_enable_filters",
            "type"=> "boolean",
            "std" => false,
            "desc" => "If checked, filter buttons will be displayed if there are more than one category selected",
            ));
            
        $this->addOption(array(
            "name" => "Categories to display",
            "id" => "portfolio_categories", // bfi_get_post_meta to this will return a serialized string 
            "type"=> "MulticheckPortfolioCategory",
            "std" => "",
            "desc" => "Portfolio items from the selected category will be displayed in this page. If no categories are selected, all portfolio items will be displayed. You can create categories at <strong>Portfolio Items > Portfolio Categories</strong>.",
            ));
    }
}
