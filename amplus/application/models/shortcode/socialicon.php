<?php

class BFIShortcodeSocialIconModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'socialicon'; 
    const ALIAS = 'social';
    
    public $type = 'twitter';
    public $tip = 'Twitter';
    public $size = '';
    public $href = '#';
    public $fontSize = '';
    public $color = '';
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        if ($this->size == 'small') {
            $fontSize = "24px";
            $y = -6;
        } elseif ($this->size == 'large') {
            $fontSize = "50px";
            $y = -24;
        } else {
            $fontSize = "40px";
            $y = -17;
        }
        
        // if a specific size is given, make the adjustments
        if ($this->fontSize) {
            $fontSize = strtolower($this->fontSize);
            $fontSize = str_replace('px', '', $fontSize);
            $y = -(int)(intval($fontSize) / 2);
            $fontSize .= 'px';
        }
        
        // if a color is specified, create a scoped style
        $style = '';
        $id = '';
        if ($this->color) {
            $color = "color: {$this->color};";
            $id = 'social-' . rand(10000, 99999);
            $style = "<style scoped>a.$id { $color } a.$id:hover { color: #222 }</style>";
        }
        
        // create the icon
        $icon = bfi_get_social_icon($this->type, "square");
        $icon = "$style<a class='monosocial $this->size $id' style='line-height: $fontSize; font-size: $fontSize;' href='$this->href'>{$icon['code']}</a>";
        
        // if a tip is specified, add a tooltip
        if ($this->tip) {
            return do_shortcode("[tooltip class='bfi_social' text='$this->tip' $unusedAttributeString data-my='bottom left' data-at='top center' data-y='$y' data-x='0']{$icon}[/tooltip]");
        }
        
        return $icon;
    }
}