<?php 
	/*
	Template Name: Maintenance
	*/
	get_header('maintenance');
	the_post();
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class('page-maintenance'); ?>>
		
		<a href="<?php echo home_url(); ?>">
			<?php if( get_option('custom_logo') ) : ?>
				<img src="<?php echo get_option('custom_logo'); ?>" alt="<?php echo get_option('custom_logo_alt_text'); ?>" class="retina" />
			<?php else : ?>
				<?php echo bloginfo('title'); ?>
			<?php endif; ?>
		</a>
		
		<?php echo '<br /><span>' . get_bloginfo('description') . '</span>'; ?>
		
		<div class="break-40"></div>
		
		<?php the_content(); ?>
	
	</article>
	
</section>

<?php	
	get_footer('maintenance');