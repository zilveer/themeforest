<?php

class BFIPagemediaVideoModel extends BFIPagemediaModel implements iBFIPagemedia {
    
    /*
     * Get Meta data via $this->getValue() 
     */
    
    const SLUG = 'video';
    
    function __construct() {
        $this->slug = self::SLUG;
        $this->name = 'Video (YouTube or Vimeo)';
    }
    
    public function getHeader() {
		$code = $this->getEmbedcode();
		
		// get only the embed code iframe
		preg_match('#<iframe[^>]*>.*?</iframe>#', $code, $matches);
		if (count($matches)) {
			$code = $matches[0];
			$code = str_replace('\'', '"', $code);
			$delimit = stripos($code, '?') === false ? "?" : "&";
			
			// get width & height
			$width = 0;
			$height = 0;
			
			if (preg_match_all('#width=(\'|")(\d+)(\'|")#', $code, $matches)) {
			    if (count($matches) > 2) {
			        $width = (int)$matches[2][0];
			    }
			}
			if (preg_match_all('#height=(\'|")(\d+)(\'|")#', $code, $matches)) {
			    if (count($matches) > 2) {
			        $height = (int)$matches[2][0];
			    }
			}
			
			// compute the content starting place
			if ($width && $height) {
			    $new_h = $this->getWidth() * $height / $width;
			    
        		echo "
        		<style>
            	header.container {
            	    padding-top:".($new_h - 130)."px;
            	}
            	@media only screen and (min-width: 828px) and (max-width: 1020px) {
            	    header.container {
            	        padding-top:".(($new_h - 130) * .81)."px;
            	    }
            	}</style>";
		    }
	    }
    }
    
    public function getBody() {
		$code = $this->getEmbedcode();
		
		// get only the embed code iframe
		preg_match('#<iframe[^>]*>.*?</iframe>#', $code, $matches);
		if (count($matches)) {
			$code = $matches[0];
			$code = str_replace('\'', '"', $code);
			$delimit = stripos($code, '?') === false ? "?" : "&";
			
			// set some youtube and vimeo options (hide as much controls as we can)
			$code = preg_replace('#(src="[^"]*)#', '${1}'.$delimit.'controls=0&rel=0&showinfo=0&title=0&byline=0&portrait=0&wmode=transparent', $code);
			
			// if autoplay, add a get variable for autoplay
			if ($this->getAutoplay()) {
				$delimit = stripos($code, '?') === false ? "?" : "&";
				$code = preg_replace('#(src="[^"]*)#', '${1}'.$delimit.'autoplay=1', $code);
			}
		}
		return $code;
    }
}
