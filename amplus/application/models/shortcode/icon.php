<?php

class BFIShortcodeIconModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'icon';
    
    public $type = 'archive'; 
    public $size = '';
	public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $this->type = strtolower($this->type);
        $sizeClass = $this->size ? 'icon-'.$this->size : '';
		return "<i class='icon-$this->type $this->class $sizeClass' $unusedAttributeString></i>";
    }
}