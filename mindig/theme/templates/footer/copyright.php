<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
include_once( YIT_THEME_ASSETS_PATH . '/lib/Walker_Nav_Menu_Div.php' );

$footer_type = apply_filters( 'yit_footer_type', yit_get_option( 'footer-type' ) );

if ( $footer_type == 'centered' || $footer_type == 'big-centered' ) : ?>
    <?php do_action( 'yit_before_center_copyright' ) ?>
    <div class="centered">
        <?php
        $nav_args = array(
            'theme_location' => 'copyright_centered',
            'container' => 'none',
            'menu_class' => 'level-1 clearfix',
            'fallback_cb' => false,
            'depth' => 1,
        );

        if ( has_nav_menu( 'copyright_centered' ) )
            $nav_args['walker'] = new YIT_Walker_Nav_Menu_Div();

        wp_nav_menu( $nav_args );
        ?>
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-center-text' ) ) ) ) ) ?>


    </div>
    <?php do_action( 'yit_after_center_copyright' ) ?>
<?php else : ?>
    <?php do_action( 'yit_before_left_copyright' ) ?>
    <div class="left col-sm-6">
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-left-text' ) ) ) ) ) ?>
        <?php
        $nav_args = array(
            'theme_location' => 'copyright_left',
            'container' => 'none',
            'fallback_cb' => false,
            'menu_class' => 'level-1 clearfix',
            'depth' => 1,
        );

        if ( has_nav_menu( 'copyright_left' ) )
            $nav_args['walker'] = new YIT_Walker_Nav_Menu_Div();

        wp_nav_menu( $nav_args );
        ?>

    </div>
    <?php do_action( 'yit_after_left_copyright' ) ?>
    <div class="right col-sm-6">
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-right-text' ) ) ) ) ) ?>
        <?php
        $nav_args = array(
            'theme_location' => 'copyright_right',
            'container' => 'none',
            'fallback_cb' => false,
            'menu_class' => 'level-1 clearfix',
            'depth' => 1,
        );

        if ( has_nav_menu( 'copyright_right' ) )
            $nav_args['walker'] = new YIT_Walker_Nav_Menu_Div();

        wp_nav_menu( $nav_args );
        ?>
    </div>
    <?php do_action( 'yit_after_right_copyright' ) ?>
<?php endif ?>