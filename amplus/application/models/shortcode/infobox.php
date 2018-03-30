<?php

class BFIShortcodeInfoboxModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'infobox'; 
    
    public $class = '';
    public $type = 'info';
	public $icon = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		if ($this->icon == '') {
			if ($this->type == 'info') {
				$this->icon = 'lightbulb';
			} elseif ($this->type == 'notice') {
				$this->icon = 'bullhorn';
			} elseif ($this->type == 'error') {
				$this->icon = 'warning-sign';
			} elseif ($this->type == 'success') {
				$this->icon = 'thumbs-up';
			}
		}
		
		$content = $content ? "<div>$content</div>" : '';
		
		return "<div class='bfi_infobox $this->type $this->class' $unusedAttributeString><i class='icon-$this->icon icon-2x'></i><i class='icon-remove icon-large'></i>$content</div>";
    }
}