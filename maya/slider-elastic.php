<?php
/**
 * @package WordPress
 * @subpackage Diverso
 * @since 1.0
 */

if ( yiw_is_empty() )
    return;

$thumbs = '';
?>

 		<!-- BEGIN #slider -->
        <div id="slider" class="ei-slider elastic <?php echo yit_slider_mobile_hide_class()?>">
            <div class="ei-slider-loading">Loading</div>
            <ul class="ei-slider-large">

                <?php while( yiw_have_slide() ) :
                    global $yit_image;
                    $thumbnail = $yit_image->image( array(
                        'src' => yiw_slide_get('image_url'),
                        'size' => 'thumb-slider-elastic',
                        //'output' => 'url',
                        'alt'  => strip_tags(yiw_slide_get( 'slide_title' ))." - ".strip_tags(yiw_slide_get( 'clean-content' ))
                    ) );

                    $thumbs .= "<li><a href=\"#\">".strip_tags(yiw_slide_get( 'slide_title' ))." - ".strip_tags(yiw_slide_get( 'clean-content' ))."</a>$thumbnail</li>\n"; ?>

                <li<?php yiw_slide_class( 'slide align-' . yiw_slide_get( 'layout_slide' ) ) ?>>
                    <?php yiw_slide_the( 'featured-content', array(
                         'container' => false
                      ) ) ?>
                    <div class="ei-title">
                        <?php yiw_string_( '<h2>', yiw_slide_get( 'title' ), '</h2>' ) ?>
                        <?php yiw_string_( '<h3>', yiw_slide_get( 'clean-content' ), '</h3>' ) ?>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul><!-- ei-slider-large -->
            <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">Current</li>
                <?php echo $thumbs ?>
            </ul><!-- ei-slider-thumbs -->

            <div class="shadow"></div>
        </div><!-- ei-slider -->
 		<!-- END #slider -->