<?php
/**
 * Template Name: Page: Full
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
<?php
    $g1_bbpress_template = g1_get_theme_option( 'bbpress', 'forum_template', 'sidebar_right' );

    // Add proper body classes
    switch ( $g1_bbpress_template ) {
        case 'sidebar_right':
            add_filter( 'body_class', array(G1_Theme(), 'secondary_after_body_class') );
            add_filter( 'body_class', array(G1_Theme(), 'secondary_wide_body_class') );
            break;
        case 'sidebar_left':
            add_filter( 'body_class', array(G1_Theme(), 'secondary_before_body_class') );
            add_filter( 'body_class', array(G1_Theme(), 'secondary_wide_body_class') );
            break;
        default:
            add_filter( 'body_class', array(G1_Theme(), 'secondary_none_body_class') );
            break;
    }
?>
<?php get_header( 'bbpress' ); ?>
    <div id="primary">
        <div id="content" role="main">
            <article id="bbp-user-<?php bbp_current_user_id(); ?>" class="bbp-single-user">
                <header class="entry-header g1-move-to-precontent">
                    <div class="g1-hgroup">
                        <div id="bbp-user-avatar">
                            <a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
                                <?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 80 ) ); ?>
                            </a>
                        </div><!-- #author-avatar -->
                        <h1 class="entry-title"><?php bbp_displayed_user_field( 'display_name' ); ?></h1>
                        <h3 class="entry-subtitle"><?php bbp_user_display_role(); ?></h3>
                    </div>
                </header><!-- .entry-header -->

                <!-- BEGIN .entry-content -->
                <div class="entry-content">
                    <?php bbp_get_template_part( 'content', 'single-user' ); ?>
                </div>
            </article><!-- #bbp-user-xxx -->
        </div><!-- #content -->
    </div><!-- #primary -->
<?php
    if ( in_array( $g1_bbpress_template, array( 'sidebar_left', 'sidebar_right' ) ) ) {
        get_sidebar( 'bbpress' );
    }
    get_footer( 'bbpress' );
