<?php

class BFIShortcodeTitleboxModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'titlebox';
    const ALIAS = 'title';
    
	public $title = '';
    public $button = ""; 
	public $link = '#';
	public $icon = '';

	public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
	    $button = $this->button ? do_shortcode("[button href='$this->link' size='large' label='$this->button' icon='$this->icon']") : '';
        return do_shortcode("[col1 class='title titlebox'] <h1>$this->title</h1> [/col1] [col1] $button{$content} [/col1]");
    }
}

