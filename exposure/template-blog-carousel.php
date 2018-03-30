<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Blog Carousel
 */

add_action('thb_content_after', 'thb_blog_carousel_controls');

if( !function_exists('thb_blog_carousel_controls') ) {
	function thb_blog_carousel_controls() {
		global $wp_query;
		
		thb_get_template_part('part-nav', array(
			'controls'          => array('prev', 'next'),
			'disabled_controls' => true,
			'total_posts'       => $wp_query->found_posts
		)); 
	?>

		<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
			<div class="thb-main-sidebar">
				<div class="thb-main-sidebar-wrapper">
					<?php thb_page_sidebar(); ?>
				</div>
			</div>
		<?php endif;
	}
}

get_header(); ?>

	<?php 

		thb_post_query(array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 3
		));

	// thb_query_posts('post', array( 'ignore_sticky_posts' => 1, 'posts_per_page' => 3 )); 

?>

	<script type="text/javascript" id="pager">
		var load_url = '<?php echo add_query_arg("paged", get_query_var("paged") + 1); ?>',
			total_posts = <?php echo $wp_query->found_posts; ?>
	</script>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>
		
		<div class="thb-content-wrapper">
			<?php get_template_part('loop/blog', 'carousel'); ?>
		</div>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>