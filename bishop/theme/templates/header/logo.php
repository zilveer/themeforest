<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$width_tagline = ( yit_get_option( 'header-logo-tagline' ) == 'yes' ) ? 'with_tagline' : 'no-tagline';
?>

<!-- START LOGO -->
<div id="logo" class="<?php echo $width_tagline ?>" >

    <?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>

        <?php the_custom_logo() ?>

    <?php elseif( yit_get_option( 'header-custom-logo' ) == 'yes' && yit_get_option( 'header-custom-logo-image' ) != '' ) : ?>

        <a id="logo-img" href="<?php echo home_url() ?>" title="<?php bloginfo( 'name' ) ?>">
            <?php $size = @getimagesize(yit_get_option( 'header-custom-logo-image' )); ?>
            <img src="<?php echo yit_ssl_url( yit_get_option( 'header-custom-logo-image' ) ) ?>" <?php if( yit_get_option( 'logo-retina-url' ) ): ?>data-at2x="<?php echo yit_ssl_url( yit_get_option( 'logo-retina-url' ) ) ?>"<?php endif ?>title="<?php bloginfo( 'name' ) ?>" alt="<?php bloginfo( 'name' ) ?>" <?php if( !empty($size) && isset($size[3] ) ) echo $size[3] ?> />
        </a>

    <?php else : ?>
        <a id="textual" href="<?php echo home_url() ?>" title="<?php echo str_replace( array( '[', ']' ), '', bloginfo( 'name' ) ) ?>">
            <?php echo yit_decode_title( get_bloginfo( 'name' ) ) ?>
        </a>
    <?php endif ?>

    <?php

       if( yit_get_option( 'header-logo-tagline' ) == 'yes' ):
        $class = array();
        if ( strpos( get_bloginfo( 'description' ), '|') ) $class[] = 'multiline';
        if ( yit_get_option('header-logo-tagline-mobile') == 'no' ) $class[] = 'hidden-xs';
        $class = ! empty( $class ) ? ' class="' . implode( $class, ' ' ) . '"' : '';
        ?>
        <?php yit_string( "<p id='tagline'{$class}>", yit_decode_title( get_bloginfo( 'description' ) ), '</p>' );?>
    <?php endif ?>

</div>
<!-- END LOGO -->

