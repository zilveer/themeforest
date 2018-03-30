<?php
/*
Template Name: Template for page builder
*/
?>
<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="usercontent">		
		<?php 	
		global $pmc_data;	
		$post_custom = get_post_custom($post->ID);		
		if(isset($post_custom['page_builder'][0]) && $post_custom['page_builder'][0] != 'none'){			
			echo do_shortcode( stripslashes('[template id="'.$post_custom['page_builder'][0].'"]') );
		}
		?>	
		<?php the_content(); ?>		
	</div>
	<?php endwhile; endif; ?>
<?php get_footer(); ?>
