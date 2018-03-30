<?php

class BFIShortcodeFeatureimageModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'featureimage'; 
    
	public $image = '';
	public $title = '';
	public $subtitle = '';
	public $lightbox = '';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $title = $this->title ? "<h3>$this->title</h3>" : '';
        $subtitle = $this->subtitle ? "<span>$this->subtitle</span>" : '';
        $href = $this->lightbox ? "href='$this->lightbox'" : '';
        $image = $this->image ? do_shortcode("[image src='$this->image' $href]") : '';
        return "<div class='featureimage $this->class' $unusedAttributeString>$title$subtitle$image{$content}</div>";
    }
}

class BFIShortcodeFeaturebox1Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'featurebox1'; 
	const ALIAS = 'featurebox';
    
	public $icon = 'fighter-jet';
	public $size = '';
	public $title = '';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$x = $this->size == 'small' ? '2' : '3';
		$title = $this->title ? "<h4>$this->title</h4>" : "";
		return "<div class='featurebox1 $this->size $this->class' $unusedAttributeString><i class='icon-$this->icon icon-{$x}x'></i><div>$title$content</div></div>";
    }
}

class BFIShortcodeFeaturebox2Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'featurebox2'; 
    
	public $icon = 'fighter-jet';
	public $size = '';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$x = $this->size == 'small' ? '3' : '4';
		return "<div class='featurebox2 $this->size $this->class' $unusedAttributeString><i class='icon-$this->icon icon-{$x}x'></i><div>$content</div></div>";
    }
}

class BFIShortcodeFeaturebox3Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'featurebox3'; 
    
	public $icon = 'fighter-jet';
	public $size = '';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$x = $this->size == 'small' ? '3' : '4';
		return "<div class='featurebox3 $this->size $this->class' $unusedAttributeString><i class='icon-$this->icon icon-{$x}x'></i><div>$content</div></div>";
    }
}

class BFIShortcodeFeatureNumberModel extends BFIShortcodeModel implements iBFIShortcode {

    const SHORTCODE = 'featurenumber'; 

	public $num = '1';
	public $size = '';

    public $class = '';

    public function render($content = NULL, $unusedAttributeString = '') {
		$x = $this->size == 'small' ? '4' : '2';
		return "<div class='featurenumber $this->size $this->class' $unusedAttributeString><h$x>$this->num</h$x><div>$content</div></div>";
    }
}