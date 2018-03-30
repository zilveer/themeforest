<?php

class BFIAdminMetaPageModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = 'page';
        $this->title = 'Page Options';
        $this->priority = 1;
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Hide Page Title",
            "id" => "hidetitle",
            "type" => "boolean",
            "desc" => "If checked, the page title won't be displayed.",
            "std" => false,
            ));

		$this->addOption(array(
            "name" => "Page media",
            "id" => "pagemedia",
            "type" => "SelectPageMedia",
            "desc" => "Select the page media to display in the page. The selected media will be displayed on the top of the page behind the navigation bar. <em>If no page media is displayed in the choices, create one in the <strong>Page Media &gt; Add New</strong> selection in the left menu.</em>",
            "std" => "default",
            ));
    
        $this->addOption(array(
            "name" => "Sidebar location",
            "id" => "sidebar_location",
            "type" => "select",
            "desc" => "Select the location of the sidebar. Choose \"(No sidebar)\" to display the page at full width. Select the sidebar to display below afterwards.",
			"options" => array("Full width (no sidebar)", "Right sidebar", "Left sidebar"),
            "values" => array("none", "right", "left"),
            "std" => "",
			"hasmore" => true,
            ));

        $this->addOption(array(
			"depends" => array("sidebar_location" => array("right", "left")),
            "name" => "Sidebar",
            "id" => "sidebar",
            "type" => "SelectSidebar",
            "desc" => "The sidebar to use for this page. Go to <strong>".BFI_THEMENAME." &gt; Sidebars</strong> to manage your sidebars. Sidebars will only show if the option above is set to \"left\" or \"right\".",
            "std" => "default",
            ));
    }
}
