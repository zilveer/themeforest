<?php
/**
 * Your Inspiration Themes
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

global $yit_is_header;
$yit_is_header = true;

do_action( 'yit_before_logo' ) ?>

<div class="row">
	<!-- START LOGO -->
	<div id="logo" class="span7 group">
	    <?php
	    /**
	     * @see yit_logo
	     */
	    do_action( 'yit_logo' ) ?>
	</div>
	<!-- END LOGO -->
	<?php do_action( 'yit_after_logo' ) ?>

	<!-- START HEADER SIDEBAR -->
	<div id="header-sidebar" class="span5 group">
		<?php

        if ( yit_get_option( 'show-top-menu-search' ) ) {
            global $yith_wcas;
            if ( isset( $yith_wcas ) ) {
                echo do_shortcode( '[yith_woocommerce_ajax_search]' );
            }
            else {
                the_widget( 'search_mini' );
            }
        }

        ?>

        <?php if ( ! apply_filters( 'yit_disable_mini_cart', false ) ) : ?>
		    <?php if( is_shop_installed() && is_shop_enabled() ) the_widget('YIT_Widget_Cart'); ?>
        <?php endif; ?>

        <?php if( apply_filters( 'yit_header_login_register_widget', true ) ) : ?>
			<?php the_widget('login_register') ?>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div id="nav" class="span12 group">
		<!-- START MAIN NAVIGATION -->
		<?php
		/**
		 * @see yit_main_navigation
		 */
		do_action( 'yit_main_navigation') ?>
		<!-- END MAIN NAVIGATION -->

		<div id="nav-sidebar">
		<?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Nav Sidebar' ) ) { } ?>
		</div>
	</div>
</div>

<?php $yit_is_header = false; ?>