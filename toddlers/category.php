<?php
/*
Archive
*/
get_header();
global $unf_options;
?>

<div id="content-wrapper" class="row clearfix categories-wrapper">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">
			<h1>
			<?php printf( __( 'Category Archives: %s', 'toddlers' ), single_cat_title( '', false ) ); ?>
			</h1>
			<?php get_template_part( 'loop','compactlist' ); ?>
			<?php get_template_part('pagination'); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>