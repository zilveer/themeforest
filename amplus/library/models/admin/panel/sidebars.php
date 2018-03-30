<?php
class BFIAdminPanelSidebarsModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 5;
        $this->menuName = 'Sidebars';
        $this->showSaveButtons = false;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {    
        $this->addOption(array(
            "name" => "A friendly note",
            "type" => "heading",
            ));
                    
        $this->addOption(array(
            "name" => "How does this work?",
            "desc" => "By default, there are 4 widget areas already available in <strong>Appearance > Widgets</strong>. These 4 are displayed horizontally on your footer and are <em>always</em> displayed in your <em>whole</em> site.<br><br>As an added option, you can specify an <em>additional</em> widgets location (sidebar) specific to each individual page. You can also set specific sidebars to be displayed for when reading blog posts or portfolio entries.<br><br>After creating a new sidebar in the settings below, a new sidebar will be made available in <strong>Appearance > Widgets</strong>, navigate to that admin panel to add/modify widgets to your sidebars.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "Add new sidebars",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "Add new sidebar",
            "desc" => "Enter the name of the new sidebar to create",
            "id" => "new_sidebar", // in sidebaradd, the id has no bearing except for getting the submitted value
            "type" => "sidebaradd",
            "std" => "",
            ));
            
        $this->addOption(array(
            "name" => "Manage existing sidebars",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "Existing sidebars",
            "type" => "sidebarlist",
            "id" => "sidebar", // in sidebarlist, the id has no bearing except for getting the submitted value
            "desc" => "This is the list of all sidebars you have created, click on the delete button to remove them permanently.",
            "std" => "",
            ));
    }
}
?>