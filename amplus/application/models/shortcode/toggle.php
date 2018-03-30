<?php

class BFIShortcodeToggleModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'toggle';
    
    public $startopen = false;
    public $title = ''; 
	public $class = '';
	public $colored = false;
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$openClass = $this->startopen ? 'open' : '';
		$colorClass = $this->colored ? 'colored' : '';
		return "<div class='bfi_toggle $openClass $colorClass $this->class'><h4>$this->title</h4><div>$content</div></div>";
    }
}