<?php

class BFIShortcodeQrModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'qr';
    
    public $data = '';
    //public $is_link = false;
    public $width = '200';
    public $height = '200';
    public $class = ''; 
    public $style = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $this->data = urlencode($this->data);
        $img = "http://chart.apis.google.com/chart?cht=qr&chs={$this->width}x{$this->height}&chl=$this->data";
        //$imgbig = "http://chart.apis.google.com/chart?cht=qr&chs=450x450&chl=$this->data&dummy.jpg"; // dummy get variable for fancybox to detect an image
    
        //if ($this->is_link) {
        //    return "<a href='$imgbig' class='fancybox qr $this->class' $unusedAttributeString><img src='$img' noshadow/></a>";
        //} else {
            return "<img src='$img' $unusedAttributeString class='$this->class' style='height: {$this->height}px !important; width: {$this->width}px !important; $this->style'/>";
        //}
    }
}