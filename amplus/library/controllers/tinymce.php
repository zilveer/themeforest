<?php

class BFITinyMCEController {
    private $buttonNames = array();
    
    function __construct() {
        if (is_admin()) {
            $this->loadButtons();
            add_action('admin_head', array($this, 'addJavascriptInit'));
            add_action('admin_init', array($this, 'addButtonFilters'));
        }
    }
    
    private function loadButtons() {
        // find the button plugins
        foreach (bfi_get_filenames_from_dir(BFI_TINYMCEPATH, "button_*_js.php") as $filename) {
            $filename = substr($filename, strripos($filename, '/')+1);
            $filename = substr($filename, 0, strripos($filename, '_js.'));
            $this->buttonNames[] = $filename;
        }
    }
    
    public function addJavascriptInit() {
        // some variables needed by the plugin
        echo "
            <script type='text/javascript' src='".BFI_TINYMCEURL."generate_button.js'></script>
            <script type='text/javascript'>
                var bfi_tinymce_url = '".BFI_TINYMCEURL."';
                var bfi_images_url = '".BFI_IMAGEURL."';
                var bfi_functions_url = '".BFI_UPLOADHANDLERURL."';
                var bfi_uploads_url = '".BFI_UPLOADURL."';
            </script>
            <style>
                .colorpicker {
                    z-index: 9999;
                }   
            </style>
            ";
    }
    
    public function addButtonFilters() {
        // only hook up these filters if we're in the admin panel, and the current user has permission
        // to edit posts and pages
        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
            add_filter('mce_buttons_3', array($this, 'addRow1Buttons'));
			if (count($this->buttonNames) > 16) {
				add_filter('mce_buttons_4', array($this, 'addRow2Buttons'));
			}
            add_filter('mce_external_plugins', array($this, 'addButtonPlugin'));
        }
    }
    
    public function addRow1Buttons($buttons) {
        // add up to 16 buttons
		for ($i = 0; $i < 16; $i++) {
			if ($i == count($this->buttonNames)) break;
			$buttons[] = $this->buttonNames[$i];
        }
        return $buttons;
    }
    
    public function addRow2Buttons($buttons) {
        // add the remaining buttons
		for ($i = 16; $i < count($this->buttonNames); $i++)
            $buttons[] = $this->buttonNames[$i];
        return $buttons;
    }
    
    public function addButtonPlugin($plugins) {
        // add the scripts for all the plugins
        foreach ($this->buttonNames as $buttonName)
            $plugins[$buttonName] = BFI_TINYMCEURL . $buttonName . '_js.php';
        return $plugins;
    }
}