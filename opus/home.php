<?php get_header(); ?>
	<div class="usercontent">		
		<?php 	
		global $pmc_data;				
		echo do_shortcode( stripslashes('[template id="'.$pmc_data['blog_content'].'"]') );
		?>	
	</div>
<?php get_footer(); ?>
