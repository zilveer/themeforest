<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */                         

if(!class_exists('RevSlider')) return;

global $is_primary;                     

$sliderID = $this->get('slider_name');
$the_slider = new RevSlider();
$the_slider->initByMixed($sliderID);            

$slider_class = '';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';
$slider_class .= ' ' . $the_slider->getParam('slider_type');

$is_fixed = false;
if ( ! $is_primary && in_array( $the_slider->getParam('slider_type'), array( 'fixed', 'responsitive' ) ) ) $is_fixed = true;

if ( $is_fixed && ! has_action( 'yit_after_header', 'yit_slider_space' ) ) add_action( 'yit_after_header', 'yit_slider_space' );

// text align
$slider_text = yit_slide_get( 'slider_text' );
if ( $is_primary && $the_slider->getParam('slider_type') == 'fullwidth' ) $slider_text = '';
if ( !empty( $slider_text ) ) $slider_class .= ' align' . ( yit_slide_get( 'slider_align' ) == 'left' ? 'right' : 'left' ); 
?>
 
<!-- START SLIDER -->
<div class="revolution-wrapper<?php if ( $the_slider->getParam('slider_type') != 'fullwidth' ) echo ' container'; ?>">
    <div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?>> 
        <div class="shadowWrapper">

            <?php if ( !empty( $slider_text ) ) : ?>

            <style type="text/css">

                .rev_slider, .rev_slider_wrapper { width:868px; height:431px;}

                @media only screen and (min-width: 1201px)  {
                    .rev_slider, .rev_slider_wrapper { width:868px; height:431px;}
                }


                @media only screen and (min-width: 1025px) and (max-width: 1200px) {
                    .rev_slider, .rev_slider_wrapper { width:700px; height:347px;}
                }

                @media only screen and (min-width: 769px) and (max-width: 1024px) {
                    .rev_slider, .rev_slider_wrapper { width:414px; height:205px;}
                }


                @media only screen and (min-width: 500px) and (max-width: 768px) {
                    .rev_slider, .rev_slider_wrapper { width:310px; height:153px;}
                }


                @media only screen and (min-width: 330px) and (max-width: 499px) {
                    .rev_slider, .rev_slider_wrapper { width:440px; height:218px;}
                }


                @media only screen and (min-width: 0px) and (max-width: 329px) {
                    .rev_slider, .rev_slider_wrapper { width:280px; height:139px;}
                }

            </style>

            <?php endif; ?>

            <?php echo do_shortcode('[rev_slider ' . yit_slide_get( 'slider_name' ) . ']'); ?>
        </div>          
    </div>      
    
    <?php if ( !empty( $slider_text ) ) : ?>
    <div class="revolution-slider-text">
        <?php echo yit_clean_text( $slider_text ) ?>
    </div>
    <div class="clear"></div>
    <?php endif; ?>
</div>
<!-- END SLIDER -->