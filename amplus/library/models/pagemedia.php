<?php

class BFIPagemediaModel {
    const POST_TYPE = "pagemedia";
    
    // public $load = false;
    public $slug = 'pagemedia_slug';
    public $name = 'Page Media';
    
    // holds the post ID of the pagemedia post
    public $postID = '';
    
    public $height = '300';
    public $width = '960';
    
    // used to get meta box data. call like this: getHeight()
    public function __call($name, $args) {
        $default = is_array($args) && count($args) ? $args[0] : '';
        if ($name == 'getHeight') {
            if (!bfi_get_post_meta($this->postID, $this->slug.'_height')) {
                return $this->height;
            } else {
                return bfi_get_post_meta($this->postID, $this->slug.'_height');
            }
        }
        if ($name == 'getWidth') return $this->width;
        if (stripos($name, 'get') === 0) {
            $property = strtolower(substr($name, 3));
            return bfi_get_post_meta($this->postID, $this->slug.'_'.$property);
        }
        return $default;
    }
}
