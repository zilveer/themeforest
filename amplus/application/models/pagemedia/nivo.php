<?php

class BFIPagemediaNivoModel extends BFIPagemediaModel implements iBFIPagemedia {
    
    /*
     * Get Meta data via $this->getValue()
     */
    
    const SLUG = 'nivo';
    
    function __construct() {
        $this->slug = self::SLUG;
        $this->name = 'Nivo Slider';
    }
    
    public function getHeader() {
		bfi_wp_enqueue_script('nivo', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.1/jquery.nivo.slider.pack.js', array('jquery'), NULL, true);
        bfi_wp_enqueue_style('nivocss', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.1/nivo-slider.css', array(), NULL);

		$numSlides = 0;
		$style = '';
		for ($i = 1; $i <= 10; $i++) {
			$image = "getImage$i";
			$caption = "getCaption$i";
			$subcaption = "getSubcaption$i";
			$location = "getCaptionlocation$i";
			if (!$this->$image()) continue;
			$numSlides++;
			$textcolor = "getTextcolor$i";
			$captionbg = "getCaptionbg$i";
			$bg = str_replace('#', '', $this->$captionbg());
		$bg = hexdec(substr($bg, 0, 2)) .','. hexdec(substr($bg, 2, 2)) .','. hexdec(substr($bg, 4, 2));
            if ($this->$location() == "l") {
                $location = "left: 30px;";
            } else {
                $location = "right: 30px; left: auto; text-align: right;";
            }
			$style .= ".nivo-caption.slide-".($numSlides-1).", .nivo-caption.slide-".($numSlides-1)." h1 {
					color: ".$this->$textcolor()." !important;
				}
				.nivo-caption.slide-".($numSlides-1)." {
				    $location
				}
				";
		}
		
		// add the padding for the content
		$style .= "
    	header.container {
    	    padding-top:".($this->getHeight() - 130)."px;
    	}
    	@media only screen and (min-width: 828px) and (max-width: 1020px) {
    	    header.container {
    	        padding-top:".(($this->getHeight() - 130) * .81)."px;
    	    }
    	}";
    	
		$style = $style ? "<style>$style</style>" : $style;
		return $style;
    }
    
    public function getBody() {
        // <div class='slider-wrapper theme-default' style='height: {$this->getHeight()}px;'>
		$sideWidth = 1;
		$numSlides = 0;
        $slides = '';
		$wrapperWidth = $this->getCaptiontype() == "side" ? $sideWidth * 100 : 100;
        for ($i = 1; $i <= 10; $i++) {
            $image = "getImage$i";
            $caption = "getCaption$i";
			$subcaption = "getSubcaption$i";
            if (!$this->$image()) continue;
			$numSlides++;
			$title = '';
			if ($this->$caption()) {
				$title .= "<h1>".$this->$caption()."</h1>";
			}
			if ($this->$subcaption()) {
				$title .= do_shortcode($this->$subcaption());
			}
            $title = str_replace("'", '&#39;', $title); // '
            $title = str_replace('"', '&#34;', $title); // "
            $title = str_replace('<', '&lt;', $title); // <
						// $string = $title ? "<img src='%s' title='%s'/>" : "<img src='%s'%s/>";
            $slides .= sprintf("<img src='%s' title='%s'/>", 
                bfi_thumb($this->$image(), array('width' => $this->getCaptiontype() == "side" ? $this->getWidth() * $sideWidth : $this->getWidth(), 'height' => $this->getHeight(), 'crop' => true)),
                addslashes($title)
                );
        }
				$controlNav = $numSlides > 1 ? "true" : "false";
        $content = "
        <div class='slider-wrapper theme-default' style='width: $wrapperWidth%;'>
            <div class='nivoSlider'>{content}</div>
            <div class='nivoCaptionSpacer'></div>
        </div>
        <script>
        jQuery(document).ready(function($) {
            \$('#heading-box .nivoSlider').nivoSlider({
                effect: '{$this->getEffect()}',
                animSpeed: {$this->getAnimation()},
                pauseTime: {$this->getPause()},
                controlNav: {$controlNav},
					directionNav: false,
					controlNavThumbs: false,
                captionOpacity: 1.0,
                afterLoad: function() {
					slide = \$('#heading-box .nivoSlider').data('nivo:vars').currentSlide;
					\$('#heading-box .nivo-caption').attr('class', 'nivo-caption slide-'+slide);
                  	\$('header .nivoSlider').fadeIn();
                    // \$('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);
                  	setTimeout(\"jQuery('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);\", 100);
                },
				beforeChange: function() {		
					slide = \$('#heading-box .nivoSlider').data('nivo:vars').currentSlide;
					var nextSlide = slide + 1 >= \$('#heading-box .nivoSlider').data('nivo:vars').totalSlides ? 0 : slide+1;
					\$('#heading-box .nivo-caption').attr('class', 'nivo-caption slide-'+(nextSlide));
					if (\$('#heading-box .nivoSlider img:eq('+slide+')').attr('title') != '') {
					    \$('#heading-box .nivo-caption').hide(); // just hide asap since colors will flicker
					}
                  	setTimeout(\"jQuery('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);\", 100);
				},
				afterChange: function() {
					slide = \$('#heading-box .nivoSlider').data('nivo:vars').currentSlide;
					\$('#heading-box .nivo-caption').attr('class', 'nivo-caption slide-'+slide);
					if (\$('#heading-box .nivoSlider img:eq('+slide+')').attr('title') != '') {
						\$('#heading-box .nivo-caption').fadeIn();
					}
                    // \$('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);
                  	setTimeout(\"jQuery('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);\", 100);
				}
				//$('.nivoSlider').data('nivo:vars').currentSlide
            });    
			setTimeout(\"jQuery('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);\", 500);
		    \$('.nivo-main-image').css('height', '100%');
			\$(window).resize(function() {
			    \$('.nivo-caption').vAlign().css('paddingTop', parseInt(jQuery('.nivo-caption').vAlign().css('paddingTop'))-20);
			    \$('.nivo-main-image').css('height', '100%');
		    });
        });
        </script>
        ";
        $content = str_replace('{content}', $slides, $content);
        return $content;
    }
}
