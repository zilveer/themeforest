<?php
get_header();
global $unf_options; ?>

	<div id="content-wrapper" class="row clearfix">
		<?php get_template_part( 'loop', 'page' ); ?>
		<?php get_sidebar('page'); ?>
	</div>

<?php get_footer(); ?>