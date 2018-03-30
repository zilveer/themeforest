<?php

class BFIShortcodeDropcapsModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'dropcaps';
    
    public $colored = false;
    public $class = ''; 
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$colorClass = $this->colored ? 'colored' : '';
        return "<span class='dropcaps $colorClass $this->class' $unusedAttributeString>$content</span>";
    }
}