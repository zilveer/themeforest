<?php

class BFIAdminMetaModel implements iBFIAdminMeta {
    
    public $postType = 'post';
    public $title = 'A Title';
    public $slug = '';
    public $options = array();
    public $priority = 10;
    public $context = 'normal';
    
    function __construct() {
    }
    
    public function register() {
        add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
        add_action('save_post', array($this, 'saveMetaBoxes'));
    }
    
    private function getModelUniqueID() {
        // use the slug as the meta box's id if it is set
        if ($this->slug)
            return BFI_SHORTNAME.'_'.$this->slug;
        return BFI_SHORTNAME.'_'.$this->postType.'_'.str_replace(' ', '_', strtolower($this->title));
    }
    
    // initiates the printing of meta boxes
    public function addMetaBoxes() {
        // remove the custom field display to lessen db queries
        remove_meta_box('postcustom' , $this->postType , 'normal');
        // add the meta box
        add_meta_box(
            $this->getModelUniqueID(),
            strtoupper(BFI_THEMENAME).' &rarr; '.$this->title,
            array($this, 'printMetaBoxes'), 
            $this->postType, 
            $this->context,
            'high');
    }
    
    // this will be overriden
    public function createOptions() { }
    
    // called when printing meta boxes
    public function printMetaBoxes($post) {
        $this->printPermissionCheckers();
        $this->options = array();
        $this->createOptions();
        $this->preProcessOptions();
        $this->displayOptions($post->ID);
    }
    
    // called when saving meta boxes
    public function saveMetaBoxes($post_id) {
        if (wp_is_post_revision($post_id)) return;
        if (!$this->checkPermissions($post_id)) return;
        $this->options = array();
        $this->createOptions();
        $this->preProcessOptions();
        $this->saveOptions($post_id);
        do_action('bfi_meta_modified', $post_id);
    }

    private function preProcessOptions() {
        // TODO: transfer this to a multilang class / module
        // create additional option fields for translation purposes
        if (function_exists('bfi_multilang_create_extra_language_options')) {
            $this->options = bfi_multilang_create_extra_language_options($this->options);
        }
        // assign meta options as type meta
        foreach ($this->options as $key => $value) {
            $this->options[$key]->optionType = BFIAdminOptionModel::TYPE_META;
        }
    }
    
    protected function addOption($args) {
        // prefix the slug if it has a value
        if ($this->slug && array_key_exists('id', $args)) $args['id'] = $this->slug.'_'.$args['id'];
        
        $option = BFIAdminOptionModel::factory($args);
        $option->optionType = BFIAdminOptionModel::TYPE_META;
        $this->options[] = $option;
    }
    
    private function displayOptions($postID) {
        foreach ($this->options as $value) {
            $value->postID = $postID; 
            $value->display();
        }
        echo BFIAdminOptionModel::createDependencyScript($this->options);
    }
    
    private function saveOptions($postID) {
        foreach ($this->options as $value)
            $value->saveAsMeta($postID);
    }
    
    private function printPermissionCheckers() {
        // Use nonce for verification
        wp_nonce_field(plugin_basename(__FILE__), $this->getModelUniqueID().'_nonce');
    }
    
    private function checkPermissions($post_id) {
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
            return false;
        
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if (!array_key_exists($this->getModelUniqueID().'_nonce', $_POST))
            return false;
        if (!wp_verify_nonce($_POST[$this->getModelUniqueID().'_nonce'], plugin_basename(__FILE__)))
            return false;
    
        // Check permissions
        if ($this->postType == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) return false;
        } else {
            if (!current_user_can('edit_post', $post_id)) return false;
        }

        // OK, we're authenticated: we need to find and save the data
        return true;
    }
}
