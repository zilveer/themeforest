<?php 
/*
Template Name: Blog Page
*/

get_header(); 

$blog_style = get_theme_mod( 'swm_blog_all_style', 'large-image' );
$loop_type = ( $blog_style == 'blog-style-grid' ) ? 'grid' : 'post';
$infinite_pagination_style = ( $blog_style == 'blog-style-grid' ) ? 'swm_infinite_scroll_style' : '';
?>
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> <?php echo $infinite_pagination_style; ?>" >	
		<div class="swm_column swm_custom_two_third">
			<div class="swm_standard_posts">
				<?php get_template_part('loop', $loop_type); ?>
				<div class="clear"></div>
			</div>			
		</div>

	<?php get_sidebar(); 	?>
	</div>	<?php
get_footer(); 
?>