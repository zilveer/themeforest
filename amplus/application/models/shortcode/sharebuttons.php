<?php

class BFIShortcodeShareButtonsModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'sharebuttons';
    
    public $media = '';
    public $title = '';
    public $url = '';
    public $desc = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $url = $this->url ? $this->url : get_permalink();
        $shortUrl = bfi_shorten_url(get_permalink());
        
        $title = $this->title ? $this->title : get_the_title();
        
        $desc = $this->desc ? $this->desc . ' ' . $shortUrl : $shortUrl;

        return "
            <div class='share-buttons'>
                <div class='share-facebook' data-url='$shortUrl' data-text='$desc'></div>
                <div class='share-twitter' data-url='$shortUrl' data-title='$title'></div>
                <div class='share-googleplus' data-url='$shortUrl' data-text='$desc' data-title='$title' data-curl='".BFI_APPLICATIONURL."includes/sharrre.php'></div>
                <div class='share-pinterest' data-text='$desc' data-title='$title' data-media='$this->media' data-desc='$desc' data-curl='".BFI_APPLICATIONURL."includes/sharrre.php'></div>
                <div class='clearfix'></div>
            </div>
            ";
    }
}