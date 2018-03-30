<?php
/**
 * The Template for displaying 404 pages (Not Found).
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

            <article id="post-0">
                <header class="entry-header">
                    <div class="g1-hgroup">
                        <h1 class="entry-title"><?php _e( 'Oops!', 'g1_theme' ); ?></h1>
                        <h3 class="entry-subtitle"><?php _e( 'This page was not found', 'g1_theme' ); ?></h3>
                    </div>
                </header>

                <div class="entry-content">
                    <div class="g1-grid" id="error404">
                        <div class="g1-column g1-one-third" data-g1-delay="">
                            <i class="fa fa-search"></i>
                            <h2><?php _e( 'Search Our Website', 'g1_theme' ); ?></h2>
                            <?php get_search_form(); ?>
                        </div>

                        <div class="g1-column g1-one-third" data-g1-delay="">
                            <i class="fa fa-envelope"></i>
                            <h2><?php _e( 'Report a Problem', 'g1_theme' ); ?></h2>
                            <p><?php printf( __( 'Please write some descriptive information about your problem, and email our <a href="mailto:%s">webmaster</a>.', 'g1_theme' ), antispambot( get_option( 'admin_email' ), true ) ); ?></p>
                        </div>

                        <div class="g1-column g1-one-third" data-g1-delay="">
                            <i class="fa fa-home"></i>
                            <h2><?php _e( 'Back to the Homepage', 'g1_theme' ); ?></h2>
                            <p><?php printf( __( 'You can also <a href="%s">go back to the homepage</a> and start browsing from there.', 'g1_theme' ), home_url() ); ?></p>
                        </div>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>