<?php
/*
*  Page
*/
?>
 
<?php get_header(); ?>
<?php if ( is_front_page() ) { ?>
	<h2 class="entry-title"><?php the_title(); ?></h2>
<?php } else { ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
<?php } ?>
<div class="page-contents-wrap float-left two-column">
<?php
/* Run the loop to output the page.
 * called loop-page.php
 */
get_template_part( 'loop', 'page' );
?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>