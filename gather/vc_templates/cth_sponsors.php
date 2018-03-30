<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $sponsorsimgs
 * @var $content
 * @var $slidestoshow
 * @var $arrows
 * @var $dots
 * @var $centermode
 * @var $autoplay
 * @var $responsive
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Sponsors
 */
$el_class = $sponsorsimgs = $slidestoshow = $arrows = $dots = $centermode = $autoplay = $responsive = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(!empty($sponsorsimgs)){
    $sponsors = explode(",", $sponsorsimgs);
    if(!empty($content)){
        $sponsorslinks = preg_split( '/\r\n|\r|\n/', strip_tags($content) );//explode("\n", $content);
    }

    if(!empty($sponsors)) : 
        $options = new stdClass;
        if(!empty($slidestoshow)){
            $options->slidesToShow = (int)$slidestoshow;
        }else{
            $options->slidesToShow = 3;
        }
        if($arrows == 'false'){
            $options->arrows = false;
        }
        if($dots == 'true'){
            $options->dots = true;
        }
        if($centermode == 'true'){
            $options->centerMode = true;
        }
        if($autoplay == 'true'){
            $options->autoplay = true;
        }

        if(!empty($responsive)){
            $options->responsive = array();
            $v_s = explode("|", $responsive);
            if(!empty($v_s)){
                foreach ($v_s as $vs_v) {
                    $v_s_v = explode(":", $vs_v);
                    $res = new stdClass;
                    $res->breakpoint = (int)$v_s_v[0];
                    $res->settings = new stdClass;
                    if($arrows == 'false'){
                        $res->settings->arrows = false;
                    }
                    if($dots == 'true'){
                        $res->settings->dots = true;
                    }
                    if($centermode == 'true'){
                        $res->settings->centerMode = true;
                    }
                    if($autoplay == 'true'){
                        $res->settings->autoplay = true;
                    }
                    $res->settings->slidesToShow = (int)$v_s_v[1];
                    $res->settings->centerPadding = '40px';
                    $options->responsive[] = $res;
                }
            }
        }

    ?>

<div class="sponsor-slider <?php echo esc_attr($el_class );?>" data-slick='<?php echo json_encode($options);?>'>
<?php foreach ($sponsors as $key => $img) {
    ?>
    <div>
    <?php 
    if(isset($sponsorslinks[$key])) :?>
        <a href="<?php echo esc_url($sponsorslinks[$key] );?>" target="_blank">
    <?php endif;?>
            <?php echo wp_get_attachment_image( $img, 'full', false, array('class'=>'img-responsive center-block') );?>
    <?php 
    if(isset($sponsorslinks[$key])) :?>
        </a>
    <?php endif;?>
    </div>
<?php
} ?>
</div>
<?php
    endif;
}

?>