<?php

class BFIShortcodeHighlightModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'highlight'; 

	public $class = '';
	public $colored = false;
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $colorClass = $this->colored ? 'colored' : '';
        return "<span class='bfi_highlight $colorClass $this->class' $unusedAttributeString>$content</span>";
    }
}