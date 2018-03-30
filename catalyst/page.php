<?php
/*
* Catalyst Page
*/
?>
 
<?php get_header(); ?>

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