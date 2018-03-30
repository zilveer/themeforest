<?php
/**
 * Template Name: Blank page 
 *
 */
 ?>


<?php
	get_header();
?>

<div class="container blank-page">
	<div class="page-content sidebar-position-without">
		<div class="row-fluid">
			<div class="content span12">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
						
						<?php the_content(); ?>
	
				<?php endwhile; else: ?>
	
					<h1><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h1>
	
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
	
	
<?php
	get_footer();
?>