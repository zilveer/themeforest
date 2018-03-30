<?php

class BFIAdminScriptController {
    
    function __construct() {
        add_action('admin_enqueue_scripts', array($this, "loadAdminScripts"));
    }
    
    public function loadAdminScripts() {
        bfi_wp_enqueue_script('ajaxupload', 'admin/scripts/ajaxupload.min.js', array('jquery'));
        bfi_wp_enqueue_script('vtip', 'admin/scripts/vtip.js', array('jquery'));
        bfi_wp_enqueue_script('admin', 'admin/scripts/admin.js', array('jquery', 'ajaxupload', 'vtip'));
        bfi_wp_enqueue_script('colorpickerjs', 'admin/scripts/colorpicker/js/colorpicker.js', array('jquery'));
        bfi_wp_enqueue_script('ddslick2', 'admin/scripts/ddslick-fontawesome.js', array('jquery'));
        
        
        bfi_wp_enqueue_style('colorpickercss', 'admin/scripts/colorpicker/css/colorpicker.css');
        bfi_wp_enqueue_style('admincss', 'admin/css/admin.css');
        
        // include the media uploader in admin panels
        // no need to include this for meta and pagebuilder
        wp_enqueue_media();
        
        add_editor_style('style.css');
        add_editor_style('css/custom.php');
        add_editor_style('library/views/admin/css/style-editor.css');
        // $filenames = BFILoader::getOverridableLibraryFiles('views/admin/scripts');
        // foreach ($filenames as $filename) {
            // $filename = BFI_TEMPLATEURL.trim(str_replace(TEMPLATEPATH, '', $filename), "\\/");
            // wp_enqueue_script('', $filename, array('jquery'));
        // }
        
        // load font awesome
		bfi_wp_enqueue_style('fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.0.0/css/font-awesome.min.css', array(), NULL);
    }
}
