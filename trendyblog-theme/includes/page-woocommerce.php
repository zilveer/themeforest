<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();


?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
	    <?php if (have_posts()) : ?>
	   	 	<?php get_template_part(THEME_SINGLE."page-title"); ?>
	        <?php woocommerce_content(); ?>
		<?php else: ?>
			<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
	<?php get_template_part(THEME_LOOP."loop-end"); ?>

