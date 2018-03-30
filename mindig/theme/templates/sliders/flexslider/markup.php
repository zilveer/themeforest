<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Markup of frontend
 *
 * @use $slider \YIT_Slider_Object The object of slider
 */

global $is_primary;

if( ! defined('YIT_SLIDER_USED') ){
    define( 'YIT_SLIDER_USED', true );
}

extract( array(
    'slider_id'  => 'slider-' . $this->index,
    'width'      => $slider->get('config-width'),
    'height'     => $slider->get('config-height'),
    'align'      => $slider->get('config-align'),
    'effect'     => $slider->get('config-effect'),
    'interval'   => $slider->get('config-interval') * 1000,
    'speed'      => $slider->get('config-speed') * 1000,
    'controlnav' => $slider->get('config-controlnav'),
) );

$width_inline  = ( empty( $width )  )  ? ( ( $is_primary ) ? "width:100%;" : '' ) : "width:{$width}px;";
$height_inline = ( empty( $height ) ) ? '' : ";height:{$height}px;";
$slider_class = '';
if ( ! $is_primary ) $slider_class = 'container';
$slider_class .= $align != '' ? ' align' . $align : '';
?>
<!-- BEGIN FLEXSLIDER SLIDER -->
<div id="<?php echo $slider_id ?>"<?php $slider->item_class($slider_class) ?> style="<?php echo $width_inline.$height_inline; ?>">

    <div class="slider-wrapper"
         data-animation="<?php echo $effect; ?>"
         data-slideshow-speed="<?php echo $interval ?>"
         data-animation-speed="<?php echo $speed ?>"
         data-touch="false"
         data-control-nav="<?php echo $controlnav != '' ? $controlnav : 'false' ?>"
         data-prev-text=""
         data-next-text="">

        <ul class="slides">
            <?php
            while( $slider->have_posts() ) : $slider->the_post() ?>
                <li>
                    <?php $slider->the( 'featured-content', array(
                        'container' => false
                    )); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<?php $slider->reset_query() ?>