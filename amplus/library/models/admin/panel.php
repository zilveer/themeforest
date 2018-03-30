<?php

// has the functions for all the behavior of an admin panel
// this gets inherited by the application panel models
class BFIAdminPanelModel implements iBFIAdminPanel {
    public $priority = 10;
    public $menuName = '';
    public $showSaveButtons = true;
    public $additionalHTML = '';
    public $options = array();
    public $title = '';
    
    function __construct() {
    }
    
    public function getSlug() {
        return 'bfi_'.strtolower(str_replace(' ', '', trim($this->menuName)));
    }
    
    protected function addOption($args) {
        $option = BFIAdminOptionModel::factory($args);
        $option->optionType = BFIAdminOptionModel::TYPE_PANEL_OPTION;
        $this->options[] = $option;
    }
    
    // saves the STD values of all defained options
    public function saveDefaultOptionValues() {
        $this->options = array();
        $this->createOptions();
        foreach ($this->options as $option) {
            if (!$option->getID()) continue;
            
            // don't overwrite existing options
            if (bfi_get_option($option->getID()) !== false) continue;
            
            // get the default value and save it. if it's an array, serialize it first
            $value = $option->getStd();
            if (is_array($value)) $value = serialize($value);
            
            bfi_update_option($option->getID(), $value);
        }
    }
    
    // this will be overriden by the inheriting class
    public function createOptions() { }
    
    public function createAdminPage() {
        $this->options = array();
        $this->createOptions();
        $this->preProcessOptions();
        $this->displayNotifications();
        $this->displayOptions();
        
        // fire action on modification
        if ((isset($_REQUEST['saved']) && $_REQUEST['saved'] == 'true')
            || (isset($_REQUEST['reset']) && $_REQUEST['reset'] == 'true')) {
            do_action('bfi_adminpanel_modified', $this->getSlug());
        }
    }
    
    private function preProcessOptions() {
        // TODO: transfer this to a multilang class / module
        // create additional option fields for translation purposes
        if (function_exists('bfi_multilang_create_extra_language_options')) {
            $this->options = bfi_multilang_create_extra_language_options($this->options);
        }

        // Save the options
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
            foreach ($this->options as $option) {
                if (!is_array($option))
                    $option->saveAsOption();
            }
            $_REQUEST['saved']='true';
            
        // Reset the options
        } else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset') {
            foreach ($this->options as $option) {
                if (!is_array($option))
                    $option->resetAsOption();
            }
            $_REQUEST['reset']='true';
        }
    }
    
    // TODO: Clean this up
    // TODO: transfer to notifier class
    private function displayNotifications() {
        // Display message after saving / resetting options' values
        if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.sprintf(__('%s settings saved', BFI_I18NDOMAIN), BFI_THEMENAME).'</strong></p></div>';
        if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>'.sprintf(__('%s settings reset', BFI_I18NDOMAIN), BFI_THEMENAME).'</strong></p></div>';
        if ( isset($_GET['msg']) && $_GET['msg'] != '') echo '<div id="message" class="updated fade"><p><strong>'.$_GET['msg'].'</strong></p></div>';
        if ( isset($_REQUEST['msg']) && $_REQUEST['msg'] != '') echo '<div id="message" class="updated fade"><p><strong>'.$_REQUEST['msg'].'</strong></p></div>';
        if ( isset($_GET['err']) && $_GET['err'] != '') echo '<div id="message" class="error fade"><p><strong>'.$_GET['err'].'</strong></p></div>';
        if ( isset($_REQUEST['err']) && $_REQUEST['err'] != '') echo '<div id="message" class="error fade"><p><strong>'.$_REQUEST['err'].'</strong></p></div>';
    }
    
    private function displayOptions() {
        ?>
        <div class="wrap bfi_adminpanel postbox optionform">
            <h2><?php $this->title ? printf(__('%s: %s', BFI_I18NDOMAIN), BFI_THEMENAME, $this->title) : printf(__('%s: %s settings', BFI_I18NDOMAIN), BFI_THEMENAME, $this->menuName) ?></h2>
            <form method="post" class="bfi_adminpanel postbox optionform">
            <?php 
    
            foreach ($this->options as $value) 
                $value->display();
            
            $style = '';
            if (!$this->showSaveButtons) {
                $style = 'visibility: hidden;';
            }
            ?>
            <div class='c'></div>
            <div class='s'>
                <input name="save" style='<?php echo $style ?>' type="submit" value="<?php _e('Save changes', BFI_I18NDOMAIN) ?>" class="button-primary"/>
                <input type="hidden" name="action" value="save" />
                <button name="action" style='<?php echo $style ?>' class="button-secondary" onclick="javascript: jQuery('#reset-form').submit(); return false;"><?php echo array_key_exists('reset', $value) ? $value['reset'] : __('Reset', BFI_I18NDOMAIN) ?></button><br>
            </div>
        </form>
        <form method="post" id="reset-form">
            <p class="submit" style="padding-top: 0">
                <input name="reset" type="submit" value="<?php _e('Reset', BFI_I18NDOMAIN) ?>" class="button-secondary" style='visibility: hidden'/>
                <input type="hidden" name="action" value="reset" />
            </p>
        </form>
        <?php echo $this->additionalHTML ?>
        </div>
        <?php
        echo BFIAdminOptionModel::createDependencyScript($this->options);
    }
}
