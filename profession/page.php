<?php 

	get_header();

	// Intro
	get_template_part('article', 'menu'); 

 ?>
	
<?php if ( opt('blog_display') ) : ?>	
<!-- Blog -->
<div class="blog-content wrap">
	<div class="container">		
		<div class="row">
			<div class="blog-header span12">
				<?php if ( opt ('blog_label') ) { ?>
					<h2><?php eopt('blog_label'); ?></h2>
				<?php } ?>
			</div>
		</div>
		
		<!-- blog post items --> 
		<div class="row clearfix">
		
				<?php 
					$blogClass = 'span9';
					
					if(opt('blog_sidebar_position') == 0)
						$blogClass = 'span12';
						
				?>
				
				<?php
					$the_query = new WP_Query('&order=DEC');
					
				if ( $the_query -> have_posts() ) { ?>
					<div class="posts <?php echo $blogClass; ?>">	
						<?php  while ( $the_query->  have_posts() ) { $the_query-> the_post(); ?>
					
								<?php get_template_part('loop'); ?>
							
						<?php } ?>
					</div>
				<?php } ?>
		
		
			<?php  if( opt('blog_sidebar_position') != 0) get_sidebar();  ?>
	
		
		</div>
	</div>
</div>
<!-- End Blog -->
<?php 
	endif; 
	get_footer();