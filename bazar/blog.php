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
 
/*
Template Name: Blog
*/

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$blog_type = yit_get_option( 'blog-type' );

get_header();

if($blog_type == 'pinterest') {
	wp_enqueue_script('yit-jquery-masonry');
}

do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-blog" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        <?php
	        //yit_debug( yit_get_excluded_categories() );
	        query_posts( 'cat=' . yit_theme_get_excluded_categories() . '&posts_per_page=' . get_option( 'posts_per_page' ) . '&paged=' . $paged );
	        
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