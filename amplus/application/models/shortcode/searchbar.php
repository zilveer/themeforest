<?php

class BFIShortcodeSearchbarModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'searchbar';
    
    public $label = '';
    public $class = '';
    public $value = ''; 
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $label = $this->label ? $this->label : __("Search", BFI_I18NDOMAIN);
        $label = "<i class='icon-search'></i>";
        $buttonClass = !$this->value || $this->value == $defaultLabel ? 'hidden' : ''; 
        if (!$this->value) $this->value = $this->label;
    
        return "<form action='".home_url()."/' method='get' class='search $this->class' $unusedAttributeString>
		<a href='#' class='button' onclick='jQuery(this).parent().submit(); return false;'>$label</a>
        <input name='s' type='text' value='$this->value' placeholder='".__('Search here...', BFI_I18NDOMAIN)."'/>
        </form>";
    }
}