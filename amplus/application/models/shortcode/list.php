<?php

class BFIShortcodeListModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'list';
    const ALIAS = 'ul';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        return "<ul class='icons $this->class' $unusedAttributeString>$content</ul>";
    }
}

class BFIShortcodeLiModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'li';

	public $type = 'arrow-right';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        return "<li $unusedAttributeString><i class='icon-$this->type'></i>$content</li>";
    }
}