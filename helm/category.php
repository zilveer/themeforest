<?php
/*
* Category List
*/
?>
<?php get_header(); ?>
<h1 class="entry-title">
	<?php printf( __( 'Category : %s', 'mthemelocal' ), '<span>' . single_cat_title( '', false ) . '</span>' );	?>
</h1>
<div class="contents-wrap float-left two-column">
<?php
	if ( have_posts() )
		the_post();
?>
	<div class="entry-content-wrapper">

		<?php
		rewind_posts();
			get_template_part( 'loop', 'category' );
		?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>