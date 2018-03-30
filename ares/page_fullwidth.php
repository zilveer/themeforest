<?php
/**
 * Template Name: Page Fullwidth
 * The main template file for display page.
 *
 * @package WordPress
*/


/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

get_header(); 
?>
		<br class="clear"/>

		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper fullwidth">
				
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
						
							<h2 class="widgettitle header"><?php the_title(); ?></h2>
							
							<div class="page_fullwidth">			
								<?php do_shortcode(the_content()); ?>
							</div>

					<?php endwhile; ?>
				
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
			
		</div>
		<!-- End content -->

<br class="clear"/>
<?php get_footer(); ?>