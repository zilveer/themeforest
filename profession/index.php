<?php 

	get_header();

	// Intro
	get_template_part('article', 'menu'); 

 ?>
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
				
			<?php if ( have_posts() ) { ?>
				<div class="posts <?php echo $blogClass; ?>">
					<div id="blog_loop">
						<?php  while ( have_posts() ) { the_post(); ?>
											
								<?php get_template_part('loop'); ?>
							
						<?php } ?>
					</div>
					<div id="readmore_container"></div>
				</div>
			<?php } ?>
		
			<?php  if( opt('blog_sidebar_position') != 0) get_sidebar();  ?>

			<?php if (have_posts()) { ?>

				<!--Single Page Navigation-->
				<div class="page-navigation clearfix">
					<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', TEXTDOMAIN)) ?></div>
					<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', TEXTDOMAIN)) ?></div>
				</div>
			
			<?php } ?>	
			
		</div>
	</div>
</div>
<!-- End Blog -->
<?php get_footer();