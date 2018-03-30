<?php 
get_header(); 

$swm_blog_style = get_theme_mod( 'swm_blog_all_style', 'large-image' );
$swm_loop_type = ( $swm_blog_style == 'blog-style-grid' ) ? 'standard-grid' : 'standard';
$swm_infinite_pagination_style = ( $swm_blog_style == 'blog-style-grid' ) ? 'swm_infinite_scroll_style' : '';
?>				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> <?php echo $swm_infinite_pagination_style; ?>" >	
		<div class="swm_column swm_custom_two_third">			
			<?php get_template_part('loop', $swm_loop_type); ?>	
			<div class="clear"></div>
		</div>		
	
	<?php get_sidebar(); 	?>

	</div>	<?php
 
get_footer(); 

?>