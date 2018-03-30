<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */                                                          

$slider_class = '';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

$show_text = yit_slide_get( 'show_text' );
$wrapper_class  = $show_text ? ' with-text' : '';
$wrapper_class .= $show_text ? ' ' . yit_slide_get( 'text_position' ) : '';

//$slider_class .= $show_text ? ' span9' : ' span12';
$text = $show_text ? yit_slide_get( 'text' ) : '';
?>

<?php if ( !empty( $slider_class ) ) : ?>

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

    <style type='text/css'>
        .rev_slider, .rev_slider_wrapper { width:470px; height:320px;}

        @media only screen and (min-width: 1170px)  {
            .rev_slider, .rev_slider_wrapper { width:470px; height:320px;}
        }


        @media only screen and (min-width: 1024px) and (max-width: 1169px) {
            .rev_slider, .rev_slider_wrapper { width:470px; height:320px;}
        }


        @media only screen and (min-width: 481px) and (max-width: 1023px) {
            .rev_slider, .rev_slider_wrapper { width:380px; height:258px;}
        }


        @media only screen and (min-width: 321px) and (max-width: 480px) {
            .rev_slider, .rev_slider_wrapper { width:440px; height:299px;}
        }


        @media only screen and (min-width: 0px) and (max-width: 320px) {
            .rev_slider, .rev_slider_wrapper { width:280px; height:190px;}
        }

    </style>

<?php endif; ?>
 
<!-- START SLIDER -->
<div id="slider-<?php echo $current_slider ?>"<?php yit_slider_class($slider_class) ?>> 
    <div class="shadowWrapper">
        <?php echo do_shortcode('[rev_slider ' . yit_slide_get( 'slider_name' ) . ']'); ?>
    </div>
</div>

<!-- END SLIDER -->