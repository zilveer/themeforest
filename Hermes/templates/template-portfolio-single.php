<?php
/**
 * The main template file for display single portfolio page.
 *
 * @package WordPress
*/


get_header(); 

?>
		<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon"><?php the_title(); ?></h1>
				</div>
			</div>
			<br class="clear"/>
		</div>
		
		</div>
		
		<div id="header_pattern"></div>
		<br class="clear"/>
		<!-- Begin content -->
		<div id="content_wrapper">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
					<div class="standard_wrapper">
						<br class="clear"/><hr/><br/>
<?php

if (have_posts()) : while (have_posts()) : the_post();

?>
							
						<?php echo do_shortcode(the_content()); ?>
						

<?php endwhile; endif; ?>

						</div>
					
				</div>
				<!-- End main content -->
				
			
			<br class="clear"/>
			
		</div>
		<!-- End content -->

<?php get_footer(); ?>