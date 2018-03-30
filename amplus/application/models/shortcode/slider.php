<?php

class BFIShortcodeSliderModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'slider'; 
    const ALIAS = 'imageslider';
    
    public $effect = 'random';
    public $animation_speed = '500';
    public $pause_time = '5000';
    public $image1 = '';
    public $image2 = '';
    public $image3 = '';
    public $image4 = '';
    public $image5 = '';
    public $link1 = '';
    public $link2 = '';
    public $link3 = '';
    public $link4 = '';
    public $link5 = '';
    public $caption1 = '';
    public $caption2 = '';
    public $caption3 = '';
    public $caption4 = '';
    public $caption5 = '';
    
    public $width = '';
    public $height = '';
    
    public $class = '';
    public $style = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		bfi_wp_enqueue_script('nivo', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.1/jquery.nivo.slider.pack.js', array('jquery'), NULL);
        bfi_wp_enqueue_style('nivocss', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.1/nivo-slider.css', array(), NULL);
        
        $randID = 'slider'.rand(10000, 99999);
        
        $slides = '';
        for ($i = 1; $i <= 5; $i++) {
            $image = "image$i";
            $link = "link$i";
            $caption = "caption$i";
            $image = $this->$image;
            $link = $this->$link;
            $caption = $this->$caption;
            if (!$image) continue;
            $cap = str_replace("'", '&#39;', $caption); // '
            $cap = str_replace('"', '&#34;', $cap); // "
            $cap = str_replace('<', '&lt;', $cap); // <
            $slide = sprintf("<img src='%s' title='%s'/>",
                bfi_thumb($image, array('width' => $this->width, 'height' => $this->height)),
                $cap
                );
            if ($link)
                $slide = sprintf("<a href='%s'>%s</a>",
                    $link,
                    $slide
                    );
            $slides .= $slide;
        }
        
        $navTop = $this->height / 2 - 50 / 2; // manually compute for the location of the next/prev arrows
        return "
            <div class='$randID $this->class' style='width:{$this->width}px;height:{$this->height}px;$this->style' $unusedAttributeString>$slides</div>
            <script>
            jQuery(document).ready(function(\$){
                \$('.$randID').nivoSlider({
                    effect: '$this->effect',
                    animSpeed: $this->animation_speed,
                    pauseTime: $this->pause_time,
                    pauseOnHover: false,
                    slices: 6,
                    boxCols: 4,
                    boxRows: 3,
					controlNav: true,
					afterLoad: function() {
	                  	\$('.$randID').fadeIn();
	                },
					beforeChange: function() {		
						slide = \$('.$randID').data('nivo:vars').currentSlide;						
						if (\$('.$randID img:eq('+slide+')').attr('title') != '') {
							\$('.$randID .nivo-caption').fadeOut();
						}
					},
					afterChange: function() {
						slide = \$('.$randID').data('nivo:vars').currentSlide;
						if (\$('.$randID img:eq('+slide+')').attr('title') != '') {
							\$('.$randID .nivo-caption').fadeIn();
						}
					}
                })
                .unbind('hover')
                .find('.nivo-directionNav').css('display', '').end()
                .find('.nivo-prevNav, .nivo-nextNav').hide(0).end();
            });
            </script>
            ";
    }
}
