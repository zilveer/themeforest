<?php

class BFIShortcodeTooltipModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'tooltip'; 

	public $class = '';
	public $text = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		bfi_wp_enqueue_script('qtip', '//cdnjs.cloudflare.com/ajax/libs/qtip2/2.0.0/jquery.qtip.min.js', array('jquery'), NULL, true);
		bfi_wp_enqueue_style('qtip', '//cdnjs.cloudflare.com/ajax/libs/qtip2/2.0.0/jquery.qtip.min.css', array(), NULL);

		return "<span class='bfi_tooltip $this->class' data-tooltip='$this->text' $unusedAttributeString>$content</span>";
    }
}