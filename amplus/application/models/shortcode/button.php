<?php

class BFIShortcodeButtonModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'button'; 
    
    public $href = 'http://';
    public $color = '';
	public $bg = '';
    public $size = '';
    public $icon = '';
    public $newwindow = false;
    public $label = "I'm a button";
    
    public $class = '';
	public $style = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$newwindow = $this->newwindow ? "target='_blank'" : '';
		$color = $this->color ? "color: $this->color;" : '';
		$bg = $this->bg ? "background: $this->bg;" : '';
		$icon = $this->icon ? "<i class='icon-$this->icon icon-2x' style='$color'></i>" : '';
		return "<a href='$this->href' class='button $this->class $this->size' style='$color $bg $this->style' $newwindow $unusedAttributeString>$icon$this->label</a>";
    }
}
