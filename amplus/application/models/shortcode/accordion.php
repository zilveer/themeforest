<?php

/* usage
[accordion opentab="1"] 
[panel title="Title 1"]...[/panel]
[/accordion]
 */
class BFIShortcodeAccordionModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'accordion';
    
    public $opentab = '0';
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		return "<ul class='bfi_accordion' data-opentab='$this->opentab' $unusedAttributeString>$content</ul>";
    }
}

class BFIShortcodeAccordionPanelModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'panel';
    
    public $title = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		return "<li><h4 $unusedAttributeString>$this->title</h4><div>$content</div></li>";
    }
}