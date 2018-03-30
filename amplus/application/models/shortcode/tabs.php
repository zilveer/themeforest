<?php

/* usage
[tabs]
    [tab title="Tab 1 title"]Tab 1 contents[/tab]
    [tab title="Tab 2 title"]Tab 2 contents[/tab]
[/tabs]
 */
class BFIShortcodeTabsModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'tabs';
    
    public $opentab = '0';
    public $class = '';
	public $orientation = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		return "<div class='bfi_tabs $this->orientation $this->class' data-opentab='$this->opentab' $unusedAttributeString><ul class='tab-title'>$content</ul></div>";
    }
}

class BFIShortcodeTabModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'tab';
    
    public $title = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		return "<li $unusedAttributeString><h4>$this->title</h4><div>".do_shortcode($content)."</div></li>";
    }
}