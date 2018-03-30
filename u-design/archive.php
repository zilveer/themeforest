<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

$content_position = ( $udesign_options['blog_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
if ( $udesign_options['remove_archive_sidebar'] == 'yes' ) $content_position = 'grid_24';

?>

<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">
<?php       udesign_main_content_top( is_front_page() ); ?>

	    <?php if (have_posts()) : ?>

		  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php while (have_posts()) : the_post(); ?>
			    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php                           udesign_blog_entry_before(); ?>
                                <div class="entry">
<?php                               udesign_blog_entry_top(); ?>
                                    <div class="post-top">
<?php                                   udesign_blog_post_top_area_inside(); ?>
                                    </div><!-- end post-top -->
                                    <div class="clear"></div>
<?php                               udesign_blog_post_content_before(); ?>
                                    
<?php				    if ( $udesign_options['show_excerpt'] == 'yes' ) {
                                        the_excerpt(); //display the excerpt
                                        if ( $udesign_options['blog_button_text'] ) {
                                            echo do_shortcode('[read_more text="'.$udesign_options['blog_button_text'].'" title="'.$udesign_options['blog_button_text'].'" url="'.get_permalink().'" align="left"]');
                                            echo '<div class="clear"></div>';
                                        }
                                    } else {
                                        the_content( $udesign_options['blog_button_text'] );
                                    } ?>
                                    
<?php                               udesign_blog_entry_bottom(); ?>
                                </div>
<?php                           udesign_blog_entry_after(); ?>
			    </div>
<?php                       echo do_shortcode('[divider_top]'); ?>
			<?php endwhile; ?>

			<div class="clear"></div>

<?php		// Pagination
		if(function_exists('wp_pagenavi')) :
		    wp_pagenavi();
		else : ?>
		    <div class="navigation">
			    <div class="alignleft"><?php previous_posts_link() ?></div>
			    <div class="alignright"><?php next_posts_link() ?></div>
		    </div>
<?php		endif; ?>

<?php       else :
                ob_start();

		if ( is_category() ) { // If this is a category archive
			printf(__("<p class='center'>No entries were found under the %s category either because they were not published or this category has been excluded from the Blog section.</p>", 'udesign'), '<em>' . single_cat_title('',false) . '</em>');
		} else if ( is_date() ) { // If this is a date archive
			_e("<p>Sorry, but there aren't any posts with this date.</p>", 'udesign');
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<p class='center'>Sorry, but there aren't any posts by %s yet.</p>", 'udesign'), $userdata->display_name);
		} else {
			_e("<p class='center'>No posts found.</p>", 'udesign');
		}
                ?><div class="inline-search-form"><?php get_search_form(); ?></div><?php 
                
                echo do_shortcode('[message type="warning"]' . ob_get_clean() . '[/message]');
		
                
	    endif;
	    //Reset Query
	    wp_reset_query(); ?>

	    <div class="clear"></div>
<?php       udesign_main_content_bottom(); ?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->

<?php	if( ( !$udesign_options['remove_archive_sidebar'] == 'yes' ) && sidebar_exist('BlogSidebar') ) { get_sidebar('BlogSidebar'); } ?>

</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();



