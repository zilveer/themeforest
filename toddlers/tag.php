<?php
/*
Tags
*/
get_header();
global $unf_options;
?>

<div id="content-wrapper" class="row clearfix archive-wrapper">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">
			<h1>
			<?php printf( __( 'Tag Archives: %s', 'toddlers' ), single_tag_title( '', false ) ); ?>
			</h1>
			<?php get_template_part( 'loop','compactlist' ); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>