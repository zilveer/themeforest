<?php 
	get_header();
	get_sidebar();
?>

	<section id="content" class="clearfix">
	
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				get_template_part('loop/content','main');
			
			endwhile;	
			else : 
				
				get_template_part('loop/content','none');
				
			endif;
			
			echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
		?>
	
	</section>
	
<?php	
	get_footer();