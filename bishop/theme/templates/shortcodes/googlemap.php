<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$full_width = ( $full_width == "yes" ) ? true : false;
$css = "";

if( ! $full_width ){
    if( $width != '' && $width != 0 ){
        $css .= "width: " . $width . "px;";
    } else{
        $css .= "width: auto;";
    }
}

if( $height != '' && $height != 0 ){
    $css .= "height: " . $height . "px;";
} else{
    $css .= "height: 380px;";
}

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';
 ?>

<div class="google-map-frame <?php echo esc_attr( $animate . $vc_css ) ?><?php echo ( $full_width ) ? "full-width" : "" ?>" <?php echo $animate_data ?> style="<?php echo $css?>" >
    <div class="inner">
	    <iframe <?php if ($width != '' && $height != '') : ?>width="<?php echo $width; ?>" <?php else: ?>style="width: 100%;"<?php endif; ?> height="<?php echo $height; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $src; ?>&amp;output=embed&amp;noscroll=1" ></iframe>
        <?php if( ! empty( $address ) || ! empty( $info ) ): ?>
        <div class="map_info">
            <div class="row">
                <div class="container_map_box_info col-sm-4">
                    <div class="map_box_info">
                        <?php if( ! empty( $address ) ) echo "<h4>".$address."</h4>"; ?>
                        <?php if( ! empty( $info ) ) echo "<p>".nl2br($info)."</p>"; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<div class="shadow-thumb-sidebar"></div>
</div>