<?php
get_header();
global $unf_options;
?>
<div id="content-wrapper" class="row clearfix">
	<div id="content" class="col-md-8 column">

		<?php get_template_part( 'loop-single' ); ?>

	</div>
	<?php get_sidebar('single'); ?>
</div>

<?php get_footer(); ?>