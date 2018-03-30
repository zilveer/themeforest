<?php
/*
Template Name: Blog list
*/
?>
<?php get_header(); ?>
<?php
global $pagelayout_type;
$pagelayout_type="two-column";
?>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="contents-wrap float-left two-column">
	<?php
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	query_posts('paged='.$paged.'&posts_per_page=');
	?>
	<div class="entry-content-wrapper">
	<?php get_template_part( 'loop', 'blog' ); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>