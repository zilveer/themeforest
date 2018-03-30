<?php

class BFIShortcodeHrModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'hr'; 
    
    public function render($content = NULL, $unusedAttributeString = '') {
        return "<hr $unusedAttributeString/>";
    }
}