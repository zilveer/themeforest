<?php
/*
* Catalyst Tag page
*/
?>
 
<?php get_header(); ?>

<div class="contents-wrap float-left two-column">
	<h1 class="entry-title">
		<?php printf( __( 'Tag : %s', 'mthemelocal' ), '<span>' . single_cat_title( '', false ) . '</span>' );	?>
	</h1>
	<?php
		rewind_posts();
		get_template_part( 'loop', 'tag' );
	?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>