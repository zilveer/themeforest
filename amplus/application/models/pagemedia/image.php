<?php

class BFIPagemediaImageModel extends BFIPagemediaModel implements iBFIPagemedia {
    
    /*
     * Get Meta data via $this->getValue() 
     */
    
    const SLUG = 'image';
    
    function __construct() {
        $this->slug = self::SLUG;
        $this->name = 'Single Image';
    }
    
    public function getHeader() {
    	return "<script>
    	jQuery(document).ready(function($){  
			$(window).bind('resize', function () { 
				$('.pagemedia.image').css('height', 'auto');
				$('.pagemedia.image img').css('height', ".$this->getHeight().").css('width', 'auto').css('marginLeft', 0).css('marginTop', 0);
				if ($(window).width() > 828) {
					$('.pagemedia.image img').imgscale({parent: '.pagemedia.image', fade: 1000});
    			} else {
                    $('.pagemedia.image img').css('width', '100%').css('height', 'auto');
				};
				if ($('.pagemedia.image img').css('visibility') == 'hidden') {
				    $('.pagemedia.image img').hide().css('visibility', 'visible').fadeIn();
			    }
			});
			$(window).trigger('resize');
    	});
    	</script>
    	<style>
    	header.container {
    	    padding-top:".($this->getHeight() - 130)."px;
    	}
    	@media only screen and (min-width: 828px) and (max-width: 1020px) {
    	    header.container {
    	        padding-top:".(($this->getHeight() - 130) * .81)."px;
    	    }
	    }
    	</style>
    	";
    }
    
    public function getBody() {
        $image = bfi_thumb($this->getImage(), array('width' => $this->getWidth(), 'height' => $this->getHeight(), 'crop' => true));
		$img = "<img class='$this->slug' src='$image'/>";
		if ($this->getLink()) {
			$link = "<a href='".$this->getLink()."' ";
			if ($this->getNewwindow()) {
				$link .= "target='_blank' ";
			}
			$img = $link.">".$img."</a>";
		}
        return "<div class='pagemedia image'>$img</div>";
    }
}
