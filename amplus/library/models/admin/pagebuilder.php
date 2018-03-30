<?php

class BFIAdminPagebuilderModel { //implements iBFIAdminPagebuilder {
    
    public $name = 'post';
    public $desc = 'A Title';
    public $priority = 10;
	public $isContainer = false;
    
    public $options = array();
    public $className;
    public $viewFilename;
    public $scripts = "";
    public $html = "";
    
    function __construct($filename, $className) {
        // decipher the view filename from the model filename
        preg_match_all('#([a-zA-Z\-\_]+).php$#', $filename, $matches);
        // $this->viewFilename = 'pagebuilder/' . $matches[1][0] . '.php';
        $this->viewFilename = basename($filename);
        
        $this->className = $className;
        $this->createOptions();
    }
    
    /**
     * Adds an option for displaying the dialog box for this panel type
     */
    public function addOption($args) {
        $option = BFIAdminOptionModel::factory($args);
        $option->optionType = BFIAdminOptionModel::TYPE_PANEL_OPTION;
        $this->options[] = $option;
    }
    
    public function addScript($script) {
        $this->scripts .= $script;
    }
    
    public function addInitScript($script) {
        $this->scripts .= "bfi_layouting['preopen_" . $this->className . "'] = function(data) { " . $script . " };";
    }
    
    public function addHTML($html) {
        $this->html .= $html;
    }
    
    /**
     * Renders the jQuery UI dialog containing the settings for this panel type
     */
    public function renderAdminDialog() {
        
        if ($this->scripts) {
            echo "<script>"
                 . "jQuery(document).ready(function($) {"
                 . "var dialog = \$('.bfi-pagebuilder-dialog[data-model=" . $this->className . "]');"
                 . $this->scripts
                 . "});"
                 . "</script>";
        }
                    
        printf("<div class='bfi-pagebuilder-dialog %s' title='%s' data-model='%s'><p>%s</p>",
			$this->isContainer ? 'is-container' : '',
            $this->name . ' Properties',
            $this->className,
            $this->desc);
        
        echo $this->html;

        foreach ($this->options as $value) {
            $value->display();
            echo BFIAdminOptionModel::createDependencyScript($this->options);
        }
            
        echo "</div>";
    }
    
    /**
     * Use the view template for this pagebuilder panel for rendering 
     * the final output. Expose the data 
     */
    public function render() {
        BFILoader::includeViewTemplate($this->viewFilename);
    }
}