<?php
/**
 * The main template file.
 *
 * This is the most generic template file in the theme.
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php get_header(); ?>

<?php $t->get_template_part("common","layout-start"); ?>
<?php // use loop-search.php template if it's a search and default loop for other cases ?>
<?php $t->content->loop(is_search() ? "search" : "") ?>
<?php $t->get_template_part("common","layout-end"); ?>

<?php get_footer(); ?>