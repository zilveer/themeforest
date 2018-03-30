<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, this theme
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php 

if ( is_day() ) {
	$date = get_the_date();
} elseif ( is_month() ) {
	$date = get_the_date('F Y');
} elseif ( is_year() ) {
	$date = get_the_date('Y');
} else {
	$date = __("Archives",'Pixelentity Theme/Plugin');
}

?>
<?php $t->layout->pageTitle = $date; ?>
<?php $t->get_template_part("common","layout-start"); ?>
<?php $t->content->loop() ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>