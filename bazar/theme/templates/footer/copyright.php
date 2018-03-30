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

$footer_type = yit_get_option( 'footer-type' );

if( $footer_type == 'centered' || $footer_type == 'big-centered' || $footer_type == 'sidebar-centered' ) : ?>
    <?php do_action( 'yit_before_center_copyright' ) ?>
    <div class="centered">
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-center-text' ) ) ) ) ) ?>
    </div>
    <?php do_action( 'yit_after_center_copyright' ) ?>
<?php else : ?>
    <?php do_action( 'yit_before_left_copyright' ) ?>
    <div class="left span6">
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-left-text' ) ) ) ) ) ?>
    </div>
    <?php do_action( 'yit_after_left_copyright' ) ?>
    <div class="right span6">
        <?php echo yit_convert_tags( yit_addp( stripslashes( yit_ssl_url( yit_get_option( 'footer-right-text' ) ) ) ) ) ?>
    </div>
    <?php do_action( 'yit_after_right_copyright' ) ?>
<?php endif ?>