<?php
/*
Template Name: Page with Left Sidebar
*/
?>
<?php get_header(); ?>
<style type="text/css" media="screen">
/* <![CDATA[ */
.sidebar {
	background:none;
	padding: 0 30px 0 30px;
	background: transparent url('<?php echo get_stylesheet_directory_uri(); ?>/images/sidebar/sidebar_divider_left.png') repeat-y right 0;
}
/* ]]> */
</style>
<div class="page-contents-wrap float-right two-column page-contents-right">
<?php
/* Run the loop to output the page.
 * called loop-page.php
 */
get_template_part( 'loop', 'page' );
?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>