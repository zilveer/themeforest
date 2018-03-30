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
			<?php printf( __( 'Author Archives: %s', 'toddlers' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' ); ?>
			</h1>
			<?php get_template_part( 'loop','compactlist' ); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>