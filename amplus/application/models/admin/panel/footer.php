<?php
class BFIAdminPanelFooterModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 5;
        $this->menuName = 'Footer';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        // $this->addOption(array(
        //             "name" => "Footer Twitter Settings",
        //             "type" => "heading",
        //             ));
            
                 //    
                 // $this->addOption(array(
                 //     "name" => "Footer Widget Layout",
                 //     "id" => "footer_widget_layout",
                 //     "type" => "select",
                 //     "options" => array("No Widgets", "4 Columns", "1/2 - 1/4 - 1/4 (3 Columns)", "1/4 - 1/4 - 1/2 (3 Columns)", "1/4 - 1/2 - 1/4 (3 Columns)", "3 Columns", "2 Columns", "1/3 - 2/3 (2 Columns)", "1/4 - 3/4 (2 Columns)", "2/3 - 1/3 (2 Columns)", "3/4 - 1/4 (2 Columns)", "1 Column"),
                 //     "values" => array("0", "4", "244", "442", "424", "3", "2", "323", "434", "233", "344", "1"),
                 //     "desc" => "Choose the layout of the footer widgets. Refer to the illustration above as a guide on how these layouts look. Choose <strong>No Widgets</strong> to disable all the widgets.",
                 //     "std" => "0",
                 //     ));
                 //     
                 // $this->addOption(array(
                 //     "type" => "save",
                 //     ));
            
        $this->addOption(array(
            "name" => "Bottom-most Copyright Text",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "Copyright text",
            "desc" => "The copyright text",
            "id" => "footer_copyright",
            "type" => "translatabletext",
            "std" => "&copy; " . date("Y") . "",
            ));
			
        $this->addOption(array(
            "type" => "save",
            ));



		$this->addOption(array(
			"name" => "Social Network Links",
			"type" => "heading",
			"std" => true,
			));
			               
		$this->addOption(array(
		    "name" => "",
		    "desc" => "Put your social links below.",
		    "type" => "note",
		    ));
    
        for ($i = 1; $i <= 10; $i++) {
            $depends = '';
            if ($i > 1) {
                $depends = array("sociallink".($i-1) => "!");
            }
            $this->addOption(array(
                "name" => "Social icon #$i",
                "type" => "selectSocialIcon",
                "id" => "social$i",
                // "options" => bfi_get_social_names("Choose a social network"),
                // "values" => bfi_get_social_values("none"),
                // "std" => "none",
                "std" => "",
                "desc" => "Choose the social network for this social icon",
                "depends" => $depends,
                ));
    
            $this->addOption(array(
                "name" => "Social link #$i",
                "type" => "text",
                "id" => "sociallink$i",
                "std" => "",
                "desc" => "Put in the link to your social page here.",
                "placeholder" => "http://",
                "depends" => $depends,
                ));
    
            $this->addOption(array(
                "name" => "Social icon tooltip #$i",
                "type" => "translatabletext",
                "id" => "socialtip$i",
                "std" => "Follow me",
                "desc" => "This is the tooltip that will appear when the mouse hovers over the social network icon.",
                "placeholder" => "Follow me",
                "depends" => $depends,
                ));
        }
    }
}
?>