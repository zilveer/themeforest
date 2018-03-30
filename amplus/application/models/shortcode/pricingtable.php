<?php

class BFIShortcodePricingtableModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'pricingtable';

	public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		return "<div class='bfi_pricingtable $this->class' $unusedAttributeString>$content</div><div class='clearfix'></div>";
    }
}


class BFIShortcodePricingtabModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'pricingtab';

	public $size = '';
	public $columns = '3';
	public $title = '';
	public $desc = '';
	
	public $button = '';
	public $link = '';
	public $newwindow = false;
	
	public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$newwindow = $this->newwindow ? "target='_blank'" : '';
		$bigTabClass = $this->size == 'large' ? 'big' : '';
		$bigTabClass = $this->size == 'small' ? 'small' : $bigTabClass;
		$desc = $this->desc ? "<div class='subtitle'>$this->desc</div>" : '';
		$button = $this->button ? "<a href='$this->link' $newwindow>$this->button</a>" : '';
		return do_shortcode("[col$this->columns class='$bigTabClass $this->class' $unusedAttributeString]
			<h3>$this->title</h3>
			<div class='description'><div>$content</div></div>
			$desc
			$button
			[/col$this->columns]");
    }
}