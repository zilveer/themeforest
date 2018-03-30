<?php
class add_karma_button {
    var $pluginname = 'karma_shortcodes';
    var $path = '';
    var $internalVersion = 100;
    function add_karma_button() {
        $this->path = get_template_directory_uri() . '/framework/truethemes/wysiwyg/';
        add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
        add_action('init', array (&$this, 'addbuttons') );
    }
    function addbuttons() {
        if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
        return;
        if ( get_user_option('rich_editing') == 'true') {
            add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
            add_filter('mce_buttons', array (&$this, 'register_button' ), 5);
            add_filter('mce_external_languages', array (&$this, 'add_tinymce_langs_path'));
        }
    }
    function register_button($buttons) {
        array_push($buttons, 'separator', $this->pluginname );
        return $buttons;
    }
    function add_tinymce_plugin($plugin_array) {
            $plugin_array[$this->pluginname] = $this->path . 'editor.js';
        return $plugin_array;
    }
    function add_tinymce_langs_path($plugin_array) {
        // Load the TinyMCE language file
        $plugin_array[$this->pluginname] = TRUETHEMES_EXTENDED . '/wysiwyg/languages.php';
        return $plugin_array;
    }
    function change_tinymce_version($version) {
        $version = $version + $this->internalVersion;
        return $version;
    }
}
if (is_admin()){
    $tinymce_button = new add_karma_button();
}
?>