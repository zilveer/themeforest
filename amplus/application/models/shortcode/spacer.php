<?php

class BFIShortcodeSpacerModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'spacer'; 
    const ALIAS = 'space';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        return "<span class='spacer'></span>";
    }
}