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

if( is_product_attribute() ) {

    if( function_exists('wc_get_template_part') ) {
        wc_get_template( 'archive-product.php' );
    } else {
        woocommerce_get_template( 'archive-product.php' );
    }

    die;
}

$paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;
$blog_type = yit_get_option( 'blog-type' );

get_header();

if($blog_type == 'pinterest' && ( is_home() || is_category() || is_tag() || is_search() )) {
    wp_enqueue_script('yit-jquery-masonry');
}

do_action( 'yit_before_primary' ) ?>
    <!-- START PRIMARY -->
    <div id="primary" class="<?php yit_sidebar_layout() ?>">
        <div class="container group">
            <div class="row">
                <?php do_action( 'yit_before_content' ) ?>
                <!-- START CONTENT -->
                <div id="content-index" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
                    <?php
                    global $wp_query;

                    $wp_query->set( 'posts_per_page', get_option( 'posts_per_page' ) );
                    $wp_query->set( 'paged', $paged );

                    do_action( 'yit_loop' );

                    comments_template();
                    ?>
                </div>
                <!-- END CONTENT -->
                <?php do_action( 'yit_after_content' ) ?>

                <?php get_sidebar() ?>

                <?php do_action( 'yit_after_sidebar' ) ?>
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>