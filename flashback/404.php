<?php get_header(); ?>

<div id="<?php the_ID(); ?>" class="inner center">

	<h1><?php _e("Page Doesn't Exist", "shorti"); ?></h1>
	
	<p><?php _e("Click the logo or the button below to go back home.", "shorti"); ?></p>
	
	<a href="<?php echo home_url("/"); ?>" class="btn"><?php _e("Return Home", "shorti"); ?></a>
	
</div>

<?php get_footer(); ?>