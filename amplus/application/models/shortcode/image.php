<?php

class BFIShortcodeImageModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'lightbox';
    const ALIAS = 'image';
    const ALIAS2 = 'img';

	public $href = '';
	public $src = '';
	
	public $blank = '';
	public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$open = $this->href;
		$typeClass = '';
		
		if ($open) {
    		// youtube
            // http://www.youtube.com/watch?v=JiglRl62xh4&feature=feedu
    		if (preg_match('/youtube\.com/i', $open)) {
    			preg_match_all('/v\=([^\&\/]+)/i', $open, $matches);
    			if (count($matches) >= 2 && count($matches[1])) {
    				$youtubeID = $matches[1][0];
    				if ($youtubeID) {
    					$typeClass = 'video';
    					$open = "http://www.youtube.com/embed/$youtubeID?autoplay=1";
                    }
    			}
    		}
    		// youtube
    		// http://youtu.be/JiglRl62xh4
    		if (preg_match('/youtu\.be\/([^\&\/]+)/', $open)) {
    			preg_match_all('/youtu\.be\/([^\&\/]+)/', $open, $matches);
    			if (count($matches) >= 2 && count($matches[1])) {
    				$youtubeID = $matches[1][0];
    				if ($youtubeID) {
    					$typeClass = 'video';
    					$open = "http://www.youtube.com/embed/$youtubeID?autoplay=1";
                    }
                }
    		}
            // vimeo
            // http://player.vimeo.com/video/30458118?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1
    		if (preg_match('/vimeo\.com\/([^\&\/]+)/i', $open)) {
    			preg_match_all('/vimeo\.com\/([^\&\/]+)/i', $open, $matches);
    			if (count($matches) >= 2 && count($matches[1])) {
    				$vimeoID = $matches[1][0];
    				if ($vimeoID) {
    					$typeClass = 'video';
    					$open = "http://player.vimeo.com/video/$vimeoID?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1";
                    }
                }
    		}
		}
				
		if ($typeClass == 'video') {
			$typeClass = "video icon-play-circle icon-3x";
		} else {
			$typeClass = 'icon-zoom-in icon-3x';
		}
		
		$blank = $this->blank ? $this->blank : BFI_BLANKIMAGELONG;
	
	    if ($open) {
		    return "<a href='$open' class='fancybox $typeClass $this->class' $unusedAttributeString><img data-original='$this->src' src='".$blank."'/><noscript><img src='$this->src'/></noscript></a>";
	    }
	    return "<img data-original='$this->src' src='".$blank."' $unusedAttributeString/><noscript><img src='$this->src' $unusedAttributeString/></noscript>";
    }
}